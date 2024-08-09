<?php
include 'mycon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['desc']);
    $apparel = mysqli_real_escape_string($conn, $_POST['apparel']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    // Insert data into the items table
    $query = "INSERT INTO items (Name, Image_Path, Description, Price, apparel, Category) 
              VALUES ('$name', 'placeholder.png', '$description', $price, $apparel, '$category')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Get the last inserted Item_ID
        $item_id = mysqli_insert_id($conn);

        // Insert data into the sizes table
        $size_query = "INSERT INTO sizes (Item_ID, size, Stocks) 
                       VALUES ($item_id, '$size', $stock)";

        $size_result = mysqli_query($conn, $size_query);

        if ($size_result) {
            print'<script>alert("New product and size added successfully!")</script>';
            // Redirect to a success page or back to the form
            header("Location: manageItems.php"); // Adjust the location as needed
            exit();
        } else {
            echo "Error: " . $size_query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>
