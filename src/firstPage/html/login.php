<?php
if (isset($_POST["submit"])) {
    include_once ("connect.php");
    $connect = connectDatabase("localhost", "id13035598_root", "mgW(F3E%948=Kcvr", 3306);
    $dbname = "id13035598_manager";
    $connect->select_db($dbname);
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (!$username || !$password) {
        echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    $sql = "SELECT *FROM users WHERE username = '$username'";
    $result = $connect->query($sql);
    if ($result->num_rows == 0) {
        echo "Tài khoản này không tồn tại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    else {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($row["username"] != $username) {
            echo "Tài khoản này không tồn tại. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
        }
        if ($row["password"] != $password) {
            echo "Mật khẩu không đúng. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
        }
        $_SESSION['timeout'] = time();
        $_SESSION["userID"] = $row["userID"]        ;
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        $_SESSION["fullName"] = $row["fullName"];
        $_SESSION["phoneNumber"] = $row["phoneNumber"];
        header("Location: main.php");
        die();
    }
    $connect->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../common/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <link rel="stylesheet" href="../css/loginStyle.css">
    <title>TripsVN-Đăng nhập</title>
</head>
<body style="background-image: url('../image/background1.jpg'); background-size: cover;">
<div id="login">
    <form id="loginForm" action="login.php?do=login" method="post">
        <div>TripsVN-Đăng nhập</div>
        <div id="username">
            <i class="far fa-user-circle"></i>
            <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập...">
        </div>
        <div id="password">
            <i class="fas fa-key"></i>
            <input type="password" class="form-control" name="password" placeholder="Mật khẩu...">
        </div>
        <div id="submit">
            <input type="submit" class="form-control" name="submit" value="Đăng nhập">
        </div>
        <div id="create">
            <a href="signup.php">
                <button type="button" class="btn btn-success">Sign Up</button>
            </a>
        </div>
    </form>
    <a href="forget.php" target="_blank">
        <i>Quên mật khẩu?</i>
    </a>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#login").slideDown(1000);
    });
</script>
</body>
</html>
