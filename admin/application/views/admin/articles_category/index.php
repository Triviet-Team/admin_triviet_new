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
                        <input type="button" onclick="location.href = '<?= base_url('admincp/articles_category/detail') ?>'" class="form-control hand btn-primary" value="Thêm mới">
                    </div>
                    <div class="col">
                        <input type="button" onclick="action_item_all('enable_all', '<?= base_url('admincp/articles_category/config') ?>')" class="form-control hand btn-success" value="Hiển thị toàn bộ">
                    </div>
                    <div class="col">
                        <input type="button" onclick="action_item_all('disable_all', '<?= base_url('admincp/articles_category/config') ?>')" class="form-control hand btn-warning" value="Ẩn toàn bộ">
                    </div>
                    <div class="col">
                        <input type="button" onclick="action_item_all('del_all', '<?= base_url('admincp/articles_category/config') ?>')" class="form-control hand btn-danger" value="Xóa toàn bộ">
                    </div>
                    <div class="col">
                        <input type="button" onclick="location.href = '<?= base_url('admincp/articles_category/clean_trash') ?>'" class="form-control hand btn btn-info" value="Dọn rác">
                    </div>
                </div>
            </div>

            <div class="title">
                <div class="titleicon">
                    <span>
                        <img src="<?= base_url() ?>public/admin/img/icon/action_2.png" alt="Ẩn"/>
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
                        <td colspan="9">
                            <form method="GET" action="">
                                <div class="form-row">
                                    <div class="col-1">
                                        <input type="text" name="id" class="form-control" placeholder="Mã số" value="<?= isset($filter['id']) ? $filter['id'] : '' ?>">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="vn_name" class="form-control" placeholder="Danh mục bài viết" value="<?= isset($filter['vn_name']) ? $filter['vn_name'] : '' ?>">
                                    </div>
                                    <div class="col">
                                        <select class="custom-select" name="pid">
                                            <option selected value="0">Chọn danh mục</option>

                                            <?php foreach ($category as $k => $row) { ?>
                                                <option value="<?= $row->id ?>" <?= (isset($filter['pid']) && $filter['pid'] == $row->id) ? 'selected' : '' ?>><?= $row->vn_name ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <input type="submit" class="form-control hand btn-success" value="Lọc">
                                    </div>
                                    <div class="col-2">
                                        <input type="reset" onclick="location.href = '<?= base_url('admincp/articles_category') ?>'" class="form-control hand btn-info" value="Reset">
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                </thead>

                <thead>
                    <tr>
                        <th scope="col" style="width: 10px">
                            <input id="checkAll" type="checkbox">
                        </th>
                        <th scope="col" style="width: 57px">STT</th>
                        <th scope="col" style="width: 61px">Mã Số</th>
                        <th scope="col" style="width: 170px">Danh mục</th>
                        <th scope="col">Tên</th>
                        <th scope="col" style="width: 83px;">Trạng thái</th>
                        <th scope="col" style="width: 97px;">Ngày taọ</th>
                        <th scope="col" style="width: 137px;">Hành động</th>
                    </tr>
                </thead>
                <?php if (@$list_category) { ?>
                    <tbody>
                        <?php foreach ($list_category as $k => $row) { ?>
                            <?php
                            if ($row->pid != 0) {
                                $categorys = $this->category->get_info_rule(array('id' => $row->pid), 'vn_name');
                            }
                            ?>
                            <tr>
                                <td><input class="checkItem" value="<?= $row->id ?>" name="id[]" type="checkbox"></td>
                                <td class="text-center"><?= $k ?></td>
                                <td class="text-center"><?= $row->id ?></td>
                                <td class="text-center"><?= isset($categorys) ? $categorys->vn_name : 'Danh mục cha' ?></td>
                                <td>
                                    <div class="info_products">
                                        <b><?= $row->vn_name ?></b>
                                        <span>Slug: <?= $row->vn_slug ?></span>
                                    </div>
                                </td>
                                <td class="text-center" id="status_<?= $row->id ?>">
                                    <img src="<?= base_url() ?>public/admin/img/icon/action_<?= $row->status ?>.png" alt="Xóa"/>
                                </td>
                                <td><?= get_date($row->created) ?></td>
                                <td class="button_action">
                                    <a href="<?= base_url('admincp/articles_category/detail/' . $row->id) ?>" class="edit_item" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa"></a>
                                    <a href="javascript:(0)" onclick="action_item(<?= $row->id ?>, 'enable', '<?= base_url('admincp/articles_category/config') ?>')" class="enable_item" id="enable_item" data-toggle="tooltip" data-placement="top" title="Hiển thị"></a>
                                    <a href="javascript:(0)" onclick="action_item(<?= $row->id ?>, 'disable', '<?= base_url('admincp/articles_category/config') ?>')" class="disable_item" id="disable_item" data-toggle="tooltip" data-placement="top" title="Ẩn"></a>
                                    <a href="javascript:(0)" onclick="action_item(<?= $row->id ?>, 'del', '<?= base_url('admincp/articles_category/config') ?>')" class="menu_item_delete" id="del_item" data-toggle="tooltip" data-placement="top" title="Xóa"></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="8">
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
                            <td colspan="8" class="text-center">Chưa có dữ liệu trong bảng này</td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>