<?php

Class Product_m extends MY_Model {

    var $table = 'product';
    
    public function loadListProduct($is = 'is_home', $limit = 1){
        $where['where'] = array('status' => 1, $is => 1);
        $where['limit'] = array($limit, 0);
        $list = $this->get_list($where);
        
        return $list;
    }

}
