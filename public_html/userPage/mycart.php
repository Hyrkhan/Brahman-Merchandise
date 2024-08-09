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
                        <select name="sortList" id="sortList" class="dropDownCont">
                          <option value="Recently added">Recently added</option>
                          <option value="Name: Ascending">Name: Ascending</option>
                          <option value="Name: Descending">Name: Descending</option>
                          <option value="Price: Ascending">Price: Ascending</option>
                          <option value="Price: Descending">Price: Descending</option>
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
                        <a href="#" class="currentPage">
                            <li>My Cart</li>
                        </a>
                        <a href="history.php">
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
                <div class="ContentCardDiv2">
                    <?php
                        include 'mycon.php';
                        $userID = $_SESSION['userID'];

                        // Join the orders and items tables to get the item name and price
                        $query = "
                            SELECT 
                                cart.Cart_ID,
                                items.Image_Path AS Image,
                                items.Name AS Item_Name, 
                                items.Price AS Price,
                                cart.size AS size,
                                cart.Item_Quantity AS Quantity,
                                cart.total AS total,
                                (SELECT SUM(total) FROM cart WHERE User_ID = '$userID') AS grand_total
                                
                            FROM 
                                cart 
                            INNER JOIN 
                                items 
                            ON 
                                cart.Item_ID = items.Items_ID
                            WHERE 
                                cart.User_ID = '$userID'
                                ";

                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }

                        
                        echo "<table border='1' id='cartTable'>";
                        echo "<tr align='center' id='historyHeader'>
                                <td><b> Item Name </b></td>
                                <td><b> Unit Price </b></td>
                                <td><b> Quantity </b></td>
                                <td><b> Total Price </b></td>
                                <td><b> Remove </b></td></tr>";

                        $grandTotal = 0;
                        while ($myrow = mysqli_fetch_array($result)) {
                            $grandTotal = $myrow['grand_total'];
                            
                            echo "<tr align='center' id='historyData'>";
                            echo "<td class='history-item'>" . "<img src='../images/items/" . $myrow['Image'] . "' class='history-image'>";
                            echo " " . $myrow["Item_Name"] . " (". $myrow["size"] .")</td>";
                            echo "<td>&#8369;" . $myrow["Price"] . "</td>";
                            echo "<td>". $myrow["Quantity"] ."</td>";
                            echo "<td>". $myrow["total"] ."</td>";
                            echo "<td>
                                <form method='POST' action='removeItem.php'>
                                    <input type='hidden' name='cartID' value='" . $myrow['Cart_ID'] . "'>
                                    <input type='submit' class='remove_btn' id='remove' name='remove' value='Remove'>
                                </form>
                            </td>";
                            echo "</tr>";
                            
                        }
                        echo "</table>";
                        

                        mysqli_close($conn);
                    ?>

                    <div class="CheckoutDiv">
                        <div class="cartTotalPrice">
                            <p>Total: &#8369;<?php echo number_format($grandTotal, 2); ?></p>
                        </div>
                        <div class="checkOut">
                            <form id="checkoutForm" method="POST" action="checkout.php">
                                <input type="submit" value="Check Out">
                            </form>
                        </div>
                    </div>

                    <script>
                        function checkout() {
                            document.getElementById('checkoutForm').submit();
                        }
                    </script>
                </div>
            </div>

        </div>
    </div>  
</body>


</html>