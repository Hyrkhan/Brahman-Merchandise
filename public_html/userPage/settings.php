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
                    <form class="searchBar" action="">
                        <input type="text" placeholder="Search order history.." name="search">
                        <button type="submit" class="searchIcon"></button>
                      </form>
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
                        <button class="btn_notification" onclick="location.href='products.html'">
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
                        <a href="#" class="currentPage">
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
                <div class="underConstruct">
                </div>
            </div>

        </div>
    </div>  
</body>


</html>