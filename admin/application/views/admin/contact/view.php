<link href="<?= base_url() ?>public/admin/css/view.css" rel="stylesheet" type="text/css"/>
<div class="view">
    <div class="title">
        <?= $view->title ?>
    </div>
    <p class="name">Họ tên: <?= $view->name ?></p>
    <p class="email">Email: <?= $view->email ?></p>
    <p class="phone">Sđt: <?= $view->phone ?></p>
    <p class="address">Địa chỉ: <?= $view->address ?></p>
    <div class="content">
        <?= $view->content ?>
    </div>
</div>