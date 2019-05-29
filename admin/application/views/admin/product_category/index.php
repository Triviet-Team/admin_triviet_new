<article>
    <div class="overlay-menu"></div>
    <section class="manager">
        <div class="container-fluid">
            <?php $this->load->view('admin/include_elements/title') ?>
            <div class="btn-top text-center">
                <button class="btn btn-primary waves-effect"><a href="them-san-pham.html">Thêm mới</a></button>
                <button onclick="action_item_all('enable_all', '<?= base_url('admincp/product_category/config') ?>', 'Danh mục sản phẩm');" class="btn btn-success waves-effect" id="active-all" disabled="disabled">Hiển thị toàn bộ</button>
                <button onclick="action_item_all('disable_all', '<?= base_url('admincp/product_category/config') ?>', 'Danh mục sản phẩm');" class="btn btn-warning waves-effect" id="private-all" disabled="disabled">Ẩn toàn bộ</button>
                <button onclick="action_item_all('del_all', '<?= base_url('admincp/product_category/config') ?>', 'Danh mục sản phẩm');" class="btn btn-danger waves-effect" id="delete-all" disabled="disabled">Xóa toàn bộ</button>
                <button class="btn btn-info waves-effect" id="go-trash">Dọn rác</button>
            </div>
            <div class="table-responsive">
                <div class="filter-category">
                    <form action="" method="GET">
                        <select name="pid" class="form-control" onchange="this.form.submit()">
                            <option value="0">Chọn danh mục</option>
                            <?php if($catalogs ) { ?>
                                <?php foreach($catalogs as $row) { ?>
                                    <option <?= $row->id == $pid ? 'selected' : '' ?> value="<?= $row->id ?>"><?= $row->pid == 0 ? '' : '--' ?><?= $row->vn_name ?></option>
                                <?php } ?>
                            <?php } ?>                        
                        </select>
                    </form>
                </div>
                <div class="filter-status">
                    <select class="form-control" onchange="filterStatus()">
                        <option value="">Chọn trạng thái</option>
                        <option value="Hiển thị">Hiển thị</option> 
                        <option value="Ẩn">Ẩn</option> 
                        <option value="Xóa">Xóa</option>                      
                    </select>
                </div>
                <table class="table table-bordered display table-hover product-table" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="width: 20px" scope="col">
                                <label class="check-box" style="margin-top: -17px">
                                    <input id="check-all" type="checkbox" /><span class="checkmark"></span>
                                </label>
                            </th>
                            <th scope="col">Mã</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col" style="width: 20px;">Vị trí</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list as $key => $row) { ?>
                            <tr>
                                <th scope="col">
                                    <label class="check-box">
                                        <input name="id[]" value="<?= $row->id ?>" type="checkbox" />
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <th scope="col"><?= $row->id ?></th>
                                <th scope="col"><?= $row->category_name ? $row->category_name : ($row->pid == 0 ? '<h4 style="color: #1668bd;">Danh mục cha</h4>' : 'Chưa có danh mục') ?></th>
                                <th scope="col">
                                    <div class="text-left" style="min-width: 250px">
                                        <a data-fancybox="gallery" href=""><img src="<?= base_url() ?>public/admin/img/logo-mini.png"/></a> 
                                        <h5><?= $row->vn_name ?></h5>
                                    </div>
                                </th>
                                <td class="text-center"><input class="form-control iptPostion" onchange="position('<?= $row->id ?>', this.value, '<?= base_url('admincp/product_category/position') ?>')" value="<?= $row->position ?>"/></td>
                                <th scope="col" class="text-center">
                                    <div class="status status-<?= $row->id ?>">                                        
                                        <?= $row->status == 1 ? '<h5 class="btn-success">Hiển thị</h5>' : ($row->status == 2 ? '<h5 class="btn-warning">Ẩn</h5>' : '<h5 class="btn-danger">Xóa</h5>') ?>                                        
                                    </div>
                                </th>
                                <th scope="col" class="text-center"><?=  date('d-m-Y', $row->created) ?></th>
                                <th scope="col">
                                    <div class="action-zone">
                                        <a class="action btn-light" href="them-san-pham.html">
                                            <span>Chỉnh sửa</span>
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a class="action btn-light active-single">
                                            <span>Hiển thị</span>
                                            <i class="mdi mdi-eye-outline" onclick="action_item(<?=$row->id?>, 'enable', '<?= base_url('admincp/product_category/config') ?>', 'Danh mục sản phẩm');"></i>
                                        </a>
                                        <a class="action btn-light private-single">
                                            <span>Ẩn</span>
                                            <i class="mdi mdi-crosshairs-gps" onclick="action_item(<?=$row->id?>, 'disable', '<?= base_url('admincp/product_category/config') ?>', 'Danh mục sản phẩm');"></i>
                                        </a>
                                        <a class="action btn-light delete-single">
                                            <span>Xóa</span>
                                            <i class="mdi mdi-trash-can-outline" onclick="action_item(<?=$row->id?>, 'del', '<?= base_url('admincp/product_category/config') ?>', 'Danh mục sản phẩm');"></i>
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</article>

<script>
    //set datatable
    const productTable = $('.product-table').DataTable({
    "processing": true,
    "responsive": true,
    "deferRender": true,
    "language": {
        "processing": "Đang tải",
        "lengthMenu": "Hiển thị _MENU_ mục",
        "emptyTable":     "Không có dữ liệu nào trong bảng",
        "loadingRecords": "Đang tải...",
        "zeroRecords": "Không có mục nào được tìm thấy",
        "info": "Hiển thị _START_ đến _END_ trong _TOTAL_ mục",
        "infoEmpty": "Không có mục nào có sẵn",
        "infoFiltered": "(Lọc từ _MAX_ mục)",
        "search": "Tìm kiếm:",
        "paginate": {
            "first":      "Đầu",
            "last":       "Cuối",
            "next":       "Sau",
            "previous":   "Trước"
        },
    },
    "order": [[ 1, "desc" ]],
    "pagingType": "full_numbers",
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tất cả"]],
    });

    filterStatus = () => {
    let val = $('.filter-status select').val();
    let replaceVal = val.replace(/-/g, '');

    productTable
        .columns(5)
        .search(replaceVal)
        .draw();
    }
</script>