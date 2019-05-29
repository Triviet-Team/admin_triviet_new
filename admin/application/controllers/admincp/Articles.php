<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('articles_m');

        $this->load->model('articles_category_m', 'category');
    }

    public function index() {

        //kiem tra co thuc hien loc du lieu hay khong
        $input = array();
        $data  = array(); 
        $id = $this->input->get('id');
        $data['id'] = $id;
        $id = intval($id);
        if ($id > 0) {
            $input['where']['id'] = $id;
        }

        $cid = $this->input->get('cid');
        $data['cid'] = $cid;
        $cid = intval($cid);
        if ($cid > 0) {
            $input['where']['cid'] = $cid;
        }

        $name = $this->input->get('vn_title');
        $data['vn_title']       = $name;
        if($name){
            $input['like']      = array('vn_title', $name );
        }

        $total_rows = $this->articles_m->get_total($input);
        $this->data['total_rows'] = $total_rows;
        $getData = array('id' => $id, 'vn_title' => $name, 'cid' => $cid);

        //load ra thu vien phan trang
        $config = array();
        $config['total_rows'] = $total_rows; //tong tat ca cac san pham tren website
        $config['base_url'] = base_url('admincp/articles');
        $config['suffix'] = '?' . http_build_query($getData, '', "&amp;");
        $config['first_url'] = $config['base_url'] . '?' . http_build_query($getData, '', "&amp;");
        $config['per_page'] = 20; //so luong san pham hien thi tren 1 trang
        $config['num_links'] = $total_rows;

        $config = array_merge($config, $this->system_library->pagination());

        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(3);
        $segment = intval($segment);

        $input['limit'] = array($config['per_page'], $segment);

        $this->data['list'] = $this->articles_m->get_list($input);


        $where = array();

        $where['where'] = array('pid' => 0, 'status' => 1);
        $catalogs = $this->category->get_list($where);
        foreach ($catalogs as $row) {
            $where['where'] = array('pid' => $row->id, 'status' => 1);
            $subs = $this->category->get_list($where);
            $row->subs = $subs;
        }

        $this->data['filter'] = $data;
        $this->data['categorys'] = $catalogs;

        $this->data['title'] = 'Danh sách chung';

        $this->data['temp'] = 'articles/index';
        $this->load->view('admin/main', $this->data);
    }

    public function detail($id = 0) {
        $input = array();
        $input['where'] = array('pid' => 0, 'status' => 1);
        $catalogs = $this->category->get_list($input);
        foreach ($catalogs as $row) {
            $input['where'] = array('pid' => $row->id, 'status' => 1);
            $subs = $this->category->get_list($input);
            $row->subs = $subs;
        }

        $this->data['catalogs'] = $catalogs;

        $info = $this->articles_m->get_info($id);

        $this->data['info'] = $info;


        if ($this->input->post()) {

            $this->form_validation->set_rules('vn_name', 'Tên bài viết', 'required');

            $this->form_validation->set_rules('cid', 'Danh mục bài viết', 'required');

            if ($this->form_validation->run()) {

                #Tạo folder upload theo ngày truoc khi upload
                $upload_path = 'uploads/images/news/1024_512/';

                $upload_data = $this->system_library->upload($upload_path, 'image');

                $image_link = '';

                $cid = $this->input->post('cid', true);
                
                if ($upload_data != NULL && !isset($info->image_link)) {                    
                    $image_link = $upload_data;
                    //$this->system_library->resize_image('crop', $upload_path . $image_link, $upload_path . '1024_512/' . $image_link, 400, 327);
                    //@unlink($upload_path . $image_link);
                
                } elseif ($upload_data != NULL && $info->image_link) {
                    $image_link = $upload_data;
                    @unlink($upload_path . '1024_512/' . $info->image_link);
                    //$this->system_library->resize_image('crop', $upload_path . $image_link, $upload_path . '1024_512/' . $image_link, 400, 327);
                    //@unlink($upload_path . $image_link);
                
                } else {
                    $image_link = $info->image_link;
                }



                $slug = $this->input->post('vn_slug', true);

                $i = 0;
                $dup = 1;
                while ($dup) {
                    $dup = $this->articles_m->check_exists(array('id <>' => $id, 'vn_slug' => $slug . ($i ? '-' . $i : '')));
                    if ($dup)
                        $i++;
                }

                $slug .= $i ? '-' . $i : '';

                $data = array(
                    'cid' => $cid,
                    'vn_name' => $this->input->post('vn_name', true),
                    'vn_slug' => $slug,
                    'vn_keyword' => $this->input->post('vn_keyword', true),
                    'vn_title' => $this->input->post('vn_title', true),
                    'vn_description' => $this->input->post('vn_description', true),
                    'vn_sapo' => $this->input->post('vn_sapo', true),
                    'vn_detail' => $this->input->post('vn_detail'),
                    'image_link' => $image_link,
                    'is_home' => $this->input->post('is_home', true),
                    'is_hot' => $this->input->post('is_hot', true),
                    'status' => $this->input->post('status', true),
                    'created' => now(),
                );



                if (!$id) {
                    if ($this->articles_m->create($data)) {
                        $this->session->set_flashdata('message', 'Thêm bài viết thành công');
                    } else {
                        $this->session->set_flashdata('message', 'Thêm bài viết thất bại');
                    }
                } else {
                    if ($this->articles_m->update($id, $data)) {
                        $this->session->set_flashdata('message', 'Cập nhật bài viết thành công');
                    } else {
                        $this->session->set_flashdata('message', 'Cập nhật bài viết thất bại');
                    }
                }

                if ($cid) {
                    redirect(base_url('admincp/articles?id=&vn_name=&cid=' . $cid));
                } else {
                    redirect(base_url() . 'admincp/articles');
                }
            }
        }

        $this->data['title'] = 'Thêm bài mới';

        $this->data['temp'] = 'articles/detail';
        $this->load->view('admin/main', $this->data);
    }

    public function config() {

        $action = $this->input->post('key', true); //'del_all';

        $id = $this->input->post('id', true);

        $ids = $this->input->post('ids', true); //array(4, 5, 6);

        if ($ids) {
            $array_id = implode(',', $ids);

            $input = 'id IN (' . $array_id . ')';
        }

        switch ($action) {
            case 'del':
                if ($this->articles_m->update($id, array('status' => 3))) {
                    $msg = 'Xóa bài viết thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 3));
                }
                break;

            case 'del_all':

                if ($this->articles_m->update_rule($input, array('status' => 3))) {

                    $msg = 'Xóa thành công tất cả các bài viết có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 3));
                }

                break;
            case 'enable':
                if ($this->articles_m->update($id, array('status' => 1))) {
                    $msg = 'Hiển thị bài viết thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 1));
                }

                break;
            case 'enable_all':

                if ($this->articles_m->update_rule($input, array('status' => 1))) {

                    $msg = 'Hiển thị thành công tất cả các bài viết có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 1));
                }

                break;
            case 'disable':

                if ($this->articles_m->update($id, array('status' => 2))) {
                    $msg = 'Ẩn bài viết thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 2));
                }

                break;

            case 'disable_all':

                if ($this->articles_m->update_rule($input, array('status' => 2))) {

                    $msg = 'Ẩn thành công tất cả các bài viết có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 2));
                }

                break;
        }
    }

    public function clean_trash() {

        $where['where'] = array(
            'status' => 3
        );
        $check_del = $this->articles_m->get_list($where);

        if ($check_del) {

            if ($this->articles_m->del_rule("status = 3")) {
                $this->session->set_flashdata('message', 'Dọn rác thành công');
            }
        } else {
            $this->session->set_flashdata('message', 'Không có gì trong thùng rác');
        }

        redirect(base_url('admincp/articles'));
    }

}
