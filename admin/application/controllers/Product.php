<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_m');
        
        $this->load->model('product_category_m');
        $this->load->model('province_m');
        $this->load->model('users_m');
    }

    public function index() {
        $slug = 'san-pham';
        $input = array();
        
        $input['where']['status'] = 1;

        if ($slug == 'san-pham') {
            $this->data['news'] = true;
        }  

        $total_rows = $this->product_m->get_total($input);
        //load ra thu vien phan trang
        $config = array();
        $config['total_rows'] = $total_rows;
        $config['base_url'] = base_url($slug . '/page/');
        $config['first_url'] = base_url($slug) .'.html';
        $config['per_page'] = 12;
        $config['num_links'] = 1;
        //custom pagination
        $config = array_merge($config, $this->system_library->pagination_site());
        //khoi tao cac cau hinh phan trang

        $this->pagination->initialize($config);
        $segment = $this->uri->segment(3);
        $segment = intval($segment);
        
        // truyền trang hiện tại trong tổng trang ra view
        $this->data['curent_page'] = ($config['per_page'] + $segment)/$config['per_page'];
        $this->data['total_page']  = ceil($total_rows / $config['per_page']);

        $this->data["pagination"] = $this->pagination->create_links();

        $input['limit'] = array($config['per_page'], $segment);
        $this->data['list_product'] = $this->product_m->get_list($input);        

        $breadcrumb[] = array(
            'url' => "",
            'name' => 'Sản phẩm',
        );

        $this->data['breadcrumb'] = $breadcrumb;

        $this->data['title_site'] = 'Sản phẩm';
        $this->data['keyword_site'] = 'Sản phẩm';
        $this->data['description_site'] = 'Sản phẩm';

        $this->data['temp'] = 'product/index';
        $this->one_col($this->data);
    }
    
    public function category($slug = '') {
        //echo $slug;die();
        $slug;
        $subPage = false;
        $where = array('status' => 1, 'vn_slug' => $slug);
        $category = $this->product_category_m->get_info_rule($where);
        $input = array();
        
        if ($category) {
            $this->data['category'] = $category;
           
            if ($category->pid == 0){
                $subcat     = $this->product_category_m->get_list(array('where'=>array('pid'=>$category->id)));               
                $id_cate    = array();
                
                foreach ($subcat as $row){
                    $id_cate[] = $row->id;                
                }
                
                if ($id_cate) {
                    $input['where']    = array('status' => 1);
                    $input['where_in'] = array('cid', $id_cate);

                    
                } else {
                    $input['where'] = array('status' => 1, 'cid' => $category->id);
                }
                
                $cate_slug = $category->vn_slug;
                
                $breadcrumb[] = array(
                    'url' => '',
                    'name' => $category->vn_name,
                );

            }else {
                $subPage        = true;
                $input['where'] = array('status' => 1, 'cid' => $category->id);
                $fatherCate     = $this->product_category_m->get_info($category->pid);
                $cate_slug      = $fatherCate->vn_slug;
                
                $breadcrumb[] = array(
                    'url' => base_url('danh-muc/') . $fatherCate->vn_slug . '.html' ,
                    'name' => $fatherCate->vn_name,
                );
                $breadcrumb[] = array(
                    'url' => '',
                    'name' => $category->vn_name,
                );
            }
            
            $total_rows = $this->product_m->get_total($input);
    
            //load ra thu vien phan trang
            $config = array();
            $config['total_rows'] = $total_rows;
            
             $this->data["total"] = $total_rows;
            
            if ($subPage){
                $config['base_url'] = base_url('danh-muc/' . $cate_slug . '/' . $slug .'/page/');
                $config['first_url'] = base_url('danh-muc/' . $cate_slug . '/' . $slug . '.html');
            }else {
                $config['base_url'] = base_url($slug . '/page/');
                $config['first_url'] = base_url($slug . '.html');
            }

            $config['per_page'] = 12;
            $config['num_links'] = 1;
            //custom pagination
            $config = array_merge($config, $this->system_library->pagination_site());
            //khoi tao cac cau hinh phan trang
            $this->pagination->initialize($config);
            if ($subPage){
                $segment = $this->uri->segment(5);
            }else {
                $segment = $this->uri->segment(3);
            }
             
            $segment = intval($segment);
            
           // truyền trang hiện tại trong tổng trang ra view
            $this->data['curent_page'] = ($config['per_page'] + $segment)/$config['per_page'];
            $this->data['total_page']  = ceil($total_rows / $config['per_page']);
    
            $this->data["pagination"] = $this->pagination->create_links();
            
            $input['limit'] = array($config['per_page'], $segment);
    
            $this->data['list_product'] = $this->product_m->get_list($input);
                       
    
            $this->data['breadcrumb'] = $breadcrumb;
    
            $this->data['title_site'] = $category->vn_title;
            $this->data['keyword_site'] = $category->vn_keyword;
            $this->data['description_site'] = $category->vn_description;
        }
    
    
        $this->data['temp'] = 'product/category';
        $this->one_col($this->data);
    }
    

    public function detail($slug = '', $id = 0) {
        //list comment
        $this->load->model('comments_m');
        $input = array();
        $input['where'] = array('product_id' => $id , 'status' => 1);
        
        $list_comments = $this->comments_m->get_list($input);
        $this->data['list_comments'] = $list_comments;

        $where = array(
            'status' => 1,
             'vn_slug' => $slug,
            'id' => $id
        );

        $object = $this->product_m->get_info_rule($where);

        if ($object) {
            $input = array();
            $input['id'] = $object->cid;
            
            $category = $this->product_category_m->get_info_rule($input);
            
            if ($category){


                $this->data['object'] = $object;
                
                //cap nhat lai luot xem cua san pham
                $data = array();
                $data['view'] = $object->view + 1;
                $this->product_m->update($object->id, $data);
                
                $breadcrumb = array(
                    array(
                        'url' => base_url($category->vn_slug . '.html'),
                        'name' =>$category->vn_name,
                    ),
                    array(
                        'url' => '',
                        'name' => $object->vn_name,
                    )
                );
                $input_related['where'] = array(
                    'id <>' => $object->id,
                    'cid' => $object->cid,
                    'status' => 1
                );
                
                $input_related['limit'] = array(2, 0);
                
                $this->data['related'] = $this->product_m->get_list($input_related);                
                
                $this->data['breadcrumb'] = $breadcrumb;
                
                $this->data['title_site'] = $object->vn_title;
                $this->data['keyword_site'] = $object->vn_keyword;
                $this->data['description_site'] = $object->vn_description;
            }

        }

        $this->data['temp'] = 'product/detail';
        $this->one_col($this->data);
    }
    
    function search() {
        
        $key = $this->input->get('key');

        $this->data['key'] = trim($key);
        $input = array();
        if(!empty($key)){
            $input['like'] = array('vn_name', $key);
            $input['or_like'] = array('vn_detail', $key);
        }

        $cid = $this->input->get('cid');
        $this->data['cid'] = $cid;
        if ($cid) {
            $input['where'] = array('cid' => $cid);
        }
        
        $limit = $this->input->post('limit') ? $this->input->post('limit') : 12;
        $this->data['limit'] = $limit;
        
        $list = $this->product_m->get_list($input);
        $this->data['list_product'] = $list;
    
        $breadcrumb = array(
            array(
                'url' => '#',
                'name' => 'Tìm kiếm'
            )
        );
    
        $this->data['breadcrumb'] = $breadcrumb;
    
        if ($this->uri->rsegment('3') == 1) {
            //xu ly autocomplete
            $result = array();
            foreach ($list as $row) {
                $item = array();
                $item['id'] = $row->id;
                $item['label'] = $row->name;
                $item['value'] = $row->name;
                $result[] = $item;
            }
            //du lieu tra ve duoi dang json
            die(json_encode($result));
        } else {
            //load view
            $this->data['temp'] = 'product/search';
            $this->one_col($this->data);
        }
    }
    // ajax get detail
    function get_detail() {
        $xhtml = '';
        if ($_POST) {
            $id = $_POST['id'];
            $action = $_POST['action'];
            $obj_product = $this->product_m->get_info($id);
            if($obj_product) {
                $xhtml .= $obj_product->$action;
            }
        }
        echo $xhtml;
    }
    
}
























