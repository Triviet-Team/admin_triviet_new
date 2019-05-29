<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('articles_m');

        $this->load->model('articles_category_m', 'category');
    }

    public function index($slug = '') {

        $where = array(
            'status' => 1,
            'vn_slug' => $slug
        );

        $category = $this->category->get_info_rule($where);
        

        if ($category) {
            $this->data['category'] = $category;
            $input['where'] = array(
                'status' => 1,
                'cid' => $category->id,
            );

            if ($slug == 'tin-tuc') {
                $this->data['news'] = true;
            }

            $total_rows = $this->articles_m->get_total($input);
            //load ra thu vien phan trang
            $config = array();
            $config['total_rows'] = $total_rows;
            $config['base_url'] = base_url($slug . '/page/');
            $config['first_url'] = base_url($slug) .'.html';
            $config['per_page'] = 6;
            $config['num_links'] = $total_rows;
            
            //custom pagination
            $config = array_merge($config, $this->system_library->pagination_site());
            //khoi tao cac cau hinh phan trang

            $this->pagination->initialize($config);
            $segment = $this->uri->segment(3);
            $segment = intval($segment);

            $this->data["pagination"] = $this->pagination->create_links();

            $input['limit'] = array($config['per_page'], $segment);

            $this->data['list_news'] = $this->articles_m->get_list($input);

            $breadcrumb[] = array(
                'url' => "",
                'name' => $category->vn_name,
            );

            $this->data['breadcrumb'] = $breadcrumb;

            $this->data['title_site'] = $category->vn_title;
            $this->data['keyword_site'] = $category->vn_keyword;
            $this->data['description_site'] = $category->vn_description;
        }

        $this->data['temp'] = 'articles/index';
        $this->one_col($this->data);
    }

    public function detail($slug = '', $id = 0) {
        $where = array(
            'status' => 1,
            'vn_slug' => $slug,
            'id' => $id
        );

        $object = $this->articles_m->get_info_rule($where);

        if ($object) {
            $this->data['object'] = $object;
            $category = $this->category->get_info($object->cid);
            //cap nhat lai luot xem cua san pham
            $data = array();
            $data['view'] = $object->view + 1;
            $this->articles_m->update($object->id, $data);
            
//             $input_related['where'] = array(
//                 'id <>' => $object->id,
//                 'cid' => $object->cid,
//                 'status' => 1
//             );
            
//             $input_related['limit'] = array(4, 0);
            
//             $this->data['related_news'] = $this->articles_m->get_list($input_related);

            $breadcrumb = array(
                array(
                    'url' => base_url($category->vn_slug . '.html'),
                    'name' => $category->vn_name,
                ),
                array(
                    'url' => base_url($category->vn_slug . '/' . $object->vn_slug . '.html'),
                    'name' => $object->vn_name,
                )
            );

            $this->data['breadcrumb'] = $breadcrumb;

            $this->data['title_site'] = $object->vn_title;
            $this->data['keyword_site'] = $object->vn_keyword;
            $this->data['description_site'] = $object->vn_description;
        }


        $this->data['temp'] = 'articles/detail';
        $this->one_col($this->data);
    }
}
