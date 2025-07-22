<?php
session_start();
require("../class/products.php");
$data = new category();
$category = $data->all()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <!-- header font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Permanent+Marker&display=swap" rel="stylesheet">

    <!-- bootstrap -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">

    <!-- fontawesome -->
    <link rel="stylesheet" href="../assets/css/fontawesome/css/all.css">

    <!-- css stylesheet -->
    <link rel="stylesheet" href="../style.css">

    <!-- food images -->
    <link rel="stylesheet" href="../assets/css/food.css">

    <!-- responsive -->
    <link rel="stylesheet" href="../assets/css/responsive.css">

</head>

<body>
    <main id="main" class="dash-board">
        <div class="container">
            <nav class="navbar bg-body-tertiary fixed-top navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <h2 class="logo"><a href="#">CRAVELAB</a></h2>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                                <h2 class="logo"><a href="#">CRAVELAB</a></h2>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                                <li class="nav-item active-nav">
                                    <a class="nav-link active fw-bold" aria-current="page" href="#">DashBoard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link fw-bold" href="products.php">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  fw-bold" aria-current="page" href="feedbacks.php">FeedBack</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container mt-5 pt-5">
                <h1 class="text-center">Admin Dashboard</h1>
                <div class="row mt-4">
                    <div class="col-md-4 py-2">
                        <div class="card dash-card">
                            <div class="card-body">
                                <h5 class="card-title color2">Total Products</h5>
                                <p class="card-text"><span class="dash-card">100</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 py-2">
                        <div class="card dash-card">
                            <div class="card-body dash-card">
                                <h5 class="card-title color2">Total Orders</h5>
                                <p class="card-text">50</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 py-2">
                        <div class="card dash-card">
                            <div class="card-body">
                                <h5 class="card-title color2">Total Users</h5>
                                <p class="card-text">200</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <h2>Recent Orders</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>User</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>ORD12345</td>
                                    <td>sammy</td>
                                    <td>#100.00</td>
                                    <td>pending</td>
                                </tr>
                                <!-- More rows as needed -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="container">
            <h1 class="text-center">Add New Products</h1>
            
            <div class="row">
                <div class="col-md-10 offset-md-1 mb-3">
                    
                </div>
            </div>
        </div>

        <!-- footer -->
        <footer class="w-100">
            <div class="footer-bottom">
                <div id="copyright" class="text-center">&copy;copyright <?php echo date("Y") ?> designed by <a href="">jovinci</a></div>
            </div>
        </footer>
        </div>
    </main>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
