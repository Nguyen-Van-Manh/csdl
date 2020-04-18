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
    <link rel="stylesheet" href="../css/dalatStyle.css">
    <script type="text/javascript" src="../../../common/javascript/commonJs.js"></script>
    <link rel="stylesheet" href="../../../common/css/clockStyle.css">
    <link rel="icon" type="image/x-icon" href="../../../common/css/icon.png">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Liu+Jian+Mao+Cao&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Liu+Jian+Mao+Cao&display=swap" rel="stylesheet">
    <title>Thành phố Đà Lạt-Việt Nam</title>
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
            <form action="dalatblog.php" method="post">
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
<div class="container"id="dalatblog">
    <h5 style="font-style: italic;">Đà Lạt luôn hấp dẫn du khách trong và ngoài nước bởi vẻ đẹp lãng mạn ngập tràn
        hương sắc của hoa tươi. Bên cạnh đó, những cảnh đẹp ở Đà Lạt là nơi mà rất nhiều
        du khách trong cũng như ngoài nước mong muốn 1 lần được thưởng thức.
    </h5>
    <br/>
    <br/>
    <br/>
    <p>
        Tọa lạc ngay vị trí đắc địa trong trung tâm thành phố hồ Hồ Xuân Hương là một
        trong cảnh đẹp ở Đà Lạt không thể bỏ qua. Được ví như hơi thở của Đà Lạt, hồ
        có khung cảnh rất đẹp, lãng mạn, quanh hồ được bao bọc bởi rừng thông và vườn cỏ hoa lá.
    </p>
    <img src="../image/dalat1.jpg">
    <p>
        Hồ Xuân Hương là hồ nước nhân tạo rộng khoảng 25ha có hình trăng lưỡi liềm.
        Nhiều hoạt động vui chơi giải trí quanh hồ được yêu thích: đi xe ngựa ngắm cảnh,
        xe đạp đôi, đạp vịt, uống cà phê và ăn đồ ăn ngon ngay bên hồ.
    </p>
    <p>
        Khi nhắc đến cảnh đẹp ở Đà Lạt thì không thể không nhắc tới hồ Tuyền Lâm.
        Nằm cách trung tâm 5km về hướng Nam, hồ có nét đẹp yên bình, lung linh huyền
        ảo trong khung cảnh thần tiên, bao quanh là đồi thông xanh biếc.
    </p>
    <img src="../image/dalat2.jpg">
    <p>
        Hồ Tuyền Lâm sẽ phù hợp cho các hoạt động thể thao, câu cá, chèo thuyền ngắm
        cảnh giữa lòng hồ, cưỡi voi, cưỡi ngựa, đánh bóng truyền trên cát…
    </p>
    <p>
        Nếu có ai hỏi Đà Lạt có gì đẹp thì Vntrip.vn sẽ mạnh dạn trả lời đó là khung cảnh
        nên thơ, lãng mạn và khí hậu tuyệt vời. Nơi đây có nhiều điểm thăm quan thích hợp
        với nhiều đối tượng du khách trong và ngoài nước.
    </p>
    <img src="../image/dalat3.jpg">
    <p>
        Một trong các cảnh đẹp Đà Lạt phải kể đến là ga Đà Lạt cổ được xây đựng từ thời Pháp.
        Khoác trên mình nét kiến trúc độc đáo, ga Đà Lạt hiện lên nổi bật với 3 hình chóp của khu
        nhà ga. Hình ảnh đó tượng trưng cho 3 đỉnh núi cao nhất của Langbiang, cũng như kết hợp với
        văn đẹp văn hóa cổ truyền nhà rông Tây Nguyên.
        <br>
        Ga giờ chỉ còn phục vụ cho hoạt động du lịch từ thành phố lên đến Trại Mát. Suốt dọc đường
        đi du khách sẽ có cơ hội chiêm ngưỡng nét văn hóa đặc sắc cũng như ngắm nhìn khung cảnh thiên n
        hiên hùng vĩ.
    </p>
    <p>
        Núi Langbiang nằm trên địa bàn huyện Lạc Dương cách trung tâm thành phố 12km về phía Bắc.
        Đây chính là địa điểm du lịch thích hợp với du khách muốn tìm hiểu, khám phá về các nét văn
        hóa truyền thống của Tây Nguyên.
    </p>
    <img src="../image/dalat4.jpg">
    <p>
        Không những được chiêm ngưỡng 1 trong những cảnh đẹp ở Đà Lạt này, đến đây du khách sẽ được
        kể về câu chuyện tình yêu đẹp giữa chàng K’lang và nàng H’biang. Vì mẫu thuẫn giữa 2 bộ tộc
        nên hai người không được phép lấy nhau. Thế nhưng vì tình yêu, chàng K’lang và nàng H’biang đã bỏ trốn.
        Mặc dù vậy, họ vẫn không thoát được sự truy sát của bộ tộc. Cuối cùng 2 người đã chết. Nơi nàng H’biang
        chết hóa thành núi Mẹ và sữa từ ngực nàng chảy ra tuôn trào tạo thành dòng suối mát. Về sau hai ngọn núi
        đó được đặt tên là Langbiang.
    </p>
    <p>
        Làng cách trung tâm Đà Lạt hơn 20km nằm sâu trong rừng thông là địa điểm du lịch văn hóa mới của thành phố. 
        Con đường đến làng Cù Lần đẹp thơ mộng khi một bên là rừng thông một nên là dòng suối Vàng trong xanh.
    </p>
    <img src="../image/dalat5.jpg">
    <p>
        Du khách sẽ muốn đến làng Cù Lần vì vẻ đẹp thanh bình, mang đậm nét thôn quê dân dã. Tại đây có những ngôi
        nhà rông đẹp mắt và các bức tượng điêu khắc độc đáo làm nổi bật lên nét đẹp của văn hóa đời sống tinh thần
        người dân Tây Nguyên.
    </p>
    <p>
        Đồi Mộng Mơ là không gian thu nhỏ của cảnh đẹp ở Đà Lạt . Đây là sự khéo léo pha trộn giữa các công trình 
        kiến trúc lịch sử và tuyệt phẩm thiên nhiên.
    </p>
    <img src="../image/dalat6.jpg">
    <p>
        Đến đây du khách sẽ được chiêm ngưỡng ngôi nhà cổ và hình ảnh tái hiện của Vạn Lý Trường Thành. Đặc biệt,
        bạn sẽ có những ngày nghỉ dưỡng tuyệt vời tại những ngôi nhà chạy dọc sườn đồi, bao quanh là hàng thông xanh mướt.
        <br>
        Cùng với đó, du khách còn bị hớp hồn vào các điệu cồng chiêng, âm nhạc và các tiết mục văn nghệ đặc sắc tại các
        lễ hội của người dân tộc K’Ho.
    </p>
    <p>
        Đây là cảnh đẹp ở Đà Lạt và cũng là điểm du lịch hấp dẫn dành cho cặp đôi và gia đình. Tại thung lũng này, 
        bạn và người thân sẽ có không gian sưởi ấm, thắt chặt tình cảm, gửi gắm những ước nguyện thú vị trên những 
        cành đa. Thung lũng tình yêu được bao quanh bởi hồ Đa Thiện (ngay cạnh đồi Mộng Mơ). Tất cả vẽ nên bức tranh 
        sơn thủy hữu tình đẹp mắt.
    </p>
    <img src="../image/dalat7.jpg">
    <p>
        Đây một trong những địa điểm mà khách du lịch thường nhắc đến, phù hợp với những du khách muốn du lịch tâm linh.
        Chùa Linh Phước tọa lạc tại số 120 Tự Phước, thuộc địa bàn Trại Mát, cách trung tâm thành phố Đà Lạt 8 km,
        trên quốc lộ 20. Chùa còn được gọi là Chùa Ve Chai vì trong sân chùa có con rồng dài 49 m được làm bằng 12.000 vỏ chai bia.
        Chùa Linh Phước là một công trình kiến trúc khảm sành đặc sắc, là 1 trong những cảnh đẹp ở Đà Lạt không nên bỏ lỡ.
    </p>
    <img src="../image/dalat8.jpg">
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