
            
<article>
    <div class="overlay-menu"></div>
    <section class="change-password">
        <div class="container-fluid">
            <form  method="POST" action="">
                <?php $this->load->view('admin/message') ?>
                <div class="md-form form-sm text-left"><i class="mdi mdi-lock-alert prefix"></i>
                    <input type="password" name="password" class="form-control validate" id="oldPassword" />
                    <label for="oldPassword">Mật khẩu cũ</label>
                    <div class="error"><?= form_error('password') ?></div>
                </div>
                <div class="md-form form-sm text-left"><i class="mdi mdi-lock prefix"></i>
                    <input type="password" name="n_password" class="form-control validate" id="newPassword" />
                    <label for="newPassword">Mật khẩu mới</label>
                    <div class="error"><?= form_error('n_password') ?></div>
                </div>
                <div class="md-form form-sm text-left"><i class="mdi mdi-lock-plus prefix"></i>
                    <input type="password" name="re_password" class="form-control validate" id="rePassword" />
                    <label for="rePassword">Nhập lại mật khẩu mới</label>
                    <div class="error"><?= form_error('re_password') ?></div>
                </div>
                <div class="change-pasword-btn text-center">
                    <button class="btn btn-primary text-center" type="submit">Lưu lại</button><a class="btn btn-light"
                        href="<?= base_url('admincp') ?>">Trở về</a>
                </div>
            </form>
        </div>
    </section>
</article>