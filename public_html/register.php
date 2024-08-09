<?php
    session_start();
    include 'mycon.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userID = mysqli_real_escape_string($conn, $_POST['User_ID']);
        $pass = mysqli_real_escape_string($conn, $_POST['Password']);
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $occup = mysqli_real_escape_string($conn, $_POST['Occupation']);
        $course = mysqli_real_escape_string($conn, $_POST['Course']);
        $dept = mysqli_real_escape_string($conn, $_POST['Department']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $Cpass = mysqli_real_escape_string($conn, $_POST['CPassword']);


        if ($pass == $Cpass)
        {
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (User_ID, fname, lname, Occupation, Course, Department, Gender, Password)
                        VALUES ($userID, '$fname', '$lname', '$occup', '$course', '$dept', '$gender','$hashed_password')";
            $result = mysqli_query($conn, $query);

    
            print'<script>alert("User Successfully Registered!")</script>';
            print'<script>window.location.assign("login.html")</script>';
        }
        else {
            print'<script>alert("Password dont match!")</script>';
            print'<script>window.location.assign("register.html")</script>';
        }

        
    }
    else
    {
        echo 'User not Added'.$ex -> getMessage();
    }

    mysqli_close($conn);
?>
