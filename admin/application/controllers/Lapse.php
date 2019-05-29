<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lapse extends MY_Controller {

    public function index(){
        
    }


    public function error_404() {
        $this->output->set_status_header('404');

        $this->data['title_site'] = 'Lỗi không tìm thấy 404';

        $this->data['temp'] = 'error/error_404';
        $this->one_col($this->data);
    }

}
