<?php
include 'mycon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btn_claim'])) {
        // Handle claim action
        $orderID = mysqli_real_escape_string($conn, $_POST['orderID']);

        // Retrieve order details from orders table
        $query_select_order = "SELECT * FROM orders WHERE Order_ID = $orderID";
        $result_select_order = mysqli_query($conn, $query_select_order);

        if ($result_select_order && mysqli_num_rows($result_select_order) > 0) {
            $order = mysqli_fetch_assoc($result_select_order);

            // Retrieve the current stock from the sizes table
            $itemID = $order['Item_ID'];
            $size = mysqli_real_escape_string($conn, $order['size']);
            $itemQuantity = $order['Item_Quantity'];

            $query_select_stock = "SELECT Stocks FROM sizes WHERE Item_ID = $itemID AND size = '$size'";
            $result_select_stock = mysqli_query($conn, $query_select_stock);

            if ($result_select_stock && mysqli_num_rows($result_select_stock) > 0) {
                $size_data = mysqli_fetch_assoc($result_select_stock);
                $current_stock = $size_data['Stocks'];

                if ($current_stock >= $itemQuantity) {
                    // Deduct the claimed quantity from the stock
                    $new_stock = $current_stock - $itemQuantity;
                    $query_update_stock = "UPDATE sizes SET Stocks = $new_stock WHERE Item_ID = $itemID AND size = '$size'";
                    $result_update_stock = mysqli_query($conn, $query_update_stock);

                    if (!$result_update_stock) {
                        die("Failed to update stock in sizes table: " . mysqli_error($conn));
                    }

                    // Insert into history table
                    $userID = $order['User_ID'];
                    $total = $order['total'];
                    $date = $order['Date'];

                    $query_insert_history = "INSERT INTO history (User_ID, Item_ID, size, Item_Quantity, total, Date) 
                                             VALUES ($userID, $itemID, '$size', $itemQuantity, $total, '$date')";
                    $result_insert_history = mysqli_query($conn, $query_insert_history);

                    if (!$result_insert_history) {
                        die("Failed to insert into history table: " . mysqli_error($conn));
                    }

                    // Delete from orders table
                    $query_delete_order = "DELETE FROM orders WHERE Order_ID = $orderID";
                    $result_delete_order = mysqli_query($conn, $query_delete_order);

                    if (!$result_delete_order) {
                        die("Failed to delete from orders table: " . mysqli_error($conn));
                    }

                    // Redirect to a success page or back to the previous page
                    header("Location: transactions.php"); // Adjust the location as needed
                    exit();
                } else {
                    print'<script>alert("Not enough stock available to claim this order")</script>';
                    print'<script>window.location.assign("transactions.php")</script>';
                }
            } else {
                echo "Stock information not found for the selected item and size.";
            }
        } else {
            echo "Order not found or already claimed.";
        }
    } elseif (isset($_POST['btn_delete'])) {
        // Handle delete action
        $orderID = mysqli_real_escape_string($conn, $_POST['orderID']);

        $query_delete_order = "DELETE FROM orders WHERE Order_ID = $orderID";
        $result_delete_order = mysqli_query($conn, $query_delete_order);

        if (!$result_delete_order) {
            die("Failed to delete from orders table: " . mysqli_error($conn));
        }

        // Redirect to a success page or back to the previous page
        header("Location: transactions.php"); // Adjust the location as needed
        exit();
    }
}

mysqli_close($conn);
?>
