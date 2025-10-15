<!-- <pre> -->
<?php
session_start();
require_once("../class/users.php");
require_once("../class/Order.php");
require_once("../class/OrderItem.php");
require_once("../class/products.php");
if (isset($_SESSION["admin"]) && isset($_GET["orderId"])) {
    $orderId = $_GET["orderId"];

    // GET ORDER
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
    return header("location:dashboard.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>
    <!-- header font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Permanent+Marker&display=swap" rel="stylesheet">

    <!-- bootstrap -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">

    <!-- fontawesome -->
    <link rel="stylesheet" href="../assets/css/fontawesome/css/all.css">

    <!-- css stylesheet -->
    <link rel="stylesheet" href="../style.css">

    <!-- food images -->
    <link rel="stylesheet" href="../assets/css/food.css">

    <!-- responsive -->
    <link rel="stylesheet" href="../assets/css/responsive.css">

</head>


<body>
    <main id="main" class="menuMain">
        <!-- nav section -->
        <nav class="navbar bg-body-tertiary fixed-top navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h2 class="logo"><a href="#">CRAVELAB</a></h2>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            <h2 class="logo"><a href="#">CRAVELAB</a></h2>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                            <li class="nav-item active-nav">
                                <a class="nav-link active fw-bold" aria-current="page" href="#">DashBoard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="products.php">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  fw-bold" aria-current="page" href="feedbacks.php">FeedBack</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  fw-bold" aria-current="page" href="payments.php">Payments</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- contact -->

        <section class="mt-5 pt-3">
            <div class="container">
                <?php if ($orders->num_rows > 0) : ?>
                    <?php while ($order = $orders->fetch_assoc()): ?>
                        <?php $addressId = $order["addressId"] ?>
                        <?php $userId = $order["userId"] ?>
                        <div class="my-2">
                            <p><b>ORDER ID: <?= $order["orderLabel"] ?></b></p>
                            <p><b>STATUS: <?= $order["status"] ?></b></p>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="ordered-items border rounded-4 my-2">
                                    <table class="table">
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
                                <?php
                                // GET user
                                $query = new users();
                                $users = $query->selectUser($userId);
                                ?>
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
                        <form action="../config/order.php" method="post" class="text-end my-3">
                            <input type="hidden" name="orderId" value="<?= $orderId ?>">
                            <button type="submit" class="btn btn-warning" name="approvePayment">Approve Order</button>
                        </form>
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