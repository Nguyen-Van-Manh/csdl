<?php
include_once ("connect.php");
$connect = connectDatabase("localhost", "id13035598_root", "mgW(F3E%948=Kcvr", 3306);
unset($_SESSION["username"]);
unset($_SESSION["timeout"]);
unset($_SESSION["password"]);
unset($_SESSION["fullName"]);
unset($_SESSION["phoneNumber"]);
session_destroy();
header("Location: login.php");
exit;
?>