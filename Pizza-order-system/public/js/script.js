$(document).ready(function () {
    $(".menu > a").click(function () {
        $(".menu > a").removeClass("nav-active");
        $(this).addClass("nav-active");
    });

    $(".close-btn").click(function () {
        $(".alert").remove();
    });

    $(".order-btn").click(function () {
        var modal_id = "#order-" + $(this).attr("id");
        $(modal_id).css("display", "block");
    });

    $(".close").click(function () {
        $(".modal").css("display", "none");

        let menuOpen = false;
        $(".menu-btn").click(function () {
            if (!menuOpen) {
                $(".menu-btn").addClass("open");
                $(".aside").css("right", "0");
                menuOpen = true;
            } else {
                $(".menu-btn").removeClass("open");
                menuOpen = false;
                $(".aside").css("right", "-100%");
            }
        });
    });
});
$(function () {
    var id = window.location.pathname.split("/")[2];
    if (id == "profile") {
        $(".menu > a").removeClass("nav-active");
        $("#profile").addClass("nav-active");
    } else if (id == "pizzas") {
        $(".menu > a").removeClass("nav-active");
        $("#pizza").addClass("nav-active");
    } else if (id == "categories") {
        $(".menu > a").removeClass("nav-active");
        $("#category").addClass("nav-active");
    } else if (id == "orders") {
        $(".menu > a").removeClass("nav-active");
        $("#order").addClass("nav-active");
    } else if (id == "riders") {
        $(".menu > a").removeClass("nav-active");
        $("#rider").addClass("nav-active");
    } else if (id == "users") {
        $(".menu > a").removeClass("nav-active");
        $("#user").addClass("nav-active");
    } else if (id == "graph") {
        $(".menu > a").removeClass("nav-active");
        $("#graph").addClass("nav-active");
    }
});

$(function () {
    var ctx = $("#graphCanvas");

    var data = {
        labels: cData.label,
        datasets: [
            {
                label: "Number of Sales",
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
                borderWidth: [1, 1, 1, 1, 1, 1, 1],
            },
        ],
    };

    //options
    var options = {
        responsive: true,
        title: {
            display: true,
            position: "top",
            text: "Last Week Registered Users -  Day Wise Count",
            fontColor: "#111",
        },
        legend: {
            display: true,
            position: "bottom",
            labels: {
                fontColor: "#333",
                fontSize: 16,
            },
        },
    };

    var chart1 = new Chart(ctx, {
        type: "bar",
        data: data,
        options: options,
    });
});
