<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emailregister extends MY_Controller {

    public function index() {
        $this->load->model('emailregister_m');
        $total_rows = $this->emailregister_m->get_total($input);
        $this->data['total_rows'] = $total_rows;

        //load ra thu vien phan trang
        $config = array();
        $config['total_rows'] = $total_rows; //tong tat ca cac san pham tren website
        $config['base_url'] = base_url('admincp/emailregister');
        $config['first_url'] = $config['base_url'];
        $config['per_page'] = 25; //so luong san pham hien thi tren 1 trang
        $config['num_links'] = $total_rows;

        $config = array_merge($config, $this->system_library->pagination());

        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(3);
        $segment = intval($segment);

        $input['limit'] = array($config['per_page'], $segment);

        $this->data['list'] = $this->emailregister_m->get_list($input);
        
        $this->data['title'] = 'Đăng kí nhận email';

        $this->data['temp'] = 'emailregister/index';
        $this->load->view('admin/main', $this->data);
    }

}
