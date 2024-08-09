<?php
session_start();
include 'mycon.php';
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
                    <form class="searchBar" action="">
                        <input type="text" placeholder="Search item.." name="search">
                        <button type="submit" class="searchIcon"></button>
                      </form>
                </div>

                <div class="categoryNavDiv">
                    <p class="categoryLabel">Sort by</p>
                    <form action="" >
                        <select name="gradeLvl" id="gradeLvl" class="dropDownCont">
                          <option value="College">College</option>
                          <option value="Sr.High">Sr. Highschool</option>
                          <option value="Jr.High">Jr. Highschool</option>
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
                                <p class="userFullname"></p>
                                <div class="userCredentials">
                                <p class="userCourse"></p>
                                    <p class="userOccupation"></p>
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
                        <a href="index.html" >
                            <li>Dashboard</li>
                        </a>
                        <a href="" class="currentPage">
                            <li>Products</li>
                        </a>
                        <a href="login.html">
                            <li>Log In</li>
                        </a>
                    </ul>
                </div>
                
                <div class="SecondNavDiv">
                    <ul class="SecondNavList">
                        <a href="#">
                            <li>Contacts</li>
                        </a>
                        <a href="#">
                            <li>Help</li>
                        </a>
                    </ul>
                </div>

                <div class="ThirdNavDiv">
                    <ul class="ThirdNavList">
                    </ul>
                </div>
            </div>

            <div class="middleContentDiv" id="itemCatalog">
                <div class="topDivItemCat">
                    <ul id="breadCrumbs">
                        <li></li>
                    </ul>
                    <div class="sortByDept">
                        <p class="categoryLabel2">Year Level</p>
                        <form method="GET" action="">
                            <select name="yearLvl" id="yearLvl" class="dropDownCont" onchange="this.form.submit()">
                                <option value="">Select Year Level</option>
                                <option value="all">All</option>
                                <option value="Grade 7">Grade 7</option>
                                <option value="Grade 8">Grade 8</option>
                                <option value="Grade 9">Grade 9</option>
                                <option value="Grade 10">Grade 10</option>
                                <option value="College">College</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="ItemCatDiv">
                    <?php
                        $query = "SELECT * FROM items";
                        if (isset($_GET['yearLvl']) && $_GET['yearLvl'] != 'all' && !empty($_GET['yearLvl'])) {
                            $yearLvl = mysqli_real_escape_string($conn, $_GET['yearLvl']);
                            $query .= " WHERE Category='$yearLvl'";
                        }
                        $result = mysqli_query($conn, $query);

                        echo "<ul class='items-list'>";

                        while ($myrow = mysqli_fetch_array($result)) {
                            $imagePath = $myrow['Image_Path'];
                            $name = $myrow['Name'];
                            $price = $myrow['Price'];
                            $desc = $myrow['Description'];
                            $itemID = $myrow['Items_ID'];
                            $apparel = $myrow['apparel'];

                            echo "<li>";
                            echo "<form action='check_login.php' method='POST'>";
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
                    ?>
                </div>
            </div>

        </div>
    </div>  
</body>


</html>