<article>
      <section class="bread-crumb">
        <div class="container">
			<?php $this->load->view('site/breadcrumb'); ?>
        </div>
      </section>
<?php if($object){ ?>
      <section class="product-page">
        <div class="container">
          <div class="left">
			<?php $this->load->view('site/sidebar'); ?>
          </div>
          <div class="main">
            <div class="product-detail">
              <div class="product-detail-1">
                <div class="row">
                  <div class="col-md-6">
                  <?php 
                      $link_img = base_url().'public/site/img/default-400x400.png';
                      if(!empty($object->image_link)){
                          $link_img = base_url().'uploads/images/product/400_400/'.$object->image_link;
                      }
                  ?>
                    <div class="product-detail-1-img"><img class="main-image xzoom" src="<?=$link_img?>" xoriginal="<?= base_url().'uploads/images/product/'.$object->image_link ?>"/>
                      <div class="xzoom-thumbs">
                        <div class="owl-carousel xzoom-carousel owl-theme">
                          <div class="item"><a href="<?= base_url().'uploads/images/product/'.$object->image_link ?>"><img class="xzoom-gallery" src="<?=$link_img?>" xpreview="<?=$link_img?>"/></a></div>
                  		<?php 
						    $listImages = json_decode($object->image_list);								   								    
						    if(count($listImages) > 0){
						        $xhtmlImageList = '';
						        foreach ($listImages as $k => $value){
						            $link_img = base_url().'public/site/img/default-400x400.png';
						            if(!empty($value)){
						                $link_img = base_url().'uploads/images/product/400_400/'.$value;
						            }
						            $xhtmlImageList .= '<div class="item"><a href="'. base_url().'uploads/images/product/'.$value.'"><img class="xzoom-gallery" src="'.$link_img.'" xpreview="'.$link_img.'"/></a></div>';
						        }
						        echo $xhtmlImageList;

						    }					        
						?>
						  <!-- 													end list images -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="product-detail-1-detail">
                      <h2><?=$object->vn_name?></h2>
                      <p>MSP: <?=$object->code?></p>
                      <h4 class="price-product">Giá: <?= $object->sale_price > 0 ? $object->sale_price: 'Liên hệ' ?></h4>
                      <h5><?=$object->vn_sapo?></h5>
                      <div class="quantity"><span>Số lượng: </span>
                        <button class="waves-effect waves-light">-</button>
                        <input id="qty-detail" type="number" value="1" min="1"/>
                        <button class="waves-effect waves-light">+</button>
                        <button class="custom-cart" onclick="javascript:addtocart(<?=$object->id?>, 'detail');">thêm vào giỏ</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="product-detail-2">
                <div class="product-detail-2-title">
                  <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="desc-1-tab" data-toggle="tab" href="#desc-1" role="tab" aria-controls="desc-1" aria-selected="true">Chi tiết sản phẩm</a></li>
                  </ul>
                </div>
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="desc-1" role="tabpanel" aria-labelledby="desc-1-tab">
					<div><?=$object->vn_detail?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
   <?php if(!empty($related)){?>
      <section class="similar-product">
        <div class="container">
          <div class="title-page">
            <h1>sản phẩm liên quan</h1>
          </div>
          <div class="similar-box">
				<?php
                    $xhtmlListRelated = '';
                    foreach($related as $row){
                        $link_img = base_url().'public/site/img/default-400x400.png';
                        if(!empty($row->image_link)){
                            $link_img = base_url().'uploads/images/product/400_400/'.$row->image_link;
                        }   
                        
                        //$prices = $row->sale_price > 0 ? '<h4><span>'.number_format($row->price, 0, "", ".").' đ</span> '.number_format($row->sale_price, 0, "", ".").' đ</h4>' : '<h4>'.($row->price == 0 ? "Liên hệ" : number_format($row->price, 0, "", ".").' đ').'</h4>';
                        $prices = $row->sale_price > 0 ? $row->sale_price : 'Liên hệ';
                        $sale   = $row->sale_price > 0 ? '<h5 class="ratio-sale">'.round((1 - $row->sale_price / $row->price)*100).'%</h5>' : '';
                        $new    = ($row->created + 30*24*60*60) > time() ? '<span>new</span>' : '';
                        $xhtmlListRelated .= '<div class="box-product">
                            					<div class="box-product-status">
                            						'.$new.'
                            					</div>
                            					<div class="box-product-img">
                            						<div class="box-product-img-custom">
                            							<a class="custom-quickview" onclick="javascript:watch('.$row->id.');" title="Xem nhanh" data-toggle="modal" data-target=".product-modal-1" href="#">
                                                            <i class="mdi mdi-eye-plus"></i></a>
                                                        <a class="custom-cart" onclick="javascript:addtocart('.$row->id.');" title="Thêm vào giỏ"><i class="mdi mdi-cart"></i></a>
                            						</div>
                            						<a href="'.base_url('chi-tiet-san-pham/').$row->vn_slug.'.html"><img src="'.$link_img.'" /></a>
                            					</div>
                            					<div class="box-product-detail">
                            						<h6>MSP: '.$row->code.'</h6>
                            						<h5>
                            							<a href="'.base_url('chi-tiet-san-pham/').$row->vn_slug.'.html" title="Cánh cửa gỗ ABC - 123">'.$row->vn_name.'</a>
                            						</h5>
                            						<h4>Giá: '.$prices.'</h4>
                            						<p>'.$row->vn_sapo.'</p>
                            					</div>
                            				</div>';
                   }
                   echo $xhtmlListRelated;
            ?>
          </div>
        </div>
      </section>
   <?php } //end sản phẩm liên quan ?>
<?php }else {
    echo 'Dữ liệu rỗng';
}?>
    </article>







