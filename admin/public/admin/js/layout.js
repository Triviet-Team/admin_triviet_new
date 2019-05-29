$(document).ready(() => {
  const windowWidth = document.body.clientWidth;
  const pageUrl = window.location.href;


  $('.menu-btn').click(() => {
    $('aside').toggleClass('aside-mini');
    $('main').toggleClass('main-mini');
    $('header').toggleClass('header-mini');

    $('.logo-large').toggleClass('logo-large-mini');
    $('.logo-mini').toggleClass('logo-mini-mini');
    $('.menu-title, .menu-down').toggleClass('mini');
    
    $('.menu-icon').toggleClass('menu-icon-mini');
    $('.nav-item .collapse').addClass('show');
    $('.menu-down').removeClass('active');

    $('.overlay-menu').addClass('overlay-in');
    $('body').addClass('active');
  });

  $('.menu .nav li').click(function() {
    $(this).find('.menu-down').toggleClass('active')
  });

  $('.overlay-menu, .menu-close').click(function() {
    $('.overlay-menu').removeClass('overlay-in');
    $('aside').removeClass('aside-mini');
    $('body').removeClass('active');
  });

  $("aside a").each( function () {
    if (pageUrl == (this.href)) {
      $(this).closest("li").addClass("active");
      $(this).parent().parent().parent().parent().addClass("active")
    }
  });



  $('.table-responsive').on('change', 'input:checkbox', function() {

    let checkboxLength = $('tbody').find('input:checkbox').length;
    let checkedLength = $('tbody input:checked').length;

    if (checkedLength < checkboxLength) {
      $('#check-all').prop('checked', false);
    } else if (checkedLength === checkboxLength)  {
      $('#check-all').prop('checked', true);
      $('#check-all').attr('checked', true);
    }

    if (this.checked) {
      $('#active-all, #delete-all, #private-all').removeAttr('disabled');
      $('#go-trash').attr('disabled', 'disabled');

    } else if (checkedLength === 0) {
      $('#active-all, #delete-all, #private-all').attr('disabled', 'disabled');
      $('#go-trash').removeAttr('disabled');
    }
  });

  $('#check-all').change(function() {
    let checkboxes = $(this).closest('.table-responsive').find(':checkbox');
    checkboxes.prop('checked', $(this).is(':checked'));
  });

});

