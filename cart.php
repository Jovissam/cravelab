<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>order cart</title>
    <!-- header font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Permanent+Marker&display=swap"
        rel="stylesheet" />
    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.css" />
    <!-- css stylesheet -->
    <link rel="stylesheet" href="style.css" />
    <!-- food images -->
    <link rel="stylesheet" href="assets/css/food.css" />
    <!-- responsive -->
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" />
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
                        <li class="min-scr active-nav"><a href="">cart</a></li>
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
        <!-- cart section -->
        <section>
            <div class="container">
                <div class="flex flex-column justify-content-between">
                    <div>
                        <a href="menu.php">
                            <i class="fas fa-arrow-left"></i>
                            <span class="ps-2"><b>Back To Products</b></span></a>
                    </div>
                    <h1 class="my-3">Review Your Cart</h1>
                    <p id="cartLength"></p>
                    <!-- cart container -->

                    <div id="cartList" class="cart-container flex flex-column">
                        <!-- dynamic cart items will be inserted here -->
                    </div>

                    <!-- cart total -->
                    <div class="cart-total flex justify-content-between align-items-center">
                        <h3 class="total">Total</h3>
                        <div class="flex">
                            <p class="pe-2">Total Amount</p>
                            <h5 id="totalAmount"></h5>
                        </div>
                    </div>
                    <!-- checkout button -->
                    <div class="checkout-btn flex justify-content-center mb-3">

                        <?php if (isset($_SESSION["user"])): ?>
                            <form action="config/checkout.php" method="post">
                                <div id="checkoutBtn"></div>
                            </form>
                        <?php else: ?>
                            <button id="checkoutBtn" class="btn color1"><a href="login.php">Checkout</a></button>
                        <?php endif ?>
                        <button id="clearCart" class="btn btn-danger ms-2">Clear Cart</button>
                    </div>


                </div>
        </section>
        <!-- footer -->
        <footer class="w-100">
            <div class="footer-top flex justify-content-between align-items-center px-4">
                <h2 class="footer-title logo">CRAVELAB</h2>
                <div>
                    <i class="fab fa-whatsapp"></i><span class="address">09075020441</span> <i
                        class="fa fa-store"></i><span class="address">info@craavelab.com</span>
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
                        <p class="f1">
                            <a class="f1" href="contact-us.php">Contact Us</a>
                        </p>
                        <p class="f1"><a class="f1" href="">Privacy</a></p>
                        <p class="f1"><a class="f1" href="">SignUp/login</a></p>
                    </div>
                    <div class="footer-details">
                        <h3 class="f2">OUR ADDRESS</h3>
                        <p class="f1">
                            No 56 Old Lagos Asaba Road <br />
                            Agbor Delta State
                        </p>
                    </div>
                    <div class="footer-details">
                        <h3 class="f2">OUR ACTIVE HOURS</h3>
                        <p class="f1">
                            Monday-Sunday <br />
                            7am-11pm
                        </p>
                    </div>
                </div>
                <hr />
                <div id="copyright" class="text-center">
                    &copy;copyright <?php echo date("Y") ?> designed by <a class="f1" href="">jovinci</a>
                </div>
            </div>
        </footer>
    </main>

    <!-- main js -->
    <script src="assets/javaScript/main.js"></script>

    <!-- cart js -->
    <script src="assets/javaScript/cart.js"></script>
</body>

</html>