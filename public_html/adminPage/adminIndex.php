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
                <i class="siteLogoDiv"></i>
            </div>

            <div class="topRightDiv">
                <div class="topHeaderDiv">
                    <p class="welcomeHeader">
                        Welcome Back Admin!
                    </p>
                    <p class="textHeader">  
                    </p>
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
                        <a href="#" class="currentPage">
                            <li>Dashboard</li>
                        </a>
                        <a href="manageItems.php">
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
                <div class="left">
                    <div class="promoDiv">
                        <div class="left">
                            <p>
                                <span>UBian</span>
                                <span>Exclusive</span>
                                <span>E-Commerce</span>
                                <span>Site</span>
                            </p>
                            <div class="promoLogo">
                                <div class="promo"></div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="top"></div>
                            <div class="bottom">
                                <div class="poweredBy"></div>
                            </div>
                        </div>
                    </div>

                    <div class="latestOrders">
                        <img src="../images/stats.jpg">
                    </div>
                </div>

                <div class="right2">
                    <div class="dashboardFilter">
                        <button type="button">NEW</button>
                        <button type="button">Popular</button>
                    </div>
                    <div class="dashboardLatest">
                        <img src="../images/mosbuy.jpg">
                    </div>
                </div>  
            </div>

        </div>
    </div>  
</body>


</html>