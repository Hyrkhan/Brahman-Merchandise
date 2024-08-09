<?php
    session_start();
    include 'mycon.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cartID = mysqli_real_escape_string($conn, $_POST['cartID'] );


        $query = "DELETE FROM cart WHERE Cart_ID = '$cartID'";
        $result = mysqli_query($conn, $query);

 
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        } else {
            // Redirect back to the cart page after deletion
            header("Location: mycart.php");
            exit();
        }
    }
    else
    {
        echo 'Unsuccessful'.$ex -> getMessage();
    }

    mysqli_close($conn);
?>
