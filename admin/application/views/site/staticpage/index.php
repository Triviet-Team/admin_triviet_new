<article>
  <section class="bread-crumb">
    <div class="container">
		<?php $this->load->view('site/breadcrumb'); ?>
    </div>
  </section>
  <section class="page-detail">
    <div class="container">
      <div class="title-page">
        <h1><?= @$staticpage->vn_name ?> </h1>
      </div>
	  <div><?= @$staticpage->vn_detail?>   </div>
    </div>
  </section>
</article>
<?php $this->load->view('site/registration_footer'); ?>