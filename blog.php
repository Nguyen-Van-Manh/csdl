<?php
function category($cityName) {
    $path="";
    switch ($cityName) {
        case "Ha Noi":
            $path = "hanoiblog.php";
            break;
        case "TP.HCM":
            $path = "sgblog.php";
            break;
        case "Da Nang":
            $path = "danangblog.php";
            break;
        case "Da Lat":
            $path = "dalatblog.php";
            break;
        case "Nha Trang":
            $path = "nhatrangblog.php";
            break;
        case "Phu Quoc":
            $path = "phuquocblog.php";
            break;
    }
    return $path;
}
?>
