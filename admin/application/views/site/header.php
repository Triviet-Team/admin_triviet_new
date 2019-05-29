    <div class="go-top" title="Lên đầu trang"><span></span><span></span></div>
    <header>
      <section class="header-top">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="hotline"><a href="tel:0903983606"><i class="mdi mdi-deskphone"></i><?= @$config->hotline ?></a></div>
            </div>
            <div class="col-md-9 text-right d-none d-md-block">
              <ul>
                <li><a href="<?= base_url('thong-tin-san-pham.html') ?>">Thông tin sản phẩm</a></li>
                <li><a href="<?= base_url('hoi-dap.html') ?>">Hỏi đáp</a></li>
                <li><a href="<?= base_url('phuong-thuc-van-chuyen.html') ?>">Phương thức vận chuyển </a></li>
                <li><a href="<?= base_url('hang-tra-ve.html') ?>">Hàng trả về</a></li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <section class="menu wow">
        <div class="container">
          <div class="row">
            <div class="col-lg-2 col-6">
              <div class="logo"><a href="<?= base_url() ?>"><img src="<?=base_url('public/site/')?>img/logo.png"/></a></div>
            </div>
            <div class="col-lg-9 col-0 order-last order-lg-0">
              <div class="main-menu">
                <ul class="nav">
                  <div class="nav-close"><i class="mdi mdi-close d-block d-lg-none"></i></div>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Trang chủ</a></li>
          		  <?php if(@$categorys){?>
					 <?php foreach ($categorys as $row){?>
					     <li class="nav-item"><a class="nav-link" href="<?= base_url() . $row->vn_slug ?>.html"><?= $row->vn_name ?></a></li>
                     <?php } ?>
				  <?php } ?>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url('giay-phep.html') ?>">Giấy phép</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?= base_url('lien-he.html') ?>">Liên hệ</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-1 col-6 text-right">
					<div class="custom-header">
						<a class="toggleMenu d-inline-block d-lg-none"><i class="mdi mdi-menu"></i></a>
						<a class="cart-btn" href="<?= base_url('cart') ?>" title="Nhấn để xem giỏ hàng">
							<?php 
    							$total_items = 0;
    							if ($_SESSION['carts']) {
    							    foreach ($_SESSION['carts'] as $val) {
    							        $total_items = $total_items + $val['qty'];
    							    }
    							}
							?>
							<i class="mdi mdi-cart-outline"></i><span id="items"><?= ($total_items > 0) ? '(' . $total_items . ')' : ''?></span>
						</a>
					</div>
				</div>
          </div>
        </div>
      </section>
      <div class="overlay-menu"></div>
    </header>