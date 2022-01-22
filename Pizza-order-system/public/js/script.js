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
    } else if (id == 'graph') {
        $(".menu > a").removeClass("nav-active");
        $('#graph').addClass("nav-active");
    }
})
$(function () {
    //get the pie chart canvas/**/
    /*var cData = {{ json_encode($data) }};*/
     var ctx = $("#graphCanvas");
     console.log(cData);

      //pie chart data
      var data = {
        labels: cData.label,
        datasets: [
          {
            label: "Price",
            data: cData.data,
            backgroundColor: [
              "#DEB887",
              "#A9A9A9",
              "#DC143C",
              "#F4A460",
              "#2E8B57",
              "#1D7A46",
              "#CDA776",
            ],
            borderColor: [
              "#CDA776",
              "#989898",
              "#CB252B",
              "#E39371",
              "#1D7A46",
              "#F4A460",
              "#CDA776",
            ],
            borderWidth: [1, 1, 1, 1, 1,1,1]
          }
        ]
      };

      //options
      var options = {
        responsive: true,
        title: {
          display: true,
          position: "top",
          text: "Last Week Registered Users -  Day Wise Count",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
      };

      //create Pie Chart class object
      var chart1 = new Chart(ctx, {
        type: "line",
        data: data,
        options: options
      });

  });
