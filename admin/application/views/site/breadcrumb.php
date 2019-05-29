<?php 
    $xhtmlBreadcrumb = '';
    if(isset($breadcrumb)){
        $xhtmlBreadcrumb .= '<div class="breadcrumb"><ol class="breadcrumb"> <nav aria-label="breadcrumb"><ol class="breadcrumb" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">';
        $xhtmlBreadcrumb .= '<li class="breadcrumb-item"><a itemprop="url" href="'.base_url().'"><span itemprop="title">Trang chủ</span></a></li>';

        foreach($breadcrumb as $k => $row){
            if($k == count($breadcrumb) - 1){
                $xhtmlBreadcrumb .= '<li class="breadcrumb-item active" aria-current="page" itemprop="title">'.$row['name'].'</li>';
            }else{
                $xhtmlBreadcrumb .= '<li class="breadcrumb-item" aria-current="page" itemprop="title"><a itemprop="url" href="'.$row['url'].'"><span itemprop="title">'.$row['name'].'</span></a></li>';
            }
        }

        $xhtmlBreadcrumb .= '</ol></nav></ol></div>';
    }
    echo $xhtmlBreadcrumb;
?>



                
                
