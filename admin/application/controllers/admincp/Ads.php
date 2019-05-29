<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ads extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('ads_m');
        $this->load->model('ads_category_m', 'category');
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

        $total_rows = $this->ads_m->get_total($input);
        $this->data['total_rows'] = $total_rows;

        $getData = array('id' => $id, 'vn_name' => $vn_name, 'cid' => $cid);

        //load ra thu vien phan trang
        $config = array();
        $config['total_rows'] = $total_rows; //tong tat ca cac san pham tren website
        $config['base_url'] = base_url('admincp/ads');
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

        $this->data['list'] = $this->ads_m->get_list($input);

        $input = array();
        $input['where'] = array('pid' => 0, 'status' => 1);
        $catalogs = $this->category->get_list($input);
        foreach ($catalogs as $row) {
            $input['where'] = array('pid' => $row->id, 'status' => 1);
            $subs = $this->category->get_list($input);
            $row->subs = $subs;
        }
        $this->data['catalogs'] = $catalogs;

        $this->data['title'] = 'Danh sách ADS';

        $this->data['temp'] = 'ads/index';
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

        $info = $this->ads_m->get_info($id);

        $this->data['info'] = $info;

        if ($this->input->post()) {

            $this->form_validation->set_rules('vn_name', 'Tên ADS', 'required');

            $this->form_validation->set_rules('cid', 'Danh mục ADS', 'required');

            if ($this->form_validation->run()) {
                
                $cid = $this->input->post('cid', true);

                #Tạo folder upload
                $upload_path = 'uploads/images/ads/';

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
                    'cid' => $cid,
                    'vn_name' => $this->input->post('vn_name', true),
                    'vn_sapo' => $this->input->post('vn_sapo', true),
                    'link' => $this->input->post('link', true),
                    'image_link' => $image_link,
                    'status' => $this->input->post('status', true),
                    'created' => now(),
                );

                if (!$id) {

                    if ($this->ads_m->create($data)) {
                        $this->session->set_flashdata('message', 'Thêm ADS thành công');
                    } else {
                        $this->session->set_flashdata('message', 'Thêm ADS thất bại');
                    }
                } else {
                    if ($this->ads_m->update($id, $data)) {
                        $this->session->set_flashdata('message', 'Cập nhật ADS thành công');
                    } else {
                        $this->session->set_flashdata('message', 'Cập nhật ADS thất bại');
                    }
                }

                if ($cid) {
                    redirect(base_url('admincp/ads?id=&vn_name=&cid=' . $cid));
                } else {
                    redirect(base_url() . 'admincp/ads/index/');
                }
            }
        }

        $this->data['title'] = 'Thêm ADS';

        $this->data['temp'] = 'ads/detail';
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
                if ($this->ads_m->update($id, array('status' => 3))) {
                    $msg = 'Xóa ADS thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 3));
                }
                break;

            case 'del_all':

                if ($this->ads_m->update_rule($input, array('status' => 3))) {

                    $msg = 'Xóa thành công tất cả các ADS có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 3));
                }

                break;
            case 'enable':
                if ($this->ads_m->update($id, array('status' => 1))) {
                    $msg = 'Hiển thị ADS thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 1));
                }

                break;
            case 'enable_all':

                if ($this->ads_m->update_rule($input, array('status' => 1))) {

                    $msg = 'Hiển thị thành công tất cả các ADS có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 1));
                }

                break;
            case 'disable':

                if ($this->ads_m->update($id, array('status' => 2))) {
                    $msg = 'Ẩn ADS thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 2));
                }

                break;

            case 'disable_all':

                if ($this->ads_m->update_rule($input, array('status' => 2))) {

                    $msg = 'Ẩn thành công tất cả các ADS có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 2));
                }

                break;
        }
    }

    public function clean_trash() {

        $where['where'] = array(
            'status' => 3
        );
        $check_del = $this->ads_m->get_list($where);

        if ($check_del) {

            if ($this->ads_m->del_rule("status = 3")) {
                $this->session->set_flashdata('message', 'Dọn rác thành công');
            }
        } else {
            $this->session->set_flashdata('message', 'Không có gì trong thùng rác');
        }

        redirect(base_url('admincp/ads'));
    }

}
