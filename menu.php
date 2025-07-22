<!-- <pre> -->
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
?>
<!-- </pre> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cravelab | Menu</title>
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
    <main id="main" class="menuMain">
        <div id="prompt"></div>
        <nav id="nav-container" class="flex justify-content-between position-sticky align-items-center">
            <div class="left-title-flip flex">
                <div class="title-logo">
                    <h2 class="logo"><a href="index.php">CRAVELAB</a></h2>
                </div>
                <div class="navlinks flex">
                    <button id="mobile-navToogle"><i class="fas fa-bars"></i></button>
                    <ul class="left-title flex fw-bold pt-1">
                        <li><a href="index.php">Home</a></li>
                        <li class="active-nav"><a href="">Menu</a></li>
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

        <section id="menu-container" class="flex">
            <section class="filter-sectionLeft p-3">
                <p class="filterTitle my-4">Filters</p>
                <h4 class="my-4">Filter by Price</h4>
                <div class="flex price-rangeFilter justify-content-between mb-5 mt-2">
                    <div class="price-filter">
                        <p><small>Minimum</small></p>
                        <span class="flex"> &#8358;<input type="number"></span>
                    </div>
                    <div class="price-filter">
                        <p><small>Maximum</small></p>
                        <span class="flex"> &#8358;<input type="number"></span>
                    </div>
                </div>

                <h4>Filter By Categories</h4>
                <label id="allFoodsFilter" for="allFood" class="category-filter flex">
                    <span class="flex">
                        <img src="assets/images/icon/food.png" alt="">
                        <p>All Food</p>
                    </span>
                    <input onclick="oneCheckbox(this)" checked type="checkbox"  id="allFood" class="checkbox form-check-input">
                </label>

                <label id="burgerDisplay" for="burger" class="category-filter flex">
                    <span class="flex">
                        <img src="assets/images/icon/burger.png" alt="">
                        <p>Burgers</p>
                    </span>
                    <input onclick="oneCheckbox(this)" type="checkbox" id="burger" class="checkbox form-check-input">
                </label>

                <label id="drinkFilter" for="drinks" class="category-filter flex">
                    <span class="flex">
                        <img src="assets/images/icon/drink.png" alt="">
                        <p>Drinks</p>
                    </span>
                    <input onclick="oneCheckbox(this)" type="checkbox" id="drinks" class="checkbox form-check-input">
                </label>
            </section>

            <section class="foodMenu-section p-3">
                <div class="product-title flex justify-content-between align-items-center">
                    <h2>Products</h2>
                    <button class="filterToogle"><i class="fas fa-sliders-h"></i><span> Filters</span>
                        <div class="mobile-toogle">
                            
                            <h3>Filter By Categories</h3>

                            <label id="allFoodsFilter" for="allFood" class="category-filter flex">
                                <span class="flex">
                                    <img src="assets/images/icon/food.png" alt="">
                                    <p>All Food</p>
                                </span>
                                <input onclick="oneCheckbox(this)" checked type="checkbox" id="allFood" class="form-check-input">
                            </label>

                            <label id="burgerDisplay" for="burger" class="category-filter flex">
                                <span class="flex">
                                    <img src="assets/images/icon/burger.png" alt="">
                                    <p>Burgers</p>
                                </span>
                                <input onclick="oneCheckbox(this)" type="checkbox" id="burger" class="form-check-input">
                            </label>

                            <label id="drinkFilter" for="drinks" class="category-filter flex">
                                <span class="flex">
                                    <img src="assets/images/icon/drink.png" alt="">
                                    <p>Drinks</p>
                                </span>
                                <input onclick="oneCheckbox(this)" type="checkbox" id="drinks" class="form-check-input">
                            </label>
                        </div>
                    </button>
                </div>

                <div class="productsSearch flex justify-content-between align-items-center my-4">
                    <div class="product-search">
                        <i class="fas fa-search"></i>
                        <input oninput="searchForProducts(this)" id="searchProducts" type="search" placeholder="Search For Products...">
                    </div>
                    <div class="defaultFilter mt-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort By
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li id="sort1"><a class="dropdown-item" href="#">Price(low to high)</a></li>
                                <li id="sort2"><a class="dropdown-item" href="#">Price(high to low)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="ProductList" class="product-menuContainer flex flex-wrap justify-content-evenly overflow-y-scroll">
                    <!-- Products will be injected here by JS -->
                </div>
            </section>
        </section>

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
                <div id="copyright" class="text-center">&copy;copyright <?php echo date("Y")?> designed by <a href="">jovinci</a></div>
            </div>
        </footer>
    </main>

    <script>
        const products = <?php echo json_encode($data ?? []); ?>;
    </script>
    <script src="assets/javaScript/main.js"></script>
    <script src="assets/javaScript/menu.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
