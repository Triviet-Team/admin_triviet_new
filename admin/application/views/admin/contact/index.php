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
                        <input type="button" onclick="action_item_all('del_all', '<?= base_url('admincp/contact/config') ?>')" class="form-control hand btn-danger" value="Xóa toàn bộ">
                    </div>
                    <div class="col">
                        <input type="button" onclick="location.href = '<?= base_url('admincp/contact/clean_trash') ?>'" class="form-control hand btn btn-info" value="Dọn rác">
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
                        <th scope="col" style="width: 57px">STT</th>
                        <th scope="col" style="width: 61px">Mã Số</th>
                        <th scope="col">Tên Người Gửi</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col" style="width: 83px;">Trạng thái</th>
                        <th scope="col" style="width: 97px;">Ngày nhận</th>
                        <th scope="col" style="width: 137px;">Hành động</th>
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
                                    <div class="info_products">
                                        <a class='lightbox' href="<?= base_url('admincp/contact/view/' . $row->id) ?>">
                                           <b><?= $row->name ?></b>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="info_products">
                                        <b><?= $row->title ?></b>
                                    </div>
                                </td>
                                <td class="text-center" id="status_<?= $row->id ?>">
                                    <img src="<?= base_url() ?>public/admin/img/icon/action_<?= $row->status ?>.png" alt=""/>
                                </td>
                                <td><?= get_date($row->created) ?></td>
                                <td class="button_action text-center">
                                    <a class='lightbox' href="<?= base_url('admincp/contact/view/' . $row->id) ?>" data-toggle="tooltip" data-placement="top" title="Xem chi tiết">
                                        <img src="<?= base_url() ?>public/admin/img/16x16/view.png" alt=""/>
                                    </a>
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