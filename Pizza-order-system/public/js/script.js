$(document).ready(function(){
    $(".menu > a").click(function () {
        $(".menu > a").removeClass("nav-active");
        $(this).addClass("nav-active");
    });

    $(".close-btn").click(function () {
        $(".alert").remove();
    });
  });

$(function () {
    var id = window.location.pathname.split("/")[2];
    if (id == 'profile') {
        $(".menu > a").removeClass("nav-active");
        $('#profile').addClass("nav-active");
    } else if (id == 'pizzas') {
        $(".menu > a").removeClass("nav-active");
        $('#pizza').addClass("nav-active");
    } else if (id == 'categories') {
        $(".menu > a").removeClass("nav-active");
        $('#category').addClass("nav-active");
    } else if (id == 'orders') {
        $(".menu > a").removeClass("nav-active");
        $('#order').addClass("nav-active");
    } else if (id == 'riders') {
        $(".menu > a").removeClass("nav-active");
        $('#rider').addClass("nav-active");
    } else if (id == 'users') {
        $(".menu > a").removeClass("nav-active");
        $('#user').addClass("nav-active");
    }else if (id == 'graph') {
        $(".menu > a").removeClass("nav-active");
        $('#graph').addClass("nav-active");
    }
})
