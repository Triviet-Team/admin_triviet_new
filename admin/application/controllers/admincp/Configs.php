<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Configs extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('configs_m');
    }

    public function index() {

        $where = array(
            'key' => 'general'
        );

        $general = $this->configs_m->get_info_rule($where);

        $this->data['general'] = json_decode($general->values);

        // echo '<pre>';
        // print_r($this->input->post());

        if ($this->input->post()) {
            // echo '<pre>';
            // print_r($this->input->post());

            $value = array(
                'vn_title_site' => $this->input->post('vn_title_site', true),
                'vn_keyword_site' => $this->input->post('vn_keyword_site', true),
                'vn_description_site' => $this->input->post('vn_description_site', true),
                'about' => $this->input->post('about', true),
                'address' => $this->input->post('address', true),
                'address_website' => $this->input->post('address_website', true),
                'email' => $this->input->post('email', true),
                'phone' => $this->input->post('phone', true),
                'name' => $this->input->post('name', true),
                'hotline' => $this->input->post('hotline', true),
                'fax' => $this->input->post('fax', true),
                'facebook' => $this->input->post('facebook', true),
                'youtube' => $this->input->post('youtube', true),
                'twitter' => $this->input->post('twitter', true),
                'google' => $this->input->post('google', true),
                'ma_thue' => $this->input->post('ma_thue', true),
                
            );
            $data = array(
                'values' => json_encode($value)
            );

            if ($this->configs_m->update(1, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
            }

            redirect(base_url() . 'admincp/configs');
        }

        $this->data['temp'] = 'configs/index';
        $this->load->view('admin/main', $this->data);
    }

}
