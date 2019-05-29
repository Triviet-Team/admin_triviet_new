<?php

Class Order extends MY_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->library('cart');
    }

    public function index() {
        
        $breadcrumb[] = array(
            'url' => base_url(),
            'name' => 'Notification',
        );

        $this->data['breadcrumb'] = $breadcrumb;


        $this->data['temp'] = 'cart/success';
        $this->one_col($this->data);
    }

    function checkout() {
        $this->load->model('province_m');
        $this->data['provinces']    = $this->province_m->get_list();
        
        //thong gio hang
        $carts = $_SESSION['carts'];
        //tong so san pham co trong gio hang
        $total_items = count($_SESSION['carts']);

        $this->data['carts'] = $carts;
        $this->data['total_items'] = $total_items;
        
        if ($total_items <= 0) {
            redirect(base_url());
        }

        //neu ma co du lieu post len thi kiem tra
        if ($this->input->post()) {
            //nhập liệu chính xác
                $qtys           = array();
                $names          = array();
                $images         = array();
                $products_id    = array();
                $prices         = array();
                $type           = array();
                $vn_slug        = array();
                $count          = array();

                foreach ($carts as $row) {
                    $qtys[]         = $row['qty'];
                    $names[]        = $row['name'];
                    $images[]       = $row['image_link'];
                    $vn_slug[]       = $row['vn_slug'];
                    $products_id[]  = $row['id_product'];
                    $prices[]       = $row['price'];
                    $type[]       = $row['type'];
                    $count[]       = $row['count'];
                }
                
                
                $province = $this->input->post('province');
                $province = $this->getNameAddress($province);
                $district = $this->input->post('district');
                $district = $this->getNameAddress($district, 'district');                
//                 $ward = $this->input->post('ward');
//                 $ward = $this->getNameAddress($ward, 'ward');

                $address = $this->input->post('user_address'). ', ' . $district . ', ' . $province;
                $email = $this->input->post('user_email');
                $name = $this->input->post('user_name');
                //them vao csdldie
                $data = array(
                    'code' => $this->system_library->rand_string(8),
                    'status' => 2, //trang thai chua thanh toan
                    'type' => 0,
                    'user_id' => 0,
                    'user_email' => $email,
                    'user_name' => $name,
                    'user_phone' => $this->input->post('user_phone'),
                    'receivingdate' => $this->input->post('receivingdate'),
                    'modeofpayment' => $this->input->post('modeofpayment'),
                    'methodofreceive' => $this->input->post('methodofreceive'),
                    'user_address' => $address,
                    'vn_names' => json_encode($names),
                    'products_id' => json_encode($products_id),
                    'qtys' => json_encode($qtys),
                    'prices' => json_encode($prices),
                    'link_images' => json_encode($images),
                    'vn_slugs' => json_encode($vn_slug),
                    'type_product' => json_encode($type),
                    'count' => json_encode($count),
                    'message' => $this->input->post('message'),
                    'created' => now(),
                );
                
                //them du lieu vao bang transaction
                $this->load->model('transaction_m');
                $this->load->model('configs_m');
                if($this->transaction_m->create($data)) {
                    $config = $this->configs_m->get_info(1);
                    $arrConfig = json_decode($config->values);
                    
                    $to = $email;  
                    $subject = 'Thông tin đơn hàng';
                    
                    $setForm = $arrConfig->email;
                    
                    $titleForm = $arrConfig->vn_title_site;
                    $totalPrice     = '';
                    $xhtml = '';
                    foreach ($names as $k => $val) {
                        $totalPrice  += $qtys[$k]*$prices[$k];
                        $link_img = base_url().'public/admin/img/default-534x534.png';
                        if(!empty($images[$k])){
                            $link_img = base_url().'uploads/images/product/'.$images[$k];
                        }
                        $strThang = $count[$k] > 1 ? ' (' . ($type[$k] + 1) . ' tháng)' : '';
                        $xhtml .= '<tr class="text-center">
                                  <td style="padding-top: 1.1rem;padding-bottom: 1rem;border: 1px solid #dee2e6;padding: .75rem;vertical-align: top;text-align: left !important;color: black;font-size: .9rem;font-weight: 300;">
                                    '.($k + 1).'
                                  </td>
                                  <td style="padding-top: 1.1rem;padding-bottom: 1rem;border: 1px solid #dee2e6;padding: .75rem;vertical-align: top;text-align: left !important;color: black;font-size: .9rem;font-weight: 300;display: flex;align-items: center;padding: 10px;">
                                    <img style="width: 100px;height: 100px;margin-right: 10px;" src="'.$link_img.'"/>
                                    <a href="'.base_url().$vn_slug[$k] .'-p'. $products_id[$k] .'.html">'.$val . $strThang .'</a>
                                  </td>
                                  <td style="padding-top: 1.1rem;padding-bottom: 1rem;border: 1px solid #dee2e6;padding: .75rem;vertical-align: top;text-align: left !important;color: black;font-size: .9rem;font-weight: 300;">
                            '.number_format($prices[$k]).'đ</td>
                                  <td style="padding-top: 1.1rem;padding-bottom: 1rem;border: 1px solid #dee2e6;padding: .75rem;vertical-align: top;text-align: left !important;color: black;font-size: .9rem;font-weight: 300;">
                            '.$qtys[$k].'</td> 
                                  <td style="padding-top: 1.1rem;padding-bottom: 1rem;border: 1px solid #dee2e6;padding: .75rem;vertical-align: top;text-align: left !important;color: black;font-size: .9rem;font-weight: 300;">
                            '.number_format($prices[$k]*$qtys[$k]).'đ</td>            
                                </tr>';
                    }
                    
                    $body = '<div>
                                 <h3> Chào '.$name.' bạn đã đặt hàng thành công. Chúng tôi sẽ giao hàng đúng hẹn</h3>
                            	 <table style="border: 1px solid #cccccc;width: 100%;margin-bottom: 1rem; background-color: transparent;border-collapse: collapse;padding: 0;margin: 0;box-sizing: border-box;">
                                  <thead style="background: #e1e1e1;border: none;">
                                    <tr>
                                      <th style="border-right: 1px solid #cccccc;text-align: center;font-weight: 500;border-top: none;padding-top: 1.1rem;padding-bottom: 1rem;border-bottom-width: 2px;vertical-align: bottom;border-bottom: 2px solid #dee2e6;border: 1px solid #dee2e6;padding: .75rem;font-size: .9rem;" scope="col">STT</th>
                                      <th scope="col">Tên sản phẩm</th>
                                      <th scope="col">Giá</th>
                                      <th scope="col">Số lượng</th>
                                      <th scope="col">Thành tiền</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                        '.$xhtml.'
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                        <td style="padding-top: 1.1rem;padding-bottom: 1rem;border: 1px solid #dee2e6;padding: .75rem;vertical-align: top;    text-align: center;color: black;font-size: .9rem;font-weight: 300;" colspan="9">
                                            Tổng : '.number_format($totalPrice).'đ</td>                           
                                    </tr>
                                </tfoot>
                            	</table>
                            </div>';
                    
                    // send mail customer
                    if($this->system_library->send_mail($to, $setForm, $titleForm, $subject, $body)) {
                        $transaction_id = $this->db->insert_id();  //lấy ra id của giao dịch vừa thêm vào
                        //xóa toàn bô giỏ hang
                        unset( $_SESSION['carts']);
                        
                        $this->session->set_flashdata('message', 'Đặt hàng thành công');
                        
                        redirect(base_url('order'));
                    }
                }
        }
        $breadcrumb[] = array(
            'url' => base_url(),
            'name' => 'Thanh toán',
        );

        $this->data['breadcrumb'] = $breadcrumb;

        $this->data['temp'] = 'cart/order';
        
        $this->one_col($this->data);
    }
    
    public function getNameAddress($id = 0, $type = 'province'){
        $query = '';
        $this->db->select('name');
    
        if($type == 'province'){
            $this->db->where('id', $id);
            $query =  $this->db->get('province');
        }
    
        if($type == 'district'){
            $this->db->where('id', $id);
            $query =  $this->db->get('district');
        }
    
        if($type == 'ward'){
            $this->db->where('id', $id);
            $query =  $this->db->get('ward');
        }
    
        if ($query->row()){
            return $query->row()->name;
        }else {
            return false;
        }
    
    }
    
    function address() {
        $this->load->model('province_m');
         
        if ($_POST['type'] == 'district'){
            $input = array();
            $this->db->where('province_id',  $_POST['province']);
            $query       = $this->db->get('district');
            $district    = $query->result();
            echo json_encode($district);
        }
    }

}
