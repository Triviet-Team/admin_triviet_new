<section class="letter">
  <div class="container">
    <div class="row">
      <div class="col-md-6 text-center text-md-left mb-3 mb-md-0"><span>Liên kết với chúng tôi:</span>
		  <a href="<?= @$config->facebook ?>"><i class="mdi mdi-facebook"></i></a>
		  <a href="<?= @$config->twitter ?>"><i class="mdi mdi-twitter"></i></a>
		  <a href="<?= @$config->youtube ?>"><i class="mdi mdi-youtube"></i></a>
		  <a href="<?= @$config->google ?>"><i class="mdi mdi-google-plus"></i></a></div>
      <div class="col-md-6 text-center text-md-right">
        <form id="myForm2" action="" method="post">
          <input name="email_register" class="form-control" type="text" placeholder="Nhập email để nhận được tin ưu đãi"/>
          <button type="submit">ĐĂNG KÝ</button>
          <p id="output2" style="color: red; position: absolute; margin-left: 30%; padding: 5px;"></p>
        </form>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
    	var options = { 
            success: function(data) {
                if(parseInt(data.status) == 1) $("#myForm2")[0].reset();
                $('#output2').html(data.message);
            },  
            url:       '<?= base_url('contact/registration') ?>',
            dataType: 'JSON',
            type:      'POST',
            timeout:   3000 
        }; 
        $('#myForm2').submit(function() { 
            $(this).ajaxSubmit(options); 
            return false; 
        }); 
</script>