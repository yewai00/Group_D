$(document).ready(function() {
    $('.humburger').click(function() {
      $(this).toggleClass('active');
  
      if ($(this).hasClass('active')) {
          $('.nav-inner').addClass('active');
      } else {
          $('.nav-inner').removeClass('active');
      }
    });
  });//menu JS