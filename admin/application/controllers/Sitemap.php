<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends MY_Controller {

    public function index() {

        header('Content-Type: text/xml; charset=utf-8');
        
        $this->load->model('product_m');
        
        $this->load->model('product_category_m');

        $this->load->model('articles_m');
        
        $input = array();
        $input['where'] = array('status' => 1);

        $this->data['articles'] = $this->articles_m->get_list($input);
        
        $input = array();
        $input['where'] = array('status' => 1);
        
        $product_category = $this->product_category_m->get_list($input);
        
        foreach ($product_category as $row) {
            $input = array();
            $input['where'] = array('status' => 1, 'cid' => $row->id);
            $list_product = $this->product_m->get_list($input);
            $row->list_product = $list_product;
        }
        $this->data['obj_product'] = $product_category;
        
        $this->output->_display($this->load->view('site/sitemap/index', $this->data, true));
    }

}
