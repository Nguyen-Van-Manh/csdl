<?php
include_once ("../../../firstPage/html/connect.php");
include_once ("../../../blog.php");
$connect = connectDatabase("localhost", "id13035598_root", "mgW(F3E%948=Kcvr", 3306);
$dbname = "id13035598_manager";
$connect->select_db($dbname);
if (isset($_SESSION['timeout']) == false || setTimeOut($_SESSION['timeout']) == true) {
    header("Location: ../../../firstPage/html/login.php");
}
if (isset($_POST["searchbar"])) {
    if (empty($_POST["searchcity"])) {
        echo "<script>window.alert('Nhập tên thành phố.')</script>";
    }

    else {
        $cityName = $_POST["searchcity"];
        $path = category($cityName);
        header("Location: $path");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../common/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="../../../common/css/commonStyle.css">
    <link rel="stylesheet" href="../css/phuquocStyle.css">
    <script type="text/javascript" src="../../../common/javascript/commonJs.js"></script>
    <link rel="stylesheet" href="../../../common/css/clockStyle.css">
    <link rel="icon" type="image/x-icon" href="../../../common/css/icon.png">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Liu+Jian+Mao+Cao&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Liu+Jian+Mao+Cao&display=swap" rel="stylesheet">
    <title>Đảo Ngọc Phú Quốc</title>
</head>
<body>
<header class="fixed-top" style="z-index: 2; position: absolute;">
    <div class="container-fluid" id="note" >
        <i class="fas fa-bell fa" style=" font-size: 20px;"></i>
        <b style="font-size: 16px; opacity: 0.5; font-family: 'Comic Sans MS';">
            Thông tin cần biết về tình trạng và chính sách áp dụng cho các chuyến bay trong đợt dịch bệnh Corona.
            <a href="https://ncov.moh.gov.vn/" target="_blank">Xem toàn bộ thông tin cập nhật.</a>
        </b>
    </div>
    <div id="border"></div>
    <div class="container-fluid" style="padding-top: 15px; background-color: white;">
        <button type="button" class="btn btn-light" id="justify" style="margin-left: 100px;">
            <i class="fas fa-bars fa" style="color: #0770cd; font-size: 22px;"></i>
        </button>
        <a href="../../../firstPage/html/main.php" id="link_home" style="padding-right: 40px;">
            <b style="font-size: 21px; margin-left: 0px; font-family: 'Comic Sans MS';">
                TripsVN
            </b>
        </a>
        <div style="display: inline-block;">
            <form action="phuquocblog.php" method="post">
                <input  type="text" name="searchcity" id="city" placeholder="Search...">
                <button type="submit" id="searchbar" class="btn" name="searchbar">
                    <i class="fas fa-search-location"></i>
                </button>
            </form>
        </div>
        <div id="personal" style="display: inline-block;">
            <a class="choice" href="../../ticket/html/abc.php" style="position: absolute; left: 950px;">
                <button class="btn btn-info" type="button">
                    <i class="fas fa-cart-plus" style="color: white;"></i>
                    <span class="badge badge-danger">
                        <?php
                        $userID = intval($_SESSION["userID"]);
                        $sql1 = "SELECT COUNT(userID) as count1 from datve WHERE userID = '$userID'";
                        $sql1Result = $connect->query($sql1);
                        $row1 = $sql1Result->fetch_array(MYSQLI_ASSOC);
                        $count1 = intval($row1["count1"]);
                        $sql2 = "SELECT COUNT(userID) as count2 from datphong WHERE userID = '$userID'";
                        $sql2Result = $connect->query($sql2);
                        $row2 = $sql2Result->fetch_array(MYSQLI_ASSOC);
                        $count2 = intval($row2["count2"]);
                        echo $count1+$count2;
                        ?>
                    </span>
                </button>
            </a>
            <div style="display: inline; margin-left: 800px;">
                <button type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="login">
                    <i class="far fa-user-circle">
                        Profile<span class="badge" style="background-color: #34ce57;">!</span>
                    </i>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand bg-light sticky-top" style="padding-left: 100px;">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto" style="font-size: 15px; margin-left: 305px; z-index: 2">
                <li class="nav-item">
                    <a class="nav-link" href="../../ticket/html/ticket.php" style="color: black;">
                        <i class="fas fa-plane-departure" style="color: #30c5f7;"></i>
                        <b>Vé máy bay</b>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../hotel/html/hotel.php" style="color: black; margin-left: 50px;">
                        <i class="fas fa-building" style="color: #235d9f;"></i>
                        <b>Khách sạn</b>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../ticket/html/abc.php" style="color: black; margin-left: 50px;">
                        <i class="fas fa-clipboard-list" style="color: #37c337;"></i>
                        <b>Đặt chỗ của tôi</b>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../firstPage/html/main.php" style="color: black; margin-left: 50px;">
                        <i class="fas fa-percent" style="color: #ff6001;"></i>
                        <b>Khuyến mại</b>
                    </a>
                </li>
                <li style="margin-left: 400px;">
                    <button type="button" class="btn btn-danger" disabled="disabled">
                        <i class="fas fa-star" style="color: yellow;"></i>
                    </button>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div id="fix"></div>
<div class="container-fluid" style="position:fixed;top: 0;z-index: 10;">
    <div class="row">
        <div class="col col-sm-3" id="menu">
            <nav class="navbar bg-light menu-item">
                <a class="navbar-brand link-item" href="../../../firstPage/html/main.php">
                    <i class="fas fa-home"></i>
                    Trang chủ
                </a>
            </nav>
            <nav class="navbar bg-light menu-item">
                <a class="navbar-brand link-item" href="../../ticket/html/abc.php">
                    <i class="fas fa-clipboard-list" style="color: #37c337;"></i>
                    Đặt chỗ của tôi
                </a>
            </nav>
            <nav class="navbar bg-light menu-item">
                <a class="navbar-brand link-item" href="https://www.facebook.com/vannguyen.manh.566">
                    <i class="fas fa-phone"></i>
                    Liên hệ với chúng tôi
                </a>
            </nav>
            <nav class="navbar bg-light menu-item">
                <a class="navbar-brand link-item" href="https://www.facebook.com/vannguyen.manh.566">
                    <i class="material-icons">help_outline</i>
                    Trợ giúp
                </a>
            </nav>
            <nav class="navbar bg-light menu-item">
                <a class="navbar-brand link-item" href="../../../firstPage/html/main.php">
                    <i class="fas fa-percent" style="color: #ff6001;"></i>
                    Khuyến mại
                </a>
            </nav>
            <nav class="navbar bg-light menu-item">
                <a class="navbar-brand link-item" href="../../ticket/html/ticket.php">
                    <i class="fas fa-plane-departure" style="color: #30c5f7;"></i>
                    Vé máy bay
                </a>
            </nav>
            <nav class="navbar bg-light menu-item">
                <a class="navbar-brand link-item" href="../../hotel/html/hotel.php">
                    <i class="fas fa-building" style="color: #235d9f;"></i>
                    Khách sạn
                </a>
            </nav>
        </div>
        <div class="col col-sm-9" id="disable_bg">
            <button type="button" class="btn btn-danger" style="color: white;">X</button>
        </div>
    </div>
</div>
<div id="user">
    <div>
        Thông tin khách hàng
        <i class="fas fa-user-edit"></i>
    </div>
    <div id="fullname">
        <?php
        echo "Name: " . $_SESSION["fullName"];
        ?>
    </div>
    <div id="username">
        <?php
        echo "Username: " . $_SESSION["username"];
        ?>
    </div>
    <div id="usercontact">
        <?php
        echo "Contact: " . $_SESSION["phoneNumber"];
        ?>
    </div>
    <div id="changePass"><a href="../../../firstPage/html/changepass.php">Đổi mật khẩu?</a></div>
    <div id="logout">
        <a href="../../../firstPage/html/logout.php">
            <button class="btn btn-danger" title="Đăng xuất">
                <i class="fas fa-power-off"></i>
            </button>
        </a>
    </div>
</div>
<div class="container" id="phuquocblog">
    <h5>SAY ĐẮM VẺ ĐẸP HOANG SƠ CỦA ĐẢO NGỌC PHÚ QUỐC</h5>
    <p>
        Không phải không có lý do mà Phú Quốc được ưu ái gọi tên là Đảo ngọc.
        Hòn đảo xinh đẹp nằm trong vịnh Thái Lan, thuộc tỉnh Kiên Giang này hiện
        là hòn đảo du lịch lớn nhất Việt Nam. Đảo ngọc Phú Quốc tiềm ẩn một sức hấp dẫn
        kì lạ, một thiên đường rực nắng giữa những hàng cây nhiệt đới xanh mát. Nếu bạn cũng
        yêu vùng “biển vắng”, muốn hòa mình vào làn nước trong lành và thiên nhiên hoang sơ thì
        Phú Quốc chính là lựa chọn tuyệt vời cho bạn trong hè này
    </p>
    <img src="../image/phuquoc1.jpg" style="width: 600px;">
    <p>
        Đảo ngọc Phú Quốc được đánh giá là hòn đảo thu hút đông khách du lịch nhất Việt Nam,
        với hàng triệu lượt khách du lịch mỗi năm, có không ít du khách trở lại đây hơn hai lần
        vì lỡ “phải lòng” hòn đảo thiên đường này. Sau những ngày học tập và làm việc căng thẳng,
        một chuyến du lịch Phú Quốc ngắn ngày chính là lúc bạn lấy lại tinh thần, giải tỏa mệt mỏi.
        Phú Quốc cũng là địa điểm lý tưởng dành cho các cặp đôi trong tuần trăng mật và nhiều gia đình
        lựa chọn nơi đây cho chuyến đi nghỉ dưỡng của họ.
    </p>
    <img src="../image/phuquoc2.jpg" style="width: 600px;">
    <p>
        Phú Quốc được thiên nhiên ưu ái ban tặng cảnh sắc hài hòa, khí hậu dễ chịu quanh năm.
        Bãi cát màu kem mịn trải dài, nước biển trong xanh, êm ả, những hàng dừa cao vút,… là những
        “đặc sản” đẹp khó cưỡng nơi đây. Không chỉ có thiên nhiên hoang sơ, kì bí, cuộc sống tươi vui
        nơi làng chài của những người dân biển bình dị cũng đem đến cho khách du lịch những trải nghiệm thú vị.
    </p>
    <p>
        Phú Quốc có nhiều bãi biển đẹp trải dài từ phía Bắc đến Nam, có 99 ngọn núi đồi và dãy rừng nguyên
        sinh với hệ động thực vật phong phú. Ở phía Bắc có hòn Móng Tay, hòn Đồi Mồi, hòn Bần, hòn Thầy Bói…
        ở phía Nam có 12 hòn đảo thuộc quần đảo An Thới….. Điều đặc biệt là thiên nhiên nơi đây vẫn giữ được
        vẻ hoang sơ, hung vĩ vốn có, không bị khai thác phục vụ du lịch quá nhiều, ảnh hưởng đến cảnh quan,
        rất phù hợp với các hoạt động ngoài trời như du thuyền, câu cá, lặn ngắm san hô, khám phá thiên nhiên
        hoang dã, dã ngoại…..
    </p>
    <img src="../image/phuquoc3.jpg">
    <p>
        Nếu đến với làng Ngọc Trai Phú Quốc, bạn sẽ say mê với quy trình nuôi cấy ngọc trai cao cấp,
        thậm chí còn được tận tay trải nghiệm những công đoạn kỳ công hay chiêm ngưỡng những viên ngọc
        trai thiên nhiên tuyệt đẹp.
        Dừng chân tại cảng cá An Thới, tận hưởng mùa hè rực nắng dưới hàng cây nhiệt đới xanh mát
        hay du ngoạn trên một chuyến tàu chạy qua những vùng vịnh đẹp, thỏa thích nhìn ngắm thiên nhiên
        và sự nhộn nhịp của các làng chài, thậm chí bạn có thể len tàu đánh bắt hay chèo thuyền thúng như
        một dân chài “đích thực”.
    </p>
    <img src="../image/phuquoc4.jpg" style="width: 600px;">
    <p>
        Những năm trở lại đây, ngành du lịch Phú Quốc phát triển khá mạnh, có rất nhiều hoạt động vui chơi,
        giải trí phục vụ khách du lịch. Dù bạn đến Đảo ngọc để nghỉ dưỡng hay thỏa chí thám hiểm đảo xanh,
        Phú Quốc cũng không khiến bạn thất vọng.
    </p>
    <p>
        Ngoài ra, thiên nhiên còn dành tặng cho Phú Quốc rất nhiều loại hải sản hảo hạng, tươi ngon nổi tiếng,
        sẽ làm hài lòng cả những thực khách khó tính nhất. Nếu có dịp ghé thăm, nhất định phải thử những món đặc
        sản biển cả như hải sâm, nấm tram, ghẹ Hàm Ninh, gỏi cá trích……… Tại đây có rất nhiều nhà hàng phục vụ
        hải sản đã chế biến và chưa chế biến với giá tốt. Bạn cũng có thể tự mua tại khu cảng cá hay khu chợ địa
        phương để tự chế biến hoặc làm quà cho người thân.
    </p>
    <img src="../image/phuquoc5.jpg">
    <p>
        Còn gì tuyệt vời hơn một mùa hè rực nắng với những trải nghiệm khó quên tại thiên đường biển đảo Phú Quốc?
        Được hòa vào thiên nhiên nên thơ, nhịp sống tươi vui, thanh bình, bên cạnh những người vùng biển đáng mến,
        hồn hậu và thưởng thức nhiều món hải  sản “thứ thiệt” chính là những gì đảo ngọc Phú Quốc dành tặng bạn.
    </p>
    <p style="font-style: italic;">
        Nguồn: Internet.
    </p>
</div>
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-3">
                <b>TripsVN</b>
                <br /><br />
                <p>
                    Ứng dụng đặt phòng, tìm kiếm địa điểm du lịch chất lượng. <br/>
                    TripsVN liên kết với các đối tác uy tín, nhằm đem lại cho khách hàng
                    sự thoải mái khi sử dụng dịch vụ!
                </p>
                <i class="fas fa-phone">
                    039 856 6421
                </i>
                <br/>
                <i class="fas fa-mail-bulk">
                    manh117bg@gmail.com
                </i>
                <br><br/>
                <a href="https://www.facebook.com/vannguyen.manh.566">
                    <i class="fa fa-facebook-official contact"></i>
                </a>
                <a href="#">
                    <i class="fab fa-instagram contact"></i>
                </a>
                <a href="#">
                    <i class="fab fa-twitter-square contact"></i>
                </a>
                <a href="#">
                    <i class="fab fa-youtube contact"></i>
                </a>
            </div>
            <div class="col col-md-3">
                <b>TripsVn-Services</b>
                <ul>
                    <li>
                        <a href="../../ticket/html/ticket.php" class="contact service">Vé máy bay</a>
                    </li>
                    <li>
                        <a href="../../hotel/html/hotel.php" class="contact service">Khách sạn</a>
                    </li>
                    <li>
                        <a href="../../ticket/html/abc.php" class="contact service">Đã đặt</a>
                    </li>
                    <li>
                        <a href="../../../firstPage/html/main.php" class="contact service">Khuyến mại</a>
                    </li>
                    <li>
                        <a href="../../../firstPage/html/main.php" class="contact service">Tìm kiếm địa điểm thú vị</a>
                    </li>
                </ul>
            </div>
            <div class="col col-md-3">
                <b>Send report to us by</b>
                <br>
                <i class="fas fa-mail-bulk">
                    sample@gmail.com
                </i>
                <br>
                <div style="width: 200px; height: 200px;">
                </div>
            </div>
        </div>
    </div>
    <div class="bg-dark" style="color: white;">Copyright © 2020 TripsVN</div>
</footer>
</body>
</html>