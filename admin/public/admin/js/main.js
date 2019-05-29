$('#checkAll').click(function () {
    $(':checkbox.checkItem').prop('checked', this.checked);
});

$('.eSave').click(function () {
    $('#frmSubmit').submit();
});

//create Swal notification
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});


function slug(value, key) {

    var str = $("#" + value).val();

    str = str.toLowerCase();

    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');

    str = str.replace(/([^0-9a-z-\s])/g, '');

    str = str.replace(/(\s+)/g, '-');

    str = str.replace(/^-+/g, '');

    str = str.replace(/-+$/g, '');

    str = str.replace(/---/g, '-');

    $("#" + key).val(str);
}

function action_item(id, key, url, name) {
    $.ajax({
        url: url,
        type: 'POST',
        data: {id: id, key: key, name: name},
        dataType: 'JSON',
        success: function (data) {
            if (data.status > 0) { 
                let strClass =  data.status == 1 ? 'btn-success' : (data.status == 2 ? 'btn-warning' : 'btn-danger'); 
                let strText =  data.status == 1 ? 'Hiển thị' : (data.status == 2 ? 'Ẩn' : 'Xóa');        
                $('.status-' + id).html('<h5 class="' + strClass + '">' + strText + '</h5>');
            }
            if (data.msg != '') {
                Toast.fire({
                    type: 'success',
                    title: data.msg
                });
            }
        }

    })
}




function action_item_all(key, url, name) {
    var ids = new Array();
    $('[name="id[]"]:checked').each(function ()
    {
        ids.push($(this).val());
    });

    if (!ids.length)
        return false;
    //ajax để xóa
    $.ajax({
        url: url,
        type: 'POST',
        data: {'ids': ids, key: key, name: name},
        dataType: 'JSON',
        success: function (data) {
            console.log(data);
            if (data.status > 0) {          
                $(ids).each(function (id, val) {
                    let strClass =  data.status == 1 ? 'btn-success' : (data.status == 2 ? 'btn-warning' : 'btn-danger'); 
                    let strText =  data.status == 1 ? 'Hiển thị' : (data.status == 2 ? 'Ẩn' : 'Xóa');        
                    $('.status-' + val).html('<h5 class="' + strClass + '">' + strText + '</h5>');
                });
            }
            if (data.msg != '') {
                Toast.fire({
                    type: 'success',
                    title: data.msg
                });
            }
        }

    })
    return false;
}


if ($('#editor').length) {
    editors = CKEDITOR.replace("editor", {
        height: '350', language: 'vi',
    });
    CKFinder.setupCKEditor(editors, base + 'public/admin/ckeditor/ckfinder/');
}

if ($('#sapo').length) {
    editors = CKEDITOR.replace("sapo", {height: '200', language: 'vi'});
    CKFinder.setupCKEditor(editors, base + 'public/admin/ckeditor/ckfinder/');
}

if ($('#sapo1').length) {
    editors = CKEDITOR.replace("sapo1", {height: '200', language: 'vi'});
    CKFinder.setupCKEditor(editors, base + 'public/admin/ckeditor/ckfinder/');
}

if ($('#sapo2').length) {
    editors = CKEDITOR.replace("sapo2", {height: '200', language: 'vi'});
    CKFinder.setupCKEditor(editors, base + 'public/admin/ckeditor/ckfinder/');
}

if ($('#sapo3').length) {
    editors = CKEDITOR.replace("sapo3", {height: '200', language: 'vi'});
    CKFinder.setupCKEditor(editors, base + 'public/admin/ckeditor/ckfinder/');
}




//Choose file show one

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile-img-tag').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#customFile").change(function () {
    readURL(this);
});




//Choose file show mutil

$(function () {
    // Multiple images preview in browser
    var imagesPreview = function (input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function (event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#files').on('change', function () {

        $('#multiImg').remove();

        imagesPreview(this, '#showMulti');
    });
});

//Number format nummber 
//$('.format_number').number(true);

//Select2 
// $(document).ready(function () {
//     $("#select").select2();
// });

// $(document).ready(function () {
//     $("#select1").select2();
// });

// $(document).ready(function () {
//     $(".lightbox").colorbox({width: "40%", height: "50%"});

// });


function position(id, position, url) {
    $.ajax({
        url: url,
        type: 'POST',
        data: {id: id, position: position},
        dataType: 'JSON',
        success: function (data) {
            Toast.fire({
                type: 'success',
                title: data.msg
            });
        }
    });
}


//Choose file show one for 1
function selectImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        	let image = $(input).parent().parent().find('.showFile .profile-img-tag');      	
        	image.attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

