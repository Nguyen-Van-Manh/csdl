<?php
include_once ("connect.php");
$connect = connectDatabase("localhost", "id13035598_root", "mgW(F3E%948=Kcvr", 3306);
$dbname = "id13035598_manager";
$connect->select_db($dbname);
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $phonenumber = $_POST["phonenumber"];
    $newpassword = $_POST["newpassword"];
    $re_password = $_POST["re-password"];
    $error =array();
    $countErr = false;
    $getInfoQuery = "SELECT *FROM users WHERE username = '$username' AND phoneNumber = '$phonenumber'";
    $result =mysqli_query($connect, $getInfoQuery);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            if ($row["username"] != $username) {
                $error["usernameErr"] = "* Username is wrong!";
                $countErr = true;
                break;
            }
            if ($row["phoneNumber"] != $phonenumber) {
                $error["phoneNumberErr"] = "* Phone Number wrong";
                $countErr = true;
                break;
            }
        }
        if (empty($newpassword)) {
            $error["passwordErr"] = "* Empty, please enter your password.";
            $countErr = true;
        }
        if (empty($re_password)) {
            $error["retype"] = "* Please retype your password.";
            $countErr = true;
        }
        if ($countErr == false) {
            if ($newpassword != $re_password) {
                $countErr = true;
                $error["retype"] ="* Password does not match";
            }
        }
        if ($countErr == false) {
            $insertQuery = "UPDATE users SET password = '$newpassword' WHERE username = '$username'";
            if ($connect->query($insertQuery) == true) {
                header("Location: login.php");
            }
        }
    }
    else {
        echo "<script>alert('This account already not exists.')</script>";
    }
}
$connect->close();
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
    <link rel="stylesheet" href="../css/forgetStyle.css">
    <script src="../javascript/forget.js"></script>
    <title>Quên mật khẩu?</title>
</head>
<body style="background-image: url('../image/background2.jpg'); background-size: cover;">
<div id="setpassword">
    <form id="resetForm"  method="post">
        <div>Lấy lại mật khẩu</div>
        <div id="username">
            <i class="far fa-user-circle"></i>
            <input type="text" class="form-control" name="username" placeholder="Username...">
            <span class="error">
                <?php
                if (isset($error["usernameErr"])) echo $error["usernameErr"];
                ?>
            </span>
        </div>
        <div id="phonenumber">
            <i class="fas fa-phone"></i>
            <input type="number" class="form-control" name="phonenumber" placeholder="Phone number...">
            <span class="error">
                <?php
                if (isset($error["phoneNumberErr"])) echo $error["phoneNumberErr"];
                ?>
            </span>
        </div>
        <div id="newpassword">
            <i class="fas fa-key"></i>
            <input type="password" class="form-control" name="newpassword" placeholder="New password...">
            <span class="error">
                <?php
                if (isset($error["passwordErr"])) echo $error["passwordErr"];
                ?>
            </span>
        </div>
        <div id="re-password">
            <i class="fas fa-key"></i>
            <input type="password" class="form-control" name="re-password" placeholder="Retype new password...">
            <span class="error">
                <?php
                if (isset($error["retype"])) echo $error["retype"];
                ?>
            </span>
        </div>
        <div id="submit">
            <input type="submit" class="form-control" name="submit" value="Set New Password">
        </div>
    </form>
</div>
<div id="login">
    <a href="login.php">
        <button type="button" class="btn">Log In</button>
    </a>
</div>
<div id="signup">
    <a href="signup.php">
        <button type="button" class="btn">Sign Up</button>
    </a>
</div>
<script type="text/javascript">
    // $(document).ready(function () {
    //     $("#login").css("background-color", "#ff5835");
    //     $("#setpassword").fadeIn(700);
    //     $("#signup").hover(function () {
    //         $(this).css("background-color", "#ff5835");
    //         $("#login").css("background-color", "transparent");
    //     },
    //     function () {
    //         $(this).css("background-color", "transparent");
    //         $("#login").css("background-color", "#ff5835");
    //     });
    //     document.getElementById("login").style.transition ="all .7s";
    //     document.getElementById("signup").style.transition ="all .7s";
    // });
</script>
</body>
</html>
