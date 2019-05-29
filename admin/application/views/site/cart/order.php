<article>
      <section class="bread-crumb">
        <div class="container">
			<?php $this->load->view('site/breadcrumb'); ?>
        </div>
        <section class="pay-page">
          <div class="container">
              <div class="row">
                <div class="col-lg-4">
                  <div class="pay-page-title">
                    <h4>Đơn hàng</h4>
                  </div>
                  <div class="pay-order">
                    <p><?= @$total_items ?> sản phẩm trong giỏ hàng</p>
                    <?php $total_pay = 0 ?>
                    <?php foreach ($carts as $row) { ?>
                    	<?php $total_pay += $row['qty']* $row['price'] > 0 ? $row['qty']* $row['price'] : 0 ?>
                        <div class="row">
                          <div class="col-lg-12">
                            <?php 
                            	$link_img = base_url().'public/site/img/default-400x400.png';
                            	if(!empty($row['image_link'])){
                            	    $link_img = base_url().'uploads/images/product/'.$row['image_link'];
                            	}
                        	?>
                            <div class="box-pay-order"><img src="<?= $link_img ?>" alt=""/>
                              <h5><a href="<?= base_url() . $row['vn_slug'] . '-p' . $row['id'] ?>.html"><?= $row['name']; ?></a></h5>
                              <h5>Số lượng: <?= $row['qty']; ?></h5>
                              <h4>Giá: <?= ($row['price'] > 0 ? number_format($row['price']) . ' đ' : 'Liên hệ')?></h4>
                            </div>
                          </div>
                        </div>
                    <?php } ?>
                     <p style="margin-top: 20px;">Tổng tiền thanh toán: <?= @$total_pay ?  number_format($total_pay) . 'đ' : '<span style="color: red; font-size: 18px;">Liên hệ</span>'?></p>
                  </div>
                </div>
                <div class="col-lg-8 order-lg-4">
                <form id="myform" method="POST" action="<?= base_url('order/checkout') ?>">
                  <div class="pay-info">
                    <div class="pay-page-title">
                      <h4>Thông tin mua hàng</h4>
                    </div>
                    <div class="pay-info-1">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="name">Họ tên* :</label>
                            <input class="form-control" id="name" name="user_name" type="text" placeholder="Nhập họ tên"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="city">Tỉnh / Thành* :</label>
                            <select name="province" class="form-control" id="province">
                              <option value="">-- Chọn tỉnh thành ---</option>
                              	<?php if(@$provinces){?>
                            		<?php foreach ($provinces as $row){?>
                            			<option value="<?= $row->id ?>"><?= $row->name ?></option>
                            		<?php }?>
                            	<?php }?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 order-6 order-md-0">
                          <div class="form-group">
                            <label for="email">Email* :</label>
                            <input class="form-control" id="email" name="user_email" type="email" placeholder="Nhập Email"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="district">Quận / Huyện* :</label>
                            <select name="district"  class="form-control" id="district">
                              <option value="">-- Chọn quận huyện ---</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="phone">Số điện thoại* :</label>
                            <input class="form-control" id="phone" name="user_phone" type="tel" placeholder="Nhập số điện thoại"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="address">Địa chỉ* :</label>
                            <input class="form-control" id="address" name="user_address" type="text" placeholder="Nhập địa chỉ"/>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="content">Ghi chú* :</label>
                            <textarea name="message" class="form-control required" id="content" placeholder="Nhập ghi chú"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="pay-info-2-btn text-right">
                      	<a href="<?= base_url('cart') ?>"><i class="fa fa-undo" aria-hidden="true"></i>Trở về giỏ hàng</a>
                        <button type="submit"><a class="order-btn">Đặt hàng</a></button>
                      </div>
                    </div>
                  </div>
                 </form>
                </div>
              </div>
          </div>
        </section>
      </section>
    </article>