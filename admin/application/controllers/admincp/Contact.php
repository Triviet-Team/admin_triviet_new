<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('contact_m');
    }

    public function index() {

        //kiem tra co thuc hien loc du lieu hay khong
        $input = array();
        $id = $this->input->get('id');
        $id = intval($id);
        if ($id > 0) {
            $input['where']['id'] = $id;
        }
        $vn_name = $this->input->get('vn_name');
        if ($vn_name) {
            $input['where']['vn_name'] = $vn_name;
        }

        $cid = $this->input->get('cid');
        $cid = intval($cid);
        if ($cid > 0) {
            $input['where']['cid'] = $cid;
        }

        $total_rows = $this->contact_m->get_total($input);
        $this->data['total_rows'] = $total_rows;
        //load ra thu vien phan trang
        $config = array();
        $config['total_rows'] = $total_rows; //tong tat ca cac san pham tren website
        $config['base_url'] = base_url('admincp/contact');
        $config['first_url'] = $config['base_url'];
        $config['per_page'] = 10; //so luong san pham hien thi tren 1 trang
        $config['num_links'] = $total_rows;

        $config = array_merge($config, $this->system_library->pagination());

        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(3);
        $segment = intval($segment);

        $input['limit'] = array($config['per_page'], $segment);

        $this->data['list'] = $this->contact_m->get_list($input);


        $this->data['title'] = 'Danh sách liên hệ';

        $this->data['temp'] = 'contact/index';
        $this->load->view('admin/main', $this->data);
    }

    public function view($id = 0) {

        $view = $this->contact_m->get_info($id);

        if ($view) {

            $this->contact_m->update($id, array('status' => 1));

            $this->data['view'] = $view;
        }

        $this->load->view('admin/contact/view', $this->data);
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
                if ($this->contact_m->update($id, array('status' => 3))) {
                    $msg = 'Xóa liên hệ thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 3));
                }
                break;

            case 'del_all':

                if ($this->contact_m->update_rule($input, array('status' => 3))) {

                    $msg = 'Xóa thành công tất cả các liên hệ có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 3));
                }

                break;
        }
    }

    public function clean_trash() {

        $where['where'] = array(
            'status' => 3
        );
        $check_del = $this->contact_m->get_list($where);

        if ($check_del) {

            if ($this->contact_m->del_rule("status = 3")) {
                $this->session->set_flashdata('message', 'Dọn rác thành công');
            }
        } else {
            $this->session->set_flashdata('message', 'Không có gì trong thùng rác');
        }

        redirect(base_url('admincp/contact'));
    }
    
}
