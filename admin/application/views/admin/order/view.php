<div class="bg-white addHeight">
    <div class="ui-wid">
        <div class="form-head">
            <?= $title ?>
        </div>
        <div class="form-mid">
<!--
            <?php $this->load->view('admin/message') ?>

            <div class="horControlA">
                <div class="form-row">
                    <div class="col">
                        <input type="button" onclick="location.href = '<?= base_url('admincp/ads/detail') ?>'" class="form-control hand btn-primary" value="Thêm mới">
                    </div>
                    <div class="col">
                        <input type="button" onclick="action_item_all('enable_all', '<?= base_url('admincp/ads/config') ?>')" class="form-control hand btn-success" value="Hiển thị toàn bộ">
                    </div>
                    <div class="col">
                        <input type="button" onclick="action_item_all('disable_all', '<?= base_url('admincp/ads/config') ?>')" class="form-control hand btn-warning" value="Ẩn toàn bộ">
                    </div>
                    <div class="col">
                        <input type="button" onclick="action_item_all('del_all', '<?= base_url('admincp/ads/config') ?>')" class="form-control hand btn-danger" value="Xóa toàn bộ">
                    </div>
                    <div class="col">
                        <input type="button" onclick="location.href = '<?= base_url('admincp/ads/clean_trash') ?>'" class="form-control hand btn btn-info" value="Dọn rác">
                    </div>
                </div>
            </div>-->

            <div class="title">
                <div class="titleicon">
                </div>
                <div class="num">
                </div>
            </div>
            <table class="table table-bordered">
<!--                <thead>
                    <tr>
                        <td colspan="9">
                            <form method="GET" action="">
                                <div class="form-row">
                                    <div class="col-1">
                                        <input type="text" name="id" class="form-control" placeholder="Mã số">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="vn_name" class="form-control" placeholder="Tên ADS">
                                    </div>
                                    <div class="col">
                                        <select class="custom-select" id="select" name="cid">
                                            <option value="0">Chọn Danh Mục</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <input type="submit" class="form-control hand btn-success" value="Lọc">
                                    </div>
                                    <div class="col-2">
                                        <input type="reset" onclick="location.href = '<?= base_url('admincp/contact') ?>'" class="form-control hand btn-info" value="Reset">
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                </thead>-->

                <thead>
                    <tr>
                        <th scope="col" width=5%>STT</th>
                        <th scope="col" width=8%>Mã Số</th>
                        <th scope="col" class="text-center" width=8%>Số lượng sản phẩm</th>
                        <th scope="col" width=25%>Tên sản phẩm</th>                        
                        <th scope="col" width=8%>Giá sản phẩm</th>
                        <th scope="col" width=8%>Trạng thái</th>
                        <th scope="col" width=10%>Ngày nhận</th>
                    </tr>
                </thead>
                <?php 
                     $totalPrice = '';
                     if (@$view) { 
                        $prices         = json_decode($view->prices);
                        $totalPrice     = '';
                        $qtys           = json_decode($view->qtys);
                        $vn_names       = json_decode($view->vn_names);
                        $products_id    = json_decode($view->products_id);
                        $link_images    = json_decode($view->link_images);
                        $vn_slugs       = json_decode($view->vn_slugs);
                        $type           = json_decode($view->type_product);
                        $count          = json_decode($view->count);
                
                ?>
                    <tbody>
                        <?php
                        foreach ($vn_names as $k => $val) {
                            $totalPrice  += $qtys[$k]*$prices[$k];
                            ?>
                            <tr>
                                <td class="text-center"><?= $k ?></td>
                                <td class="text-center"><?= $products_id[$k] ?></td>
                                <td class="text-center"><b><?= $qtys[$k] ?></b></td>
                                <td class="text-center">
                                	 <div class="image_thumb">
                                        <?php 
                                                $link_img = base_url().'public/admin/img/default-534x534.png';
                                                if(!empty($link_images[$k])){
                                                    $link_img = base_url().'uploads/images/product/'.$link_images[$k];
                                                }
                                        ?>
                                        <img src="<?= $link_img ?>" alt=""/>
                                    </div>
                                    <div class="info_products">
                                    	<?php 
                                        	// check xem product coa mấy loại(1 tháng, 2 tháng, 3 tháng)
                                        	$strThang = $count[$k] > 1 ? ' (' . ($type[$k] + 1) . ' tháng)' : '';
                                    	?>
                                        <b><a href="<?=base_url().$vn_slugs[$k] .'-p' . $products_id[$k]?>.html"><?= $vn_names[$k] . $strThang ?></a></b>
                                    </div>
                                </td>
                                <td class="text-center"><?= number_format($prices[$k]) ?> đ</td>
                                <td class="text-center" id="status_<?=$prices[$k] ?>">
                                    <img src="<?= base_url() ?>public/admin/img/icon/action_<?= @$view->status ?>.png" alt=""/>
                                </td>
                                <td class="text-center"><?=date('H:i:s - d/m/Y', @$view->created) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        Tổng : <?=$totalPrice == '' ? "0đ" : number_format($totalPrice) . "đ"?>
                                    </ul>
                                </nav>
                            </td>                           
                        </tr>
                    </tfoot>                                       
            </table>
            <table>
            	<thead>
            		<th>
            			<tr></tr>
            		</th>
            	</thead>
            	
            </table>
            
			<div class="thong-tin-khach-hang">
    				<h3 style="font-weight:bold;margin-bottom:20px">Thông tin khách hàng</h3>
    			   <table style="margin-bottom:50px" class="table table-bordered">
                      <thead style="background:#f4f4f4">
                        <tr>
                          <th scope="col">Họ tên</th>
                          <th scope="col">Điện thoại</th>
                          <th scope="col">Email</th>
                          <th scope="col">Địa chỉ nhận hàng</th>
                          <th scope="col">Lời nhắn</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="text-center">
                          <td><?= $view->user_name ?></td>
                          <td><?= $view->user_phone ?></td>
                          <td><?= $view->user_email ?></td>
                          <td><?= $view->user_address ?></td>
                          <td><?= $view->message ?></td>
                        </tr>
                      </tbody>
                    </table>
    			</div>
			<div class="thong-tin-khach-hang">
				<h3 style="font-weight:bold;margin-bottom:20px">Thông tin thanh toán</h3>
    				 <table class="table table-bordered">
                      <thead style="background:#f4f4f4">
                        <tr>
                          <th scope="col">Mã giao dịch</th>
                          <th scope="col">Ngày tạo</th>
                          <th scope="col">Số lượng</th>
                          <th scope="col">Tổng số tiền thanh toán</th>
                          <th scope="col">PT thanh toán</th>
                          <th scope="col">PT nhân hàng</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="text-center">
                          <td><?= $view->code ?></td>
                          <td><?= date('H:i:s - d/m/Y', $view->created) ?></td>
                          <td><?= array_sum(json_decode($view->qtys))?></td>
                          <td><?=$totalPrice == '' ? "0đ" : number_format($totalPrice) . "đ"?></td>
                          <td><?= $view->modeofpayment == 0 ? 'Thanh toán bằng tiền mặt' : 'Thanh toán bằng chuyển khoản' ?></td>
                          <td><?= $view->methodofreceive == 0 ? 'Khách đến nhận hàng' : 'Giao hàng tại nhà' ?></td>
                          
                        </tr>
                      </tbody>
    				</table>
				</div>
               <?php } else { ?>
                    <tbody>
                        <tr>
                            <td colspan="9" class="text-center">Chưa có dữ liệu trong bảng này</td>
                        </tr>
                    </tbody>
                <?php } ?>
        </div>
    </div>
</div>