$(document).ready(function() {
    $('.humburger').click(function() {
      $(this).toggleClass('active');

      if ($(this).hasClass('active')) {
          $('.nav-inner').addClass('active');
      } else {
          $('.nav-inner').removeClass('active');
      }
    });

    $('.page-link').attr("href", function()
    {
      return $(this).attr("href") + "#pizza-list"
      });
  });//menu JS
