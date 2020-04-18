<?php
include_once ("connect.php");
$Err = array();
if (isset($_POST["signup"])) {
    $countErr = 0;
    $connect = connectDatabase("localhost", "id13035598_root", "mgW(F3E%948=Kcvr", 3306);
    $dbname = "id13035598_manager";
    $connect->select_db($dbname);
    $phonenumber = $fullname = $username = $password = $re_password = "";
    if (empty($_POST["phonenumber"])){
        $Err["phoneNuErr"] = "Required";
        $countErr++;
    } else {
        $phonenumber = test_input($_POST["phonenumber"]);
    }
    if (empty($_POST["fullname"])) {
        $Err["nameErr"] = "Required";
        $countErr++;
    } else {
        $fullname = test_input($_POST["fullname"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$fullname)) {
            $Err["nameErr"] = "Error";
            $countErr++;
        }
    }
    if (empty($_POST["username"])) {
        $Err["username"] = "Required";
        $countErr++;
    } else {
        $username = test_input($_POST["username"]);
    }
    if (empty($_POST["password"])) {
        $Err["password"] = "Required";
        $countErr++;
    } else {
        $password = test_input($_POST["password"]);
    }
    if (empty($_POST["re-password"])) {
        $Err["re-password"] = "Required";
        $countErr++;
    } else {
        $re_password = test_input($_POST["re-password"]);
        if (equalPassword($password, $re_password) == false) {
            $Err["re-password"] = "Not same";
            $countErr++;
        }
    }
    if ($countErr == 0) {
        $sql = "SELECT *FROM users WHERE phoneNumber = '$phonenumber' OR username = '$username'";
        $result = $connect->query($sql);
        if ($result->num_rows > 0) {
            echo "Tài khoản này đã tồn tại. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
        }
        else {
            $query = "INSERT INTO users(username, password, fullName, phoneNumber) 
                    VALUES ('$username', '$password', '$fullname', '$phonenumber')";
            if ($connect->query($query) == true) {
                header("Location: main.php");
            }
            else {
                echo $connect->error; die('');
            }
        }
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
    <link rel="stylesheet" href="../css/signupStyle.css">
    <title>TripsVN-Đăng ký tài khoản</title>
</head>
<body style="background-size: cover; background-repeat: no-repeat; background-image: url('../image/background2.jpg');">
<div id="signup">
    <form id="signupForm" action="signup.php?do=signup" method="post">
        <div>TripsVN-Đăng ký tài khoản</div>
        <div id="phonenumber">
            <i class="fas fa-phone-alt"></i>
            <input type="text" class="form-control" name="phonenumber" placeholder="Phone Number...">
            <span class="error">
                <?php
                if (isset($Err["phoneNuErr"])) echo $Err["phoneNuErr"];
                ?>
            </span>
            <div class="required">*</div>
        </div>
        <div id="fullname">
            <i class="fas fa-address-card"></i>
            <input type="text" class="form-control" name="fullname" placeholder="Name...">
            <span class="error">
                <?php
                if (isset($Err["nameErr"])) echo $Err["nameErr"];
                ?>
            </span>
            <div class="required">*</div>
        </div>
        <div id="username">
            <i class="far fa-user-circle"></i>
            <input type="text" class="form-control" name="username" placeholder="Username...">
            <span class="error">
                <?php
                if (isset($Err["username"])) echo $Err["username"];
                ?>
            </span>
            <div class="required">*</div>
        </div>
        <div id="password">
            <i class="fas fa-key"></i>
            <input type="password" class="form-control" name="password" placeholder="Password...">
            <span class="error">
                <?php
                if (isset($Err["password"])) echo $Err["password"];
                ?>
            </span>
            <div class="required">*</div>
        </div>
        <div id="re-password">
            <input type="password" class="form-control" name="re-password" placeholder="Retype password...">
            <span class="error">
                <?php
                if (isset($Err["re-password"])) echo $Err["re-password"];
                ?>
            </span>
            <div class="required">*</div>
        </div>
        <div id="submit">
            <input type="submit" class="form-control" name="signup" value="Sign Up">
        </div>
    </form>
    <div id="login">
        <a href="login.php">
            <button type="button" class="btn btn-success">Login</button>
        </a>
    </div>
    <div style="color: #ff5835; margin-top: 10px; margin-left: 20px;">(*): Required field.</div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#signup").slideDown(500);
    });
</script>
</body>
</html>
