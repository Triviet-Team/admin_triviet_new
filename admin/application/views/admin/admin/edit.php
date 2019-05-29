<article>
    <div class="overlay-menu"></div>
    <section class="add-item">
        <div class="container-fluid">
            <?php $this->load->view('admin/include_elements/title') ?>
            <form method="POST" action="" >
                <select name="status" class="form-control mb-4" id="select-status">
                    <option value="1" <?= $info_users->status == 1 ? 'selected' : '' ?>>Hiển thị</option>
                    <option value="2" <?= $info_users->status == 2 ? 'selected' : '' ?>>Ẩn</option>
                    <option value="3" <?= $info_users->status == 3 ? 'selected' : '' ?>>Xóa</option>
                </select>
                <select name="tid" class="form-control mb-4">
                    <option value="2" <?= $info_users->tid == 2 ? 'selected' : '' ?>>Manager</option>
                    <option value="3" <?= $info_users->tid == 3 ? 'selected' : '' ?>>Admin</option>
                    <option value="4" <?= $info_users->tid == 4 ? 'selected' : '' ?>>Founder</option>
                </select>
                <div class="md-form mb-3">
                    <input name="name" value="<?= $info_users->name ?>"  type="text" class="form-control form-control-sm" id="name" />
                    <label for="name">Họ tên</label>
                    <div class="error"><?= form_error('name') ?></div>
                </div>
                <div class="md-form mb-3">
                    <input name="email" value="<?= $info_users->email ?>"  type="text" class="form-control form-control-sm" id="email" />
                    <label for="email">Email</label>
                    <div class="error"><?= form_error('email') ?></div>
                </div>
                <div class="md-form mb-3">
                    <input name="phone" value="<?= $info_users->phone ?>"  type="text" class="form-control form-control-sm" id="phone" />
                    <label for="phone">Số điện thoại</label>
                    <div class="error"><?= form_error('phone') ?></div>
                </div>
                <div class="md-form mb-3">
                    <input name="address" value="<?= $info_users->address ?>"  type="text" class="form-control form-control-sm" id="address" />
                    <label for="address">Địa chỉ</label>
                    <div class="error"><?= form_error('address') ?></div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mr-3">Lưu lại</button><a class="btn btn-light"
                        href="<?= base_url('admincp/admin') ?>">Trở về</a>
                </div>
            </form>
        </div>
    </section>
</article>