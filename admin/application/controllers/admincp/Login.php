<?php
Class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->data['msg'] = form_error('username');
                $this->data['msg'] = form_error('password');
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $password = md5($password);

                $this->load->model('users_m');
                $where = array(
                    'tid >=' => 2,
                    'username' => $username,
                    'password' => $password,
                    'status' => 1
                );

                $info = $this->users_m->get_info_rule($where);

                if ($info) {
                    $username = array(
                        'id' => $info->id,
                        'tid' => $info->tid,
                        'name' => $info->name,
                        'email' => $info->email,
                        'phone' => $info->phone,
                        'address' => $info->address,
                        'isCheckLogin' => TRUE,
                    );
                    $this->session->set_userdata($username);
                    
                    redirect(base_url('admincp'));
                } else {
                    $this->session->set_flashdata('message', 'Tài khoản hoặc mật khẩu không đúng');
                    $this->data['msg'] = $this->session->flashdata('message');
                }
            }

        }

        $this->load->view('admin/login/index', $this->data);
    }

}
