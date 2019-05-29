<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('product_m');

        $this->load->model('transaction_m');
        
        $this->lang->load('admin/order');
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

        $total_rows = $this->transaction_m->get_total($input);
        $this->data['total_rows'] = $total_rows;

        $getData = array('id' => $id, 'vn_name' => $vn_name, 'cid' => $cid);

        //load ra thu vien phan trang
        $config = array();
        $config['total_rows'] = $total_rows; //tong tat ca cac san pham tren website
        $config['base_url'] = base_url('admincp/order');
        $config['suffix'] = '?' . http_build_query($getData, '', "&amp;");
        $config['first_url'] = $config['base_url'] . '?' . http_build_query($getData, '', "&amp;");
        $config['per_page'] = 25; //so luong san pham hien thi tren 1 trang
        $config['num_links'] = $total_rows;

        $config = array_merge($config, $this->system_library->pagination());

        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(3);
        $segment = intval($segment);

        $input['limit'] = array($config['per_page'], $segment);

        $order = $this->transaction_m->get_list($input);

        $this->data['list'] = $order;

        $this->data['title'] = 'Danh sách đơn hàng';

        $this->data['temp'] = 'order/index';
        $this->load->view('admin/main', $this->data);
    }

    public function view($id = 0) {

        $view = $this->transaction_m->get_info($id);
        if ($view) {
            if($view->status == 2) {
                $this->transaction_m->update($id, array("status" => 1));
                
            }
            
            $this->data['view'] = $view;
        }
        
        $this->data['title'] = 'Xem chi tiết đơn hàng';
        
        $this->data['temp'] = 'order/view';
        $this->load->view('admin/main', $this->data);
        
    }

    public function del($id) {

        $del = $this->order_m->get_info($id);

        if ($del) {

            if ($this->order_m->update($id, array("status" => 3))) {
                redirect(base_url('admincp/order'));
            }
        }
    }

    public function clean_trash() {

        $where['where'] = array(
            'status' => 3
        );
        $check_del = $this->transaction_m->get_list($where);

        if ($check_del) {

            if ($this->transaction_m->del_rule("status = 3")) {
                $this->session->set_flashdata('message', 'Dọn rác thành công');
            }
        } else {
            $this->session->set_flashdata('message', 'Không có gì trong thùng rác');
        }

        redirect(base_url('admincp/order'));
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
                if ($this->transaction_m->update($id, array('status' => 3))) {
                    $msg = 'Xóa sản phẩm thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 3));
                }
                break;
    
            case 'del_all':
    
                if ($this->transaction_m->update_rule($input, array('status' => 3))) {
    
                    $msg = 'Xóa thành công tất cả các sản phẩm có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 3));
                }
    
                break;
            case 'enable':
                if ($this->product_m->update($id, array('status' => 1))) {
                    $msg = 'Hiển thị sản phẩm thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 1));
                }
    
                break;
            case 'enable_all':
    
                if ($this->product_m->update_rule($input, array('status' => 1))) {
    
                    $msg = 'Hiển thị thành công tất cả các sản phẩm có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 1));
                }
    
                break;
            case 'disable':
    
                if ($this->product_m->update($id, array('status' => 2))) {
                    $msg = 'Ẩn sản phẩm thành công';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 2));
                }
    
                break;
    
            case 'disable_all':
    
                if ($this->product_m->update_rule($input, array('status' => 2))) {
    
                    $msg = 'Ẩn thành công tất cả các sản phẩm có id (' . $array_id . ')';
                    echo json_encode(array('msg' => $msg, 'success' => true, 'status' => 2));
                }
    
                break;
        }
    }

}
