<?php
    session_start();
    include 'mycon.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $size = mysqli_real_escape_string($conn, $_POST['selectedSize']);
        $total = mysqli_real_escape_string($conn, $_POST['totalPrice']);
        $quantity = mysqli_real_escape_string($conn, $_POST['finalQuantity']);
        $itemID = mysqli_real_escape_string($conn, $_POST['itemID']);
        $userID = $_SESSION['userID'];

        /*
        echo "<script>";
        echo "var size = '" . $size . "';";
        echo "var total = '" . $total . "';";
        echo "var quantity = '" . $quantity . "';";
        echo "var itemID = '" . $itemID . "';";
        echo "var userID = '" . $userID . "';";
        echo "alert('Order Details:\\nSize: ' + size + '\\nTotal Price: ' + total + '\\nQuantity: ' + quantity + '\\nItem ID: ' + itemID + '\\nUser ID: ' + userID);";
        echo "</script>";
        */

        $query = "INSERT INTO cart (User_ID, Item_ID, size, Item_Quantity, total)
                    VALUES ($userID, $itemID, '$size', $quantity, $total)";
        $result = mysqli_query($conn, $query);

 
        print'<script>alert("Added to Cart Successfully!")</script>';
        print'<script>window.location.assign("mycart.php")</script>';
    }
    else
    {
        echo 'Unsuccessful'.$ex -> getMessage();
    }

    mysqli_close($conn);
?>
