<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Admin extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('users_m');
        $this->lang->load('admin/admin');
    }

    public function index() {
        $this->data['list'] = $this->users_m->get_list();

        $this->data['title'] = 'Danh sách tài khoản';
        $this->data['temp'] = 'admin/index';
        $this->load->view('admin/main', $this->data);
    }

    function check_username() {
        $username = $this->input->post('username');
        $where = array('username' => $username);
        //kiêm tra xem username đã tồn tại chưa
        if ($this->users_m->check_exists($where)) {
            //trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Tài khoản đã tồn tại');
            return false;
        }
        return true;
    }

    public function add() {
        if($this->input->post()){
            $data = array();
            $data['status']     = $this->input->post('status');
            $data['tid']        = $this->input->post('tid');

            $this->data['filter'] =  $data;
            
            $this->form_validation->set_rules('name', 'Họ tên', 'required|min_length[8]');
            $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Nhập lại password', 'matches[password]');
            $this->form_validation->set_rules('phone', 'Điện thoại', 'numeric');

            if($this->form_validation->run()){
                $data = array(
                    'status' => $this->input->post('status', true),
                    'name' => $this->input->post('name', true),
                    'username' => $this->input->post('username', true),
                    'password' => md5($this->input->post('password', true)),
                    'tid' => $this->input->post('tid', true),
                    'email' => $this->input->post('email', true),
                    'phone' => $this->input->post('phone', true),
                    'address' => $this->input->post('address', true),
                    'created' => now(),
                );

                if($this->users_m->create($data)){
                    $this->session->set_flashdata('message', 'Tạo tài khoản thành công');
                }else{
                    $this->session->set_flashdata('message', 'Tạo tài khoản thất bại');
                }
                redirect(base_url() . 'admincp/admin');
            }
        }

        $this->data['title'] = 'Thêm tài khoản';
        $this->data['temp'] = 'admin/add';
        $this->load->view('admin/main', $this->data);
    }

    public function edit() {
        $id = $this->uri->rsegment('3');
        $id = intval($id);

        $this->data['info_users'] = $this->users_m->get_info($id);

        if($this->input->post()){
            $data = array(
                'status' => $this->input->post('status', true),
                'name' => $this->input->post('name', true),
                'tid' => $this->input->post('tid', true),
                'email' => $this->input->post('email', true),
                'phone' => $this->input->post('phone', true),
                'address' => $this->input->post('address', true),
            );

            if($this->users_m->update($id, $data)){
                $this->session->set_flashdata('message', 'Cập nhật tài khoản thành công');
            }else{
                $this->session->set_flashdata('message', 'Cập nhật tài khoản thất bại');
            }
            redirect(base_url() . 'admincp/admin');
        }

        $this->data['title'] = 'Chỉnh sửa tài khoản';
        $this->data['temp'] = 'admin/edit';
        $this->load->view('admin/main', $this->data);
    }

    public function change_password() {

        if ($this->input->post()) {

            $this->form_validation->set_rules('password', 'Mật khẩu cũ', 'required');
            $this->form_validation->set_rules('n_password', 'Mật khẩu mới', 'required|min_length[6]');
            $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu mới', 'matches[n_password]');

            if ($this->form_validation->run()) {
                $password = $this->input->post('password');
                $_check = $this->users_m->get_info($this->session->userdata('id'));
                if ($_check->password == md5($password)) {

                    $data = array(
                        'password' => md5($this->input->post('n_password', true))
                    );

                    if ($this->users_m->update($this->session->userdata('id'), $data)) {
                        //tạo ra nội dung thông báo
                        $this->session->set_flashdata('message', 'Đổi mật khẩu thành công');
                    } else {
                        $this->session->set_flashdata('message', 'Đổi mật khẩu thất bại');
                    }
                    redirect(base_url() . 'admincp/admin/change_password');
                } else {
                    $this->session->set_flashdata('message', 'Nhập lại mật khẩu cũ không đúng');
                    redirect(base_url() . 'admincp/admin/change_password');
                }
            }
        }


        $this->data['title'] = 'Đổi mật khẩu';
        $this->data['temp'] = 'admin/change_password';
        $this->load->view('admin/main', $this->data);
    }

    public function del() {
        $id = $this->uri->rsegment('3');
        $id = intval($id);

        //lay thong tin cua quan tri vien
        $info = $this->users_m->get_info($id);
        if (!$info) {
            $this->session->set_flashdata('message', 'Thông tin tài khoản không tồn tại');
            redirect(base_url('admincp/admin'));
        }
        //thuc hiện xóa
        $this->users_m->delete($id);

        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(base_url('admincp/admin'));
    }

    public function logout() {
        if ($this->session->userdata('isCheckLogin') == TRUE) {
            $username = array('id', 'tid', 'name', 'email', 'phone', 'address', 'isCheckLogin');
        }

        $this->session->unset_userdata($username);

        redirect(base_url('admincp/login'));
    }

    public function config() {
        $this->load->model('users_m', 'item');
        $name = $this->input->post('name', true); //name obj

        $action = $this->input->post('key', true); //'del_all';

        $id = $this->input->post('id', true);

        $status = 0;
        $msg    = '';

        switch ($action) {
            case 'enable':
                if ($this->item->update($id, array('status' => 1))) {
                    $msg = 'Hiển thị ' . $name . ' thành công';
                    $status = 1;
                    
                }else {
                    $msg = 'Hiển thị ' . $name . ' không thành công';
                }
                break;
            case 'disable':
                if ($this->item->update($id, array('status' => 2))) {
                    $msg = 'Ẩn ' . $name . ' thành công';
                    $status = 2;
                    
                }else {
                    $msg = 'Ẩn' . $name . ' không thành công';
                }
                break;
        }
        //return string JSON
        echo json_encode(array('msg' => $msg, 'status' => $status));
    }

}
