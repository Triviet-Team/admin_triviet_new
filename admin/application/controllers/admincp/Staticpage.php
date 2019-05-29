<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Staticpage extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('staticpage_m');
    }

    public function index() {
        //lay tong so luong ta ca cac san pham trong websit
        $total_rows = $this->staticpage_m->get_total();
        $this->data['total_rows'] = $total_rows;

        $getData = array('per_page' => 0);

        //load ra thu vien phan trang
        $config = array();
        $config['total_rows'] = $total_rows; //tong tat ca cac san pham tren website
        $config['base_url'] = base_url('admincp/staticpage/index');
        $config['per_page'] = 20; //so luong san pham hien thi tren 1 trang
        $config['num_links'] = $total_rows;

        $config = array_merge($config, $this->system_library->pagination());

        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(4);
        $segment = intval($segment);

        $input = array();
        $input['limit'] = array($config['per_page'], $segment);

        $this->data['list'] = $this->staticpage_m->get_list($input);

        $this->data['title'] = 'Danh sách trang tĩnh';

        $this->data['temp'] = 'staticpage/index';
        $this->load->view('admin/main', $this->data);
    }

    public function detail($id = 0) {

        $info = $this->staticpage_m->get_info($id);

        $this->data['info'] = $info;

        if ($this->input->post()) {

            $this->form_validation->set_rules('vn_name', 'Tên trang tĩnh', 'required');

            if ($this->form_validation->run()) {

                $data = array(
                    'vn_name' => $this->input->post('vn_name', true),
                    'vn_slug' => $this->input->post('vn_slug', true),
                    'vn_keyword' => $this->input->post('vn_keyword', true),
                    'vn_title' => $this->input->post('vn_title', true),
                    'vn_description' => $this->input->post('vn_description', true),
                    'vn_sapo' => $this->input->post('vn_sapo'),
                    'vn_detail' => $this->input->post('vn_detail'),
                    'image_link' => $image_link,
                    'status' => $this->input->post('status', true),
                    'created' => now()
                );

                if (!$id) {
                    if ($this->staticpage_m->create($data)) {
                        $this->session->set_flashdata('message', 'Thêm trang tĩnh thành công');
                    } else {
                        $this->session->set_flashdata('message', 'Thêm trang tĩnh thất bại');
                    }
                } else {
                    if ($this->staticpage_m->update($id, $data)) {
                        $this->session->set_flashdata('message', 'Cập nhật trang tĩnh thành công');
                    } else {
                        $this->session->set_flashdata('message', 'Cập nhật trang tĩnh thất bại');
                    }
                }

                redirect(base_url('admincp/staticpage'));
            }
        }

        $this->data['title'] = 'Thêm trang tĩnh';

        $this->data['temp'] = 'staticpage/detail';
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
                if ($this->staticpage_m->update($id, array('status' => 3))) {
                    $msg = 'Xóa trang tĩnh thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 3));
                }
                break;

            case 'del_all':

                if ($this->staticpage_m->update_rule($input, array('status' => 3))) {

                    $msg = 'Xóa thành công tất cả các trang tĩnh có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 3));
                }

                break;
            case 'enable':
                if ($this->staticpage_m->update($id, array('status' => 1))) {
                    $msg = 'Hiển thị trang tĩnh thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 1));
                }

                break;
            case 'enable_all':

                if ($this->staticpage_m->update_rule($input, array('status' => 1))) {

                    $msg = 'Hiển thị thành công tất cả các trang tĩnh có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 1));
                }

                break;
            case 'disable':

                if ($this->staticpage_m->update($id, array('status' => 2))) {
                    $msg = 'Ẩn trang tĩnh thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 2));
                }

                break;

            case 'disable_all':

                if ($this->staticpage_m->update_rule($input, array('status' => 2))) {

                    $msg = 'Ẩn thành công tất cả các trang tĩnh có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 2));
                }

                break;
        }
    }

    public function clean_trash() {

        $_check = $this->staticpage_m->check_exists('status = 3');

        if ($_check) {
            if ($this->staticpage_m->del_rule('status = 3')) {
                $this->session->set_flashdata('message', 'Dọn rác thành công');
            }
        } else {
            $this->session->set_flashdata('message', 'Không có gì trong thùng rác');
        }
        redirect(base_url('admincp/staticpage'));
    }

}
