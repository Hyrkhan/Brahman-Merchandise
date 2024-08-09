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
                        <a href="" class="currentPage">
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
                    <form action="" >
                        <select name="yearLvl" id="yearLvl" class="dropDownCont">
                            <option value="College">CITEC</option>
                            <option value="College">CENAR</option>
                            <option value="College">CMT</option>
                            <option value="College">CEAS</option>
                        </select>
                    </form>
                </div>
                <div class="ContentCardDiv3">
                    <?php
                        include 'mycon.php';

                        // Query to fetch all users
                        $query = "SELECT * FROM users";

                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }

                        echo "<table border='1' id='userTable' class='user-table'>";
                        echo "<tr align='center' id='historyHeader'>
                                <td><b>User ID</b></td>
                                <td><b>Name</b></td>
                                <td><b>Occupation</b></td>
                                <td><b>Course</b></td>
                                <td><b>Department</b></td>
                                <td><b>Gender</b></td>
                                <td colspan='2'><b>Actions</b></td></tr>";

                        while ($myrow = mysqli_fetch_array($result)) {
                            echo "<form action='ManageUserData.php' method='POST'>";
                            echo "<tr align='center' id='userData'>";
                            echo "<input type='hidden' name='userID' value='" . $myrow['User_ID'] . "'>";
                            echo "<td>" . $myrow["User_ID"] . "</td>";
                            echo "<td><input type='text' name='name' value='" . $myrow['fname'] . " " . $myrow['lname'] . "'></td>";
                            echo "<td><input type='text' name='occupation' value='" . $myrow["Occupation"] . "'></td>";
                            echo "<td><input type='text' name='course' value='" . $myrow["Course"] . "'></td>";
                            echo "<td><input type='text' name='department' value='" . $myrow["Department"] . "'></td>";
                            echo "<td><input type='text' name='gender' value='" . $myrow["Gender"] . "'></td>";
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