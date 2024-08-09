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
                        <a href="history.php">
                            <li>History</li>
                        </a>
                    </ul>
                </div>
                
                <div class="SecondNavDiv">
                    <ul class="SecondNavList">
                        <a href="#" class="currentPage">
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

            <div class="middleContentDiv_prof">
                <div class="profileCardDiv">
                    <div class="topCard">
                        <div class="firstTopCard">
                            <ul class="profileClassiList">
                                <li>Name:</li>
                                <li>Course:</li>
                                <li>Department:</li>
                                <li>Gender:</li>
                                <li>Occupation:</li>
                            </ul>
                        </div>

                        <div class="secondTopCard">
                            <ul class="profileClassiList">
                                <li><b><?php echo htmlspecialchars($_SESSION['fullname']); ?></b></li>
                                <li><?php echo htmlspecialchars($_SESSION['course']); ?></li>
                                <li><?php echo htmlspecialchars($_SESSION['dept']); ?></li>
                                <li><?php echo htmlspecialchars($_SESSION['gender']); ?></li>
                                <li><?php echo htmlspecialchars($_SESSION['occup']); ?></li>
                            </ul>
                        </div>
                        
                        <div class="thirdTopCard">
                            <i class="userProfilePic"></i>
                            <p class="userID">ID No. <?php echo htmlspecialchars($_SESSION['userID']); ?></p>
                        </div>
                    </div>

                    <div class="bottomCard">
                        <div class="firstBottomCard">
                            <ul class="profileClassiList2">
                                <li>UB-Mail:</li>
                                <li>Address:</li>
                            </ul>
                        </div>

                        <div class="secondBottomCard">
                            <ul class="profileClassiList2">
                                <li><?php echo htmlspecialchars($_SESSION['userID']); ?>@ub.edu.ph</li>
                                <li>Lipa City</li>
                            </ul>
                        </div>
                        
                        <div class="thirdBottomCard">
                            <p>
                                <a href="">
                                    Change Password
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>  
</body>


</html>