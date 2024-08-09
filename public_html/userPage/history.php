<?php
session_start();
?>

<html lang="en">
<head>
    <title>Brahman Merchandise</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="mainDiv">
        <div class="topDiv">
            <div class="topLeftDiv">
                <div class="siteLogoDiv"></div>
            </div>

            <div class="topRightDiv">
                <div class="searchBarDiv">
                </div>

                <div class="categoryNavDiv">
                    <p class="categoryLabel">Sort by</p>
                    <form action="" >
                        <select name="historySort" id="historySort" class="dropDownCont">
                          <option value="Date: Newest">Date: Newest</option>
                          <option value="Date: Oldest">Date: Oldest</option>
                          <option value="Name: Ascending">Name: Ascending</option>
                          <option value="Name: Descending">Name: Descending</option>
                          <option value="Price: Ascending">Price: Ascending</option>
                          <option value="Price: Descending">Price: Descending</option>
                          <option value="Claimed">Claimed</option>
                          <option value="Not Claimed">Not Claimed</option>
                        </select>
                      </form>
                </div>

                <div class="notifProfileDiv">
                    <div class="notifDiv">
                        <button class="btn_notification">
                            <i class="notif_image"></i>
                        </button>
                    </div>
                    <div class="profileDiv">
                        <div class="profile">
                            <div class="profileLeft">
                                <i class="userProfPic"></i>
                            </div>
                            <div class="profileRight">
                                <p class="userFullname"><?php echo htmlspecialchars($_SESSION['fullname']); ?></p>
                                <div class="userCredentials">
                                    <p class="userCourse"><?php echo htmlspecialchars($_SESSION['course']); ?></p>
                                    <p class="userOccupation"><?php echo htmlspecialchars($_SESSION['occup']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="middleDiv">
            <div class="middleLeftDiv">
                <div class="FirstNavDiv">
                    <ul class="FirstNavList">
                        <a href="index.php" >
                            <li>Dashboard</li>
                        </a>
                        <a href="products.php">
                            <li>Products</li>
                        </a>
                        <a href="mycart.php">
                            <li>My Cart</li>
                        </a>
                        <a href="#" class="currentPage">
                            <li>History</li>
                        </a>
                    </ul>
                </div>
                
                <div class="SecondNavDiv">
                    <ul class="SecondNavList">
                        <a href="profile.php">
                            <li>Profile</li>
                        </a>
                        <a href="settings.php">
                            <li>Settings</li>
                        </a>
                        <a href="logout.php">
                            <li>Log Out</li>
                        </a>
                    </ul>
                </div>

                <div class="ThirdNavDiv">
                    <ul class="ThirdNavList">
                        <a href="#">
                            <li>Contacts</li>
                        </a>
                        <a href="#">
                            <li>Help</li>
                        </a>
                    </ul>
                </div>
            </div>

            <div class="middleContentDiv">
                <div class="ContentCardDiv">
                <?php
                    include 'mycon.php';
                    $userID = $_SESSION['userID'];

                    // Query to fetch both not claimed orders and claimed history
                    $query = "
                        SELECT 
                            'order' AS type,
                            orders.Order_ID, 
                            items.Image_Path AS Image,
                            items.Name AS Item_Name, 
                            orders.Date, 
                            orders.Item_Quantity, 
                            items.Price,
                            orders.size,
                            NULL AS total,      
                            'Not Claimed' AS status
                        FROM 
                            orders 
                        INNER JOIN 
                            items 
                        ON 
                            orders.Item_ID = items.Items_ID
                        WHERE 
                            orders.User_ID = '$userID'

                        UNION ALL

                        SELECT 
                            'history' AS type,
                            history.history_ID AS Order_ID, 
                            items.Image_Path AS Image,
                            items.Name AS Item_Name, 
                            history.Date, 
                            history.Item_Quantity, 
                            items.Price,
                            history.size,
                            history.total,      
                            'Claimed' AS status
                        FROM 
                            history 
                        INNER JOIN 
                            items 
                        ON 
                            history.Item_ID = items.Items_ID
                        WHERE 
                            history.User_ID = '$userID'

                        ORDER BY Date DESC"; 

                    $result = mysqli_query($conn, $query);

                    if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                    }

                    echo "<table border='1'>";
                    echo "<tr align='center' id='historyHeader'>
                            <td><b> Order Number </b></td>
                            <td><b> Item Name </b></td>
                            <td><b> Date (Y/M/D) </b></td>
                            <td><b> Quantity </b></td>
                            <td><b> Total </b></td>
                            <td><b> Status </b></td></tr>";

                    while ($myrow = mysqli_fetch_array($result)) {
                        // Determine if it's an order or history entry
                        $type = $myrow['type'];

                        if ($type == 'order') {
                            // Calculate the total price for the order
                            $total_price = $myrow["Item_Quantity"] * $myrow["Price"];
                            $status = $myrow['status']; // Not Claimed
                        } elseif ($type == 'history') {
                            // Already calculated total from history table
                            $total_price = $myrow['total'];
                            $status = $myrow['status']; // Claimed
                        }

                        echo "<tr align='center' id='historyData'>";
                        echo "<td>" . $myrow["Order_ID"] . "</td>";
                        echo "<td class='history-item'>" . "<img src='../images/items/" . $myrow['Image'] . "' class='history-image'>";
                        echo " " . $myrow["Item_Name"] . " (" . $myrow["size"] . ")</td>";
                        echo "<td>" . $myrow["Date"] . "</td>";
                        echo "<td>" . $myrow["Item_Quantity"] . "</td>";
                        echo "<td>&#8369;" . number_format($total_price, 2) . "</td>";
                        echo "<td>" . $status . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";

                    mysqli_close($conn);
                    ?>

                </div>

            </div>

        </div>
    </div>  
</body>


</html>