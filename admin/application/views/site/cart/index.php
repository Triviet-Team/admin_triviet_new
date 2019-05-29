<article>
	<section class="bread-crumb">
		<div class="container">
			<?php $this->load->view('site/breadcrumb'); ?>
		</div>
		<section class="cart-page">
			<div class="container">
			 <?php if ($carts) { ?>
				<div class="cart-page-product">
					<div class="table-responsive">
					<form id="form-cart" action="<?php echo base_url('cart/update') ?>" method="post">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th scope="col">Sản phẩm</th>
									<th scope="col">Giá</th>
									<th scope="col">Số lượng</th>
									<th scope="col">Thành tiền</th>
								</tr>
							</thead>
							<tbody>
							 <?php $total_amount = 0;?>

                        	<?php foreach ($carts as $k => $row) { ?>
                            <?php $total_amount = $total_amount + $row['subtotal']; ?>
								<tr>
                                	<?php 
                                    	$link_img = base_url().'public/site/img/default-400x400.png';
                                    	if(!empty($row['image_link'])){
                                    	    $link_img = base_url().'uploads/images/product/'.$row['image_link'];
                                    	}
                                	?>
									<td class="cart-page-product-1"><img src="<?= $link_img ?>" alt="" />
										<h5>
											<?php 
											     // check xem product coa mấy loại(1 tháng, 2 tháng, 3 tháng)
											     $strThang = $row['count'] > 1 ? ' (' . ($row['type'] + 1) . ' tháng)' : '';
											?>
											<a href="<?= base_url() . $row['vn_slug'] . '-p' . $row['id_product'] ?>.html"><?= $row['name'] . $strThang; ?></a>
										</h5>
										<div class="cart-remove">
											<a title="Xóa sản phẩm" href="<?= base_url('cart/del/' . $k) ?>"><i class="mdi mdi-close"></i></a>
										</div></td>
									<td>
										<h4>Giá: <?= ($row['price'] > 0 ? number_format($row['price']) . ' đ' : 'Liên hệ')?></h4>
									</td>
									<td class="quantity">
										<button type="button" class="waves-effect waves-light">-</button> 
											<input name="qty_<?= $k ?>" type="number" value="<?= $row['qty']; ?>" min="1" />
										<button type="button" class="waves-effect waves-light">+</button>
									</td>
									<td class="cart-page-product-3">
										<h4>Giá: <?= ($row['price'] > 0 ? number_format($row['price']*$row['qty']) . ' đ' : 'Liên hệ')?></h4>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
						</form>
					</div>
				</div>
				<div class="row">
					<div
						class="col-lg-5 col-md-4 text-center text-md-left order-md-0 order-12">
						<div class="cart-page-btn">
							<a href="<?= base_url('san-pham.html') ?>"><i class="fa fa-undo" aria-hidden="true"></i>
								Tiếp tục mua sắm</a>
						</div>
					</div>
					<div class="col-lg-7 order-lg-3 col-md-8">
						<div class="cart-page-btn text-lg-right text-md-right text-center">
							<button>
								<a class="submit"><i class="fa fa-refresh" aria-hidden="true"></i> Cập nhật giỏ hàng</a>
							</button>
							<button>
								<a href="<?= base_url('cart/del') ?>"><i class="fa fa-times" aria-hidden="true"></i> Xóa giỏ hàng</a>
							</button>
						</div>
					</div>
				</div>
				<div class="cart-page-total-btn">
					<a href="<?= base_url('order/checkout') ?>">tiến hành thanh toán</a>
				</div>
    	<?php } else { ?>
            <p class="text-center" style="margin-bottom: 15px;">Không có sản phẩm trong giỏ hàng</p>
        <?php } ?>
			</div>
		</section>
	</section>
</article>
