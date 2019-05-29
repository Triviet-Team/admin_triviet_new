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
                                <?php if (count($row->subs) > 1) { ?>
                                    <optgroup label="<?php echo $row->vn_name ?>">
                                        <?php foreach ($row->subs as $sub) { ?>
                                            <option value="<?php echo $sub->id ?>" <?= @$info->cid == $sub->id ? 'selected' : '' ?>> <?php echo $sub->vn_name ?> </option>
                                        <?php } ?>
                                    </optgroup>
                                <?php } else { ?>
                                    <option value="<?php echo $row->id ?>" <?= @$info->cid == $row->id ? 'selected' : '' ?>><?php echo $row->vn_name ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>  
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tên Bài Viết</label>
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

                <!--<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cấu Hình</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" <?= @$info->is_home == 1 ? 'checked' : '' ?> value="1" name="is_home" id="is_home">
                            <label class="custom-control-label" for="is_home">Hiên thị trang chủ</label>
                        </div>
                    </div>
                </div>-->

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
                        <textarea class="form-control" rows="2" name="vn_description"><?= isset($info->vn_description) ? $info->vn_description : set_value('vn_description') ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mô Tả</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="4" name="vn_sapo"><?= isset($info->vn_sapo) ? $info->vn_sapo : set_value('vn_sapo') ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nôi Dung Bài Viết</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="10" id="editor" name="vn_detail"><?= isset($info->vn_detail) ? $info->vn_detail : set_value('vn_detail') ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Hình Ảnh</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="customFile">
                            <label class="custom-file-label">Chọn File</label>
                        </div>


                        <div class="showFile">
                            <?php if (!isset($info->image_link)) { ?>
                                <img id="profile-img-tag" src="<?= base_url() ?>public/admin/img/no-img.png" alt="No-Img">
                                <?php
                            } else { ?>
                                <img id="profile-img-tag" src="<?= base_url('uploads/images/news/1024_512/' . $info->image_link) ?>" alt="No-Img">
                            <?php } ?>
                        </div>
                    </div>
                </div>
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
                        <a class="eCancel" href="javascript:(0)" onclick="location.href = '<?= base_url('admincp/articles') ?>'">
                            <span>Cancel</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>