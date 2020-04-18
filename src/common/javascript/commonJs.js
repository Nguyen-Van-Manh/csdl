$(function () {
    var data = ["Ha Noi", "TP.HCM", "Da Nang", "Phu Quoc", "Nha Trang", "Da Lat"];
    $("#city").autocomplete({
        source: data
    });
});
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
    $("#login").click(function () {
        $("#user").slideToggle(200);
    });
});
function time() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    if(h >= 12 && h<= 23) {
        document.getElementById("w").innerHTML = 'PM';
    }
    else {
        document.getElementById('w').innerHTML = 'AM';
    }
    if(h >= 6 && h < 12) {
        document.getElementById("clock").style.backgroundImage = "url('../../common/image/morning.jpg'), url('../../../common/image/morning.jpg')";
    }
    if(h >=12 && h<18) {
        document.getElementById("clock").style.backgroundImage = "url('../../common/image/afternoon.jpg'), url('../../../common/image/afternoon.jpg')";
    }
    if((h >= 18 && h<= 23) || (h >= 0 && h < 6)) {
        document.getElementById("clock").style.backgroundImage = "url('../../common/image/ninght.jpg'), url('../../../common/image/ninght.jpg')";
    }
    h = fixTime(h);
    h = checkTime(h) + '  :';
    m = checkTime(m) + '  :';
    s = checkTime(s);
    document.getElementById("h").innerHTML = h;
    document.getElementById("m").innerHTML = m;
    document.getElementById("s").innerHTML = s;
    clockTime = setTimeout("time()", 1000);
}
function checkTime(value) {
    if(value < 10) value = "0" + value;
    return value;
}
function fixTime(value){
    if(value >= 12) value -= 12;
    return value;
}
$(document).ready(function () {

});