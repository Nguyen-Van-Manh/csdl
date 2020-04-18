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
$userID = intval($_SESSION["userID"]);
$total = 0;
$total2 = 0;
?>
<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" href="../css/ticketStyle.css">
    <link rel="icon" type="image/x-icon" href="../../../common/css/icon.png">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Liu+Jian+Mao+Cao&display=swap" rel="stylesheet">
    <title>Chuyến bay và khách sạn đã đặt</title>
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
            <form action="abc.php" method="post">
                <input  type="text" name="searchcity" id="city" placeholder="Search...">
                <button type="submit" id="searchbar" class="btn" name="searchbar">
                    <i class="fas fa-search-location"></i>
                </button>
            </form>
        </div>
        <div id="personal" style="display: inline-block;">
            <a class="choice" href="abc.php" style="position: absolute; left: 950px;">
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
                    <a class="nav-link" href="ticket.php" style="color: black;">
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
                    <a class="nav-link" href="abc.php" style="color: black; margin-left: 50px;">
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
<div class="table-responsive container" style="position: relative; margin-top: 300px;">
    <table class="table table-bordered table-striped">
        <tr style="text-align: center;">
            <th>Hãng bay</th>
            <th>Mã chuyến bay</th>
            <th>Điểm khởi hành</th>
            <th>Điểm đến</th>
            <th>Ngày bay</th>
            <th>Giờ bay</th>
            <th>Loại vé</th>
            <th>Số lượng</th>
            <th>Số tiền</th>
            <th>Status</th>
            <th>Tên Khách hàng</th>
        </tr>
        <?php
        //GET PLANE TICKET INFORMATION
        $planeIdQuery = "SELECT *FROM datve WHERE userID = '$userID'";
        $resultsPlaneID = mysqli_query($connect, $planeIdQuery);
        if (mysqli_num_rows($resultsPlaneID) > 0) {
            while ($row = mysqli_fetch_array($resultsPlaneID)) {
                $planeID = intval($row["idChuyenBay"]);
                //GET PLANE INFO
                $planeInfoQuery = "SELECT *FROM chuyenbay INNER JOIN timchuyenbay ON timchuyenbay.idLoTrinh = chuyenbay.idLoTrinh WHERE idChuyenBay =  '$planeID'";
                $planeInfo = mysqli_query($connect, $planeInfoQuery);
                if (mysqli_num_rows($planeInfo) > 0) {
                    while ($row2 = mysqli_fetch_array($planeInfo)) {
                        ?>
                        <tr>
                            <td><?php echo $row2["hangBay"]; ?></td>
                            <td><?php echo $row2["tenChuyenBay"]; ?></td>
                            <td><?php echo $row2["diemDi"];?></td>
                            <td><?php echo $row2["diemDen"];?></td>
                            <td><?php $date =  date("d-m-Y", strtotime($row2["ngayBay"])); echo $date;?></td>
                            <td><?php echo $row2["gioBay"]; ?></td>
                            <td><?php
                                switch (intval($row2["ticketID"])) {
                                    case 1:
                                        echo "Phổ thông";
                                        break;
                                    case 2:
                                        echo "Phổ thông đặc biệt";
                                        break;
                                    case 3:
                                        echo "Thương gia";
                                        break;
                                    case 4:
                                        echo "Hạng nhất";
                                        break;
                                    default:
                                        echo "Error";
                                }
                                ?>
                            </td>
                            <td><?php echo $row["quantity"];?></td>
                            <td><?php echo "$" . doubleval($row2["giaVe"]) * intval($row["quantity"]); $total += doubleval($row2["giaVe"])*(intval($row["quantity"]));?></td>
                            <td>Chưa thanh toán</td>
                            <td><?php echo $_SESSION["fullName"];?></td>
                        </tr>
        <?php
                    }

                }
            }
        }
        ?>
        <tr>
            <td colspan="8">TOTAL</td>
            <td colspan="3" style="text-align: left;"><?php echo "=$ " . number_format($total, 2); ?></td>
        </tr>
    </table>
</div><br/>
<div class="table-responsive container">
    <table class="table table-bordered table-striped">
        <tr style="text-align: center;">
            <th>Tên khách sạn</th>
            <th>Địa chỉ</th>
            <th>Số phòng đặt</th>
            <th>Ngày nhận phòng</th>
            <th>Ngày trả phòng</th>
            <th>Số tiền</th>
            <th>Status</th>
            <th>Tên khách hàng</th>
        </tr>
        <?php
        $infoOrderedQuery = "SELECT *FROM datphong WHERE userID = '$userID'";
        $resultOrdered = mysqli_query($connect, $infoOrderedQuery);
        if (mysqli_num_rows($resultOrdered) > 0) {
            while ($row3 = mysqli_fetch_array($resultOrdered)) {
                $hotelID = intval($row3["hotelID"]);
                $infoHotelQuery = "SELECT *FROM timkhachsan WHERE hotelID = '$hotelID'";
                $resultInfoHotel = mysqli_query($connect, $infoHotelQuery);
                if (mysqli_num_rows($resultInfoHotel) > 0) {
                    while ($row4 = mysqli_fetch_array($resultInfoHotel)) {
                        ?>
                        <tr>
                            <td><?php echo $row4["hotelName"];?></td>
                            <td><?php echo $row4["address"];?></td>
                            <td><?php echo $row3["soPhong"];?></td>
                            <td><?php echo date("d-m-Y", strtotime($row3["ngayNhan"]));?></td>
                            <td><?php echo date("d-m-Y", strtotime($row3["ngayTra"]));?></td>
                            <td><?php echo "$ " . doubleval($row3["total"]); $total2 += doubleval($row3["total"]);?></td>
                            <td>Chưa thanh toán</td>
                            <td><?php echo $_SESSION["fullName"];?></td>
                        </tr>
        <?php
                    }
                }
            }
        }
        ?>
        <tr>
            <td colspan="6">TOTAL</td>
            <td colspan="2" style="text-align: left;"><?php echo "=$ " . number_format($total2, 2); ?></td>
        </tr>
    </table>
</div>
<div class="container">
    <div style="height: 2px; background-color: rgba(64,58,28,0.22);"></div>
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
                <a class="navbar-brand link-item" href="ticket.php">
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
                        <a href="ticket.php" class="contact service">Vé máy bay</a>
                    </li>
                    <li>
                        <a href="../../hotel/html/hotel.php" class="contact service">Khách sạn</a>
                    </li>
                    <li>
                        <a href="abc.php" class="contact service">Đã đặt</a>
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
