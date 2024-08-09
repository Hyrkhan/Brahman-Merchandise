<?php
session_start();
// Ensure session is started and any necessary includes are made (like database connection)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_SESSION['userID'];

    // Connect to database (assuming 'mycon.php' includes database connection)
    include 'mycon.php';

    // Fetch items from cart for the user
    $query = "SELECT * FROM cart WHERE User_ID = '$userID'
    ";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $allItemsInStock = true;
    $cartItems = [];

    // Process each item in the cart
    while ($cartItem = mysqli_fetch_assoc($result)) {
        $itemID = $cartItem['Item_ID'];
        $size = $cartItem['size'];
        $quantity = $cartItem['Item_Quantity'];
        
        // Fetch current stock for the item
        $stockQuery = "SELECT Stocks FROM sizes WHERE Item_ID = $itemID AND size = '$size'";
        $stockResult = mysqli_query($conn, $stockQuery);

        if ($stockResult && mysqli_num_rows($stockResult) > 0) {
            $stockData = mysqli_fetch_assoc($stockResult);
            $currentStock = $stockData['Stocks'];

            if ($currentStock < $quantity) {
                $allItemsInStock = false;
                break;
            } else {
                // Add item to array for later processing
                $cartItems[] = $cartItem;
            }
        } else {
            $allItemsInStock = false;
            break;
        }
    }

    if ($allItemsInStock) {
        // All items are in stock, proceed with checkout

        foreach ($cartItems as $cartItem) {
            $itemID = $cartItem['Item_ID'];
            $size = $cartItem['size'];
            $quantity = $cartItem['Item_Quantity'];
            $total = $cartItem['total'];

            // Insert into orders table
            $insertQuery = "INSERT INTO orders (User_ID, Item_ID, size, Item_Quantity, total)
                            VALUES ($userID, $itemID, '$size', $quantity, $total)";
            $insertResult = mysqli_query($conn, $insertQuery);

            if (!$insertResult) {
                die("Insert query failed: " . mysqli_error($conn));
            }

            // Deduct stock from sizes table
            $updateStockQuery = "UPDATE sizes SET Stocks = Stocks - $quantity WHERE Item_ID = $itemID AND size = '$size'";
            $updateStockResult = mysqli_query($conn, $updateStockQuery);

            if (!$updateStockResult) {
                die("Update stock query failed: " . mysqli_error($conn));
            }
        }

        // Clear the cart after successful insertion into orders
        $deleteCartQuery = "DELETE FROM cart WHERE User_ID = '$userID'";
        $deleteCartResult = mysqli_query($conn, $deleteCartQuery);

        if (!$deleteCartResult) {
            die("Delete from cart query failed: " . mysqli_error($conn));
        }

        // Close database connection
        mysqli_close($conn);

        // Redirect or show success message as needed
        print'<script>alert("Checkout Successful!")</script>';
        print'<script>window.location.assign("history.php")</script>';
        exit();
    } else {
        // If any item is out of stock, show an error message
        mysqli_close($conn);
        print'<script>alert("Checkout failed! An item in your cart is out of stock.")</script>';
        print'<script>window.location.assign("mycart.php")</script>';
        exit();
    }
} else {
    // Handle cases where form was not submitted via POST
    header("Location: checkout.php"); // Redirect back to checkout page or handle accordingly
    exit();
}
?>
