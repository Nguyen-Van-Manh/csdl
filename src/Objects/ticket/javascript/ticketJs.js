$(function () {
    var data = ["Ha Noi", "TP.HCM", "Da Nang", "Phu Quoc", "Nha Trang", "Vinh", "Da Lat"];
    $("#start, #end").autocomplete({
        source: data
    });
    $("#ticket1 .container:nth-last-child(1) input").autocomplete({
        source: data
    });
});
$(document).ready(function () {

    $('a[href="#ticket1"]').css({"background-color":"#30c5f7", "color":"white"});

    $('a[href="#ticket1"]').click(function () {
        $(this).css({"background-color":"#30c5f7", "color":"white"});
        $('a[href="#combo"]').css({"background-color":"black", "color":"white"});
    });
});