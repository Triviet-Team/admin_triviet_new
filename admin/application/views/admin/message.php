<div class="messages">
    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-success" role="alert">
            <?= $this->session->flashdata('message'); ?>
        </div>
    <?php } ?>
</div>