<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>ADMINCP</title>
    <!-- embed style -->
    <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/mdb.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/sweetalert2.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/datepicker.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>public/admin/css/layout.css" />
    <link rel="shortcut icon" href="<?= base_url() ?>public/admin/img/favicon.png" />
    <!-- embed script -->
    <script src="<?= base_url() ?>public/admin/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url() ?>public/admin/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>public/admin/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>
    <!-- embed sidebar -->
    <?php $this->load->view('admin/include_elements/sidebar') ?>

    <main>
        <!-- embed header -->
        <?php $this->load->view('admin/include_elements/header') ?>
        <!-- embed body -->
        <?php $this->load->view('admin/' . $temp) ?>
        <!-- embed footer -->
        <?php $this->load->view('admin/include_elements/footer') ?>
    </main>

    <!-- embed script --> 
    <script src="<?= base_url() ?>public/admin/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>public/admin/js/mdb.min.js"></script>
    <script src="<?= base_url() ?>public/admin/js/jquery.fancybox.min.js"></script>
    <script src="<?= base_url() ?>public/admin/js/sweetalert2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/decoupled-document/ckeditor.js"></script>
    <script src="<?= base_url() ?>public/admin/js/data.js"></script>
    <script src="<?= base_url() ?>public/admin/js/datepicker.min.js"></script>
    <script src="<?= base_url() ?>public/admin/js/layout.js"></script>
    <script src="<?= base_url() ?>public/admin/js/main.js"></script>
</body>

</html>