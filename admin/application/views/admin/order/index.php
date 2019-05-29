<div class="bg-white addHeight">
    <div class="ui-wid">
        <div class="form-head">
            <?= $title ?>
        </div>
        <div class="form-mid">

            <?php $this->load->view('admin/message') ?>

            <div class="horControlA">
                <div class="form-row">
                    <div class="col">
                        <input type="button" onclick="action_item_all('del_all', '<?= base_url('admincp/order/config') ?>')" class="form-control hand btn-danger" value="Xóa toàn bộ">
                    </div>
                    <div class="col">
                        <input type="button" onclick="location.href = '<?= base_url('admincp/order/clean_trash') ?>'" class="form-control hand btn btn-info" value="Dọn rác">
                    </div>
                </div>
            </div>

            <div class="title">
                <div class="titleicon">
                    <span>
                        <img src="<?= base_url() ?>public/admin/img/icon/action_2.png" alt="Ẩn"/>
                        Mới nhận
                    </span>
                    <span>
                        <img src="<?= base_url() ?>public/admin/img/icon/action_1.png" alt="Hiển Thị"/>
                        Đã xem
                    </span>
                    <span>
                        <img src="<?= base_url() ?>public/admin/img/icon/action_3.png" alt="Hủy bỏ"/>
                        Đã giao
                    </span>
                </div>
                <div class="num">
                    Tổng số : <b><?= $total_rows ?></b>
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
<!--                 </thead>--> 

                <thead>
                    <tr>
                    	<th scope="col" style="width: 10px">
                            <input id="checkAll" type="checkbox">
                        </th>
                        <th scope="col" width=5%>STT</th>
                        <th scope="col" width=8%>Mã Số</th>
                        <th scope="col" class="text-center" width=8%>Số lượng</th>
                        <th scope="col" width=15%>Khách hàng</th>                        
                        <th scope="col" width=8%>Tổng tiền</th>
                        <th scope="col" width=20%>Địa chỉ</th>
                        <th scope="col" style="width: 83px;">Trạng thái</th>
                        <th scope="col" style="width: 97px;">Ngày nhận</th>
                        <th scope="col" style="width: 97px;">Ngày giao</th>
                        <th scope="col" width=5%>Hành động</th>
                    </tr>
                </thead>
                <?php if (@$list) { ?>
                    <tbody>
                        <?php
                        foreach ($list as $k => $row) {
                            $product = $row->product;
                            $transaction = $row->transaction;
                            $prices      = json_decode($row->prices);
                            $qtys        = json_decode($row->qtys);
                            $totalPrice  = '';
                            foreach ($prices as $key => $value){
                                $totalPrice  += $qtys[$key]*$prices[$key];
                            }
                            
                            
                            ?>
                            <tr>
                            	<td><input class="checkItem text-center" name="id[]" value="<?= $row->id ?>" type="checkbox"></td>
                                <td class="text-center"><?= $k ?></td>
                                <td class="text-center"><?= $row->code ?></td>
                                <td class="text-center"><b><?= array_sum($qtys) ?></b></td>
                                <td class="text-center"><?= $row->user_name?></td>
                                <td class="text-center"><?= number_format($totalPrice) ?> đ</td>
                                <td class="text-center"><?= $row->user_address ?></td>
                                <td class="text-center" id="status_<?= $row->id ?>">
                                    <img src="<?= base_url() ?>public/admin/img/icon/action_<?= $row->status ?>.png" alt=""/>
                                </td>
                                <td class="text-center"><?= date('H:i:s - d/m/Y', $row->created) ?></td>
                                <td class="text-center"><?= ($row->receivingdate == 0) ? "Chưa biết" :  date('d/m/Y', strtotime($row->receivingdate)) ?></td>
                                <td class="button_action text-center">
                                    <a  href="<?= base_url('admincp/order/view/' . $row->id) ?>" data-toggle="tooltip"  title="Xem chi tiết">
                                        <img src="<?= base_url() ?>public/admin/img/16x16/view.png" alt=""/>                                    
</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="12">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <?php echo $this->pagination->create_links() ?>
                                    </ul>
                                </nav>
                            </td>
                        </tr>
                    </tfoot>
                <?php } else { ?>
                    <tbody>
                        <tr>
                            <td colspan="9" class="text-center">Chưa có dữ liệu trong bảng này</td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>