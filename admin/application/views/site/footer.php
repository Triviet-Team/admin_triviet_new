<section class="footer">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="contact">
              <h4>
                 THÔNG TIN CHUNG<i class="mdi mdi-chevron-down"></i></h4>
              <ul>
                <li><i class="mdi mdi-map-outline"></i><?= @$config->address ?></li>
                <li><i class="mdi mdi-deskphone"></i><?= @$config->phone ?></li>
                <li><i class="mdi mdi-email-outline"></i><?= @$config->email ?></li>
                <li><i class="mdi mdi-fax"></i>Fax: <?= @$config->fax ?></li>
                <li><i class="mdi mdi-note-outline"></i>Mã số thuế: <?= @$config->ma_thue ?></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-lg-2 col-sm-6">
            <div class="link">
              <h4>
                 Tổng quan<i class="mdi mdi-chevron-down"></i></h4>
              <ul>
                <li><a href="<?= base_url('hoi-dap.html') ?>">Hỏi đáp</a></li>
                <li><a href="<?= base_url('bao-dam.html') ?>">Bảo đảm</a></li>
                <li><a href="<?= base_url('gioi-thieu-ve-trilastin.html') ?>">Giới thiệu về TriLASTIN</a></li>
				  <li><a href="<?= base_url('tai-sao-phai-chon-trilastin.html') ?>">Tại sao phải chọn trilastin</a></li>
                <li><a href="<?= base_url('he-thong-phan-phoi.html') ?>">Hệ thống phân phối</a></li>
                <li><a href="<?= base_url('lien-he.html') ?>">Liên hệ</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="support">
              <h4>
                 THÔNG TIN KHÁCH HÀNG<i class="mdi mdi-chevron-down"></i></h4>
              <ul>
                <li><a href="<?= base_url('cham-soc-khach-hang.html') ?>">Chăm sóc khách hàng</a></li>
                <li><a href="<?= base_url('thong-tin-van-chuyen.html') ?>">Thông tin vận chuyển</a></li>
                <li><a href="<?= base_url('hang-tra-ve.html') ?>">Hàng trả về</a></li>
                <li>
                    <a target="_blank" href="http://www.online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=8132">
                      <img src="<?=base_url('public/site/img/congthuong.png') ?>">
                    </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="statistical">
              <h4>
                 Chính sách<i class="mdi mdi-chevron-down"></i></h4>
              <ul>
                <li><a href="<?= base_url('chinh-sach-quy-dinh-chung.html') ?>">Chính sách & Quy định chung</a></li>
                <li><a href="<?= base_url('chinh-sach-doitra-hang-va-hoan-tien.html') ?>">Chính sách đổi/trả hàng và hoàn tiền</a></li>
                <li><a href="<?= base_url('chinh-sach-van-chuyen-giao-nhan.html') ?>">Chính sách vận chuyển, giao nhận</a></li>
                <li><a href="<?= base_url('quy-dinh-va-hinh-thuc-thanh-toan.html') ?>">Quy định và hình thức thanh toán</a></li>
                <li><a href="<?= base_url('chinh-sach-bao-mat-thong-tin.html') ?>">Chính sách bảo mật thông tin</a></li>
                <li><a href="<?= base_url('chinh-sach-bao-hanh.html') ?>">Chính sách bảo hành</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="copyright text-center text-md-left">
          <div class="row">
            <div class="col-md-7">
              <h5>Copyright @ 2019 TriLASTIN. All Reserved. Designed by Tri Viet</h5>
            </div>
            <div class="col-md-5 text-center text-md-right">
              <ul class="mt-2 mt-md-0">
                  <?php if(@$categorys){?>
					 <?php foreach ($categorys as $row){?>
					     <li><a class="nav-link" href="<?= base_url() . $row->vn_slug ?>.html"><?= $row->vn_name ?></a></li>
                     <?php } ?>
				  <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>