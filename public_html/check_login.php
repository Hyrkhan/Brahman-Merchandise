<?php
    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        // Redirect to login page
        echo '<script>alert("Need to Log in to proceed.");</script>';
        echo '<script>window.location.assign("login.html");</script>';
        exit();
    }

    // Redirect to profile page if logged in
    header('Location: userPage/index.php');
    exit();
?>
