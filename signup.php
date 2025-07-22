<?php
session_start();
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
                <!-- nav bar -->
                        <!-- form section -->
        <section class="form-container pt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-6 d-none d-lg-block">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="assets/images/food/food1.jpeg" class="d-block w-100 rounded-4" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="assets/images/food/food2.jpeg" class="d-block w-100 rounded-4" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="assets/images/food/food3.jpeg" class="d-block w-100 rounded-4" alt="...">
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-6 offset-md-2 offset-lg-0">
                        <div class="sign-up-form overflow-y-scroll p-1 p-md-3 rounded-4">
                            <h1 class="text-center">Sign Up</h1>
                            <p class="text-center">Fill in your details to create An Account</p>
                            <p class="text-center text-danger"><?=$_SESSION["error"] ?? ""?></p>
                            <form action="config/signup.php" method="post" class="flex flex-column p-2">
                                <label class="pt-3" for="fullname"><b>Full name <span class="naira">*</span></b></label>
                                <input type="text" name="name" required id="fullname" placeholder="full name" class="p-2 border rounded-3">

                                <label class="pt-3" for="phoneNo"><b>Phone Number <span class="naira">*</span></b></label>
                                <input type="text" name="phoneNo" required id="phoneNo" placeholder="Phone Number" class="p-2 border rounded-3">

                                <label class="pt-3" for="email"><b>Email Address <span class="naira">*</span></b></label>
                                <input type="email" name="email" required id="email" placeholder="email" class="p-2 border rounded-3">

                                <label class="pt-3" for="pwd"><b>Password <span class="naira">*</span></b></label>
                                <input type="password" name="password" required id="pwd" placeholder="Password" class="p-2 border rounded-3">

                                <div class="flex py-1">
                                    <input type="checkbox" id="check1" class="form-check-input">
                                    <p class="pb-2 ms-2">password must be at least 8 chracters long</p>
                                </div>
                                <div class="flex py-">
                                    <input type="checkbox" id="check2" class="form-check-input">
                                    <p class="pb-2 ms-2">password must contain at least 1 number.</p>
                                </div>

                                <p class="text-center p-3">
                                    By clicking “Get Started”, you agree to the <br>
                                    <b><a href="">Terms of Use</a></b> and <b><a href="">Privacy Policy.</a></b>
                                </p>

                                <div class="d-grid gap-2">
                                    <button id="submit" disabled class="btn rounded-5" type="submit">sign up</button>
                                </div>
                            </form>
                            <p class="text-center p-3">Already Have An Account? <b><a href="login.php">Log in</a></b></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- main js -->
     <!-- <script src="assets/javaScript/main.js"></script> -->
    <!-- main js -->
     <script src="assets/javaScript/signup.js"></script>
</body>
</html>
<?php
$_SESSION["error"] = null;
?>