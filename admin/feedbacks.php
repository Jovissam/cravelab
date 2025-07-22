<?php
session_start();
require("../class/feedback.php");
$query = new Feedback();
$result = $query->all();
$i = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback</title>
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

    <main id="main">
        <div class="container">
            <nav class="navbar bg-body-tertiary fixed-top navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="">
                        <h2 class="logo"><a href="">CRAVELAB</a></h2>
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
                                <li class="nav-item ">
                                    <a class="nav-link fw-bold" href="dashboard.php">DashBoard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  fw-bold" aria-current="page" href="products.php">products</a>
                                </li>
                                <li class="nav-item active-nav">
                                    <a class="nav-link  fw-bold" aria-current="page" href="">FeedBack</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container">
                <h2 class="text-center mt-5 pt-1">Products</h2>
                <p class="text-center text-danger"><?= $_SESSION["error"] ?? "" ?></p>
                <p class="text-center text-success"><?= $_SESSION["success"] ?? "" ?></p>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sender</th>
                            <th scope="col">date</th>
                            <th scope="col">Message</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0) : ?>
                            <?php while ($rows = $result->fetch_assoc()): ?>
                                <tr>
                                    <th scope="row"><?= $i++?></th>
                                    <td><?= $rows["senderName"]?></td>
                                    <td><?= $rows["create_time"]?></td>
                                    <td><?= $rows["message"]?></td>
                                    <td><button type="button" class="btn color1"><a href="../config/feedback.php?id=<?= $rows["id"]?>">Delete</a></button></td>
                                </tr>
                            <?php endwhile ?>
                        <?php endif ?>
                    </tbody>
                </table>

            </div>
        </div>
    </main>

    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
$_SESSION["error"] = "";
$_SESSION["success"] = "";
?>