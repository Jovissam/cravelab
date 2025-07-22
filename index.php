<?php
session_start();
require ("class/products.php");

$query = new Product();
$products = $query->all();
$data = [];

if ($products->num_rows > 0) {
    while ($rows = $products->fetch_assoc()) {
        $data[] = $rows;
    }
}
// print_r($_SERVER);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cravelab</title>
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
    <main id="main">
        <div id="prompt"></div>
        <!-- nav bar -->
        <nav id="nav-container" class="flex justify-content-between position-sticky align-items-center">
            <div class="left-title-flip flex">
                <div class="title-logo">
                    <h2 class="logo"><a href="index.php">CRAVELAB</a></h2>
                </div>
                <div class="navlinks flex">
                    <button id="mobile-navToogle"><i class="fas fa-bars"></i></button>
                    <ul class="left-title flex fw-bold pt-1">
                        <li class="active-nav"><a href="">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="contact-us.php">Contact Us</a></li>
                        <li class="min-scr"><a href="cart.php">cart</a></li>
                        <li class="min-scr"><a href="favorite.php">Favourite</a></li>
                    </ul>
                </div>
            </div>
            <div class="right-title">
                <span class="nav-cart"><a href="cart.php"><i class="fas fa-shopping-cart"></i></a></span>
                <span class="heart"><a href="favorite.php"><i class="fas fa-heart"></i></a></span>
                <?php if (isset($_SESSION["user"])):?>
                    <span class="sign-up"><a href='profile.php'><b><?= $_SESSION["name"]?></b></a></span>
                    <?php else:?>
                        <span class="sign-up"><a href='signup.php'><i class='fas fa-user'></i></a></span>
                <?php endif?>
            </div>
        </nav>      

        <!-- header section -->
        <header id="header-container">
            <div id="display-section" class="flex mt-5">
                <div class="display-left ps-4">
                    <button class="display-left1 white">Hungry?</button>
                    <h3 class="display-left2">JUST COME TO CRAVELAB & ORDER</h3>
                    <p class="display-left3">CRAVELAB is your go-to destination for delicious food experiences! Order Now To satisfy Your Cravings</p>
                    
                    <div class="display-left-down flex justify-content-between my-5">
                        <div class="display-left4"><a href="">Order Now</a></div>
                        <div class="display-left5"><a href="menu.php">Explore More &#8594;</a></div>
                    </div>
                </div>
                <div class="display-right flex justify-content-between align-items-center flex-wrap">
                    <img class="banner" src="assets/images/banner/banner4.png" alt="">
                    <img class="banner" src="assets/images/banner/banner5.png" alt="">
                    <img class="banner" src="assets/images/banner/banner6.png" alt="">
                    <img class="banner" src="assets/images/banner/banner4.png" alt="">
                </div>
            </div>
        </header>

        <section>
            <div id="foodDisplay" class="food-list flex justify-content-between align-items-center py-1 mx-2">
                <!-- food cards -->
                <!-- <div class="food-card">
                    <a href="product-Item.php">
                        <div class="food-img food2"><i class="fas fa-heart fa-4x"></i></div>
                        <div class="food-name">Grilled hamburger</div>
                        <div class="food-details">
                            <span class="rating"><i class="fas fa-star"></i> 5.4 (32)</span>
                            <span class="food-price"><span class="naira">&#8358;</span> 20,000.00</span>
                        </div>
                        <div class="food-purchase">
                            <button class="add-to-cart"><span class="naira">+</span> Add To Cart</button>
                            <button class="buy-now"><a href=""><span>Buy Now</span></a></button>
                        </div>
                    </a>
                </div> -->
            </div>

            <div class="view-all-food"><span class="view-food-btn"><a href="menu.php">View All Foods</a></span></div>

            <!-- why choose us -->
            <div id="choose-us" class="center py-3">
                <h1 class="subtitle2 fs-1">WHY CHOOSE US</h1>
                <p>Freshly Prepared Meals by Passionate Chefs, Fast Delivery With Quality, Taste,<br> And Your Satisfaction At Heart</p>
                
                <div class="proof flex justify-content-evenly flex-wrap">
                    <div class="choose-us-card">
                        <img class="choose-us-img" src="assets/images/icon/dinner.png" alt="">
                        <h2 class="subtitle2-1">Serve Healthy Food</h2>
                        <p>Nourishing meals made with fresh, natural ingredients crafted to fuel your body.</p>
                    </div>
                    <div class="choose-us-card">
                        <img class="choose-us-img" src="assets/images/icon/best-seller.png" alt="">
                        <h2 class="subtitle2-1">Best Quality</h2>
                        <p>Hot, fresh meals delivered to your doorstep — fast, reliable, and always on time.</p>
                    </div>
                    <div class="choose-us-card">
                        <img class="choose-us-img" src="assets/images/icon/delivery.png" alt="">
                        <h2 class="subtitle2-1">Fast Delivery</h2>
                        <p>Hot, fresh meals delivered to your doorstep — fast, reliable, and always on time.</p>
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
                        <p class="f1"><a class="f1" href="signup.php">SignUp/login</a></p>
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
                    &copy;copyright <?php echo date("Y")?> designed by <a class="f1" href="">jovinci</a>
                </div>
            </div>
        </footer>
    </main>

    <!-- main js -->
    <script src="assets/javaScript/main.js"></script>

    <!-- products -->
     <script>
        const products = <?php echo json_encode(array_slice($data, 0) ?? []); ?>;
    </script>

    <script src="assets/javaScript/index.js"></script>
</body>
</html>
