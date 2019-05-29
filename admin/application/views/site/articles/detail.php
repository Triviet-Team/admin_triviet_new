<article>
      <section class="bread-crumb">
        <div class="container">
			<?php $this->load->view('site/breadcrumb'); ?>
        </div>
      </section>
      <section class="page-text">
      <?php if(isset($object)){?>
        <div class="container">
          <h2><?=$object->vn_name?></h2>
          <h5> <i class="mdi mdi-clock"></i><?=date("d/m/Y", $object->created)?></h5>
          <h4><?=$object->vn_sapo?></h4>
		  <div><?=$object->vn_detail?></div>
        </div>
    <?php 
        }else{
            echo 'Dữ liệu đang cập nhật';
        }
    ?>
      </section>
    </article>




