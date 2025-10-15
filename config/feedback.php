<!-- <pre> -->
<?php
require("../class/feedback.php");
$db = new Database();
$conn = $db->getconnection();

$feedback = new Feedback();

print_r($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get inputs and sanitize
    $senderName = mysqli_real_escape_string($conn, $_POST["senderName"]);
    $productId = mysqli_real_escape_string($conn, $_POST["productId"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);

    // send inputs to database
    if ($feedback->addFeedback($productId, $message, $senderName)) {
        return header("location:../menu.php?id=$productId");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];
    if ($feedback->delete($id)) {
        $_SESSION["success"] = "deleted successfuly";
        return header("location:../admin/feedbacks.php");
    } else {
         $_SESSION["error"] = "unable to delete";
        return header("location:../admin/feedbacks.php");
    }
}
