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
                        <a href="#" class="currentPage">
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

            <div class="middleContentDiv" id="itemCatalog">
                <div class="topDivItemCat">
                </div>

                <div class="ItemCatDiv">
                    <?php
                        include 'mycon.php';
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $imagePath = mysqli_real_escape_string($conn, $_POST['image']);
                            $name = mysqli_real_escape_string($conn, $_POST['name']);
                            $price = mysqli_real_escape_string($conn, $_POST['price']);
                            $desc = mysqli_real_escape_string($conn, $_POST['desc']);
                            $itemID = mysqli_real_escape_string($conn, $_POST['itemID']);
                            $apparel = mysqli_real_escape_string($conn, $_POST['apparel']);

                            if ($apparel == 1)
                            {
                                $query = "SELECT size, Stocks FROM sizes WHERE Item_ID = '$itemID'";
                                $result = mysqli_query($conn, $query);
                                $stocks = [];
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $stocks[$row['size']] = $row['Stocks'];
                                }
                                $isApparel = True;
                            }
                            else {
                                $query = "SELECT Stocks FROM sizes WHERE Item_ID = '$itemID'";
                                $result = mysqli_query($conn, $query);
                                if (!$result) {
                                    die("Query failed: " . mysqli_error($conn));
                                }
                            
                                while ($myrow = mysqli_fetch_array($result)) {
                                    $stock = $myrow['Stocks'];
                                    $isApparel = False;
                                }
                            }
                            
                        }
                    ?>

                    <div class="itemDivLeft">
                        <div class="itemDivLeft-top">
                            <img class="itemDivImage" src="../images/items/<?php echo $imagePath; ?>">
                        </div>
                        <div class="itemDivLeft-bot">
                            <p id="itemDivDesc"><br><br><?php echo $desc; ?></p>
                        </div>
                    </div>

                    <div class="itemDivRight">
                        <div class="productDeets">
                            <div class="deetsTopDiv">
                                <p><?php echo $name; ?></p>
                                <button type="button" value="Back" onclick="location.href='products.php'">X</button>
                            </div>

                            <form method="POST" action="addToCart.php">
                                <div class="deetsMidDiv">
                                    <table id="deetsTable">
                                        <tr>
                                            <td>Unit Price:</td>
                                            <td>&#8369;<?php echo $price; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Size:</td>
                                            <td id="deetsRadios">
                                                <ul class="deetsAllRadio">
                                                    <?php
                                                    if ($isApparel)
                                                    {
                                                        $sizes = ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
                                                        foreach ($sizes as $size) {
                                                            $stock = isset($stocks[$size]) ? $stocks[$size] : 0;
                                                            echo "<li>
                                                                    <input type='radio' id='tshirtSize' name='tshirtSize' value='$size' data-stock='$stock' onclick='updateStock(this)'>
                                                                    <p>$size</p>
                                                                </li>";
                                                        }
                                                    }
                                                    else {
                                                        echo"<li>
                                                            </li>";
                                                    }
                                                    
                                                    ?>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Quantity:</td>
                                            <td>
                                                <input type="number" id="quantity" name="quantity" min="0" max="<?php echo $isApparel ? '0' : $stock; ?>" oninput='calcueTotal(<?php echo $price; ?>)'>
                                                &ensp; Stocks: <span id="stocks"><?php echo $isApparel ? '-' : $stock; ?></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <input type="hidden" id="itemID" name="itemID" value="<?php echo $itemID; ?>">
                                <input type="hidden" id="selectedSize" name="selectedSize">
                                <input type="hidden" id="totalPrice" name="totalPrice">
                                <input type="hidden" id="finalQuantity" name="finalQuantity">

                                <div class="deetsBotDiv">
                                    <div class="deetsBotLeft">
                                        <span id="deetsTotal">
                                            Total: &#8369; <span id="total">-</span>
                                        </span>
                                    </div>
                                    <div class="deetsBotRight">
                                        <input type="submit" id="addtoCart" name="addtoCart" value="Add To Cart">
                                    </div>
                                </div>
                            </form>

                            
                        </div>
                    </div>
                </div>
                <script>
                    function updateStock(radio) {
                        var stock = radio.getAttribute("data-stock");
                        document.getElementById("stocks").innerText = stock;
                        document.getElementById("quantity").max = stock;
                        document.getElementById("quantity").value = stock > 0 ? 0 : 0;

                        document.getElementById("selectedSize").value = radio.value;
                    }
                    function calcueTotal(price){
                        var quantity = document.getElementById("quantity").value;
                        var total = price * quantity;
                        document.getElementById("total").innerText = total;

                        document.getElementById("totalPrice").value = total;
                        
                        document.getElementById("finalQuantity").value = quantity;
                    }
                </script>;
            </div>

        </div>
    </div>  
</body>


</html>