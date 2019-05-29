<?php
    $xhtmlListNews = '';
    if(!empty($list_news)){
        foreach($list_news as $row){
            $link_img = base_url().'public/site/img/default-1024x512.png';
            if(!empty($row->image_link)){
                $link_img = base_url().'uploads/images/news/1024_512/'.$row->image_link;
            }
            $day    = date('d', $row->created);
            $month  = date('m', $row->created);
            $xhtmlListNews .= '
            					<div class="box-news">
            						<div class="box-news-img">
            							<a href="'.base_url() . $row->vn_slug .'-a' .$row->id.'.html"><img
            								src="'.$link_img.'" /></a>
            						</div>
            						<div class="box-news-detail">
            							<div class="box-news-detail-date">
            								<span>'.$day.'</span>/ Tháng '.$month.'
            							</div>
            							<h4>
            								<a href="'.base_url() . $row->vn_slug .'-a' .$row->id.'.html"
            									title="'.$row->vn_name.'">'.$row->vn_name.'</a>
            							</h4>
            							<h5>'.$row->vn_sapo.'</h5>
            						</div>
            					</div>
            				';
        }
    }else{
        $xhtmlListNews = '<p>Dữ liệu đang cập nhật</p>';
    }

?>

<article>
      <section class="bread-crumb">
        <div class="container">
			<?php $this->load->view('site/breadcrumb'); ?>
        </div>
      </section>
      <section class="news-page">
        <div class="container">
          <div class="title-page">
            <h1><?= @$category->vn_name ?></h1>
          </div>
          
          <?php echo $xhtmlListNews;?>
		  
          <nav>
            <ul class="pagination justify-content-end">
				<?=$pagination?>
            </ul>
          </nav>
        </div>
      </section>
    </article>
