$(function () {
    var data = ["Ha Noi", "TP.HCM", "Da Nang", "Phu Quoc", "Nha Trang", "Vinh", "Da Lat"];
    $("#hotel-name").autocomplete({
        source: data
    });
});