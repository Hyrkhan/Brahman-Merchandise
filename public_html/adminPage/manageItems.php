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
                        <a href="" class="currentPage">
                            <li>Manage Items</li>
                        </a>
                        <a href="manageUsers.php">
                            <li>Manage Users</li>
                        </a>
                        <a href="transactions.php">
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
                    <button type="button" onclick="location.href='addItem.php'">Add Item</button>
                </div>
                <div class="ContentCardDiv2">
                    <?php
                        include 'mycon.php';
                        $userID = $_SESSION['userID'];

                        // Query to fetch all items
                        $query = "
                            SELECT 
                                items.Items_ID,
                                items.Name,
                                items.Price,
                                items.apparel,
                                items.Image_Path,
                                items.Category,
                                sizes.size,
                                sizes.Stocks
                            FROM items
                            LEFT JOIN sizes ON items.Items_ID = sizes.Item_ID
                        ";

                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }

                        echo "<table border='1' id='cartTable'>";
                        echo "<tr align='center' id='historyHeader'>
                                <td><b>Item ID</b></td>
                                <td><b>Item Name</b></td>
                                <td><b>Unit Price</b></td>
                                <td><b>isApparel</b></td>
                                <td><b>Size</b></td>
                                <td><b>Stocks</b></td>
                                <td><b>Category</b></td>
                                <td colspan='2'><b>Actions</b></td></tr>";

                        while ($myrow = mysqli_fetch_array($result)) {
                            echo "<form action='ManageData.php' method='POST'>";
                            echo "<tr align='center' id='historyData'>";
                            echo "<input type='hidden' name='itemID' value='" . $myrow['Items_ID'] . "'>";
                            echo "<input type='hidden' name='size' value='" . $myrow['size'] . "'>";
                            echo "<td>" . $myrow["Items_ID"] . "</td>";
                            echo "<td class='history-item'>
                                    <img src='../images/items/" . $myrow['Image_Path'] . "' class='history-image'>
                                    <input type='text' name='name' value='" . $myrow['Name'] . "'>
                                </td>";
                            echo "<td>&#8369;<input type='text' name='price' value='" . $myrow["Price"] . "'></td>";
                            echo "<td><input type='text' name='apparel' value='" . $myrow["apparel"] . "'></td>";
                            echo "<td>" . $myrow["size"] . "</td>";
                            echo "<td><input type='text' name='stocks' value='" . $myrow["Stocks"] . "'></td>";
                            echo "<td><input type='text' name='category' value='" . $myrow["Category"] . "'></td>";
                            echo "<td>
                                    <center><input type='submit' name='btn_edit' value='EDIT' class='btn_edit'>
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
