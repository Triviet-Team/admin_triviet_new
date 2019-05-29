
function addtocart(id, opption = '') {
    var qty = '';
    var require = false;
    
    if(opption == 'detail'){
      qty = $('#qty-detail').val();
    }
    
    if(opption == 'watch-faster'){
      qty = $('#qty-faster').val();
    }
    
    var type = $('.time .btn-primary').attr('type-price');
    
    //jQuery('html, body').animate({scrollTop: 0}, 1000);
    $.ajax({
        url: base_url + 'cart/add',
        type: 'POST',
        data: {id: id, qty: qty, type: type},
		beforeSend: function() {
			$('.loading-cart').addClass('active');
    	},
        success: function (data) {
			setTimeout(function(){
				        	$('.loading-cart').removeClass('active');
        	let srt = '';
	        if(data != 0){
		        $("#items").html('(' + data + ')').fadeIn(1000);
				Swal({
				  title: 'Thông báo',
				  type: 'success',
				  html: 'Bạn đã thêm vào giỏ thành công',
				  showCloseButton: true,
				  showCancelButton: true,
				  focusConfirm: false,
				  confirmButtonText:
					'<a href="'+base_url + 'cart' +'">Vào giỏ hàng</a>',
				  cancelButtonText:
					'Tiếp tục mua sắm',
				})
				
        	}else{
        		
				Swal({
				  title: 'Thông báo',
				  type: 'warning',
				  html: 'Thêm giỏ hàng không thành công vì lỗi gì đó',
				  showCloseButton: true,
				  showCancelButton: true,
				  focusConfirm: false,
				  cancelButtonText:
					'Vui lòng thử lại',
				})
        	}					 
			}, 1000);
        }
    });

}


function updateCart(id = 0, val, type = 'update') {	
	  $.ajax({
	      url: base_url + 'cart/watch_cart/' + id,
	      type: 'POST',
	      data: {type: type, value: val},
	      datatype:'json',
		  beforeSend: function() {
			  $('.loading-cart').removeClass('d-none');
		  },
	      success: function (data) {	
	      	var myObj 	= JSON.parse(data);
	      	var number 	= myObj.number;
	      	if(myObj) {
	        	if(myObj.succes == 1 || myObj.succes == 0) {
    	        	$(".cart-body").html(myObj.xhtml);
    	        	$("#item-cart-2").html(number);
    	        	$("#items").hide().html(number).fadeIn(1000);
        			$('.loading-cart').addClass('d-none'); 
	        	}
	        	
	      	}
	      }
	  });
}

function getDetail(id = 0, action) {	
	  $.ajax({
	      url: base_url + 'get-detail.html',
	      type: 'POST',
	      data: {id: id, action: action},
	      //datatype:'json',
//		  beforeSend: function() {
//			  $('.loading-cart').removeClass('d-none');
//		  },
	      success: function (data) {
	      	if(data) {
	      		$("#desc-" + action).html(data);
	      	}
	      }
	  });
}

function changeQty(obj, val) {
    let $button = $(obj);
    let oldValue = $button.parent().find("input").val();
    
    if (val == 1) {
        var newVal = parseFloat(oldValue) + 1;
      } else {
        if (oldValue > 1) {
          var newVal = parseFloat(oldValue) - 1;
        } else {
          newVal = 1;
        }
      }
    
      $button.parent().find("input").val(newVal);
}

$(document).ready(function() {
	//xem giỏ hàng
	$(".cart-btn").click(function(){
		$('.loading-cart').addClass('d-none'); 
		watchCart();
	});
	//update giỏ hàng	
	$('.cart').on('click', '.update-cart', function() {
		var qty = $(this).parent().parent().find('.quantity input').val();
		var id  = $(this).attr('id-product');
		updateCart(id, qty);
	});
	
	//del giỏ hàng	
	$('.cart').on('click', '.del-cart', function() {
		var qty = $(this).parent().parent().find('.quantity input').val();
		var id  = $(this).attr('id-product');
		updateCart(id, qty, 'del');
	});
	
	$(".submit").click(function(){
		$("#form-cart").submit();
	});
	$("#seach").click(function(){
		$("#form-seach").submit();
	});
	//sort
	$("#sort").change(function(){
		$("#form-sort").submit();
	});
	$(".limit").change(function(){
		$("#form-sort").submit();
	});
	$(".filter-done").click(function(){
		$("#filter-color").submit();
	});
	// ajax select districts
	$("#province").change(function(){
		var province_id = $("#province option:selected").val();
		if(province_id > 0){
		    $.ajax({	    	
		        url: base_url + 'order/address',
		        type: 'POST',
		        data: {type: 'district', province: province_id},
		        dataType: 'JSON',
		        success: function (data) {
		        	var strDistrict = '<option value="0">Chọn Quận/Huyện</option>';
		        	if(data){
		        		$.each(data, function(i, value){
		        			strDistrict += '<option value="'+ value.id +'">'  + ' ' + value.name + '</option>';
		        		});
		        		$('#district').html(strDistrict);
		        	}
		        }
		    });
		}else{
			$('#district').html('<option value="0">Chọn Quận/Huyện</option>');
		}
	});
	
$("#myform").validate({
      rules: {
    	  user_name: {
          required: true,
          minlength: 5
    	  },
          user_email: {
	          required: true,
	          email: true
	        },
	      user_phone: {
	          required: true,
	          minlength: 10
	        },
	      province: {
	          required: true
	        },
	      district: {
	          required: true
	        },
	      ward: {
	          required: true
	        }
	        ,
	      user_address: {
	          required: true
	        },
		  message: {
	          required: true
	        }
		  
        
    
      },
      messages: {
    	  user_name: {
	          required: "Họ tên không được trống",
	          minlength: "Họ tên có ít nhất có 5 ký tự"
        },
          user_email: {
	          required: "Email không được trống",
	          email	  : "Vui lòng nhập email đúng"
        },
        user_phone: {
	          required: "Điện thoại không được trống",
	          minlength: "Điện thoại có ít nhất có 10 số"
        },
        province: {
	          required: "Tỉnh/Thành phố không được trống"
        },
        district: {
	          required: "Quận/Huyện không được trống"
        },
        ward: {
	          required: "Xã/Phường không được trống"
        }
        ,
        user_address: {
	          required: "Địa chỉ không được trống"
	        }
		          ,
        message: {
	          required: "Nội dung không được trống"
	      }
	   }

  });

});





