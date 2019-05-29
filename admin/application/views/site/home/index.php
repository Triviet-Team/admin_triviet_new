    <article>
      <section class="slider mt-4">
        <div class="container">
            <div class="owl-carousel slider-carousel owl-theme">
    			<?php 
        			  $xhtmlSliderTop = '';
        			  if (@$slider_home){
                            foreach ($slider_home as $k => $row){
                                $link_img = base_url().'public/site/default-1024x1024.png';
                                if(!empty($row->image_link)){
                                    $link_img = base_url().'uploads/images/ads/'.$row->image_link;
                                }
                                $xhtmlSliderTop .= '<div class="item">
                            							<a href="'.$row->link.'"><img
                            								src="'.$link_img.'" /></a>
                            						</div>';
                            }
        			  }
        			  echo $xhtmlSliderTop;
    			?>
            </div>
        </div>
      </section>
       <?php if($list_baner_home[8]) { ?>
      <section class="about">
        <div class="container">
          <div class="row">
            <div class="col-md-5">
              <div class="about-img"><img src="<?= base_url().'uploads/images/ads/'.$list_baner_home[8]->image_link ?>"/></div>
            </div>
            <div class="col-md-7">
              <div class="about-detail">
                <div class="title-page">
                  <h1><?= $list_baner_home[8]->vn_name ?></h1>
                </div>
				<?= $list_baner_home[8]->vn_sapo ?>
                <div class="about-detail-btn"><a href="<?= $list_baner_home[8]->link ?>">xem chi tiết</a></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php } ?>
      <?php if($list_baner_home[7]) { ?>
      <section class="why">
        <div class="why-img" style="background-image: url('<?= base_url().'uploads/images/ads/'.$list_baner_home[7]->image_link ?>')"></div>
        <div class="why-detail">
          <div class="why-detail-zone">
            <div class="title-page">
              <a href="<?= $list_baner_home[7]->link ?>"><h1><?= $list_baner_home[7]->vn_name ?></h1></a>
            </div>
			<?= $list_baner_home[7]->vn_sapo ?>
			<div class="why-detail-btn">
			    <a href="<?= $list_baner_home[7]->link ?>">Xem thêm</a>
			</div>
          </div>
        </div>
      </section>
      <?php } ?>
      <section class="result">
        <div class="container">
          <ul>
          <?php if($list_baner_home[6]) { ?>
            <li>
              <div class="box-result">
                <div class="box-result-in text-center"><img src="<?= base_url().'uploads/images/ads/'.$list_baner_home[6]->image_link ?>"/>
                  <h4><?= $list_baner_home[6]->vn_name ?></h4>
                  <?= $list_baner_home[6]->vn_sapo ?>
                </div>
              </div><span></span>
            </li>
            <?php } ?>
            <li class="order-first order-lg-0">
              <div class="box-result">
                <div class="box-result-in text-center">
                  <div class="title-page">
                    <h1>KẾT QUẢ SAU 3-4 TUẦN SỬ DỤNG TRILASTIN</h1>
                  </div>
                </div>
              </div><span></span>
            </li>
            <?php if($list_baner_home[5]) { ?>
            <li>
              <div class="box-result">
                <div class="box-result-in text-center"><img src="<?= base_url().'uploads/images/ads/'.$list_baner_home[5]->image_link ?>"/>
                  <h4><?= $list_baner_home[5]->vn_name ?></h4>
                  <?= $list_baner_home[5]->vn_sapo ?>
                </div>
              </div><span></span>
            </li>
            <?php } ?>
            <?php if($list_baner_home[4]) { ?>
            <li>
              <div class="box-result">
                <div class="box-result-in text-center"><img src="<?= base_url().'uploads/images/ads/'.$list_baner_home[4]->image_link ?>"/>
                  <h4><?= $list_baner_home[4]->vn_name ?></h4>
                  <?= $list_baner_home[4]->vn_sapo ?>
                </div>
              </div><span></span>
            </li>
            <?php } ?>
            <?php if($list_baner_home[3]) { ?>
            <li>
              <div class="box-result">
                <div class="box-result-in text-center"><img src="<?= base_url().'uploads/images/ads/'.$list_baner_home[3]->image_link ?>"/>
                  <h4><?= $list_baner_home[3]->vn_name ?></h4>
                  <?= $list_baner_home[3]->vn_sapo ?>
                </div>
              </div><span></span>
            </li>
            <?php } ?>
            <?php if($list_baner_home[2]) { ?>
            <li>
              <div class="box-result">
                <div class="box-result-in text-center"><img src="<?= base_url().'uploads/images/ads/'.$list_baner_home[2]->image_link ?>"/>
                  <h4><?= $list_baner_home[2]->vn_name ?></h4>
                  <?= $list_baner_home[2]->vn_sapo ?>
                </div>
              </div><span></span>
            </li>
            <?php } ?>
          </ul>
        </div>
      </section>
      <section class="product-home">
        <div class="container">
          <div class="title-page">
            <h1>SẢN PHẨM CỦA CHÚNG TÔI</h1>
          </div>
          <?php if($list_baner_home[1]) { ?>
          <div class="box-product">
            <div class="row">
              <div class="col-md-6 order-first order-md-last">
                <div class="box-product-img"><a href="<?= $list_baner_home[1]->link ?>"><img src="<?= base_url().'uploads/images/ads/'.$list_baner_home[1]->image_link ?>"/></a></div>
              </div>
              <div class="col-md-6">
                <div class="box-product-detail">
                  <h5>sản phẩm chính</h5>
                  <h1><a href="<?= $list_baner_home[1]->link ?>"><?= $list_baner_home[1]->vn_name ?></a></h1>
					<?= $list_baner_home[1]->vn_sapo ?>
                  <div class="box-product-detail-btn"> <a href="<?= $list_baner_home[1]->link ?>">Xem chi tiết</a></div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if($list_baner_home[0]) { ?>
          <div class="box-product">
            <div class="row">
              <div class="col-md-6">
                <div class="box-product-img"><a href="<?= $list_baner_home[0]->link ?>"><img src="<?= base_url().'uploads/images/ads/'.$list_baner_home[0]->image_link ?>"/></a></div>
              </div>
              <div class="col-md-6">
                <div class="box-product-detail">
                  <h5>sản phẩm chính</h5>
                  <h1><a href="<?= $list_baner_home[0]->link ?>"><?= $list_baner_home[0]->vn_name ?></a></h1>
					<?= $list_baner_home[0]->vn_sapo ?>
                  <div class="box-product-detail-btn"> <a href="<?= $list_baner_home[0]->link ?>">Xem chi tiết</a></div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </section>
    </article>
<?php $this->load->view('site/registration_footer'); ?>