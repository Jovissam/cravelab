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
                        <div class="sign-up-form p-1 p-md-3 rounded-4">
                            <h1 class="text-center">Forgot Password?</h1>
                            <p class="text-center">No worries, we'll send you reset instructions.</p>
                            <form action="" class="flex flex-column p-2">

                                <label class="pt-4" for="email"><b>Email Address</b></label>
                                <input type="email" id="email" placeholder="email" class="p-2 border rounded-3">

                                <div class="d-grid gap-2 my-4">
                                    <button class="btn rounded-5" type="submit">Log In</button>
                                </div>
                            </form>
                            <p class="text-center p-3"><b><a href="login.php"><i class="fas fa-arrow-left    "></i> 
                            Back To Login
                            </a></b></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>