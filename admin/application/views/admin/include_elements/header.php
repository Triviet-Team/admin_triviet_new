<header>
    <div class="container-fluid">
        <div class="menu-btn"><i class="mdi mdi-menu"> </i></div>
        <div class="username" title="<?= $this->session->userdata('name') ? $this->session->userdata('name') : 'Tài khoản đăng nhập chưa có tên' ?>"><?= $this->session->userdata('name') ? $this->session->userdata('name') : 'Tài khoản đăng nhập chưa có tên' ?></div>
        <div class="custom">
            <ul>
                <li class="noti bell"><a href="quan-ly-lien-he.html" title="Xem thông báo"><i
                            class="mdi mdi-bell-outline"></i></a></li>
                <li> <a target="_blank" href="<?= base_url() ?>"><i class="mdi mdi-eye-outline"></i><span>Xem trang</span></a></li>
                <li><a href="<?= base_url('admincp/admin/change_password') ?>"><i class="mdi mdi-key-change"></i><span>Đổi mật khẩu</span></a></li>
                <li><a href="<?= base_url('admincp/admin/logout') ?>"><i class="mdi mdi-logout"></i><span>Đăng xuất</span></a></li>
            </ul>
        </div>
    </div>
</header>