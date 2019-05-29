<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //load model item
        $this->load->model('product_m', 'item');
        //load model category_item
        $this->load->model('product_category_m', 'category_item');
    }

    public function index() {
        //get list item
        $list = $this->item->get_list();
        foreach($list as $row) {
            $obj_product_category = $this->category_item->get_info($row->cid);
            $row->name_category = $obj_product_category->vn_name;
        }
        $this->data['list'] = $list;
        //get category item
        $input = array();
        $input['where'] = array('pid' => 0);
        $catalogs = $this->category_item->get_list($input);

        foreach ($catalogs as $row) {
            $input['where'] = array('pid' => $row->id);
            $subs = $this->category_item->get_list($input);
            $row->subs = $subs;
        }       
        $this->data['catalogs'] = $catalogs;

        $this->data['title'] = 'Danh sách sản phẩm';
        $this->data['temp'] = 'product/index';
        $this->load->view('admin/main', $this->data);
    }

    public function detail($id = 0) {
        //phpinfo();die();
        $input = array();
        $input['where'] = array('pid' => 0, 'status' => 1);
        
        $input['order'][0] = 'position';
        $input['order'][1] = 'ASC';
        
        $catalogs = $this->category_item->get_list($input);
        foreach ($catalogs as $row) {
            $input['where'] = array('pid' => $row->id, 'status' => 1);
            $subs = $this->category_item->get_list($input);
            $row->subs = $subs;
        }
        $this->data['catalogs'] = $catalogs;
        if($id){
            $info = $this->item->get_info($id);
            if(!empty($info)){
                $this->data['info'] = $info;
            }else{
                $this->session->set_flashdata('message', 'Dịch vụ muốn chỉnh sửa không tồn tại');
                redirect(base_url() . 'admincp/product/index/');
            }
        }

        if ($this->input->post()) {
            
            $this->form_validation->set_rules('vn_name', 'Tên sản phẩm', 'required');

            if ($this->form_validation->run()) {

                #Tạo folder upload theo ngày truoc khi upload
                $upload_path = ROOT_PATH . '/uploads/images/product/';

                $upload_data = $this->system_library->upload($upload_path, 'image_link');

                $image_link = '';

                //Xử lý hình ảnh của sản phẩm và sản phẩm kèm theo
                if ($upload_data != NULL && !isset($info->image_link)) {
                    $image_link = $upload_data;
                    //$this->system_library->resize_image('force', $upload_path . $image_link, $upload_path . '400_400/' . $image_link, 500, 500);
                    //@unlink($upload_path . $image_link);
                } elseif ($upload_data != NULL && $info->image_link) {
                    $image_link = $upload_data;
                    //@unlink($upload_path . '400_400/' . $info->image_link);
                    //@unlink($upload_path . '400_400/' . $info->image_link);
                    @unlink($upload_path . $info->image_link);
                    //$this->system_library->resize_image('crop', $upload_path . $image_link, $upload_path . '400_400/' . $image_link, 500, 500);
                    //@unlink($upload_path . $image_link);
                } else {
                    $image_link = $info->image_link;
                }
                
                //upload cac anh kem theo
                $image_list = array();
                $image_list = $this->system_library->upload_file($upload_path, 'image_list');
                $price = $this->input->post('price');
                $sale_price = $this->input->post('sale_price');
                $files = $_FILES['image_list'];
                $arrNameFile = $files['name'];
                // khai báo các mảng insert
                $price_insert = array();
                $sale_price_insert = array();
                $name_insert = array();
                // kiểm tra trường hợp insert
                if (!isset($info->image_list)) {
                    foreach ($arrNameFile as $k => $name) {
                        if (!empty($name) && $price[$k]) {
                            $img = addslashes((time() . "_" . $this->system_library->filterName($name)));
                            $tmp_img = $files['tmp_name'][$k];
                            // Thực hiện upload và lưu vào biến tạm
                            move_uploaded_file($tmp_img, $upload_path . $img);
                            $price_insert[] = $price[$k];
                            $sale_price_insert[] = $sale_price[$k];
                            $name_insert[] = $img;
                        }
                    }
                } elseif ($info->image_list) {// kiểm tra trường hợp update
                     $info_image_list = json_decode($info->image_list);
                     $info_price = json_decode($info->price);
                     $info_sale_price = json_decode($info->sale_price);
                     foreach ($arrNameFile as $k => $name) {
                            if (isset($info_price[$k])) $info_price[$k] = $price[$k];
                            if (isset($info_sale_price[$k])) $info_sale_price[$k] = $sale_price[$k];
                            if (!empty($name) && !empty($price[$k])) {
                                $img = addslashes((time() . "_" . $this->system_library->filterName($name)));
                                $tmp_img = $files['tmp_name'][$k];
                                // Thực hiện upload và lưu vào biến tạm
                               move_uploaded_file($tmp_img, $upload_path . $img);
                                
                                if (isset($info_image_list[$k])) {
                                    @unlink($upload_path . $info_image_list[$k]);
                                    $info_image_list[$k] = $img;
                                }else {
                                    array_push($info_price, $price[$k]);
                                    array_push($info_sale_price, $sale_price[$k]);
                                    array_push($info_image_list, $img);
                                }
                            }
                        }
                        $price_insert = $info_price;
                        $sale_price_insert = $info_sale_price;
                        $name_insert = $info_image_list;
                }

                //Kết thúc xử lý hình ảnh
                $slug = $this->input->post('vn_slug', true);
                $i = 0;
                $dup = 1;
                while ($dup) {
                    $dup = $this->item->check_exists(array('id <>' => $id, 'vn_slug' => $slug . ($i ? '-' . $i : '')));
                    if ($dup)
                        $i++;
                }
                $slug .= $i ? '-' . $i : '';
                $cid = $this->input->post('cid', true);

                $data = array(
                    'cid' => $cid,
                    'vn_name' => $this->input->post('vn_name', true),
                    'vn_slug' => $slug,
                    'vn_keyword' => $this->input->post('vn_keyword', true),
                    'vn_title' => $this->input->post('vn_title', true),
                    'vn_description' => $this->input->post('vn_description', true),
                    'price' => json_encode($price_insert),
                    'sale_price' => json_encode($sale_price_insert),
                    'code' => $this->input->post('code', true),
                    'vn_sapo' => $this->input->post('vn_sapo', true),
                    //'vn_detail' => $this->input->post('vn_detail', true),
                    'tinh_nang' => $this->input->post('tinh_nang'),
                    'thanh_phan' => $this->input->post('thanh_phan'),
                    'huong_dan' => $this->input->post('huong_dan'),
                    'image_link' => $image_link,
                    'image_list' => json_encode($name_insert),
                    'is_home' => $this->input->post('is_home', true),
                    'is_pay' => $this->input->post('is_pay', true),
                    'status' => $this->input->post('status', true),
                    'created' => now(),
                );
                
                if (!$id) {
                    if ($this->item->create($data)) {
                        $this->session->set_flashdata('message', 'Thêm sản phẩm thành công');
                    } else {
                        $this->session->set_flashdata('message', 'Thêm sản phẩm thất bại');
                    }
                } else {
                    if ($this->item->update($id, $data)) {
                        $this->session->set_flashdata('message', 'Cập nhật sản phẩm thành công');
                    } else {
                        $this->session->set_flashdata('message', 'Cập nhật sản phẩm thất bại');
                    }
                }
				
				//die();

                if ($pid) {
                    redirect(base_url('admincp/product?id=&vn_name=&cid=' . $cid));
                } else {
                    redirect(base_url() . 'admincp/product/index/');
                }
            }
        }

        if($id){
            $this->data['title'] = 'Chỉnh sản phẩm';
        }else{
            $this->data['title'] = 'Thêm sản phẩm';
        }

        $this->data['temp'] = 'product/detail';
        $this->load->view('admin/main', $this->data);
    }

    public function config() {

        $name = $this->input->post('name', true); //name obj

        $action = $this->input->post('key', true); //'del_all';

        $id = $this->input->post('id', true);

        $ids = $this->input->post('ids', true); //array(4, 5, 6);

        if ($ids) {
            $array_id = implode(',', $ids);

            $input = 'id IN (' . $array_id . ')';
        }

        $status = 0;
        $msg    = '';

        switch ($action) {
            case 'del': 
                if ($this->item->update($id, array('status' => 3))) {
                    $msg = 'Xóa ' . $name . ' thành công';
                    $status = 3;
                    
                }else {
                    $msg = 'Xóa' . $name . ' không thành công';                   
                }                
                break;
            case 'del_all':
                if ($this->item->update_rule($input, array('status' => 3))) {
                    $msg = 'Xóa ' . count($ids). ' ' . $name . ' thành công';
                    $status = 3;                   
                }else {
                    $msg = 'Xóa ' . $name . ' không thành công';
                }
                break;
            case 'enable':
                if ($this->item->update($id, array('status' => 1))) {
                    $msg = 'Hiển thị ' . $name . ' thành công';
                    $status = 1;
                    
                }else {
                    $msg = 'Hiển thị ' . $name . ' không thành công';
                }
                break;
            case 'enable_all':
                if ($this->item->update_rule($input, array('status' => 1))) {
                    $msg = 'Hiển thị ' . count($ids). ' ' . $name . ' thành công';
                    $status = 1;                   
                }else {
                    $msg = 'Hiển thị ' . $name . ' không thành công';
                }
                break;
            case 'disable':
                if ($this->item->update($id, array('status' => 2))) {
                    $msg = 'Ẩn ' . $name . ' thành công';
                    $status = 2;
                    
                }else {
                    $msg = 'Ẩn' . $name . ' không thành công';
                }
                break;

            case 'disable_all':
                if ($this->item->update_rule($input, array('status' => 2))) {
                    $msg = 'Ẩn ' . count($ids). ' ' . $name . ' thành công';
                    $status = 2;                   
                }else {
                    $msg = 'Ẩn ' . $name . ' không thành công';
                }
                break;
        }
        //return string JSON
        echo json_encode(array('msg' => $msg, 'status' => $status));
    }

    public function clean_trash() {

        $where['where'] = array(
            'status' => 3
        );
        $check_del = $this->item->get_list($where);

        if ($check_del) {

            if ($this->item->del_rule("status = 3")) {
                $this->session->set_flashdata('message', 'Dọn rác thành công');
            }
        } else {
            $this->session->set_flashdata('message', 'Không có gì trong thùng rác');
        }

        redirect(base_url('admincp/product'));
    }
    
    function search() {
    
        if ($this->uri->rsegment('3') == 1) {
            //lay du lieu tu autocomplete
            $key = $this->input->get('term');
        } else {
            $key = $this->input->get('key-search');
        }
    
        $this->data['key'] = trim($key);
        $input = array();
        $input['like'] = array('vn_name', $key);
    
        $province_id = $this->input->get('province_id');
        if ($province_id) {
            $input['where'] = array('province_id' => $province_id);
        }
        $cid = $this->input->get('cid');
        if ($cid) {
            $input['where'] = array('cid' => $cid);
        }
    
        $list = $this->item->get_list($input);
        $this->data['list_product'] = $list;
    
        $breadcrumb = array(
            array(
                'url' => '#',
                'name' => 'Tìm kiếm'
            )
        );
    
        $this->data['breadcrumb'] = $breadcrumb;
    
        if ($this->uri->rsegment('3') == 1) {
            //xu ly autocomplete
            $result = array();
            foreach ($list as $row) {
                $item = array();
                $item['id'] = $row->id;
                $item['label'] = $row->name;
                $item['value'] = $row->name;
                $result[] = $item;
            }
            //du lieu tra ve duoi dang json
            die(json_encode($result));
        } else {
            //load view
            $this->data['temp'] = 'product/search';
            $this->one_col($this->data);
        }
    }
    
    
    

}
