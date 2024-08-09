<?php
include 'mycon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemID = mysqli_real_escape_string($conn, $_POST['itemID']);

    if (isset($_POST['btn_edit'])) {
        // Edit item
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $apparel = mysqli_real_escape_string($conn, $_POST['apparel']);
        $size = mysqli_real_escape_string($conn, $_POST['size']);
        $stocks = mysqli_real_escape_string($conn, $_POST['stocks']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);

        $query_update_item = "UPDATE items SET Name = '$name', Price = $price, apparel = '$apparel', Category = '$category' WHERE Items_ID = $itemID";
        $result_update_item = mysqli_query($conn, $query_update_item);

        if (!$result_update_item) {
            die("Update query failed: " . mysqli_error($conn));
        }

        // Update stocks
        $query_update_stocks = "UPDATE sizes SET Stocks = $stocks WHERE Item_ID = $itemID AND size = '$size'";
        $result_update_stocks = mysqli_query($conn, $query_update_stocks);

        if (!$result_update_stocks) {
            die("Update stocks query failed: " . mysqli_error($conn));
        }
        print '<script>alert("Action successful!");</script>';
    } elseif (isset($_POST['btn_delete'])) {
        // Delete related records in the sizes table first
        $deleteSizesQuery = "DELETE FROM sizes WHERE Item_ID = $itemID";
        $deleteSizesResult = mysqli_query($conn, $deleteSizesQuery);

        if (!$deleteSizesResult) {
            die("Delete related sizes query failed: " . mysqli_error($conn));
        }

        // Delete item
        $query = "DELETE FROM items WHERE Items_ID = $itemID";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Delete item query failed: " . mysqli_error($conn));
        }
        print '<script>alert("Action successful!");</script>';
    }

    mysqli_close($conn);

    // Redirect back to the items page
    header("Location: manageItems.php");
    exit();
}
?>
