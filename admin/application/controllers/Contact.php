<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

    public function index() {
        $this->load->model('configs_m');
        $this->load->model('contact_m');

        if ($this->input->post()) {

            $this->form_validation->set_rules('name', 'Họ tên', 'required');

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[10]');

            $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
            
            $this->form_validation->set_rules('content', 'Nội dung', 'required');
			
			$this->form_validation->set_message('valid_email', 'Email chưa đúng');

            if ($this->form_validation->run()) {

                $email = $this->input->post('email', true);
                $date = now();
                $data = array(
                    'name' => $this->input->post('name', true),
                    'email' => $email,
                    'phone' => $this->input->post('phone', true),
                    'title' => $this->input->post('title', true),
                    'content' => $this->input->post('content', true),
                    'status' => 2,
                    'created' => $date
                );
                $config = $this->configs_m->get_info(1);
                
                $arrConfig = json_decode($config->values);

                if ($this->contact_m->create($data)) {
                    $to = $email;
                    
                    $subject = $arrConfig->vn_title_site;
                    
                    $setForm = $arrConfig->email;
                    
                    $titleForm = $arrConfig->vn_title_site;
                    
                    $body = '<table class="body-wrap" style="box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
                    
                            <tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
                    
                                <td style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                    
                                <td class="container" width="600" style="box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                    
                                    <div class="content" style="box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                    
                                        <table class="main" width="100%" cellpadding="0" cellspacing="0" style=" box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">
                    
                                            <tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
                    
                                                <td class="alert alert-warning" style=" box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #FF9F00; margin: 0; padding: 20px;" align="center" bgcolor="#FF9F00" valign="top">
                    
                                                    '.$arrConfig->vn_title_site.'
                    
                                                </td>
                    
                                            </tr>
                    
                                            <tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
                    
                                                <td class="content-wrap" style=" box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                    
                                                    <table width="100%" cellpadding="0" cellspacing="0" style=" box-sizing: border-box; font-size: 14px; margin: 0;">
                                                        
                                                        <tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
                    
                                                            <td class="content-block" style=" box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi sẽ liên hệ lại bạn trong thời gian sớm nhất
                                                            </td>
                    
                                                        </tr>
                    
                                                        <tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
                    
                                                            <td class="content-block" style=" box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">                  
                                                                Cảm ơn bạn đã liên hệ với chúng tôi
                                                            </td>
                    
                                                        </tr>
                                                    </table>
                    
                                                </td>
                    
                                            </tr>
                    
                                        </table>
                    
                                    </div>
                    
                                </td>
                    
                                <td style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                    
                            </tr>
                    
                        </table>';
                    
                    
                    // send mail customer
                    if($this->system_library->send_mail($to, $setForm, $titleForm, $subject, $body)) {
                        $to = $arrConfig->email;
                        $subject = 'Admin ' . $arrConfig->vn_title_site;
                        $setForm = $email;
                        $titleForm = $arrConfig->vn_title_site;
                        $body = '<table class="body-wrap" style="box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
                        
                            <tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
                        
                                <td style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                        
                                <td class="container" width="600" style="box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                        
                                    <div class="content" style="box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                        
                                        <table class="main" width="100%" cellpadding="0" cellspacing="0" style=" box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">
                        
                                            <tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
                        
                                                <td class="alert alert-warning" style=" box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #FF9F00; margin: 0; padding: 20px;" align="center" bgcolor="#FF9F00" valign="top">
                        
                                                    Thông tin liên hệ từ khách hàng
                        
                                                </td>
                        
                                            </tr>
                        
                                            <tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
                        
                                                <td class="content-wrap" style=" box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                        
                                                    <table width="100%" cellpadding="0" cellspacing="0" style=" box-sizing: border-box; font-size: 14px; margin: 0;">
                        
                                                        <tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
                        
                                                            <td class="content-block" style=" box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                        
                                                                Thông tin liên hệ từ khách hàng vào lúc: '.date('d/m/Y H:m:s', $date).'
                        
                                                            </td>
                        
                                                        </tr>
                        
                        
                        
                                                        <tr style="box-sizing: border-box; font-size: 14px; margin: 0;">
                        
                                                            <td class="content-block" style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                           
                                                                <p>Họ tên: '.$this->input->post('name', true).'</p>
                                                                <p>Số điện thoại: '.$this->input->post('phone', true).'</p>
                                                                <p>Email: '.$email.'</p>
                                                                <p>Tiêu đề: '.$this->input->post('title', true).'</p>
                                                                <p>Lời nhắn: '.$this->input->post('content', true).'</p>
                        
                                                            </td>
                        
                                                        </tr>
                        
                                                    </table>
                        
                                                </td>
                        
                                            </tr>
                        
                                        </table>
                        
                                    </div>
                        
                                </td>
                        
                                <td style="box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                        
                            </tr>
                        
                        </table>';
                        //send mail admin
                        if($this->system_library->send_mail($to, $setForm, $titleForm, $subject, $body)) {
                            $this->session->set_flashdata('message', 'Cảm ơn bạn đã gửi liên hệ đến công ty của chúng tối!');
                            redirect(base_url('lien-he.html'));
                        }
                    }
                }
            }
        }

        $breadcrumb[] = array(
            'url' => '#',
            'name' => 'Liên hệ',
        );

        $this->data['breadcrumb'] = $breadcrumb;

        $this->data['title_site'] = 'Liên hệ';

        $this->data['temp'] = 'contact/index';
        $this->one_col($this->data);
    }
    
    public function registration() { 
        $result = null;
        if ($_POST) {
            $this->load->helper('security');
            $this->load->model('emailregister_m');
            $this->form_validation->set_rules('email_register', 'Email', 'required|valid_email', array(
                'required'      => '%s không được rỗng.',
                'valid_email'     => '%s không đúng.'
            ));
            if ($this->form_validation->run()) {
                $email = $this->input->post('email_register', true);
                $data = array(
                    'email' => $email,
                    'created' =>  now(),
                    'status' => 1,
                );
                if($this->emailregister_m->create($data)){
                    $result['message'] = 'Đăng ký nhận mail thành công';
                    $result['status'] = 1;
                }
            }else {
                $result['message'] = form_error('email_register');
                $result['status'] = 0;
            }           
        }
       echo json_encode($result);         
    }

    
    
    
}
