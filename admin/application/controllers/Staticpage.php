<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staticpage extends MY_Controller {

    public function index($slug = '') {

        $this->load->model('staticpage_m');

        $where = array(
            'vn_slug' => $slug,
            'status' => 1,
        );

        $staticpage = $this->staticpage_m->get_info_rule($where);

        if ($staticpage) {

            $this->data['staticpage'] = $staticpage;

            $breadcrumb = array(
                array(
                    'url' => base_url($staticpage->vn_slug),
                    'name' => $staticpage->vn_name,
                ),
            );

            $this->data['breadcrumb'] = $breadcrumb;

            $this->data['title_site'] = $staticpage->vn_title;
            $this->data['keyword_site'] = $staticpage->vn_keyword;
            $this->data['description_site'] = $staticpage->vn_description;
        }




        $this->data['temp'] = 'staticpage/index';
        $this->one_col($this->data);
    }

}
