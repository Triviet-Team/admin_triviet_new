$('.slider-carousel').owlCarousel({
  loop: true,
  autoplay: true,
  autoplayTimeout: 5000,
  autoplayHoverPause: true,
  dots: false,
  nav: true,
  items: 1,
  center:true,
  autoHeight: true,
  autoplaySpeed: 1000,
  navText: [
    "<i class='mdi mdi-chevron-left'></i>",
    "<i class='mdi mdi-chevron-right'></i>" 
  ],
});

// XZOOM
$('.xzoom-carousel').owlCarousel({
  loop:false,
  autoplay: false,
  dots: false,
  margin:10,
  nav: true,
  items: 4,
  navText: [
    "<i class='mdi mdi-chevron-left'></i>",
    "<i class='mdi mdi-chevron-right'></i>" 
  ],
});

$(".xzoom, .xzoom-gallery").xzoom({tint: '#333', Xoffset: 15});
$('.main-image').bind('click', function () {
  var xzoom = $(this).data('xzoom');
  xzoom.closezoom();
  var gallery = xzoom.gallery().cgallery;
  var i, images = new Array();
  for (i in gallery) {
    images[i] = {
      src: gallery[i]
    };
  }
  $.magnificPopup.open({
    items: images,
    type: 'image',
    gallery: {
      enabled: true
    }
  });
  event.preventDefault();
});

wow = new WOW ({
  mobile: true,
})
wow.init();


$(document).ready(() => {
  const windowWidth = document.body.clientWidth;
  const pageUrl = window.location.href;


  // GO TOP
  $(window).scroll(function () {
    if ($(this).scrollTop() > 150) {
      $('.go-top').fadeIn().css('transform','scale(1)');
      $('.menu').addClass('down animated slideInDown');
    } else {
      $('.go-top').fadeOut().css('transform','scale(0)');
      $('.menu').removeClass('down animated slideInDown');

    }
  });

  $('.go-top').click(() => {
    $("html, body").animate({
      scrollTop: 0
    }, 600);
    return false;
  });

  $(".quantity button").on("click", function() {
    let $button = $(this);
    let oldValue = $button.parent().find("input").val();
  
    if ($button.text() == "+") {
      var newVal = parseFloat(oldValue) + 1;
    } else {
      if (oldValue > 1) {
        var newVal = parseFloat(oldValue) - 1;
      } else {
        newVal = 1;
      }
    }
  
    $button.parent().find("input").val(newVal);
  });


  $(".menu a").each( function () {
    if (pageUrl == (this.href)) {
      $(this).closest("a").addClass("active");
    }
  });
  
  $('.toggleMenu').click(() => {
    $('.nav').toggleClass('out');
    $('.overlay-menu').toggleClass('overlay-in');
	$('.hotline').toggleClass('active')
  });

  $('.overlay-menu, .nav-close').click(function() {
    $('.overlay-menu').removeClass('overlay-in');
    $('.nav').removeClass('out');
	$('.hotline').removeClass('active')
  });


  $('.footer h4').click(function() {
    $(this).parent().find('ul').toggleClass('active');
  });

  $(function() {
    $(' .result ul > li').each( function() { $(this).hoverdir(); } );
  });
	
	                
  $('.price-product').eq(0).addClass('active');
  $('.time button').eq(0).removeClass('btn-light').addClass('btn-primary');

                                
  for(let item = 0; item < 10; item ++) {
    $('.time button').eq(item).click(function() {
      $('.xzoom-thumbs img').removeClass('xactive');
      $('.xzoom-thumbs img').eq(item).addClass('xactive');
      let src = $('.xzoom-thumbs img').eq(item).attr('src');
      $('.main-image').attr('src', src).attr('xoriginal', src);
                  $('.price-product').removeClass('active')
                  $('.price-product').eq(item).addClass('active');
                  $('.time button').addClass('btn-light').removeClass('btn-primary');
                  $(this).removeClass('btn-light').addClass('btn-primary');
    });
  }


});
