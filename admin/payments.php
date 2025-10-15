<?php
session_start();
if (isset($_SESSION["admin"])) {
    require("../class/paymentMethod.php");
    $query = new PaymentMethod();
    $payments = $query->getPayments();

    $paymentMethods = $query->getPaymentMethods();
    while ($row = $paymentMethods->fetch_assoc()) {
        $paymentMethod[$row["id"]] = $row["name"];
    }
} else {
    return header("location:../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Products</title>
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
                                <li class="nav-item active-nav">
                                    <a class="nav-link  fw-bold" aria-current="page" href="">products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  fw-bold" aria-current="page" href="feedbacks.php">Feed Backs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  fw-bold" aria-current="page" href="#">Payments</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container">
                <h2 class="text-center mt-5 pt-2">manage Payments</h2>
                <p class="text-center text-danger"><?= $_SESSION["error"] ?? "" ?></p>
                <p class="text-center text-success"><?= $_SESSION["success"] ?? "" ?></p>

                <!-- products list -->
                <div class="table-list container mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">order Label</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($payments->num_rows > 0): ?>
                                <?php while ($rows = $payments->fetch_assoc()): ?>
                                <!-- <?php print_r($rows)?> -->
                                    <tr>
                                        <td><!-- Button trigger modal -->
                                            <button type="button" class="text-decoration-underline" data-bs-toggle="modal" data-bs-target="#<?=$rows["id"]?>">
                                                <?=$rows["orderLabel"]?>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="<?=$rows["id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Order No: <?=$rows["orderLabel"]?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><b>Date: <?=$rows["orderDate"]?></b></p>
                                                            <div class=" mt-3">
                                                                <img src="../<?=$rows["imageUrl"]?>" class="img-fluid">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn color1"><a href="orderDetails.php?orderId=<?=$rows["id"]?>">Approve</a></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $rows["orderDate"] ?></td>
                                        <td><?=$rows["totalPrice"]?></td>
                                        <td><?=$paymentMethod[$rows["paymentMethod"]]?></td>
                                        <td><?=$rows["status"]?></td>
                                    </tr>
                                <?php endwhile ?>
                            <?php endif ?>
                        </tbody>
                    </table>

                </div>
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