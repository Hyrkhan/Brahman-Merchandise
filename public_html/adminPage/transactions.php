<?php
session_start();
?>

<html lang="en">
<head>
    <title>Brahman Merchandise</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="adminstyles.css">
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
                                    <p class="userCourse"></p>
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
                        <a href="adminIndex.php">
                            <li>Dashboard</li>
                        </a>
                        <a href="manageItems.php">
                            <li>Manage Items</li>
                        </a>
                        <a href="manageUsers.php">
                            <li>Manage Users</li>
                        </a>
                        <a href="" class="currentPage">
                            <li>Transactions</li>
                        </a>
                    </ul>
                </div>
                
                <div class="SecondNavDiv">
                    <ul class="SecondNavList">
                        <a href="adminHistory.php">
                            <li>History</li>
                        </a>
                        <a href="">
                            <li>Revenue</li>
                        </a>
                        <a href="">
                            <li>Settings</li>
                        </a>
                    </ul>
                </div>

                <div class="ThirdNavDiv">
                    <ul class="ThirdNavList">
                        <a href="#">
                            <li>Contacts</li>
                        </a>
                        <a href="logout.php">
                            <li>Logout</li>
                        </a>
                    </ul>
                </div>
            </div>

            <div class="middleContentDiv">
                <div class="topContentDiv2">
                    <form action="" >
                        <select name="yearLvl" id="yearLvl" class="dropDownCont">
                            <option value="College">Newest</option>
                            <option value="College">Oldest</option>
                        </select>
                    </form>
                </div>
                <div class="ContentCardDiv3">
                    <?php
                        include 'mycon.php';

                        // Query to fetch all orders with user and item details
                        $query = "
                            SELECT 
                                orders.Order_ID, 
                                items.Name as Item_Name, 
                                CONCAT(users.fname, ' ', users.lname) as Customer_Name,
                                items.Price as Unit_Price,
                                orders.size as size,
                                orders.Item_Quantity, 
                                orders.total, 
                                orders.Date
                            FROM 
                                orders
                            JOIN 
                                users ON orders.User_ID = users.User_ID
                            JOIN 
                                items ON orders.Item_ID = items.Items_ID
                                ORDER BY Date DESC";

                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }

                        echo "<table border='1' id='userTable' class='user-table'>";
                        echo "<tr align='center' id='historyHeader'>
                                <td><b>Order ID</b></td>
                                <td><b>Item Name</b></td>
                                <td><b>Customer Name</b></td>
                                <td><b>Unit Price</b></td>
                                <td><b>Quantity</b></td>
                                <td><b>Total</b></td>
                                <td><b>Date</b></td>
                                <td colspan='2'><b>Actions</b></td></tr>";

                        while ($myrow = mysqli_fetch_array($result)) {
                            echo "<form action='ManageTransactions.php' method='POST'>";
                            echo "<tr align='center' id='orderData'>";
                            echo "<input type='hidden' name='orderID' value='" . $myrow['Order_ID'] . "'>";
                            echo "<td>" . $myrow["Order_ID"] . "</td>";
                            echo "<td>" . $myrow["Item_Name"] . " (" . $myrow["size"] . ")</td>";
                            echo "<td>" . $myrow["Customer_Name"] . "</td>";
                            echo "<td>&#8369;" . $myrow["Unit_Price"] . "</td>";
                            echo "<td>" . $myrow["Item_Quantity"] . "</td>";
                            echo "<td>&#8369;" . $myrow["total"] . "</td>";
                            echo "<td>" . $myrow["Date"] . "</td>";
                            echo "<td>
                                    <center><input type='submit' name='btn_claim' value='CLAIM' class='btn_claim'>
                                </td>";
                            echo "<td>
                                    <center><input type='submit' name='btn_delete' value='DELETE' class='btn_delete'>
                                </td>";
                            echo "</tr>";
                            echo "</form>";
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