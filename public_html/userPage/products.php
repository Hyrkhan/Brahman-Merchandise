<?php
session_start();
include 'mycon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
                    <form class="searchBar" method="GET" action="">
                        <input type="text" placeholder="Search item.." name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button type="submit" class="searchIcon"></button>
                    </form>
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
                        <a href="index.php"><li>Dashboard</li></a>
                        <a href="#" class="currentPage"><li>Products</li></a>
                        <a href="mycart.php"><li>My Cart</li></a>
                        <a href="history.php"><li>History</li></a>
                    </ul>
                </div>
                
                <div class="SecondNavDiv">
                    <ul class="SecondNavList">
                        <a href="profile.php"><li>Profile</li></a>
                        <a href="settings.php"><li>Settings</li></a>
                        <a href="logout.php"><li>Log Out</li></a>
                    </ul>
                </div>

                <div class="ThirdNavDiv">
                    <ul class="ThirdNavList">
                        <a href="#"><li>Contacts</li></a>
                        <a href="#"><li>Help</li></a>
                    </ul>
                </div>
            </div>

            <div class="middleContentDiv" id="itemCatalog">
                <div class="topDivItemCat">
                    <ul id="breadCrumbs"><li></li></ul>
                    <div class="sortByDept">
                        <p class="categoryLabel2">Year Level</p>
                        <form method="GET" action="">
                            <select name="yearLvl" id="yearLvl" class="dropDownCont" onchange="this.form.submit()">
                                <option value="">Select Year Level</option>
                                <option value="all" <?php if(isset($_GET['yearLvl']) && $_GET['yearLvl'] == 'all') echo 'selected'; ?>>All</option>
                                <option value="Grade 7" <?php if(isset($_GET['yearLvl']) && $_GET['yearLvl'] == 'Grade 7') echo 'selected'; ?>>Grade 7</option>
                                <option value="Grade 8" <?php if(isset($_GET['yearLvl']) && $_GET['yearLvl'] == 'Grade 8') echo 'selected'; ?>>Grade 8</option>
                                <option value="Grade 9" <?php if(isset($_GET['yearLvl']) && $_GET['yearLvl'] == 'Grade 9') echo 'selected'; ?>>Grade 9</option>
                                <option value="Grade 10" <?php if(isset($_GET['yearLvl']) && $_GET['yearLvl'] == 'Grade 10') echo 'selected'; ?>>Grade 10</option>
                                <option value="College" <?php if(isset($_GET['yearLvl']) && $_GET['yearLvl'] == 'College') echo 'selected'; ?>>College</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="ItemCatDiv">
                    <?php
                        $query = "SELECT * FROM items WHERE 1=1";

                        // Apply year level filter if selected
                        if (isset($_GET['yearLvl']) && $_GET['yearLvl'] != 'all' && !empty($_GET['yearLvl'])) {
                            $yearLvl = mysqli_real_escape_string($conn, $_GET['yearLvl']);
                            $query .= " AND Category='$yearLvl'";
                        }

                        // Apply search filter if provided
                        if (isset($_GET['search']) && !empty($_GET['search'])) {
                            $search = mysqli_real_escape_string($conn, $_GET['search']);
                            $query .= " AND Name LIKE '%$search%'";
                        }

                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            echo "<ul class='items-list'>";
                            while ($myrow = mysqli_fetch_array($result)) {
                                $imagePath = $myrow['Image_Path'];
                                $name = $myrow['Name'];
                                $price = $myrow['Price'];
                                $desc = $myrow['Description'];
                                $itemID = $myrow['Items_ID'];
                                $apparel = $myrow['apparel'];

                                echo "<li>";
                                echo "<form action='product-desc.php' method='POST'>";
                                echo "<input type='hidden' name='name' value='$name'>";
                                echo "<input type='hidden' name='price' value='$price'>";
                                echo "<input type='hidden' name='image' value='$imagePath'>";
                                echo "<input type='hidden' name='desc' value='$desc'>";
                                echo "<input type='hidden' name='itemID' value='$itemID'>";
                                echo "<input type='hidden' name='apparel' value='$apparel'>";
                                echo "<button type='submit' class='item-button'>";
                                echo "<span class='item-pic'><img src='../images/items/" . $imagePath . "' class='item-image'></span>";
                                echo "</button>";
                                echo "</form>";
                                echo "<span class='item-name'><b>" . $name . "</b></span>";
                                echo "<span class='item-stocks'>Status: Available</span>";
                                echo "<span class='item-price'>&#8369;" . $price . "</span>";
                                echo "</li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "<p>No items found for the selected criteria.</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
