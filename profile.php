<!-- <pre> -->
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
} else {
    return header("location:index.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile home</title>
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

        <section>
            <div class="row">
                <div class="col-12">
                    <div class="profile-nav flex align-items-center justify-content-center py-2">
                        <h6 class="active-nav"><b><a href="">Profile-home</a></b></h6>
                        <h6 class="px-3"><b><a href="profile-settings.php">Profile Settings</a></b></h6>
                        <h6 class=""><b><a href="config/logout.php">Logout</a></b></h6>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact -->

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="profile-home my-3">
                            <h2 class="logo text-center">Your CraveLab Profile</h2>
                            <p class="text-center"><i>manage And Edit Your profile</i></p>

                            <div class="border m-2 pb-2">
                                <h5 class="color1 p-1 px-2">Profile Settings</h5>
                                <div class="row">
                                    <div class="col-8">
                                        <p class="ps-1">Review and manage your saved personal info, and addresses</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="naira"><a href="profile-settings.php"><b>view | Edit</b></a></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <?php if ($user->num_rows > 0): ?>
                                            <?php while ($data = $user->fetch_assoc()): ?>
                                                <div class="profile-info px-2 my-2">
                                                    <h6><b>Your Information</b></h6>
                                                    <p><?= $data["name"]?></p>
                                                    <p><?= $data["email"]?></p>
                                                    <p><?= $data["phoneNo"]?></p>
                                                </div>
                                            <?php endwhile ?>
                                        <?php endif ?>

                                    </div>

                                    <div class="col-12 col-sm-7">
                                        <?php if ($userAddress->num_rows > 0): ?>
                                            <?php while ($data = $userAddress->fetch_assoc()): ?>
                                                <div class="profile-info my-2">
                                                    <h6><b>Primary Address</b></h6>
                                                    <p><?= $data["state"]?></p>
                                                    <p><?= $data["city"]?></p>
                                                    <p><?= $data["homeAddress"]?></p>
                                                </div>
                                            <?php endwhile ?>
                                            <?php else : ?>
                                                <h6><b>No Address yet</b></h6>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>

                            <div class="border m-2 pb-2">
                                <h5 class="color1 p-1 px-2">email offers</h5>
                                <div class="row">
                                    <div class="col-8">
                                        <p class="ps-1"> Review your Cravelab subscription status:</p>
                                    </div>
                                    <div class="col-4">
                                        <p class="naira"><a href="profile-settings.php"><b>view | Edit</b></a></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-7 offset-md-1 ">
                                        <div class="newsletter flex align-items-center justify-content-center mt-2">
                                            <i class="p-2 border border-3 rounded-circle mx-2     fas fa-envelope    "></i>
                                            <h5><i>Receive Email Offers</i></h5>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="profile-info flex justify-content-center mt-2">
                                            <div class="newsletter-toogle flex justify-content-between">
                                                <i class="fas fa-check"></i>
                                                <p><b>yes</b></p>
                                                <p><b>no</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-white text-end my-1">
                    <button class="naira rounded-4 pt-2 px-2">
                        <a href="config/logout.php">
                            <h5><a href="config/logout.php">Log out</a></h5>
                        </a>
                    </button>
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