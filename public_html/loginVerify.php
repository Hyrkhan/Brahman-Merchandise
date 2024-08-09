<?php
session_start();

include 'mycon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = mysqli_real_escape_string($conn, $_POST['User_ID']);
    $pass = mysqli_real_escape_string($conn, $_POST['Password']);

    $query = "SELECT * FROM users WHERE User_ID = '$userID'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($pass, $user['Password'])) {
            // Credentials are correct, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['userID'] = $user['User_ID'];
            $_SESSION['fullname'] = $user['fname'] . " " . $user['lname'];
            $_SESSION['occup'] = $user['Occupation'];
            $_SESSION['course'] = $user['Course'];
            $_SESSION['dept'] = $user['Department'];
            $_SESSION['gender'] = $user['Gender'];
            $_SESSION['fname'] = $user['fname'];

            echo '<script>alert("Successfully Logged In!");</script>';
            echo '<script>window.location.assign("userPage/index.php");</script>';
        } else {
            echo '<script>alert("Invalid Password!");</script>';
            echo '<script>window.location.assign("login.html");</script>';
        }
    } else {
        // Invalid userID
        echo '<script>alert("Invalid email! / User not registered!");</script>';
        echo '<script>window.location.assign("login.html");</script>';
    }
}

mysqli_close($conn);
?>
