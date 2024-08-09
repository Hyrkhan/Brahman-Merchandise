<?php
session_start();

include 'mycon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = mysqli_real_escape_string($conn, $_POST['User_ID']);
    $pass = mysqli_real_escape_string($conn, $_POST['Password']);


    if ($userID == "123123") {

        if ($pass == "admin") {

            $_SESSION['loggedin'] = true;
            $_SESSION['userID'] = $userID;
            $_SESSION['fullname'] = "Admin 123";
            $_SESSION['occup'] = "Admin";

            echo '<script>alert("Successfully Logged In!");</script>';
            echo '<script>window.location.assign("adminPage/adminIndex.php");</script>';
        } else {
            echo '<script>alert("Invalid Password!");</script>';
            echo '<script>window.location.assign("adminlogin.html");</script>';
        }
    } else {
        // Invalid userID
        echo '<script>alert("Not an Admin ID number");</script>';
        echo '<script>window.location.assign("adminlogin.html");</script>';
    }
}

mysqli_close($conn);
?>
