<?php
include 'mycon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = mysqli_real_escape_string($conn, $_POST['userID']);

    // Check which button was pressed
    if (isset($_POST['btn_edit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
        $course = mysqli_real_escape_string($conn, $_POST['course']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        
        // Split name into first name and last name
        $nameParts = explode(' ', $name);
        $fname = $nameParts[0];
        $lname = isset($nameParts[1]) ? $nameParts[1] : '';

        // Update the user's data
        $query = "UPDATE users SET fname='$fname', lname='$lname', Occupation='$occupation', Course='$course', Department='$department', Gender='$gender' WHERE User_ID='$userID'";

        if (mysqli_query($conn, $query)) {
            print'<script>alert("User updated successfully!")</script>';
        } else {
            echo "Error updating user: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['btn_delete'])) {
        // Delete the user
        $query = "DELETE FROM users WHERE User_ID='$userID'";

        if (mysqli_query($conn, $query)) {
            print'<script>alert("User deleted successfully!")</script>';
        } else {
            echo "Error deleting user: " . mysqli_error($conn);
        }
    }
}

// Redirect back to the manage users page
print'<script>alert("Action successfull!")</script>';
header("Location: manageUsers.php");
exit();

// Close database connection
mysqli_close($conn);
?>
