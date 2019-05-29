<article>
    <div class="overlay-menu"></div>
    <section class="manager">
        <div class="container-fluid">
            <?php $this->load->view('admin/include_elements/title') ?>
            <div class="table-responsive">
                <?php $this->load->view('admin/message') ?>
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
                            <th scope="col" style="width: 57px">STT</th>
                            <th scope="col" style="width: 61px">Mã Số</th>
                            <th scope="col">Username</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col" style="width: 130px;">Chức vụ</th>
                            <th scope="col" style="width: 83px;">Trạng thái</th>
                            <th scope="col" style="width: 97px;">Ngày taọ</th>
                            <th scope="col" style="width: 137px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list as $key => $row) { ?>
                            <tr>
                                <th scope="col"><?= $key + 1 ?></th>
                                <th scope="col"><?= $row->id ?></th>
                                <th scope="col"><?= $row->username ?></th>
                                <th scope="col">
                                    <div class="text-left" style="min-width: 250px">
                                        <h5><?= $row->name ?></h5>
                                    </div>
                                </th>
                                <?php 
                                    // mảng chức vụ user
                                    $array_tid = array(
                                                    1 => 'Customer',
                                                    2 => 'Manager' ,
                                                    3 => 'Admin',
                                                    4 => 'Founder'
                                                );
                                ?>
                                <th scope="col"><?= array_key_exists($row->tid, $array_tid) ? $array_tid[$row->tid] : 'Không có chức vụ' ?></th>
                                <th scope="col" class="text-center">
                                    <div class="status status-<?= $row->id ?>">                                        
                                        <?= $row->status == 1 ? '<h5 class="btn-success">Hiển thị</h5>' : ($row->status == 2 ? '<h5 class="btn-warning">Ẩn</h5>' : '<h5 class="btn-danger">Xóa</h5>') ?>                                        
                                    </div>
                                </th>
                                <th scope="col"><?=  date('d-m-Y', $row->created) ?></th>
                                <th scope="col">
                                    <div class="action-zone">
                                        <a class="action btn-light" href="<?= base_url('admincp/admin/edit/') . $row->id ?>">
                                            <span>Chỉnh sửa</span>
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a class="action btn-light active-single">
                                            <span>Hiển thị</span>
                                            <i class="mdi mdi-eye-outline" onclick="action_item(<?=$row->id?>, 'enable', '<?= base_url('admincp/admin/config') ?>', 'tài khoản');"></i>
                                        </a>
                                        <a class="action btn-light private-single">
                                            <span>Ẩn</span>
                                            <i class="mdi mdi-crosshairs-gps" onclick="action_item(<?=$row->id?>, 'disable', '<?= base_url('admincp/admin/config') ?>', 'tài khoản');"></i>
                                        </a>
                                        <a class="action btn-light delete-single">
                                            <span>Xóa</span>
                                            <i class="mdi mdi-trash-can-outline" onclick="deleteItem('<?= base_url('admincp/admin/del/') . $row->id ?>');"></i>
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

    function deleteItem(url) {
        Swal({
        title: 'Bạn chắc chắn chứ?',
        text: "Thao tác này sẽ được thay đổi trong database!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Tôi đồng ý, Dọn!',
        cancelButtonText: 'Hủy bỏ'
        }).then((result) => {
            if (result.value) {
                window.location.href = url;
            }
        })
    }

    // $('#go-trash').click(() => {
    //     Swal({
    //     title: 'Bạn chắc chắn chứ?',
    //     text: "Thao tác này sẽ được thay đổi trong database!",
    //     type: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Tôi đồng ý, Dọn!',
    //     cancelButtonText: 'Hủy bỏ'
    //     }).then((result) => {
    //     if (result.value) {
    //         Swal(
    //         'Xóa thành công!',
    //         'Bạn đã dọn rác thành công.',
    //         'success'
    //         ).then(function(res) {
    //         if (res) {
    //             // cái cần xóa
    //         }
    //         });
    //     }
    //     })
    // });

</script>