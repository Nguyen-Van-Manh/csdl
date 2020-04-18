<?php session_start();
function connectDatabase($servername, $username, $password, $port) {
   $connect = new mysqli($servername, $username, $password, "", $port);
    if ($connect ->connect_error) {
        die('Connection failed.');
    }
    else {
        return $connect;
    }
}
function setTimeOut($start) {
    $duration = 86400;
    $current_time = time();
    if ($duration < $current_time - $start) return true;
    return false;
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function equalPassword($pass, $retype) {
    if ($pass != $retype) return false;
    return true;
}
?>
