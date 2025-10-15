<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact us</title>
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
                        <li><a href="">Contact Us</a></li>
                        <li class="min-scr"><a href="cart.php">cart</a></li>
                        <li class="min-scr"><a href="">Favourite</a></li>
                    </ul>
                </div>
            </div>
            <div class="right-title">
                <span class="nav-cart"><a href="cart.php"><i class="fas fa-shopping-cart"></i></a></span>
                <span class="heart"><a href=""><i class="fas fa-heart"></i></a></span>
                <?php if (isset($_SESSION["user"])):?>
                    <span class="sign-up"><a href='profile.php'><b><?= $_SESSION["name"]?></b></a></span>
                    <?php else:?>
                        <span class="sign-up"><a href='signup.php'><i class='fas fa-user'></i></a></span>
                <?php endif?>
            </div>
        </nav>

        <!-- contact -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="contact-left p-1 my-2">
                            <p>Contact Us</p>
                            <h2>Ready To Contact Us?</h2>

                            <div class="contact-card flex align-items-center p-3 my-3">
                                <div class="contact-card-icon p-3 mx-2"><i class="fas fa-plus fa-2x"></i></div>
                                <div>
                                    <h6>location</h6>
                                    <p><b>No 56 Old Lagos Asaba Road Agbor Delta State</b></p>
                                </div>
                            </div>

                            <div class="contact-card flex align-items-center p-3 my-3">
                                <div class="contact-card-icon p-3 mx-2"><i class="fas fa-envelope fa-2x"></i></div>
                                <div>
                                    <h6>Email Address</h6>
                                    <p><b>joj573466@info.com</b></p>
                                </div>
                            </div>

                            <div class="contact-card flex align-items-center p-3 my-3">
                                <div class="contact-card-icon p-3 mx-2"><i class="fas fa-envelope fa-2x"></i></div>
                                <div>
                                    <h6>Phone Number</h6>
                                    <p><b>+2349075020441</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="contact-right my-2">
                            <h2>Send Us A Message</h2>
                            <form action="" class="flex flex-column">
                                <input type="text" placeholder="Your Name">
                                <input type="email" placeholder="Your Email">
                                <input type="text" placeholder="phone number">
                                <textarea name="message" placeholder="Your Message"></textarea>
                                <button class="p-2 rounded-3">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2938.408322978235!2d6.194502410249497!3d6.253636728263332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10414e3bfbe0183b%3A0x5c4bcf45dc94a106!2sMEGAMINDSET%20ICT%20SOLUTIONS!5e1!3m2!1sen!2sng!4v1748636609412!5m2!1sen!2sng" width="100%" height="500" style="border:0; border-radius: 10px; margin-top: 20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                    &copy;copyright <?php echo date("Y")?> designed by <a class="f1" href="">jovinci</a>
                </div>
            </div>
        </footer>
    </main>

    <!-- main js -->
    <script src="assets/javaScript/main.js"></script>
</body>
</html>
