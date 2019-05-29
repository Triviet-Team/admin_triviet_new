<div class="bg-white addHeight">
    <div class="ui-wid">
        <div class="form-head">
            Thêm sản phẩm
        </div>
        <div class="form-mid">

            <?php $this->load->view('admin/message') ?>

            <form id="frmSubmit" action="" method="POST">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Title Site</label>
                    <div class="col-sm-10">
                        <input type="text" name="vn_title_site" value="<?= @$general->vn_title_site ? $general->vn_title_site : '' ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Keywords Site</label>
                    <div class="col-sm-10">
                        <input type="text" name="vn_keyword_site" value="<?= @$general->vn_keyword_site ? $general->vn_keyword_site : '' ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description Site</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="vn_description_site" rows="3"><?= @$general->vn_description_site ? $general->vn_description_site : '' ?></textarea>
                    </div>
                </div>
                
				<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Giới thiệu</label>
                    <div class="col-sm-10">
                        <input type="text" name="about" value="<?= @$general->about ? $general->about : '' ?>" class="form-control">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Địa chỉ website</label>
                    <div class="col-sm-10">
                        <input type="text" name="address_website" value="<?= @$general->address_website ? $general->address_website : '' ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Địa chỉ</label>
                    <div class="col-sm-10">
                        <input type="text" name="address" value="<?= @$general->address ? $general->address : '' ?>" class="form-control">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Hotline</label>
                    <div class="col-sm-10">
                        <input type="text" name="hotline" value="<?= @$general->hotline ? $general->hotline : '' ?>" class="form-control">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Số điện thoại</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone" value="<?= @$general->phone ? $general->phone : '' ?>" class="form-control">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Mã số thuế</label>
                    <div class="col-sm-10">
                        <input type="text" name="ma_thue" value="<?= @$general->ma_thue ? $general->ma_thue : '' ?>" class="form-control">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Fax</label>
                    <div class="col-sm-10">
                        <input type="text" name="fax" value="<?= @$general->fax ? $general->fax : '' ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10 email" id="email">
						<input type="text" name="email" value="<?= @$general->email ? $general->email : '' ?>" class="form-control col-sm-12 add-email" style="margin-top:5px;">                                      
                    </div>
                   
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Facebook</label>
                    <div class="col-sm-10">
                        <input type="text" name="facebook" value="<?= @$general->facebook ? $general->facebook : '' ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Youtube</label>
                    <div class="col-sm-10">
                        <input type="text" name="youtube" value="<?= @$general->youtube ? $general->youtube : '' ?>" class="form-control">
                    </div>
                </div>
				
				<div class="form-group row">
                    <label class="col-sm-2 col-form-label">Twitter</label>
                    <div class="col-sm-10">
                        <input type="text" name="twitter" value="<?= @$general->twitter ? $general->twitter : '' ?>" class="form-control">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Google plus</label>
                    <div class="col-sm-10">
                        <input type="text" name="google" value="<?= @$general->google ? $general->google : '' ?>" class="form-control">
                    </div>
                </div>
            </form>
        </div>
        <div class="form-bottom">
            <div class="horControlB">
                <ul>
                    <li>
                        <a href="javascript:(0)" class="eSave">
                            <span>Save</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>