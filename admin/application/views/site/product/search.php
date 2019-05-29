
<?php
    $xhtmlListProduct = '';
    if(!empty($list_product)){
        foreach($list_product as $row){
            $link_img = base_url().'public/site/img/default-400x400.png';
            if(!empty($row->image_link)){
                $link_img = base_url().'uploads/images/product/400_400/'.$row->image_link;
            }            
            //$prices = $row->sale_price > 0 ? '<h4><span>'.number_format($row->price, 0, "", ".").' đ</span> '.number_format($row->sale_price, 0, "", ".").' đ</h4>' : '<h4>'.($row->price == 0 ? "Liên hệ" : number_format($row->price, 0, "", ".").' đ').'</h4>';
            $prices = $row->sale_price > 0 ? $row->sale_price : 'Liên hệ';
            $sale   = $row->sale_price > 0 ? '<h5 class="ratio-sale">'.round((1 - $row->sale_price / $row->price)*100).'%</h5>' : '';
            $new    = ($row->created + 30*24*60*60) > time() ? '<span>new</span>' : '';
            $xhtmlListProduct .= '<div class="box-product">
            						<div class="box-product-status">
            							'.$new.'
            						</div>
            						<div class="box-product-img">
            							<div class="box-product-img-custom">
            								<a class="custom-quickview" onclick="javascript:watch('.$row->id.');" title="Xem nhanh" data-toggle="modal" data-target=".product-modal-1" href="#">
                                                <i class="mdi mdi-eye-plus"></i>
                                            </a>
                                            <a class="custom-cart" onclick="javascript:addtocart('.$row->id.');" title="Thêm vào giỏ"><i class="mdi mdi-cart"></i></a>
            							</div>
            							<a href="'.base_url('chi-tiet-san-pham/').$row->vn_slug.'.html"><img
            								src="'.$link_img.'" /></a>
            						</div>
            						<div class="box-product-detail">
            							<h6>MSP: '.$row->code.'</h6>
            							<h5>
            								<a href="'.base_url('chi-tiet-san-pham/').$row->vn_slug.'.html" title="'.$row->vn_name.'">'.$row->vn_name.'</a>
            							</h5>
            							<h4>Giá: '.$prices.'</h4>
            							<p>'.$row->vn_sapo.'</p>
            						</div>
            					</div>';
        }
    }else{
        $xhtmlListProduct = '<p>Dữ liệu đang cập nhật</p>';
    }

?>
<article>
      <section class="bread-crumb">
        <div class="container">
        	<?php $this->load->view('site/breadcrumb'); ?>
        </div>
      </section>
      <section class="product-page">
        <div class="container">
          <div class="left">
				<?php $this->load->view('site/sidebar'); ?>
				<!-- 				end content -->
          </div>
          <div class="main">
            <h2>bộ bàn ghế phòng khách</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, odit dolore doloribus omnis laudantium veniam consectetur illo suscipit veritatis esse architecto mollitia, sit autem molestias cupiditate quibusdam quis labore culpa.</p>
            <div class="filter-btn d-block d-xl-none"><i class="mdi mdi-filter"></i>Lọc sản phẩm</div>
            <form id="form-sort" action="" method="post">
            <div class="main-custom">
              <div class="type d-none d-md-block"><span>Kiểu xem:</span><i class="mdi mdi-view-grid type-grid active"></i><i class="mdi mdi-view-list type-list"></i></div>
              <div class="sort">
			    <?php
			        $arrOpp = array(
			                            'price_asc'     => 'Giá từ thấp lên cao',
			                            'price_desc'    => 'Giá từ cao xuống thấp',
			                            'name_asc'      => 'Tên từ A đến Z',
			                            'name_desc'     => 'Tên từ Z đến A',
			                    );
			       $xhtmlOpp = '';
			       foreach($arrOpp as $k => $val){
			           if(isset($sort) && $sort == $k ){
			               $xhtmlOpp .= '<option selected value="'.$k .'">'.$val.'</option>';
			           }else{
			                $xhtmlOpp .= '<option value="'.$k .'">'.$val.'</option>';
			           }
			       }
			    ?>
				
					<select name="sort" class="form-control" name="" id="sort">
						<option value="0">Sắp xếp mặc định</option>
                        <?=$xhtmlOpp?>
					</select>

              </div>
              <div class="view">Hiển thị:
                <select class="limit" name="limit" class="form-control">
                  <option <?= $limit == 12 ? 'selected' : '' ?> value="12" >12</option>
                  <option <?= $limit == 24 ? 'selected' : '' ?> value="24">24</option>
                  <option <?= $limit == 32 ? 'selected' : '' ?> value="32">32</option>
                </select><span class="d-none d-xl-inline-block">Sản phẩm</span>
              </div>
            </div>
            </form>
            <div class="main-product">
				<?php echo $xhtmlListProduct;?>
			</div>
            <div class="main-paging">
              <nav>
                <ul class="pagination justify-content-end">
                	<?=$pagination?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </section>
    </article>

