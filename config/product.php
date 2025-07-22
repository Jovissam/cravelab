<pre>
<?php
session_start();
require("../class/products.php");

$db = new Database();
$conn = $db->getconnection();

$product = new Product();

// function to sanitize file
function checkFile($file)
{
    // check if there is a file upload
    if ($file == "") {
        return $_SESSION["error"] = "no file choosen";
    } else {
        // check file type
        $supportedFiles = ["image/jpeg", "image/png", "image/jpg"];
        if (in_array($file["type"], $supportedFiles)) {
            // check file size
            $supportedSize = 2000000;
            if ($file["size"] <= $supportedSize) {
                // check for error
                if ($file["error"] == 0) {
                    return true;
                } else {
                    $_SESSION["error"] = "error uploading file";
                    return header("location:../admin/products.php");
                }
            } else {
                $_SESSION["error"] = "file too large";
                return header("location:../admin/products.php");
            }
        } else {
            $_SESSION["error"] = "not a known file type";
            return header("location:../admin/products.php");
        }
    }
}

// for adding products
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addProduct"])) {

    $file = $_FILES["image1"];

    // sanitize input 
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $image = mysqli_real_escape_string($conn, $imageUrl);
    $category = mysqli_real_escape_string($conn, $_POST["category"]);

    if (empty($name) || empty($description) || empty($price) || empty($file) || empty($category)) {
        $_SESSION["error"] = "error! make sure all inputs are taken";
        return header("location:../admin/products.php");
    } else {
        if (checkFile($file) == true) {
            // rename file and upload
            $ext = explode("/", $file["type"]);
            $newName = explode(".", $file["name"]);
            $stamp = time();
            $location = "../uploads/products/$newName[0]$stamp.$ext[1]";

            if (move_uploaded_file($file["tmp_name"], $location)) {
                $image = "uploads/products/$newName[0]$stamp.$ext[1]";

                $product->add($name, $description, $price, $image, $category);
                $_SESSION["success"] = "file uploaded successfully";
                return header("location:../admin/products.php");
            } else {
                $_SESSION["error"] = "unable to upload file";
                return header("location:../admin/products.php");
            }
        }
    }
}


// for updating products
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateProduct"])) {

    // sanitize input 
    $pid = mysqli_real_escape_string($conn, $_POST["id"]);
    $pname = mysqli_real_escape_string($conn, $_POST["name"]);
    $pdescription = mysqli_real_escape_string($conn, $_POST["description"]);
    $pprice = mysqli_real_escape_string($conn, $_POST["price"]);
    $pcategory = mysqli_real_escape_string($conn, $_POST["category"]);

    if (empty($pname) || empty($pdescription) || empty($pprice) || empty($pcategory)) {
        $_SESSION["error"] = "cannot update $name make sure all inputs are entered";
        return header("location:../admin/products.php");
    } else {
        $product->updateProductDetails($pid, $pname, $pdescription, $pprice, $pcategory);
        $_SESSION["success"] = "file updated successfully";
        return header("location:../admin/products.php");
    }
}

// updating product image
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateProductImage"])) {
    $file = $_FILES["image2"];
    $pid = mysqli_real_escape_string($conn, $_POST["id"]);

    if (checkFile($file) == true) {
        // rename file and upload
        $ext = explode("/", $file["type"]);
        $newName = explode(".", $file["name"]);
        $stamp = time();
        $location = "../uploads/products/$newName[0]$stamp.$ext[1]";

        if (move_uploaded_file($file["tmp_name"], $location)) {
            $pimage = "uploads/products/$newName[0]$stamp.$ext[1]";
            $product->updateProductImage($pid, $pimage);

            $_SESSION["success"] = "file updated successfully";
            return header("location:../admin/products.php");
        } else {
            $_SESSION["error"] = "unable to upload file";
            return header("location:../admin/products.php");
        }
    }
}

// deletion of products
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    if ($product->delete($id)) {
        $_SESSION["success"] = "file deleted successfully";
        return header("location:../admin/products.php");
    } else {
        $_SESSION["error"] = "unable to delete file";
        return header("location:../admin/products.php");
    }
}
