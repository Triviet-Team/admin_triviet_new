<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('product_m');
        $this->load->model('product_category_m');
        $this->load->model('ads_m');
    }
    public function index() {     
        // slider_home
        $input = array();
        $input['where'] = array('status' => 1, 'cid' => 1);
        $this->data['slider_home'] = $this->ads_m->get_list($input);
        
        // baner home
        $input = array();
        $input['where'] = array('status' => 1, 'cid' => 8);
        $this->data['list_baner_home'] = $this->ads_m->get_list($input);

        $this->data['temp'] = 'home/index';
        $this->one_col($this->data);
    }
  

}