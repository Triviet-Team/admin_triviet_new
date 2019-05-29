<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>ADMINCP</title>
    <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/mdb.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/login.css" />
    <link rel="shortcut icon" href="<?= base_url() ?>public/admin/img/favicon.png" />
    <style></style>
</head>

<body>
    <div class="container" style="margin-top: 50px">
        <h6 class="mb-4 text-center">Chào mừng bạn đến với trang quản trị của chúng tôi, vui lòng đăng nhập</h6>
        <div class="box-login">
            <h5>Đăng nhập</h5>
            <form method="POST" action="">
                <div class="text-success text-center" style="color: red;"><?= $msg ?></div>
                <div class="md-form text-left"><i class="mdi mdi-account prefix"></i>
                    <input name="username" class="form-control" id="account" type="text" />
                    <label for="account">Tài khoản</label>
                </div>
                <div class="md-form text-left"><i class="mdi mdi-lock prefix"></i>
                    <input name="password"  class="form-control" id="password" type="password" />
                    <label for="password">Mật khẩu</label>
                </div>
                <button class="btn btn-primary mt-2 mb-5 text-center" type="submit">Đăng nhập</button>
            </form>
        </div>
    </div>
    <script src="<?= base_url() ?>public/admin/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url() ?>public/admin/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>public/admin/js/mdb.min.js"></script>
    <script>
        $(document).ready(() => {
            $('input#account').focus();
        });
    </script>
</body>

</html>