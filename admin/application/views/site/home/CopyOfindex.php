 <article>
      <section class="banner-top">
        <div class="container">
          <div class="row">
            <div class="col-md-6"><a href="<?= base_url() . $baner_home_1->link ?>"><img src="<?= base_url('uploads/images/ads/') . $baner_home_1->image_link ?>"/></a></div>
            <div class="col-md-6"><a href="<?= base_url() . $baner_home_2->link ?>"><img src="<?= base_url('uploads/images/ads/') . $baner_home_2->image_link ?>"/></a></div>
          </div>
        </div>
      </section>
  <?php if(@$list_product_home) { ?>  
  	<?php foreach ($list_product_home as $row_1) { ?>  
  		<?php if($row_1->list_product) { ?>
          <section class="product">
            <div class="container">
              <div class="title-page">
                <h1><?= $row_1->vn_name ?></h1>
              </div>
              <div class="product-zone">
              	<?php 
              	         $xhtmlListProductHome = '';
              	         foreach($row_1->list_product as $row){
              	             $link_img = base_url().'public/site/img/default-400x400.png';
              	             if(!empty($row->image_link)){
              	                 $link_img = base_url().'uploads/images/product/400_400/'.$row->image_link;
              	             }
              	             //$prices = $row->sale_price > 0 ? '<h4><span>'.number_format($row->price, 0, "", ".").' đ</span> '.number_format($row->sale_price, 0, "", ".").' đ</h4>' : '<h4>'.($row->price == 0 ? "Liên hệ" : number_format($row->price, 0, "", ".").' đ').'</h4>';
              	             $prices = $row->sale_price > 0 ? $row->sale_price : 'Liên hệ';
              	             $sale   = $row->sale_price > 0 ? '<h5 class="ratio-sale">'.round((1 - $row->sale_price / $row->price)*100).'%</h5>' : '';
              	             $new    = ($row->created + 30*24*60*60) > time() ? '<span>new</span>' : '';
              	             $xhtmlListProductHome .= '<div class="box-product">
                						<div class="box-product-status">
                							'.$new.'
                						</div>
                						<div class="box-product-img">
                							<div class="box-product-img-custom">
                								<a class="custom-quickview" onclick="javascript:watch('.$row->id.');" title="Xem nhanh" data-toggle="modal" data-target=".product-modal-1" href="#">
                                                    <i class="mdi mdi-eye-plus"></i>
                                                </a>
                                                <a class="custom-cart" onclick="javascript:addtocart('.$row->id.');" title="Thêm vào giỏ"><i class="mdi mdi-cart"></i></a>
                							</div>
                							<a href="'.base_url('chi-tiet-san-pham/').$row->vn_slug.'.html"><img
                								src="'.$link_img.'" /></a>
                						</div>
                						<div class="box-product-detail">
                							<h6>MSP: '.$row->code.'</h6>
                							<h5>
                								<a href="'.base_url('chi-tiet-san-pham/').$row->vn_slug.'.html" title="'.$row->vn_name.'">'.$row->vn_name.'</a>
                							</h5>
                							<h4>Giá: '.$prices.'</h4>
                							<p>'.$row->vn_sapo.'</p>
                						</div>
                					</div>';
              	         }
              	    echo $xhtmlListProductHome;
              	?>
              </div>
              <div class="product-all">
                <div class="product-all-btn"><a href="<?= base_url('danh-muc/') .$row_1->vn_slug ?>.html">Xem tất cả<i class="mdi mdi-arrow-right">   </i></a></div>
              </div>
            </div>
          </section>
          <?php } ?>
    <?php } ?>
 <?php } ?>     
      <section class="service">
        <div class="container">
          <div class="owl-carousel service-carousel owl-theme">
            <div class="item">
              <div class="box-service"><img src="<?=base_url('public/site/')?>img/service-1.png"/>
                <h3>vận chuyển miễn phí</h3>
                <h5>Cho tất cả các đơn hàng trên toàn quốc</h5>
              </div>
            </div>
            <div class="item">
              <div class="box-service"><img src="<?=base_url('public/site/')?>img/service-2.png"/>
                <h3>GIẢM GIÁ 20%</h3>
                <h5>Khi đặt hàng online</h5>
              </div>
            </div>
            <div class="item">
              <div class="box-service"><img src="<?=base_url('public/site/')?>img/service-3.png"/>
                <h3>ĐẶT HÀNG THEO YÊU CẦU</h3>
                <h5>Nếu quý khách chưa chọn được mẫu phù hợp</h5>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="news">
        <div class="container">
          <div class="title-page">
            <h1>tin tức nổi bật</h1>
          </div>
          <div class="owl-carousel news-carousel owl-theme">
          	<?php 
          	     if (@$newHome) {
          	         $xhtmlListNewsHome = '';
          	         foreach($newHome as $row){
          	             $link_img = base_url().'public/site/img/default-1024x512.png';
          	             if(!empty($row->image_link)){
          	                 $link_img = base_url().'uploads/images/news/1024_512/'.$row->image_link;
          	             }
          	             $day    = date('d', $row->created);
          	             $month  = date('m', $row->created);
          	             $xhtmlListNewsHome .= '<div class="item">
                                					<div class="box-news">
                                						<div class="box-news-img">
                                							<a href="'.base_url('chi-tiet/') . $row->vn_slug .'.html"><img
                                								src="'.$link_img.'" /></a>
                                						</div>
                                						<div class="box-news-detail">
                                							<div class="box-news-detail-date">
                                								<span>'.$day.'</span>/ Tháng '.$month.'
                                							</div>
                                							<h4>
                                								<a href="'.base_url('chi-tiet/') . $row->vn_slug .'.html"
                                									title="'.$row->vn_name.'">'.$row->vn_name.'</a>
                                							</h4>
                                							<h5>'.$row->vn_sapo.'</h5>
                                						</div>
                                					</div>
                                				</div>';
          	         }
          	         echo $xhtmlListNewsHome;
          	     }
          	?>
          </div>
        </div>
      </section>
    </article>