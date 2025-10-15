<!-- <pre> -->
<?php
session_start();
require_once("class/users.php");
require_once("class/Order.php");
require_once("class/OrderItem.php");
require_once("class/products.php");
if (isset($_SESSION["user"]) && isset($_GET["orderId"])) {
    $orderId = $_GET["orderId"];
    $userId = $_SESSION["userId"];

    // GET user
    $query = new users();
    $users = $query->selectUser($userId);

    // GET ORDR
    $query1 = new Order();
    $orders = $query1->getOrder($orderId);

    // GET ORDER ITEMS
    $query2 = new OrderItem();
    $orderItems = $query2->getOrderItem($orderId);
    if ($orderItems->num_rows > 0) {
        while ($item = $orderItems->fetch_assoc()) {
            $itemId[] = $item["productId"];
            $itemQuantity[$item["productId"]] = $item["quantity"];
        }
        $itemValues = implode(",", $itemId);

        // GET PRODUCTS
        $query3 = new Product();
        $products = $query3->getProducts($itemValues);
        
        // GET ADDRESS
        $query4 = new Address();
        $addressId = null;
    }
} else {
    return header("location:index.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <!-- header font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Permanent+Marker&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <!-- css stylesheet -->
    <link rel="stylesheet" href="style.css">
    <!-- food images -->
    <link rel="stylesheet" href="assets/css/food.css">
    <!-- responsive -->
    <link rel="stylesheet" href="assets/css/responsive.css">

</head>


<body>
    <main id="main" class="menuMain">
        <!-- nav section -->
        <nav id="nav-container" class="flex justify-content-between position-sticky align-items-center">
            <div class="left-title-flip flex">
                <div class="title-logo">
                    <h2 class="logo"><a href="index.html">CRAVELAB</a></h2>
                </div>
                <div class="navlinks flex">
                    <button id="mobile-navToogle"><i class="fas fa-bars"></i></button>
                    <ul class="left-title flex fw-bold pt-1">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="">Contact Us</a></li>
                        <li class="min-scr"><a href="cart.php">cart</a></li>
                        <li class="min-scr"><a href="favorite.php">Favourite</a></li>
                    </ul>
                </div>
            </div>
            <div class="right-title">
                <span class="nav-cart"><a href="cart.php"><i class="fas fa-shopping-cart"></i></a></span>
                <span class="heart"><a href="favorite.php"><i class="fas fa-heart"></i></a></span>
                <?php if (isset($_SESSION["user"])): ?>
                    <span class="sign-up"><a href='profile.php'><b><?= $_SESSION["name"] ?></b></a></span>
                <?php else: ?>
                    <span class="sign-up"><a href='signup.php'><i class='fas fa-user'></i></a></span>
                <?php endif ?>
            </div>
        </nav>
        <!-- contact -->

        <section>
            <div class="container">
                <?php if ($orders->num_rows > 0) : ?>
                    <?php while ($order = $orders->fetch_assoc()): ?>
                        <?php $addressId = $order["addressId"] ?>
                        <div class="my-2">
                            <p><b>ORDER ID: <?= $order["orderLabel"] ?></b></p>
                            <p><b>STATUS: <?= $order["status"] ?></b></p>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="ordered-items border rounded-4 my-2">
                                    <table id="tab" class="table tab">
                                        <thead>
                                            <tr>
                                                <th scope="col">Product</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($products->num_rows > 0): ?>
                                                <?php while ($product = $products->fetch_assoc()): ?>
                                                    <tr>
                                                        <td><?= $product["name"] ?></td>
                                                        <td><?= $itemQuantity[$product["id"]] ?></td>
                                                        <td><?= number_format($product["price"], 2) ?></td>
                                                    </tr>
                                                <?php endwhile ?>
                                            <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="order-summary border rounded-4 my-2">
                                    <table id="tab" class="table tab">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order Summary</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><b>Total</b></td>
                                                <td><?= number_format($order["totalPrice"], 2) ?></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="address-information border rounded-4 my-2 p-2">
                                    <p><b>User Information</b></p>
                                    <?php if ($users->num_rows > 0): ?>
                                        <?php while ($row = $users->fetch_assoc()): ?>
                                            <p class="my-3"><?= $row["name"] ?></p>
                                            <p class="my-3"><?= $row["phoneNo"] ?></p>
                                            <p class="my-3"><?= $row["email"] ?></p>
                                        <?php endwhile ?>
                                    <?php endif ?>
                                </div>

                                <div class="address-information border rounded-4 my-2 p-2">
                                    <p><b>Shipping Information</b></p>
                                    <?php $address = $query4->getOneAddress($addressId) ?>
                                    <?php if ($address->num_rows > 0): ?>
                                        <?php while ($rows = $address->fetch_assoc()): ?>
                                            <p class="my-3"><?= $rows["state"] ?></p>
                                            <p class="my-3"><?= $rows["city"] ?></p>
                                            <p class="my-3"><?= $rows["homeAddress"] ?></p>
                                            <p class="my-3"><?= $rows["additionalInformation"] ?></p>
                                        <?php endwhile ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile ?>
                <?php endif ?>
            </div>
        </section>
        <!-- footer -->
        <footer class="w-100">
            <div class="footer-top flex justify-content-between align-items-center px-4">
                <h2 class="footer-title logo">CRAVELAB</h2>
                <div>
                    <i class="fab fa-whatsapp"></i><span class="address">09075020441</span>
                    <i class="fa fa-store"></i><span class="address">info@craavelab.com</span>
                </div>
                <div class="socials">
                    <a href=""><i class="fab fa-facebook"></i></a>
                    <a href=""><i class="fab fa-instagram"></i></a>
                    <a href=""><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-details-container flex justify-content-evenly ">
                    <div class="footer-details">
                        <h3 class="f2">ABOUT</h3>
                        <p class="f1"><a class="f1" href="menu.php">Our Menu</a></p>
                        <p class="f1"><a class="f1" href="contact-us.php">Contact Us</a></p>
                        <p class="f1"><a class="f1" href="">Privacy</a></p>
                        <p class="f1"><a class="f1" href="">SignUp/login</a></p>
                    </div>
                    <div class="footer-details">
                        <h3 class="f2">OUR ADDRESS</h3>
                        <p class="f1">No 56 Old Lagos Asaba Road <br> Agbor Delta State</p>
                    </div>
                    <div class="footer-details">
                        <h3 class="f2">OUR ACTIVE HOURS</h3>
                        <p class="f1">Monday-Sunday <br> 7am-11pm</p>
                    </div>
                </div>
                <hr>
                <div id="copyright" class="text-center">&copy;copyright <?php echo date("Y") ?> designed by <a class="f1" href="">jovinci</a></div>
            </div>
        </footer>
    </main>



    <!-- main js -->
    <script src="assets/javaScript/main.js"></script>
</body>

</html>