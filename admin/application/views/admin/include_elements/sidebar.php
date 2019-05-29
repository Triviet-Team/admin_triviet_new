<aside>
    <div class="menu-close"><i class="mdi mdi-close d-block d-xl-none"></i></div>
    <div class="logo"><a href="bang-dieu-khien.html"><img class="logo-large"
                src="<?= base_url() ?>public/admin/img/logo.png" /></a><img class="logo-mini"
            src="<?= base_url() ?>public/admin/img/logo-mini.png" /></div>
    <div class="menu">
        <nav class="sidebar" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link waves-effect" data-toggle="collapse" href="#manager" aria-expanded="false" aria-controls="ui-basic">
                        <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
                        <span class="menu-title">Quản lý website</span>
                    </a>
                    <i class="mdi mdi-chevron-down menu-down" data-toggle="collapse" href="#manager" aria-expanded="false" aria-controls="ui-basic"></i>
                    <div class="collapse show" id="manager">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('admincp') ?>">Bảng điều khiển</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="cau-hinh-tong-quat.html">Cấu hình tổng quát</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect" data-toggle="collapse" href="#account" aria-expanded="false" aria-controls="ui-basic">
                        <i class="mdi mdi-account-circle-outline menu-icon"></i>
                        <span class="menu-title">Quản lý tài khoản</span>
                    </a>
                    <i class="mdi mdi-chevron-down menu-down" data-toggle="collapse" href="#account" aria-expanded="false" aria-controls="ui-basic"></i>
                    <div class="collapse show" id="account">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('admincp/admin') ?>">Danh sách tài khoản</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('admincp/admin/add') ?>">Thêm tài khoản</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link waves-effect" data-toggle="collapse" href="#order-menu"
                        aria-expanded="false" aria-controls="ui-basic"><i
                            class="mdi mdi-wallet-giftcard menu-icon"></i><span class="menu-title">Quản lý đơn
                            hàng</span></a><i class="mdi mdi-chevron-down menu-down" data-toggle="collapse"
                        href="#order-menu" aria-expanded="false" aria-controls="ui-basic"></i>
                    <div class="collapse show" id="order-menu">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="danh-sach-don-hang.html">Danh sách đơn
                                    hàng</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link waves-effect" data-toggle="collapse" href="#product-manager"
                        aria-expanded="false" aria-controls="ui-basic"><i class="mdi mdi-shopify menu-icon"></i><span
                            class="menu-title">Quản lý sản phẩm</span></a><i class="mdi mdi-chevron-down menu-down"
                        data-toggle="collapse" href="#product-manager" aria-expanded="false"
                        aria-controls="ui-basic"></i>
                    <div class="collapse show" id="product-manager">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link"
                                    href="<?= base_url('admincp/product_category') ?>">Danh mục sản phẩm</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="them-danh-muc.html">Thêm danh mục</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('admincp/product') ?>">Danh sách
                                    sản
                                    phẩm</a></li>
                            <li class="nav-item"><a class="nav-link" href="them-san-pham.html">Thêm sản phẩm</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link waves-effect" data-toggle="collapse" href="#post-manager"
                        aria-expanded="false" aria-controls="ui-basic"><i class="mdi mdi-newspaper menu-icon"></i><span
                            class="menu-title">Quản lý bài viết</span></a><i class="mdi mdi-chevron-down menu-down"
                        data-toggle="collapse" href="#post-manager" aria-expanded="false" aria-controls="ui-basic"></i>
                    <div class="collapse show" id="post-manager">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="danh-muc-bai-viet.html">Danh mục bài viết</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="them-danh-muc.html">Thêm danh mục</a></li>
                            <li class="nav-item"><a class="nav-link" href="danh-sach-bai-viet.html">Danh sách bài
                                    viết</a></li>
                            <li class="nav-item"><a class="nav-link" href="them-bai-viet.html">Thêm bài viết</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link waves-effect" data-toggle="collapse" href="#static-page"
                        aria-expanded="false" aria-controls="ui-basic"><i
                            class="mdi mdi-comment-text-outline menu-icon"></i><span class="menu-title">Quản lý trang
                            tĩnh</span></a><i class="mdi mdi-chevron-down menu-down" data-toggle="collapse"
                        href="#static-page" aria-expanded="false" aria-controls="ui-basic"></i>
                    <div class="collapse show" id="static-page">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="danh-sach-trang-tinh.html">Danh sách trang
                                    tĩnh</a></li>
                            <li class="nav-item"><a class="nav-link" href="them-trang-tinh.html">Thêm trang tĩnh</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link waves-effect" data-toggle="collapse" href="#contact-manager"
                        aria-expanded="false" aria-controls="ui-basic"><i
                            class="mdi mdi-email-outline menu-icon"></i><span class="menu-title">Quản lý liên
                            hệ</span></a><i class="mdi mdi-chevron-down menu-down" data-toggle="collapse"
                        href="#contact-manager" aria-expanded="false" aria-controls="ui-basic"></i>
                    <div class="collapse show" id="contact-manager">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="danh-sach-lien-he.html">Danh sách liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link waves-effect" data-toggle="collapse" href="#ads-manager"
                        aria-expanded="false" aria-controls="ui-basic"><i
                            class="mdi mdi-credit-card menu-icon"></i><span class="menu-title">Quản lý ADS</span></a><i
                        class="mdi mdi-chevron-down menu-down" data-toggle="collapse" href="#ads-manager"
                        aria-expanded="false" aria-controls="ui-basic"></i>
                    <div class="collapse show" id="ads-manager">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="danh-muc-ads.html">Danh mục ADS</a></li>
                            <li class="nav-item"><a class="nav-link" href="them-danh-muc.html">Thêm danh mục</a></li>
                            <li class="nav-item"><a class="nav-link" href="danh-sach-ads.html">Danh sách ADS</a></li>
                            <li class="nav-item"><a class="nav-link" href="them-ads.html">Thêm ADS</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</aside>