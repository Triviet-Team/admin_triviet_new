<?php

Class Cart extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    /*
     * Phuoc thuc them san pham vao gio hang
     */
    function add() {
        //lay ra san pham muon them vao gio hang
        $this->load->model('product_m');
        $id_product = $this->input->post('id');
        $qty = $this->input->post('qty') == '' ? 1 : $this->input->post('qty');
        $type = $this->input->post('type') == '' ? 0 : $this->input->post('type');
        $product = $this->product_m->get_info($id_product);
        
        if ($product){
            $prices = json_decode($product->price);
            $sale_prices = json_decode($product->sale_price);
            $price = $sale_prices[$type] > 0 ? $sale_prices[$type] : $prices[$type];
            //thong tin them vao gio hang  
            $id = substr(rand(0, 999),0,4);
            $data = array();
            $data['id_product'] = $id_product;
            $data['qty'] = $qty;
            $data['name'] = $product->vn_name;
            $data['vn_slug'] = $product->vn_slug;
            $data['image_link'] = $product->image_link;
            $data['price'] = $price;
            $data['type'] = $type;
            $data['count'] = count($prices);
            //unset($_SESSION['carts']);die();
            if (isset($_SESSION['carts'])) {
                $flag = false;
                foreach ($_SESSION['carts'] as $k => $value) {
                    if ($value['id_product'] == $id_product && $value['type'] == $type) {
                        $_SESSION['carts'][$k]['qty'] = $value['qty'] + 1;
                        $flag = true;
                    }
                }
                if(!$flag) {
                    $_SESSION['carts'][$id] = $data;
                }
            }else {
                $_SESSION['carts'][$id] = $data;
            }
            $total_items = 0;
            if ($_SESSION['carts']) {
                foreach ($_SESSION['carts'] as $val) {
                    $total_items = $total_items + $val['qty'];
                }
            }
            echo $total_items;
         }else {
            echo 0;
        }

    }

    /*
     * Hien thị ra danh sách sản phẩm trong gio hàng
     */

    function index() {
        //thong gio hang
        $carts = $this->cart->contents();
        //tong so san pham co trong gio hang
        $total_items = $this->cart->total_items();

        $this->data['carts'] = $_SESSION['carts'];
        
        $breadcrumb[] = array(
            'url' => '#',
            'name' => 'Giỏ hàng',
        );

        $this->data['breadcrumb'] = $breadcrumb;

        $this->data['title_site'] = 'Giỏ hàng';

        $this->data['temp'] = 'cart/index';
        $this->one_col($this->data);
    }

    /*
     * Cập nhật giỏ hàng
     */

    function update() {
        //thong gio hang
        $carts = $_SESSION['carts'];
        foreach ($carts as $key => $row) {
            //tong so luong san pham
            $total_qty = $this->input->post('qty_' . $key);
            $_SESSION['carts'][$key]['qty'] = $total_qty;
        }

        //chuyen sang trang danh sach san pham trong gio hang
        redirect(base_url('cart'));
    }

    /*
     * Xoa sản phẩm trong gio hang
     */

    function del() {
        $id = $this->uri->rsegment(3);
        $id = intval($id);
        //trường hợp xóa 1 sản phẩm nào đó trong giỏ hàng
        if ($id > 0) {
            //thong gio hang
            $carts = $_SESSION['carts'];
            foreach ($carts as $key => $row) {
                if ($key == $id) {
                    unset( $_SESSION['carts'][$id]);
                }
            }
        } else {
            //xóa toàn bô giỏ hang
            unset( $_SESSION['carts']);
        }

        //chuyen sang trang danh sach san pham trong gio hang
        redirect(base_url('cart'));
    }


}
