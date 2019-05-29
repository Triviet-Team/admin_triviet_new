
<?php
    $xhtmlListProduct = '';
    if(!empty($list_product)){
        foreach($list_product as $row){
            $link_img = base_url().'public/site/img/default-400x400.png';
            if(!empty($row->image_link)){
                $link_img = base_url().'uploads/images/product/'.$row->image_link;
            } 
            $price = json_decode($row->price);
            $sale_price = json_decode($row->sale_price);
            $prices = $sale_price[0] > 0 ? '<h4>'.number_format($sale_price[0], 0, "", ".").' VNĐ<span> '.number_format($price[0], 0, "", ".").' VNĐ</span></h4>' : '<h4>'.($price[0] == 0 ? "Liên hệ" : number_format($price[0], 0, "", ".").' VNĐ').'</h4>';
            //$prices = $row->sale_price > 0 ? $row->sale_price : 'Liên hệ';
            $sale   = $row->sale_price > 0 ? '<h5 class="ratio-sale">'.round((1 - $row->sale_price / $row->price)*100).'%</h5>' : '';
            $new    = ($row->created + 30*24*60*60) > time() ? '<span>new</span>' : '';
            $xhtmlListProduct .= '<div class="box-product">
                                      <div class="box-product-img"> <a href="'.base_url().$row->vn_slug.'-p'.$row->id.'.html"><img src="'.$link_img.'"/></a></div>
                                      <div class="box-product-detail">
                                        <h3><a href="'.base_url().$row->vn_slug.'-p'.$row->id.'.html">'.$row->vn_name.'</a></h3>
                                        '.$prices.'
                                        
                                        <div class="box-product-detail-btn"><a href="'.base_url().$row->vn_slug.'-p'.$row->id.'.html">Xem chi tiết</a></div>
                                      </div>
                                    </div>';
        }
    }else{
        $xhtmlListProduct = '<p>Dữ liệu đang cập nhật</p>';
    }

?>
<article>
  <section class="bread-crumb">
    <div class="container">
		<?php $this->load->view('site/breadcrumb'); ?>
    </div>
  </section>
  <section class="product-page">
    <div class="container">
		<?php $this->load->view('site/sidebar'); ?>
      <div class="main">
            <h2>Tất cả sản phẩm</h2>
		  	<div class="main-zone">
				<?php echo $xhtmlListProduct; ?>
			</div>
		    <div class="main-paging">
              <nav>
                <ul class="pagination justify-content-end">
                	<?=$pagination?>
                </ul>
              </nav>
           </div>
      </div>
    </div>
  </section>
</article>
<?php $this->load->view('site/registration_footer'); ?>

