<?php
function isUserExists($email, $mobileNumber)
{
    include 'database_connection.php';
//    $sql = "SELECT * FROM users WHERE mobile_number='$mobileNumber'";
    $sql = "SELECT * FROM users WHERE email='$email' OR mobile_number='$mobileNumber'";
//    echo $sql;
    echo '<script>alert($sql)</script>';
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function isValidLogin($mobileNumber, $password) {
    include "database_connection.php";
    $sql = "SELECT * FROM users WHERE mobile_number='$mobileNumber' AND password='$password'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    if (mysqli_num_rows($result) > 0) {
//        $userData = array();
//        while ($row = mysqli_fetch_assoc($result)) {
//            $userData[] = $row;
//        }
        return true;
    }
    else {
        return false;
    }
}

function isAuthorizedUser($userType){
    if (!isset($_SESSION['userInfo'])) {
//        header("Location: login.php");
        return false;
    }
    elseif (isset($_SESSION['userInfo']) && $_SESSION['userInfo']['user_type'] != $userType){
//        echo "Not authorized to view this page<br>";
//        echo '<a href="login.php">Login</a>';
        return false;
    }
    else {
        return true;
    }
}

?>
