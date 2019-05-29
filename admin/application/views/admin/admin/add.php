<article>
    <div class="overlay-menu"></div>
    <section class="add-item">
        <div class="container-fluid">
            <?php $this->load->view('admin/include_elements/title') ?>
            <form method="POST" action="" >
                <select name="status" class="form-control mb-4" id="select-status">
                    <option value="1" <?= (isset($filter['status']) && $filter['status'] == 1) ? 'selected' : '' ?>>Hiển thị</option>
                    <option value="2" <?= (isset($filter['status']) && $filter['status'] == 2) ? 'selected' : '' ?>>Ẩn</option>
                    <option value="3" <?= (isset($filter['status']) && $filter['status'] == 3) ? 'selected' : '' ?>>Xóa</option>
                </select>
                <select name="tid" class="form-control mb-4">
                    <option value="1" <?= (isset($filter['tid']) && $filter['tid'] == 1) ? 'selected' : '' ?>>Customer</option>
                    <option value="2" <?= (isset($filter['tid']) && $filter['tid'] == 2) ? 'selected' : '' ?>>Manager</option>
                    <option value="3" <?= (isset($filter['tid']) && $filter['tid'] == 3) ? 'selected' : '' ?>>Admin</option>
                    <option value="4" <?= (isset($filter['tid']) && $filter['tid'] == 4) ? 'selected' : '' ?>>Founder</option>
                </select>
                <div class="md-form mb-3">
                    <input name="name" value="<?php echo set_value('name'); ?>"  type="text" class="form-control form-control-sm" id="name" />
                    <label for="name">Họ tên</label>
                    <div class="error"><?= form_error('name') ?></div>
                </div>
                <div class="md-form mb-3">
                    <input name="username" value="<?php echo set_value('username'); ?>"  type="text" class="form-control form-control-sm" id="username" />
                    <label for="username">Username</label>
                    <div class="error"><?= form_error('username') ?></div>
                </div>
                <div class="md-form mb-3">
                    <input name="password" type="password" class="form-control form-control-sm" id="password" />
                    <label for="password">Password</label>
                    <div class="error"><?= form_error('password') ?></div>
                </div>

                <div class="md-form mb-3">
                    <input name="re_password" type="password" class="form-control form-control-sm" id="re_password" />
                    <label for="re_password">Nhập lại password</label>
                    <div class="error"><?= form_error('re_password') ?></div>
                </div>
                <div class="md-form mb-3">
                    <input name="email" value="<?php echo set_value('email'); ?>"  type="text" class="form-control form-control-sm" id="email" />
                    <label for="email">Email</label>
                    <div class="error"><?= form_error('email') ?></div>
                </div>
                <div class="md-form mb-3">
                    <input name="phone" value="<?php echo set_value('phone'); ?>"  type="text" class="form-control form-control-sm" id="phone" />
                    <label for="phone">Số điện thoại</label>
                    <div class="error"><?= form_error('phone') ?></div>
                </div>
                <div class="md-form mb-3">
                    <input name="address" value="<?php echo set_value('address'); ?>"  type="text" class="form-control form-control-sm" id="address" />
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