<pre>
<?php
session_start();
require_once("../class/paymentMethod.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["payment"])) {

    // CHECK FILE
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
                        return header("location:../payOrder.php");
                    }
                } else {
                    $_SESSION["error"] = "file too large";
                    return header("location:../payOrder.php");
                }
            } else {
                $_SESSION["error"] = "not a known file type";
                // return header("location:../payOrder.php");
            }
        }
    }

    $file = $_FILES["paymentUpload"];
    $orderId = $_POST["orderId"];

    if (checkFile($file) == true) {
        // rename file and upload
        $ext = explode("/", $file["type"]);
        $newName = explode(".", $file["name"]);
        $stamp = time();
        $location = "../uploads/payments/$newName[0]$stamp.$ext[1]";

        if (move_uploaded_file($file["tmp_name"], $location)) {
            $imageUrl = "uploads/payments/$newName[0]$stamp.$ext[1]";

            $payment = new PaymentMethod();
            $payment->addPayment($orderId, $imageUrl);

            $_SESSION["orderId"] = null;
            $_SESSION["totalPrice"] = null;
            $_SESSION["success"] = "file uploaded successfully";
            return header("location:../menu.php");
        } else {
            $_SESSION["error"] = "unable to upload payment";
            return header("location:../menu.php");
        }
    }
}


