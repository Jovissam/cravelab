<?php
session_start();
if (isset($_SESSION["user"])) {
    // USER INFO
    require("class/users.php");
    $email = $_SESSION["email"];
    $query1 = new users();
    $user = $query1->selectUser($email);

    // ADDRESS INFO
    $query2 = new Address();
    $userAddress = $query2->getAddress($email);
    $noDefault = null;
} else {
    return header("location:index.php");
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
        <!-- nav section -->
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
        </nav>

        <!-- favourite section -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="flex flex-column justify-content-between mt-3">
                            <div><a href="menu.php">
                                    <i class="fas fa-arrow-left"></i>
                                    <span class="ps-2"><b>Back To Products</b></span></a>
                            </div>
                            <h1 class="my-3">Check Out</h1>
                            <p id="favLength"></p>

                            <div class="recipient-info border-bottom pb-3">
                                <h5>Recipient Information</h5>
                                <?php if ($user->num_rows > 0): ?>
                                    <?php while ($data = $user->fetch_assoc()): ?>
                                        <div class="flex">
                                            <i class="mt-2 fas fa-user    "></i>
                                            <p class="fs-5 ms-2"><?= $data["name"] ?></p>
                                        </div>
                                        <div class="flex">
                                            <i class="mt-2 fas fa-phone"></i>
                                            <p class="fs-5 ms-2"><?= $data["phoneNo"] ?></p>
                                        </div>
                                        <div class="flex">
                                            <i class="mt-2 fas fa-envelope    "></i>
                                            <p class="fs-5 ms-2"><?= $data["email"] ?></p>
                                        </div>
                                    <?php endwhile ?>
                                <?php endif ?>
                            </div>
                            <div class="address-info border-bottom py-3">
                                <h5>Address Information</h5>
                                <?php if ($userAddress->num_rows > 0): ?>
                                    <?php while ($data = $userAddress->fetch_assoc()): ?>
                                        <?php if ($data["defaultAddress"] == "true"): ?>
                                            <?php $noDefault = true ?>
                                            <div class="flex">
                                                <i class="mt-2 fas fa-map-marker-alt    "></i>
                                                <p class="fs-5 ms-2"><?= $data["homeAddress"] ?>, <?= $data["city"] ?>, <?= $data["state"] ?>.</p>
                                            </div>
                                        <?php endif ?>
                                    <?php endwhile ?>
                                    <?php if (!$noDefault): ?>
                                        <div class="d-grid gap-2">
                                            <button id="submit" class="btn rounded-5 color1" type="button"><a href="profile-settings.php">Add Address</a></button>
                                        </div>
                                    <?php endif ?>
                                <?php else : ?>
                                    <h6><b>No Address yet</b></h6>
                                <?php endif ?>
                            </div>

                            <div class="payment-info border-bottom py-3">
                                <h5>Payment Information</h5>

                            </div>

                            <div class="orders-total border-bottom py-3">
                                <div class="flex justify-content-between my-2">
                                    <p class="fs-5">SubTotal</p>
                                    <p class="fs-5 ms-2"><span class="naira">&#8358;</span>200,00</p>
                                </div>
                                <div class="flex justify-content-between my-2">
                                    <p class="fs-5">Delivery Fee</p>
                                    <p class="fs-5 ms-2"><span class="naira">&#8358;</span>200,00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="footer-details-container flex justify-content-evenly">
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
                <div id="copyright" class="text-center">
                    &copy;copyright <?php echo date("Y") ?> designed by <a class="f1" href="">jovinci</a>
                </div>
            </div>
        </footer>
    </main>

    <!-- main js -->
    <script src="assets/javaScript/main.js"></script>

</body>

</html>