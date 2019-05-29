<?php

Class MY_Controller extends CI_Controller {

    //bien gui du lieu sang ben view
    public $data = array();

    function __construct() {
        //ke thua tu CI_Controller
        parent::__construct();

        $controller = $this->uri->segment(1);
        switch ($controller) {
            case 'admincp' : {
                    $this->_check_login();
                    break;
                }
            default: {

                    $this->load->model('configs_m');

                    $where = array('key' => 'general');

                    $config = $this->configs_m->get_info_rule($where);

                    $config = json_decode($config->values);

                    $this->data['config'] = $config;
                    
                    // Danh sách slider                    
                    $where = array();
                    $this->load->model('ads_m');
                    $where['where'] = array('status' => 1, 'cid' => 1);
                    $this->data['slider_top'] = $this->ads_m->get_list($where);

                    #Meta head
                    $this->data['title_page'] = $config->vn_title_site;

                    $this->data['keyword_page'] = $config->vn_keyword_site;

                    $this->data['description_page'] = $config->vn_description_site;

                    $this->data['url'] = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

                    $this->data['img_page'] = base_url('public/site/images/bannerfacebook.jpg');

                    $this->user_online();
                }
        }
    }

    public function one_col($data) {

        $this->load->model('product_category_m');

        $input_cate['where'] = array('status' => 1, 'pid' => 0);
        $input_cate['order'][0] = 'position';
        $input_cate['order'][1] = 'ASC';

        $categorys = $this->product_category_m->get_list($input_cate);

        foreach ($categorys as $row) {
            $input_cate['where'] = array('status' => 1, 'pid' => $row->id);
            $input_cate['order'][0] = 'position';
            $input_cate['order'][1] = 'ASC';
            $subs = $this->product_category_m->get_list($input_cate);
            $row->subs = $subs;
        }

        $data['categorys'] = $categorys;

        $this->load->model('ads_m');
        // logo top
//         $input_logo_top['where'] = array('status' => 1, 'cid' => 6);
//         $data['logo_top'] = $this->ads_m->get_row($input_logo_top);
        
        // baner sidebar product
        $input_logo_top['where'] = array('status' => 1, 'id' => 25);
        $data['baner_sidebar_product'] = $this->ads_m->get_row($input_logo_top);
        
        //load sản phẩm bán chạy
        $this->load->model('product_m');
        $input['where'] = array('is_pay' => 1, 'status' => 1);
        $input['limit'] = array(6 ,0);
        $data['sp_ban_chay'] =   $this->product_m->get_list($input);    
        

        $this->load->view('site/layout', $data);
    }

    /*
     * Kiem tra trang thai dang nhap cua admin
     */

    private function _check_login() {

        $controller = $this->uri->rsegment('1');
        $controller = strtolower($controller);

        $login = $this->session->userdata('isCheckLogin');
        //neu ma chua dang nhap,ma truy cap 1 controller khac login
        if (!$login && $controller != 'login') {
            redirect(base_url('admincp/login'));
        }
        //neu ma admin da dang nhap thi khong cho phep vao trang login nua.
        if ($login && $controller == 'login') {
            redirect(base_url('admincp/home'));
        }
    }

    public function user_online() {
        $session_id = session_id();

        $time = time();

        $timeRefresh = 15 * 60;

        $timeNew = $time - $timeRefresh;

        $local = $_SERVER['PHP_SELF'];

        $this->load->model('useronline_m');
        $this->load->model('counters_m');
        $this->counters_m->resetCounter();
        $check = $this->useronline_m->checkExits($session_id);
        if ($check == 1) {
            $this->useronline_m->updateTime($time, $local, $session_id);
        } else {

            $datas = array('session_id' => $session_id,
                'time' => $time,
                'local' => $local);

            $this->useronline_m->addDatas($datas);
        }
        $this->useronline_m->clear($timeNew);
        $this->counters_m->update();
        $counters = $this->counters_m->getCounter();
        $this->data['counters'] = $counters;
        $this->data['userOnline'] = $this->useronline_m->getOnline();
    }

}
