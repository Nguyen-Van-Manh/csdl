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
        $path = "../../blogs/html/" . $path;
        header("Location: $path");
    }
}
$cart = $_SESSION["userID"];
if (isset($_POST["assign"])) {
    if (isset($_SESSION[$cart])) {
        $item_id = array_column($_SESSION[$cart], "hotelID");
        $count = count($_SESSION[$cart]);
        $_SESSION[$cart][$count] = intval($_GET["hotelID"]);
    } else {
        $_SESSION[$cart][0] = $_GET["hotelID"];
    }
    $size = count($_SESSION[$cart]);
    $index = intval($_SESSION[$cart][$size-1]);
    $numberRoom = intval($_POST["numberRoom"]);
    $price = doubleval($_GET["price"]);
    $userID = intval($_SESSION["userID"]);
    $date1 = $_SESSION["hotel_date1"];
    $date2 = $_SESSION["hotel_date2"];
    $subtract = strtotime($date2) - strtotime($date1);
    $day = intval($subtract/86400);
    $total = doubleval($price * $numberRoom * $day);
    $query = "INSERT INTO datphong(hotelID, soPhong, ngayNhan, ngayTra, total, status, userID) VALUES('$index', '$numberRoom', '$date1', '$date2', '$total', 'NO', '$userID')";
    if ($connect->query($query) == true) {
        echo '<script>window.alert("Thêm phòng thành công! Chờ xác nhận của đơn vị khách sạn")</script>';
        $_SESSION["total"] = $total;
    } else {
        exit();
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
    <script type="text/javascript" src="../../../common/javascript/commonJs.js"></script>
    <link rel="stylesheet" href="../../../common/css/clockStyle.css">
    <link rel="stylesheet" href="../css/hotelStyle.css">
    <script type="text/javascript" src="../javascript/hotelJs.js"></script>
    <link rel="icon" type="image/x-icon" href="../../../common/css/icon.png">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Liu+Jian+Mao+Cao&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Liu+Jian+Mao+Cao&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/abc.css">
    <title>Đặt phòng khách sạn giá rẻ nhất, chất lượng tốt nhất-TripsVN</title>
</head>
<body onload="time()">
<header class="fixed-top" style="z-index: 2;">
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
            <form action="test.php?category=blogs" method="post">
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
                    <a class="nav-link" href="hotel.php" style="color: black; margin-left: 50px;">
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
<?php
if (isset($_SESSION["hotel_name"])) {
    $place = $_SESSION["hotel_name"];
    $sql = "SELECT *FROM timkhachsan WHERE place = '$place'";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        $i = 0;
        $top = 200;
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="container result" >
                <p>
                    <span><?php echo $row["hotelName"]; ?></span>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <button type="button" class="btn btn-success evaluation">
                        <?php echo $row["evaluation"];?>
                    </button>
                    <br/>
                    <i class="fas fa-map-marker-alt address">
                        <?php echo $row["address"]; ?>
                    </i><br>
                    <button class="btn btn-danger price">
                        <?php echo (doubleval($row["price"]) + 20) . "$ / day";?>
                    </button>
                    <br>
                    <i class="fas fa-hand-point-down handDown"></i> <br/>
                    <button class="btn btn-success sale-price">
                        <?php echo $row["price"] . "$ / day";?>
                    </button>
                </p>
                <form action="test.php?hotelID= <?php echo $row["hotelID"];?>&price=<?php echo $row["price"];?>" method="post" style="position: absolute; left: 900px; margin-top: 100px;">
                    <input type="number"  min="1" name="numberRoom" class="form-control numberroom" placeholder="Số lượng...">
                    <br/>
                    <input type="submit" value="Đặt phòng" name="assign" class="form-control assign">
                </form>
                <img src="<?php echo $row["image"];?>" class="img-fluid image" >
            </div>
            <?php
        $i++;}
    }
}
?>
<div class="container">
    <div style="height: 2px; background-color: rgba(64,58,28,0.22);"></div>
</div>
<div class="container" style="margin-top: 50px; margin-left: 430px; margin-bottom: 50px;">
    <b style=" font-size: 20px; opacity: 1.0; text-transform: uppercase; ">
        Tại sao nên đặt combo tiết kiệm với TripsVN?
    </b>
</div>
<div class="container" style="padding-bottom: 200px; margin-left: 100px;">
    <p style="float: left; font-size: 17px; margin-left: 150px;">
        <img src="../image/img1.png">
    <p style="position: relative;margin-left: 450px;">
        <b style="font-size: 20px; margin-left: 20px;">
            Giá rẻ mỗi ngày với ưu đãi đặc biệt dành <br>
            riêng cho ứng dụng
        </b> <br/><br/>
        Đặt phòng qua ứng dụng để nhận giá tốt nhất với các khuyến mãi tuyệt vời!<br/>
    </p>
    </p>
    <br><br><br><br>
    <p style="float: right; font-size: 17px; margin-left: 100px;">
        <img src="../image/img2.png">
    <p style="position: relative;margin-left: 270px;">
        <b style="font-size: 20px; margin-left: 20px;">Phương thức thanh toán an toàn và linh hoạt</b><br/>
        Giao dịch trực tuyến an toàn với nhiều lựa chọn như thanh toán tại cửan<br>
        hàng tiện lợi, chuyển khoản ngân hàng, thẻ tín dụng đến Internet<br>
        Banking. Không tính phí giao dịch.<br>
    </p>
    </p>
    <br><br><br><br>
    <p style="float: left; font-size: 17px; margin-left: 150px;">
        <img src="../image/img3.png">
    <p style="position: relative;margin-left: 450px;">
        <b style="font-size: 20px; margin-left: 20px;">Hỗ trợ khách hàng 24/7</b><br/>
        Đội ngũ nhân viên hỗ trợ khách hàng luôn sẵn sàng giúp đỡ bạn trongn <br>
        từng bước của quá trình đặt vé <br>
    </p>
    </p><br><br><br><br>
    <p style="float: right; font-size: 17px; margin-left: 100px;">
        <img src="../image/img4.png">
    <p style="position: relative;margin-left: 270px;">
        <b style="font-size: 20px; margin-left: 20px;">Phương thức thanh toán an toàn và linh hoạt</b><br/>
        Hơn 10.000.000 đánh giá, bình chọn đã được xác thực từ du khách sẽ<br>
        giúp bạn đưa ra lựa chọn đúng đắn.<br>
    </p>
    </p>
</div>
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
                <a class="navbar-brand link-item" href="abc.php">
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
                <a class="navbar-brand link-item" href="ticket.html">
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
                        <a href="hotel.php" class="contact service">Khách sạn</a>
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