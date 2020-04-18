$(document).ready(function () {
    $("#justify").click(function () {
        $("#menu").show(200);
        $("#disable_bg").show(200);
         $("body").css("overflow-y", "hidden");
    });
    $("#disable_bg").click(function () {
        $(this).hide(200);
        $("#menu").hide(200);
         $("body").css("overflow-y", "auto");
         $("body").css("overflow-x", "hide");
    });
    $("#showDown1").click(function () {
        $("#blog1").slideDown(200);
        $("#footer1").slideDown(200);
        $("#card1").css("transform", "scale(1.05, 1.05)","transition", "all 0.5s");
        $("#card1").css("box-shadow", "12px 10px 15px #818182");
        $("#hideUp1").show();
        $(this).hide();
    });
    $("#hideUp1").click(function () {
        $("#blog1").slideUp(200);
        $("#footer1").slideUp(200);
        $("#card1").css("box-shadow", "none", "transform", "scale(0.95, 0.95)");
        $("#showDown1").show();
        $(this).hide();
    });
    $("#showDown2").click(function () {
        $("#blog2").slideDown(200);
        $("#footer2").slideDown(200);
        $("#card2").css("transform", "scale(1.05, 1.05","transition", "all 0.5s");
        $("#card2").css("box-shadow", "12px 10px 15px #818182");
        $("#hideUp2").show();
        $(this).hide();
    });
    $("#hideUp2").click(function () {
        $("#blog2").slideUp(200);
        $("#footer2").slideUp(200);
        $("#card2").css("box-shadow", "none", "transform", "scale(0.95, 0.95)");
        $("#showDown2").show();
        $(this).hide();
    });
    $("#showDown3").click(function () {
        $("#blog3").slideDown(200);
        $("#footer3").slideDown(200);
        $("#card3").css("transform", "scale(1.05, 1.05","transition", "all 0.5s");
        $("#card3").css("box-shadow", "12px 10px 15px #818182");
        $("#hideUp3").show();
        $(this).hide();
    });
    $("#hideUp3").click(function () {
        $("#blog3").slideUp(200);
        $("#footer3").slideUp(200);
        $("#card3").css("box-shadow", "none", "transform", "scale(0.95, 0.95)");
        $("#showDown3").show();
        $(this).hide();
    });
    $("#more1").click(function () {
        $(this).css("color", "green");
        $("#more2, #more3, #more4").css("color","black");
        $(".table:first-child").fadeIn();
        $(".table:nth-last-child(3), .table:nth-last-child(2), .table:nth-last-child(1)").hide();
    });
    $("#more2").click(function () {
        $(this).css("color", "green");
        $("#more1, #more3, #more4").css("color","black");
        $(".table:nth-last-child(3)").fadeIn();
        $(".table:first-child, .table:nth-last-child(2), .table:nth-last-child(1)").hide();
    });
    $("#more3").click(function () {
        $(this).css("color", "green");
        $("#more2, #more1, #more4").css("color","black");
        $(".table:nth-last-child(2)").fadeIn();
        $(".table:nth-last-child(3), .table:first-child, .table:nth-last-child(1)").hide();
    });
    $("#more4").click(function () {
        $(this).css("color", "green");
        $("#more2, #more3, #more1").css("color","black");
        $(".table:nth-last-child(1)").fadeIn();
        $(".table:nth-last-child(3), .table:nth-last-child(2), .table:first-child").hide();
    });
});
