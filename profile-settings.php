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

    $i = 1;
} else {
    return header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile settings</title>
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
        <div id="prompt"></div>
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
                <span class="heart"><a href="favorite.php"><i class="fas fa-heart"></i></a></span>
                <?php if (isset($_SESSION["user"])): ?>
                    <span class="sign-up"><a href='profile.php'><b><?= $_SESSION["name"] ?></b></a></span>
                <?php else: ?>
                    <span class="sign-up"><a href='signup.php'><i class='fas fa-user'></i></a></span>
                <?php endif ?>
            </div>
        </nav>

        <section class="profile-nav">
            <div class="flex align-items-center justify-content-center py-2">
                <h6 class=""><b><a href="profile.php">Profile-home</a></b></h6>
                <h6 class="active-nav px-3"><b><a href="#">Profile Settings</a></b></h6>
                <h6 class=""><b><a href="config/logout.php">Logout</a></b></h6>
            </div>
        </section>
        <!-- contact -->
        <section>
            <?php if ($user->num_rows > 0): ?>
                <?php while ($data = $user->fetch_assoc()): ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="profile-home my-3">
                                    <h2 class="logo text-center">Profile Settings</h2>
                                    <p class="text-center"><i>Easily manage your profile settings right from this page.</i></p>
                                    <p class="text-center text-danger"><?= $_SESSION["error"] ?? "" ?></p>
                                    <p class="text-center text-success"><?= $_SESSION["success"] ?? "" ?></p>

                                    <div class="border m-2 pb-2">
                                        <h5 class="color1 p-1 px-2">My Profile Settings</h5>

                                        <div class="row">
                                            <div class="col-9">
                                                <div class="user-info">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <ul>
                                                                <li>Name:</li>
                                                                <li>Email Address:</li>
                                                                <li>Primary Phone Number:</li>
                                                                <li>Password:</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-6">
                                                            <ul>
                                                                <li><?= $data["name"] ?></li>
                                                                <li><?= $data["email"] ?></li>
                                                                <li><?= $data["phoneNo"] ?></li>
                                                                <li><b class="text-danger">Change</b></li>
                                                            </ul>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <b class="naira">Edit</b>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="config/user.php" method="post" class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel"><i>Edit Your Profile</i></h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="flex flex-column p-2">
                                                                    <input type="hidden" name="id" value="<?= $data["id"] ?>">
                                                                    <label class="pt-2" for="fullname"><b>Name <span class="naira">*</span></b></label>
                                                                    <input type="text" name="name" value="<?= $data["name"] ?>" id="fullname" placeholder="full name" class="p-1 px-2 border rounded-3">

                                                                    <label class="pt-2" for="phoneNo"><b>Phone Number <span class="naira">*</span></b></label>
                                                                    <input type="text" name="phoneNo" value="<?= $data["phoneNo"] ?>" id="phoneNo" placeholder="Phone Number" class="p-1 px-2 border rounded-3">

                                                                    <label class="pt-2" for="email"><b>Email Address <span class="naira">*</span></b></label>
                                                                    <input type="email" name="email" id="email" value="<?= $data["email"] ?>" placeholder="email" class="p-1 px-2 border rounded-3">

                                                                    <label class="pt-2" for="confirm-email"><b>Confirm Email Address <span class="naira">*</span></b></label>
                                                                    <input type="email" name="confirmEmail" value="<?= $data["email"] ?>" id="confirm-email" placeholder="Password" class="p-1 px-2 border rounded-3">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn rounded-5 btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button name="updateUserProfile" type="submit" class="btn rounded-5 color1">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="border m-2 pb-2">
                                        <h5 class="color1 p-1 px-2">Address Information</h5>
                                        <?php if ($userAddress->num_rows > 0): ?>
                                            <?php while ($address = $userAddress->fetch_assoc()): ?>
                                                <div class="row">
                                                    <div class="col-9">
                                                        <div class="user-info">
                                                            <div class="row">
                                                                <div class="col-12 col-md-5 align-items-center flex">
                                                                    <div class="flex ps-3">
                                                                        <input class="checkbox" onclick="oneCheckbox(this)" type="radio" name="" id="">
                                                                        <h6 class="ps-2">Address <?= $i++ ?> <br>
                                                                            <?php if ($address["defaultAddress"] == "true"): ?>
                                                                                <small>(Default Address)</small>
                                                                            <?php endif ?>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6">
                                                                    <ul>
                                                                        <li><?= $address["state"] ?></li>
                                                                        <li><?= $address["city"] ?></li>
                                                                        <li><?= $address["homeAddress"] ?></li>
                                                                        <li><?= $address["additionalInformation"] ?></li>
                                                                        <small id="defaultBtn" onclick="makeDefault(<?= $address['id'] ?>, <?= $address['userId'] ?>)" type="button" class="naira"><b>Make Default</b></small>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <p class="naira"><a href="config/address.php?id=<?= $address["id"] ?>"><b>remove</b></a></p>
                                                    </div>
                                                </div>
                                            <?php endwhile ?>
                                        <?php else : ?>
                                            <h6><b>No Address yet</b></h6>
                                        <?php endif ?>

                                        <div>
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                            <p><b>Add Address</b></p>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="sign-up-formp-1 p-md-3 rounded-4">
                                                                <form action="config/address.php" method="post" class="flex flex-column p-2">
                                                                    <input type="hidden" name="id" value="<?= $data["id"] ?>">
                                                                    <label class="pt-3" for="state"><b>State <span class="naira">*</span></b></label>
                                                                    <input type="text" name="state" id="state" placeholder="state" class="p-2 border rounded-3">

                                                                    <label class="pt-3" for="city"><b>City<span class="naira">*</span></b></label>
                                                                    <input type="text" name="city" id="city" placeholder="Your City" class="p-2 border rounded-3">

                                                                    <label class="pt-3" for="address"><b>Home Address <span class="naira">*</span></b></label>
                                                                    <input type="text" name="homeAddress" id="address" placeholder="Your Address" class="p-2 border rounded-3">

                                                                    <label class="pt-3" for="additionalinfo"><b>Additional Information<span class="naira">*</span></b></label>
                                                                    <input type="text" name="additionalInformation" id="additionalinfo" placeholder="Additional Information" class="p-2 border rounded-3">
                                                                    <div class=" gap-2">
                                                                        <button name="addAddress" class="btn rounded-5 color1 my-2" type="submit">Add Address</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="text-white text-end my-1">
                            <button class="color1 rounded-5 pt-2 px-2">
                                <a href="menu.html">
                                    <h6>ORDER NOW</h6>
                                </a>
                            </button>
                        </div>
                    </div>
                <?php endwhile ?>
            <?php endif ?>
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
    <script src="assets/javaScript/profile.js"></script>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?= $_SESSION["error"] = "" ?>
<?= $_SESSION["success"] = "" ?>