<?php
require_once("class/Order.php");
require_once("class/paymentMethod.php");
session_start();
if (isset($_SESSION["user"]) && isset($_SESSION["orderId"])) {
    $orderId = $_SESSION["orderId"];
    $userId = $_SESSION["userId"];
    // GET ORDER INFO
    $order = new Order();
    $getOrder = $order->getOrder($orderId);

    if ($getOrder->num_rows > 0) {
        while ($rows = $getOrder->fetch_assoc()) {
            $orderLabel = $rows["orderLabel"];
            $total = number_format($rows["totalPrice"], 2);
            $paymentMethod = $rows["paymentMethod"];
            $paymentId = $rows["paymentId"];
        }
    } else {
        return header("location:../menu.php");
    }

    $payments = new PaymentMethod();
    $payment = $payments->getPaymentMethod($paymentId);
} else {
    return header("location:../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- header font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Permanent+Marker&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.css">
    <!-- css stylesheet -->
    <link rel="stylesheet" href="style.css">
    <!-- food images -->
    <link rel="stylesheet" href="assets/css/food.css">
    <!-- responsive -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
</head>

<body>
    <main id="main" class="menuMain">
        <!-- nav section
        <nav id="nav-container" class="flex justify-content-between position-sticky align-items-center">
            <div class="left-title-flip flex">
                <div class="title-logo">
                    <h2 class="logo"><a href="index.php">CRAVELAB</a></h2>
                </div>
                <div class="navlinks flex">
                    <button id="mobile-navToogle"><i class="fas fa-bars"></i></button>
                    <ul class="left-title flex fw-bold pt-1">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="contact-us.php">Contact Us</a></li>
                        <li class="min-scr"><a href="cart.php">cart</a></li>
                        <li class="min-scr"><a href="">Favourite</a></li>
                    </ul>
                </div>
            </div>
            <div class="right-title">
                <span class="nav-cart"><a href="cart.php"><i class="fas fa-shopping-cart"></i></a></span>
                <span class="heart active-nav"><a href=""><i class="fas fa-heart"></i></a></span>
                <?php if (isset($_SESSION["user"])): ?>
                    <span class="sign-up"><a href='profile.php'><b><?= $_SESSION["name"] ?></b></a></span>
                <?php else: ?>
                    <span class="sign-up"><a href='signup.php'><i class='fas fa-user'></i></a></span>
                <?php endif ?>
            </div>
        </nav> -->

        <!-- payment section -->
        <section>
            <div class="container">
                <p class="text-center text-danger"><?= $_SESSION["error"] ?? "" ?></p>
                <p class="text-center text-success"><?= $_SESSION["success"] ?? "" ?></p>
                <div class="row">

                    <div id="order-display" class="col-12 col-md-6 offset-md-3">
                        <div class="flex flex-column justify-content-between mt-5">
                            <ul id="pay-order-details">
                                <li>Order Id: <?= $orderLabel ?></li>
                                <li>Total: <?= $total ?></li>
                                <li>Payment Method: <?= $paymentMethod ?></li>
                            </ul>
                            <div class="checkout-btn flex justify-content-center my-3">
                                <button id="payment-trigger" class='btn color1'>Pay Now</button>
                            </div>
                        </div>
                    </div>
                    <div id="payment-display" class="d-none col-12 col-md-6 offset-md-3 rounded border py-2 pt-4">
                        <form action="config/payment.php" method="post" enctype="multipart/form-data">
                            <?php if ($payment->num_rows > 0): ?>
                                <?php while ($info = $payment->fetch_assoc()): ?>
                                    <div class="text-center">
                                        <p class="d-inline">Account Number:
                                        <h5 class="d-inline"><button type="button" id="accNo"><?= $info["accountNo"] ?></button></h5><small id="copy-state" class="ms-1">(Tap to copy)</small>
                                        </p>
                                        <p>Account Name: <?= $info["accountName"] ?></p>
                                        <p>Bank Name: <?= $info["name"] ?></p>
                                        <p>Ammount: <b><?= $total ?></b></p>
                                        <input type="hidden" name="orderId" value="<?= $orderId ?>">
                                    </div>
                                    <div class="my-3 ">
                                        <label for="input1" class="form-label">Add A screenshot of your payment<span class="naira">*</span></label>
                                        <input name="paymentUpload" class="form-control" type="file" id="input1">
                                    </div>
                                    <div class="text-center">
                                        <button name="payment" type="submit" class="btn color1 mx-1">I have made Payment</button>
                                        <button id="close" type="button" class="btn btn-warning">close</button>
                                    </div>
                                <?php endwhile ?>
                            <?php endif ?>
                        </form>
                    </div>
                </div>
            </div>
        </section>


    </main>

    <!-- main js -->
    <script src="assets/javaScript/payment.js"></script>

</body>

</html>
<?php
$_SESSION["success"] = "";
$_SESSION["error"] = "";
?>