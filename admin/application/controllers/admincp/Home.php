<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    public function index() {

        $this->data['temp'] = 'home/index';
        $this->load->view('admin/main', $this->data);
    }

}
