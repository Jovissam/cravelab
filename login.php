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
                        <div class="sign-up-form p-1 p-md-3 rounded-4">
                            <h1 class="text-center">Log In</h1>
                            <p class="text-center">Welcome back! please enter your details</p>
                            <p class="text-center text-danger"><?=$_SESSION["error"] ?? ""?></p>
                            <form action="config/login.php" method="post" class="flex flex-column p-2">

                                <label class="pt-3" for="email"><b>Email Address</b></label>
                                <input type="email" name="email" id="email" placeholder="email" class="p-2 border rounded-3">

                                <label class="pt-3" for="pwd"><b>Password</b></label>
                                <input type="password" name="password" id="pwd" placeholder="Password" class="p-2 border rounded-3">


                                <p class="text-end p-3">
                                    <b><a href="forgotPassword.html">Forgot password?</a></b>
                                </p>

                                <div class="d-grid gap-2">
                                    <button class="btn rounded-5" type="submit">Log In</button>
                                </div>
                            </form>
                            <p class="text-center p-3">Not A Member Yet? <b><a href="signup.php">Create Account</a></b></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$_SESSION["error"] = null;
?>