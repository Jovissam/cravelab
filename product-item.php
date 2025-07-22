<?php
session_start();
require_once("class/products.php");
require_once("class/feedback.php");
$key = $_GET["id"];
$query = new Product();
$result = $query->view($key);

$feed = new Feedback();
$reviews = $feed->getFeedback($key);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cravelab - Product</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Permanent+Marker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome/css/all.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/css/food.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
</head>

<body>
    <div id="prompt"></div>
    <main id="main" class="menuMain">
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
                        <li><a href="contact-us.html">Contact Us</a></li>
                        <li class="min-scr"><a href="cart.php">Cart</a></li>
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
            <?php if ($result->num_rows > 0): ?>
                <?php while ($productView = $result->fetch_assoc()): ?>
                    <?php $data[] = $productView; ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-8 offset-md-2">
                                <div class="product-details">
                                    <div class="food-img" style="background-image: url(<?= $productView["image"] ?>);">
                                        <i onclick="addToFavourite(<?= $productView['id'] ?>)" class="far fa-heart fa-4x"></i>
                                    </div>
                                    <div class="flex justify-content-between align-items-center flex-wrap py-3">
                                        <h2><?= $productView["name"] ?></h2>
                                        <span class="rating"><i class="fas fa-star"></i>5.4 (<?= rand(1,13)?>)</span>
                                    </div>
                                    <p><?= $productView["description"] ?></p>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button onclick="addToCart(<?= $productView['id'] ?>)" type="button" class="btn color1 ">Add To cart</button>
                                    </div>
                                    <div class="review pt-5">
                                        <div class="flex align-items-center justify-content-between flex-wrap mb-3">
                                            <?php if (isset($_SESSION["user"])): ?>
                                                <div>
                                                    <h6>Write A Review</h6>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                                <form action="config/feedback.php" method="post" class="flex justify-content-between review-form">
                                                    <input type="hidden" name="productId" value="<?= $productView['id'] ?>">
                                                    <input type="hidden" name="senderName" value="<?= $_SESSION["name"] ?>">
                                                    <input type="text" name="message" maxlength="100" placeholder="Write A Review">
                                                    <button type="submit" class="color1 rounded-4 px-3 mx-1">Send</button>
                                                </form>
                                            <?php else: ?>
                                                <h6>Reviews</h6>
                                            <?php endif ?>
                                        </div>

                                        <div class="user-review">
                                            <?php if ($reviews->num_rows > 0): ?>
                                                <?php while ($review = $reviews->fetch_assoc()): ?>
                                                    <div class="write-review py-2 px-3">
                                                        <div class="flex justify-content-between align-items-center">
                                                            <p><b><?= $review["senderName"] ?></b></p>
                                                            <small><?= $review["date"] ?></small>
                                                        </div>
                                                        <p class="review-content py-2"><?= $review["message"] ?></p>
                                                    </div>
                                                <?php endwhile ?>
                                            <?php endif ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile ?>
            <?php else: ?>
                <h4 class="text-center">no product available</h4>
            <?php endif ?>
        </section>

        <footer class="w-100 mt-2">
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
                <div id="copyright" class="text-center">&copy;copyright <?php echo date("Y") ?> designed by <a class="f1" href="">jovinci</a></div>
            </div>
        </footer>
    </main>
    <script src="assets/javaScript/main.js"></script>
    <script>
        const productItem = <?php echo json_encode($data ?? []) ?>
    </script>
    <script src="assets/javaScript/product.js"></script>
</body>

</html>