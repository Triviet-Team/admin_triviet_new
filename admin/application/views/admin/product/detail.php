<div class="bg-white addHeight height-auto">
    <div class="ui-wid">
        <div class="form-head">
            <?= $title ?>
        </div>
        <div class="form-mid">
            <form action="" method="POST" id="frmSubmit" enctype="multipart/form-data">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Trạng Thái</label>
                    <div class="col-sm-10">
                        <select class="custom-select" name="status">
                            <option value="1" <?= @$info->status == 1 ? 'selected' : '' ?>>Hiển thị</option>
                            <option value="2" <?= @$info->status == 2 ? 'selected' : '' ?>>Ẩn</option>
                            <option value="3" <?= @$info->status == 3 ? 'selected' : '' ?>>Xóa</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Danh mục</label>
                    <div class="col-sm-10">
                        <select class="custom-select" id="select" name="cid">
                            <?php foreach ($catalogs as $row) { ?>
                                <?php if ($row->subs) { ?>
                                    <optgroup label="<?php echo $row->vn_name ?>">
                                        <?php foreach ($row->subs as $sub) { ?>
                                            <option value="<?php echo $sub->id ?>" <?= @$info->cid == $sub->id ? 'selected' : '' ?>><?php echo $sub->vn_name ?> </option>
                                        <?php } ?>
                                    </optgroup>
                                <?php } else { ?>
                                    <option value="<?php echo $row->id ?>"  <?= @$info->cid == $row->id ? 'selected' : '' ?>><?php echo $row->vn_name ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>  
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tên Sản Phẩm</label>
                    <div class="col-sm-10">
                        <input type="text" name="vn_name" value="<?= isset($info->vn_name) ? $info->vn_name : set_value('vn_name') ?>" id="vn_name" onkeyup="return slug('vn_name', 'vn_slug');" class="form-control">
                        <div class="error"><?= form_error('vn_name') ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" name="vn_slug" value="<?= isset($info->vn_slug) ? $info->vn_slug : set_value('vn_slug') ?>" id="vn_slug" onkeyup="return slug('vn_name', 'vn_slug');" class="form-control">
                    </div>
                </div>
               	<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mã sản phẩm</label>
                    <div class="col-sm-10">
                        <input class="form-control" value="<?= isset($info->code) ? $info->code : set_value('code') ?>" name="code"/>
                    </div>
                </div>
                <!--<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cấu Hình</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" <?= @$info->is_home == 1 ? 'checked' : '' ?> value="1" name="is_home" id="is_home">
                                    <label class="custom-control-label" for="is_home">Hiện trang chủ</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" <?= @$info->is_pay == 1 ? 'checked' : '' ?> value="1" name="is_pay" id="is_pay">
                                    <label class="custom-control-label" for="is_pay">Sản phẩm bán chạy</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Keyword</label>
                    <div class="col-sm-10">
                        <input type="text" name="vn_keyword" value="<?= isset($info->vn_keyword) ? $info->vn_keyword : set_value('vn_keyword') ?>"  data-role="tagsinput" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="vn_title" value="<?= isset($info->vn_title) ? $info->vn_title : set_value('vn_title') ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="vn_description"><?= isset($info->vn_description) ? $info->vn_description : set_value('vn_description') ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mô tả</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="10" id="sapo" name="vn_sapo"><?= isset($info->vn_sapo) ? $info->vn_sapo : set_value('vn_sapo') ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tính năng sản phẩm</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="10" id="sapo1" name="tinh_nang"><?= isset($info->tinh_nang) ? $info->tinh_nang : set_value('tinh_nang') ?></textarea>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Thành phần chính</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="10" id="sapo2" name="thanh_phan"><?= isset($info->thanh_phan) ? $info->thanh_phan : set_value('thanh_phan') ?></textarea>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Hướng dẫn sử dụng</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="10" id="sapo3" name="huong_dan"><?= isset($info->huong_dan) ? $info->huong_dan : set_value('huong_dan') ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Ảnh đại diện</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" name="image_link" class="custom-file-input" id="customFile">
                            <label class="custom-file-label">Chọn File</label>
                        </div>

                        <div class="showFile">
                            <?php if (!isset($info->image_link)) { ?>
                                <img id="profile-img-tag" src="<?= base_url() ?>public/admin/img/no-img.png" alt="No-Img">
                            <?php } else { ?>
                                <img id="profile-img-tag" src="<?= base_url('uploads/images/product/' . $info->image_link) ?>" alt="No-Img">
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div id="block-list-product">
                	<div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                           	<button type="button" class="btn btn-primary add-product">Thêm</button>
                        </div>
                    </div>
                    <?php 
                        $xhtml = '<div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Giá sản phẩm</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" value="" name="price[]"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Giá SP sau khi giảm</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" value="" placeholder="Nhập giá sản phẩm sau khi đã giảm giá" name="sale_price[]"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Hình Ảnh</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="image_list[]" class="custom-file-input customFile" onchange="selectImg(this);">
                                            <label class="custom-file-label">Chọn File</label>
                                        </div>
                
                                        <div class="showFile">
                                            <img class="profile-img-tag" src="'.base_url() . 'public/admin/img/no-img.png' .'" alt="No-Img">
                                        </div>
                                    </div>
                                </div>';
                        if($info->image_list) {
                            $xhtml = '';
                            $price = json_decode($info->price);
                            $sale_price = json_decode($info->sale_price);
                            $image_list = json_decode($info->image_list);
                            foreach ($image_list as $k => $value) {
                                $img = '<img class="profile-img-tag" src="'.base_url() . 'public/admin/img/no-img.png' .'" alt="No-Img">';
                                if($value) {
                                    $img = '<img class="profile-img-tag" src="'. base_url('uploads/images/product/' . $value).'" alt="No-Img">';
                                }
                                $xhtml .= '<div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Giá sản phẩm</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" value="'.$price[$k].'" name="price[]"/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Giá SP sau khi giảm</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" value="'.$sale_price[$k].'" placeholder="Nhập giá sản phẩm sau khi đã giảm giá" name="sale_price[]"/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Hình Ảnh</label>
                                                <div class="col-sm-10">
                                                    <div class="custom-file">
                                                        <input type="file" name="image_list[]" class="custom-file-input customFile" onchange="selectImg(this);">
                                                        <label class="custom-file-label">Chọn File</label>
                                                    </div>
                            
                                                    <div class="showFile">
                                                        '.$img.'
                                                    </div>
                                                </div>
                                            </div>'; 
                            }
                        }
                        echo $xhtml;
                    ?>
                    
                </div>
                <script type="text/javascript">
					$('.add-product').click( function(){
							let str = '<div class="form-group row">' +
            		                        '<label class="col-sm-2 col-form-label">Giá sản phẩm</label>' +
            		                        '<div class="col-sm-10">' +
            		                            '<input class="form-control" type="number" value="" name="price[]">' +
            		                        '</div>' +
            		                    '</div>' +
            		                    '<div class="form-group row">' +
            		                        '<label class="col-sm-2 col-form-label">Giá SP sau khi giảm</label>' +
            		                        '<div class="col-sm-10">' +
            		                            '<input class="form-control" type="number" value="" placeholder="Nhập giá sản phẩm sau khi đã giảm giá" name="sale_price[]">' +
            		                        '</div>' +
            		                    '</div>' +
            		                    '<div class="form-group row">' +
            		                        '<label class="col-sm-2 col-form-label">Hình Ảnh</label>' +
            		                        '<div class="col-sm-10">' +
            		                            '<div class="custom-file">' +
            		                                '<input type="file" name="image_list[]" class="custom-file-input customFile" onchange="selectImg(this);">' +
            		                                '<label class="custom-file-label">Chọn File</label>' +
            		                            '</div>' +
            		                            '<div class="showFile">' +
            		                              '<img class="profile-img-tag" src="<?= base_url() ?>public/admin/img/no-img.png" alt="No-Img">' +
            		                            '</div>' +
            		                        '</div>' +
            		                    '</div>'; 
							$('#block-list-product').append(str);
						}
					);
                </script>
                <!--<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Hình ảnh kèm theo</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" name="image_list[]" multiple class="custom-file-input" id="files">
                            <label class="custom-file-label">Chọn File</label>
                        </div>
                        <div class="showFile" id="showMulti">
                            <?php if (!isset($info->image_list)) { ?>
                                <img id="profile-img-tag" src="<?= base_url() ?>public/admin/img/no-img.png" alt="No-Img">
                            <?php } else { ?>
                                <div  id="showMulti">
                                    <?php $image_list = json_decode($info->image_list) ?>
                                    <?php foreach ($image_list as $img) { ?>
                                        <img src="<?= base_url('uploads/images/product/400_400/' . $img) ?>" alt="No-Img">
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <p style="margin-top:10px;">Giữ Ctrl và chọn nhiều File Ảnh để đính kèm 2 hoặc nhiều ảnh !</p>
                    </div>
                </div>
                
               </div>  -->
            </form>
        </div>

        <div class="form-bottom">
            <div class="horControlB">
                <ul>
                    <li>
                        <a class="eSave">
                            <span>Save</span>
                        </a>
                    </li>
                    <li>
                        <a class="eCancel" href="javascript:(0)" onclick="location.href = '<?= base_url('admincp/product') ?>'">
                            <span>Cancel</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>