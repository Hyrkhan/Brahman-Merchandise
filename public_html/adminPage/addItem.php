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
                <div class="ContentCardDiv">
                    <form class="newItemForm" method="POST" action="addNewItem.php">
                        <div class="addProductTop">
                            <div class="newProductLeft">
                                <p>Add New Product</p>
                                <div class="addNewProd">
                                    <div class="leftDiv">   
                                        Product Name
                                        <input  type="text" id="name" name="name"><br>
                                        Description
                                        <textarea id="desc" name="desc"></textarea><br>
                                        isAparrel
                                        <input type="number" id="apparel" name="apparel">
                                    </div>

                                    <div class="rightDiv">
                                        Unit Price
                                        <input  type="number" id="price" name="price"><br>
                                        Units in Stock
                                        <input type="number" id="stock" name="stock"><br>
                                        Size
                                        <input type="text" id="size" name="size"><br>
                                        Category
                                        <input type="text" id="category" name="category">
                                    </div>
                                </div>
                            </div>
                            <div class="newProductRight">
                                <div class="uploadPic">
                                </div>
                                <button type="button">Upload Product Image</button>
                            </div>
                        </div>
                        <div class="addProductBot">
                            <input type="submit" id="addProdbtn" value="Add Product Now">
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>  
</body>


</html>