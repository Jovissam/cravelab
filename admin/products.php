<?php
session_start();
require("../class/products.php");
$data = new category();
$category = $data->all();

$query = new Product();
$products = $query->all();
$i = 1;
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
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container">
                <h2 class="text-center mt-5 pt-1">Products</h2>
                <p class="text-center text-danger"><?= $_SESSION["error"] ?? "" ?></p>
                <p class="text-center text-success"><?= $_SESSION["success"] ?? "" ?></p>
                <div class="d-flex justify-content-end mt-5">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn color1" data-bs-toggle="modal" data-bs-target="#modal1">
                        Add Product
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center" id="staticBackdropLabel">Add a new product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="../config/product.php" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="productName" class="form-label">Product Name</label>
                                            <input name="name" type="text" class="form-control" id="productName" placeholder="Enter product name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="productPrice" class="form-label">Product Price</label>
                                            <input name="price" type="text" class="form-control" id="productPrice" placeholder="Enter product price">
                                        </div>
                                        <div class="mb-3">
                                            <label for="productImage" class="form-label">Product Image</label>
                                            <input name="image1" type="file" class="form-control" id="productImage" placeholder="Enter product image URL">
                                        </div>
                                        <div class="mb-3">
                                            <label for="productdes" class="form-label">Product Description</label>
                                            <input name="description" type="text" class="form-control" id="productdes" placeholder="Enter product Description">
                                        </div>
                                        <div class="mb-3">
                                            <label for="productCategory" class="form-label">Product Category</label>
                                            <select name="category" class="form-select" id="productCategory">
                                                <option selected disabled>Choose Category</option>
                                                <?php if ($category->num_rows > 0): ?>
                                                    <?php while ($rows = $category->fetch_assoc()): ?>
                                                        <option value="<?= $rows["id"] ?>"><?= $rows["name"] ?></option>
                                                    <?php endwhile ?>
                                                <?php endif ?>
                                            </select>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button name="addProduct" type="submit" class="btn color1">Add</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- products list -->
                <div class="table-list container mt-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($products->num_rows > 0): ?>
                                <?php while ($rows = $products->fetch_assoc()): ?>
                                    <tr>
                                        <th class="text-center pt-4" scope="row"><?= $i++ ?></th>
                                        <td class="text-center"><img width="70px" height="70px" class="img-fluid" src="../<?= $rows["image"] ?>"></td>
                                        <td class="text-center pt-4"><a href="../product-item.php?id=<?= $rows["id"]?>"><?= $rows["name"]?></a></td>
                                        <td class="text-center pt-4">
                                            <button
                                                class="btn color1 dropdown-toggle btn-sm"
                                                type="button"
                                                id="triggerId"
                                                data-bs-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false">
                                                OPTIONS
                                            </button>
                                            <div
                                                class="dropdown-menu dropdown-menu-start"
                                                aria-labelledby="triggerId">
                                                <!-- Button for product details -->
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal<?= $rows["id"] ?>">
                                                    Edit Product Details
                                                </button>
                                                <!-- Button for product image -->
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#product<?= $rows["id"] ?>">
                                                    Edit Product Image
                                                </button>

                                                <a class="dropdown-item" href="../config/product.php?id=<?= $rows["id"] ?>">DELETE</a>
                                            </div>
                                            <!-- Modal for product details -->
                                            <div class="modal fade" id="modal<?= $rows["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Update <?= $rows["name"] ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post" action="../config/product.php">
                                                            <div class="modal-body">

                                                                <input type="hidden" name="id" value="<?= $rows["id"] ?>">
                                                                <div class="mb-3">
                                                                    <label for="productName" class="form-label">Product Name</label>
                                                                    <input name="name" type="text" value="<?= $rows["name"] ?>" class="form-control" id="productName" placeholder="Enter product name">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="productPrice" class="form-label">Product Price</label>
                                                                    <input name="price" type="text" value="<?= $rows["price"] ?>" class="form-control" id="productPrice" placeholder="Enter product price">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="productdes" class="form-label">Product Description</label>
                                                                    <input name="description" type="text" value="<?= $rows["description"] ?>" class="form-control" id="productdes" placeholder="Enter product Description">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="productCategory" class="form-label">Product Category</label>
                                                                    <select name="category" class="form-select" id="productCategory">
                                                                        <option selected disabled>Choose Category</option>
                                                                        <?php if ($category->num_rows > 0): ?>
                                                                            <?php $category2 = $data->all(); ?>
                                                                            <?php while ($subrows = $category2->fetch_assoc()): ?>
                                                                                <option value="<?= $subrows["id"] ?>"><?= $subrows["name"] ?></option>
                                                                            <?php endwhile ?>
                                                                        <?php endif ?>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="updateProduct" class="btn color1">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal for product image -->
                                            <div class="modal fade" id="product<?= $rows["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Update <?= $rows["name"] ?> image</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post" action="../config/product.php" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" value="<?= $rows["id"] ?>">
                                                                <div class="mb-3">
                                                                    <label for="productImage" class="form-label">Product Image</label>
                                                                    <input name="image2" type="file" class="form-control" id="productImage" placeholder="Enter product image URL">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="updateProductImage" class="btn color1">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
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