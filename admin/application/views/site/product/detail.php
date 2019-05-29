<article>
	<div class="loading-cart">
		<img src="<?=base_url().'public/site/img/loading.gif'?>" />
	</div>
  <section class="bread-crumb">
    <div class="container">
		<?php $this->load->view('site/breadcrumb'); ?>
    </div>
  </section>
  <section class="product-page">
    <div class="container">
	  <?php $this->load->view('site/sidebar'); ?>
      <div class="main">
		<?php if($object){ ?>
        <div class="product-detail">
          <div class="product-detail-1">
            <div class="row">
              <div class="col-md-6">
                  <?php 
//                       $link_img = base_url().'public/site/img/default-400x400.png';
//                       if(!empty($object->image_link)){
//                           $link_img = base_url().'uploads/images/product/'.$object->image_link;
//                       }
                  ?>
                <?php 
                    $imageThumb = '';
				    $listImages = json_decode($object->image_list);								   								    
				    if(count($listImages) > 0){
				        $xhtmlImageList = '';
				        foreach ($listImages as $k => $value){
				            if($k == 0) $imageThumb = base_url().'uploads/images/product/'.$value;
				            $link_img = base_url().'public/site/img/default-400x400.png';
				            if(!empty($value)){
				                $link_img = base_url().'uploads/images/product/'.$value;
				            }
				            $xhtmlImageList .= '<div class="item"><a href="'. base_url().'uploads/images/product/'.$value.'"><img class="xzoom-gallery" src="'.$link_img.'" xpreview="'.$link_img.'"/></a></div>';
				        }
				    }					        
				?>
                <div class="product-detail-1-img"><img class="main-image xzoom" src="<?=$imageThumb?>" xoriginal="<?=$imageThumb?>"/>
                  <div class="xzoom-thumbs">
                    <div class="owl-carousel xzoom-carousel owl-theme">
						<?= $xhtmlImageList ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="product-detail-1-detail">
                  <h2><?=$object->vn_name?></h2>
					<h5><?=$object->vn_sapo?></h5>
                  
                  	 <?php 
                  	     $btn = '';
                  	     $price = json_decode($object->price);
                  	     $sale_price = json_decode($object->sale_price);
                  	     $xhlmtPrice = '';
                  	     if ($price) {
                  	         foreach ($price as $k => $value) {
                  	             $xhlmtPrice .= $sale_price[$k] > 0 ? '<h4 class="price-product">'.number_format($sale_price[$k], 0, "", ".").' VNĐ<span> '.number_format($value, 0, "", ".").' VNĐ</span></h4>' : '<h4 class="price-product">'.($value == 0 ? "Liên hệ" : number_format($value, 0, "", ".").' VNĐ').'</h4>';
                  	             if(count($price) > 1)$btn .= '<button type-price="'.$k.'" class="btn btn-light">'.($k + 1).' Tháng</button>';
                  	         }
                  	     }
                  	     echo $xhlmtPrice;
                  	 ?>
					
					<div class="time">
						<?= $btn ?>
					</div>
                  <div class="quantity"><span>Số lượng: </span>
                    <button class="waves-effect waves-light">-</button>
                    <input id="qty-detail" type="number" value="1" min="1"/>
                    <button class="waves-effect waves-light">+</button>
                    <button class="custom-cart" onclick="javascript:addtocart(<?=$object->id?>, 'detail');">thêm vào giỏ</button>
                    <div id="notifi"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="product-detail-2">
            <div class="product-detail-2-title">
              <ul class="nav nav-tabs justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link dkm active" id="desc-tinh_nang-tab" onclick="getDetail(<?= $object->id ?>, 'tinh_nang');" data-toggle="tab" href="#desc-tinh_nang" role="tab" aria-controls="desc-tinh_nang" aria-selected="true">Tính năng sản phẩm</a>
                </li>
                <li class="nav-item">
                	<a class="nav-link dkm" id="desc-thanh_phan-tab" onclick="getDetail(<?= $object->id ?>, 'thanh_phan');" data-toggle="tab" href="#desc-thanh_phan" role="tab" aria-controls="desc-thanh_phan" aria-selected="true">Thành phần chính</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dkm" id="desc-huong_dan-tab" onclick="getDetail(<?= $object->id ?>, 'huong_dan');" data-toggle="tab" href="#desc-huong_dan" role="tab" aria-controls="desc-huong_dan" aria-selected="true">Hướng dẫn sử dụng</a>
                </li>
              </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="desc-tinh_nang" role="tabpanel" aria-labelledby="desc-tinh_nang-tab">
				<?= $object->tinh_nang ?>
              </div>
              <div class="tab-pane fade" id="desc-thanh_phan" role="tabpanel" aria-labelledby="desc-thanh_phan-tab">
				
              </div>
              <div class="tab-pane fade" id="desc-huong_dan" role="tabpanel" aria-labelledby="desc-huong_dan-tab">			
				
              </div>
            </div>
          </div>
        </div>
        <div class="box-comment">
        	<h3>Bình luận của khách hàng</h3>
        	<div class="title-comment"><span>Ý kiến của khách hàng(<?= count($list_comments) ?>)</span></div>
        		<?php if($list_comments) { ?>
        			<?php foreach ($list_comments as $row) { ?>
                		<div style="padding-top: 10px;margin-top: 10px;border-top:1px solid #e1e1e1">
                			<h5><?= $row->fullname ?> | <?= $row->date_created ?></h5>
                			<h5><?= $row->comment ?></h5>
                		</div>
        			<?php } ?>
        		<?php }?>

        	</div>
        	
        	<button class="btn btn-primary comment-active mt-3">Ý kiến của bạn</button>
        	<div id="comment-box" style="margin-top: 30px; display: none">    		
        		<input class="form-control mb-3" style="width: calc(50% - 30px); display: inline-block;margin-right: 30px;" type="text" name="comment_name" id="comment_name" placeholder="Tên">
        		<input class="form-control mb-3" style="width: calc(50% - 5px); display: inline-block" type="email" name="comment_email" id="comment_email" placeholder="Email">
        		<textarea class="form-control" style="height: 100px" name="comment_content" id="comment_content" placeholder="Nội dung"></textarea>
        		<div class=" text-center ">
        			<button class="btn btn-primary mt-3" type="submit" id="comment_submit" onclick="send_comment(<?= $object->id ?>)" value="Gửi">Gửi ý kiến</button>  		
        		</div>
        	</div>
        <script type="text/javascript">
//           $(document).ready(function(){
//             	$(".fancybox").fancybox();
//         		$('.bxslider_detail').bxSlider({
//         		  pagerCustom: '#bx-pager',
//         	      mode: 'fade'
//         		});
//         	  // 	$('.box-img-custommer img').click(function() {
//         	  //       var href = $(this).attr('href');
//         			// $('#img-fancybox a').attr('href',href);
//         			// $('#img-fancybox img').attr('src',href);
//         	  // 	});
          		
//         	});
			$('.comment-active').click( function() {
				$('#comment-box').css('display', 'block');
				$(this).addClass('d-none');
			})
        
          	function send_comment(id){
          		var emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
          		var comment_name = $('#comment_name').val();
        		var comment_email = $('#comment_email').val();
        		var comment_content = $('#comment_content').val();
        		if(comment_name == ''){
        			alert('Bạn chưa nhập tên!');
        			$('#comment_name').focus();
        			return false;
        		}
        		if(comment_email == ''){
        			alert('Bạn chưa nhập địa chỉ Email!');
        			$('#comment_email').focus();
        			return false;
        		}else{
                     if(!emailRegExp.test(comment_email)){
                        alert('Email bạn nhập không đúng định dạng.');               
                        $('#comment_email').focus();
                        return false;
                    }
                }
        		if(comment_content == ''){
        			alert('Bạn chưa nhập tên!');
        			$('#comment_content').focus();
        			return false;
        		}
        
        		$.ajax({
        			type:"POST",
        			url:"<?=base_url()?>ajax/send_comment",
        			data:{'id':id,'comment_name':comment_name,'comment_email':comment_email,'comment_content':comment_content},
        			success: function(res){
            			//console.log(res);
        				alert(res);
        				location.reload();
        			}
        		});
        		return false
          	}
        
        </script>
        <?php if(!empty($related)){?>
        <div class="similar">
          <div class="title-page">
            <h1>Sản phẩm liên quan</h1>
          </div>
				<div class="main-zone">
  				<?php
                    $xhtmlListRelated = '';
                    foreach($related as $row){
                        $link_img = base_url().'public/site/img/default-400x400.png';
                        if(!empty($row->image_link)){
                            $link_img = base_url().'uploads/images/product/'.$row->image_link;
                        }   
                        $price = json_decode($row->price);
                        $sale_price = json_decode($row->sale_price);
                        $prices = $sale_price[0] > 0 ? '<h4>'.number_format($sale_price[0], 0, "", ".").' VNĐ<span> '.number_format($price[0], 0, "", ".").' VNĐ</span></h4>' : '<h4>'.($price[0] == 0 ? "Liên hệ" : number_format($price[0], 0, "", ".").' VNĐ').'</h4>';
                        //$prices = $row->sale_price > 0 ? $row->sale_price : 'Liên hệ';
                        $sale   = $row->sale_price > 0 ? '<h5 class="ratio-sale">'.round((1 - $row->sale_price / $row->price)*100).'%</h5>' : '';
                        $new    = ($row->created + 30*24*60*60) > time() ? '<span>new</span>' : '';
                        $xhtmlListRelated .= '<div class="box-product">
                                                <div class="box-product-img"> <a href="'.base_url().$row->vn_slug.'-p'.$row->id.'.html"><img src="'.$link_img.'"/></a></div>
                                                <div class="box-product-detail">
                                                  <h3><a href="'.base_url().$row->vn_slug.'-p'.$row->id.'.html">'.$row->vn_name.'</a></h3>
                                                  '.$prices.'
                                                  <h5></h5>
                                                  <div class="box-product-detail-btn"><a href="'.base_url().$row->vn_slug.'-p'.$row->id.'.html">Xem chi tiết</a></div>
                                                </div>
                                              </div>';
                   }
                   echo $xhtmlListRelated;
                ?>
			</div>
        </div>
        <?php } //end sản phẩm liên quan ?>
    <?php }else {
        echo 'Dữ liệu rỗng';
    }?>   
            </div>     
      </div>
    </div>
  </section>
</article>
<?php $this->load->view('site/registration_footer'); ?>