<div class="bg-white addHeight height-auto">
    <div class="ui-wid">
        <div class="form-head">
            <?= $title ?>
        </div>
        <div class="form-mid">

            <?php $this->load->view('admin/message') ?>

            <div class="horControlA">
                <div class="form-row">
                    <div class="col">
                        <input type="button" onclick="action_item_all('enable_all', '<?= base_url('admincp/comment/config') ?>')" class="form-control hand btn-success" value="Hiển thị toàn bộ">
                    </div>
                    <div class="col">
                        <input type="button" onclick="action_item_all('disable_all', '<?= base_url('admincp/comment/config') ?>')" class="form-control hand btn-warning" value="Ẩn toàn bộ">
                    </div>
                    <div class="col">
                        <input type="button" onclick="action_item_all('del_all', '<?= base_url('admincp/comment/config') ?>')" class="form-control hand btn-danger" value="Xóa toàn bộ">
                    </div>
                    <div class="col">
                        <input type="button" onclick="location.href = '<?= base_url('admincp/comment/clean_trash') ?>'" class="form-control hand btn btn-info" value="Dọn rác">
                    </div>
                </div>
            </div>

            <div class="title">
                <div class="titleicon">
                    <span>
                        <img src="<?= base_url() ?>public/admin/img/icon/action_3.png" alt="Ẩn"/>
                        Ẩn
                    </span>
                    <span>
                        <img src="<?= base_url() ?>public/admin/img/icon/action_1.png" alt="Hiển Thị"/>
                        Hiển Thị
                    </span>
                    <span>
                        <img src="<?= base_url() ?>public/admin/img/icon/action_3.png" alt="Xóa"/>
                        Xóa
                    </span>
                </div>
                <div class="num">
                    Tổng số : <b><?= $total_rows ?></b>
                </div>
            </div>
            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th scope="col" style="width: 10px">
                            <input id="checkAll" type="checkbox">
                        </th>
                        <th scope="col" width=5%>STT</th>
                        <th scope="col" width=5%>Mã Số</th>
                        <th scope="col">Tên</th>
                        <th scope="col" width=30%>Nội dung</th>
                        <th scope="col" width=15%>Email</th>
                        <th scope="col" width=5%>Trạng thái</th>
                        <th scope="col" width=10%>Ngày taọ</th>
                        <th scope="col"style="width: 145px" class="text-center">Hành động</th>
                    </tr>
                </thead>
                <?php if (@$list) { ?>
                    <tbody>
                        <?php
                        foreach ($list as $k => $row) {
                            ?>
                            <tr>
                                <th><input class="checkItem" name="id[]" value="<?= $row->id ?>" type="checkbox"></th>
                                <td class="text-center"><?= $k ?></td>
                                <td class="text-center"><?= $row->id ?></td>
                                <td>
                                    <div class="image_thumb">
                                    </div>
                                    <div class="info_products">
                                        <b><?= $row->fullname ?></b>
                                    </div>

                                </td>
                                <td class="text-center"><?= $row->comment ?></td>
                                <td class="text-center"><?= $row->email ?></td>
                                <td class="text-center" id="status_<?= $row->id ?>">
                                    <img src="<?= base_url() ?>public/admin/img/icon/action_<?= $row->status ?>.png" alt=""/>
                                </td>
                                <td class="text-center"><?= $row->date_created ?></td>
                                <td class="button_action">
                                    <a href="javascript:(0)" onclick="action_item(<?= $row->id ?>, 'enable', '<?= base_url('admincp/comment/config') ?>')" class="enable_item" data-toggle="tooltip" data-placement="top" title="Hiển thị"></a>
                                    <a href="javascript:(0)" onclick="action_item(<?= $row->id ?>, 'disable', '<?= base_url('admincp/comment/config') ?>')" class="disable_item" data-toggle="tooltip" data-placement="top" title="Ẩn"></a>
                                    <a href="javascript:(0)" onclick="action_item(<?= $row->id ?>, 'del', '<?= base_url('admincp/comment/config') ?>')" class="menu_item_delete" data-toggle="tooltip" data-placement="top" title="Xóa"></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="9">
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