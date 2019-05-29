<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manager_service extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('articles_m');

        $this->load->model('articles_category_m', 'category');

         $this->load->model('dowload_m');
         
         $this->load->helper("text");

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


        $name = $this->input->get('vn_name');
        $data['vn_name']       = $name;
        if($name){
            $input['like']      = array('vn_name', $name );
        }

        $total_rows = $this->dowload_m->get_total($input);
        $this->data['total_rows'] = $total_rows;
        $getData = array('id' => $id, 'vn_name' => $vn_name);

        //load ra thu vien phan trang
        $config = array();
        $config['total_rows'] = $total_rows; //tong tat ca cac san pham tren website
        $config['base_url'] = base_url('admincp/manager');
        $config['suffix'] = '?' . http_build_query($getData, '', "&amp;");
        //$config['first_url'] = $config['base_url'] . '?' . http_build_query($getData, '', "&amp;");
        $config['per_page'] = 20; //so luong san pham hien thi tren 1 trang
        $config['num_links'] = $total_rows;

        $config = array_merge($config, $this->system_library->pagination());

        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(3);
        $segment = intval($segment);

        $input['limit'] = array($config['per_page'], $segment);

        $this->data['list'] = $this->dowload_m->get_list($input);

        $this->data['title'] = 'Danh sách dịch vụ';

        $this->data['temp'] = 'manager_service/index';
        $this->load->view('admin/main', $this->data);
    }

    public function detail($id = 0) {

        $input = array();


        $info = $this->dowload_m->get_info($id);

        $this->data['info'] = $info;


        if ($this->input->post()) {

            $this->form_validation->set_rules('vn_name', 'Tên dịch vụ', 'required');

            $this->form_validation->set_rules('vn_content', 'Nội dung', 'required');

            if ($this->form_validation->run()) {
                
                #Tạo folder upload
                $upload_path = 'uploads/images/services/';
                
                $upload_data = $this->system_library->upload($upload_path, 'image_link');
                
                $image_link = '';
                
                if ($upload_data != NULL && !isset($info->image_link)) {
                    $image_link = $upload_data;
                } elseif ($upload_data != NULL && $info->image_link) {
                    $image_link = $upload_data;
                } else {
                    $image_link = $info->image_link;
                }
                
                $data = array(
                    'vn_name' => $this->input->post('vn_name', true),
                    'vn_content' =>  $this->input->post('vn_content', true),
                    'image_link' =>  $image_link,
                    'status' => $this->input->post('status', true),
                    'created' => now(),
                );



                if (!$id) {
                    if ($this->dowload_m->create($data)) {
                        $this->session->set_flashdata('message', 'Thêm link website thành công');
                    } else {
                        $this->session->set_flashdata('message', 'Thêm link website thất bại');
                    }
                } else {
                    if ($this->dowload_m->update($id, $data)) {
                        $this->session->set_flashdata('message', 'Cập nhật link website thành công');
                    } else {
                        $this->session->set_flashdata('message', 'Cập nhật link website thất bại');
                    }
                }

                if ($cid) {
                    redirect(base_url('admincp/manager_service?id=&vn_name=&cid=' . $cid));
                } else {
                    redirect(base_url() . 'admincp/manager_service');
                }
            }
        }

        $this->data['title'] = 'Thêm dịch vụ';

        $this->data['temp'] = 'manager_service/detail';
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
                if ($this->dowload_m->update($id, array('status' => 3))) {
                    $msg = 'Xóa link website thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 3));
                }
                break;

            case 'del_all':

                if ($this->dowload_m->update_rule($input, array('status' => 3))) {

                    $msg = 'Xóa thành công tất cả link website có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 3));
                }

                break;
            case 'enable':
                if ($this->dowload_m->update($id, array('status' => 1))) {
                    $msg = 'Hiển thị link website thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 1));
                }

                break;
            case 'enable_all':

                if ($this->dowload_m->update_rule($input, array('status' => 1))) {

                    $msg = 'Hiển thị thành công tất cả link website có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 1));
                }

                break;
            case 'disable':

                if ($this->dowload_m->update($id, array('status' => 2))) {
                    $msg = 'Ẩn link website thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 2));
                }

                break;

            case 'disable_all':

                if ($this->dowload_m->update_rule($input, array('status' => 2))) {

                    $msg = 'Ẩn thành công tất cả link website có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 2));
                }

                break;
        }
    }

    public function clean_trash() {

        $where['where'] = array(
            'status' => 3
        );
        $check_del = $this->dowload_m->get_list($where);

        if ($check_del) {

            if ($this->dowload_m->del_rule("status = 3")) {
                $this->session->set_flashdata('message', 'Dọn rác thành công');
            }
        } else {
            $this->session->set_flashdata('message', 'Không có gì trong thùng rác');
        }

        redirect(base_url('admincp/manager_service'));
    }

}
