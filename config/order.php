<?php
session_start();
require_once("../class/Order.php");
// APPROVE ORDER
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["approvePayment"]) &&  isset($_SESSION["admin"])) {
    $orderId = $_POST["orderId"];
    
    $newStatus = "successful";
    $order = new Order();

    if ($order->approveOrder($orderId, $newStatus)) {
        $_SESSION["success"] = "order Updated Successfully";
        return header("location:../admin/payments.php");
    } else {
        $_SESSION["error"] = "unable to approve order";
        return header("location:../admin/payments.php");
    }
} else {
    return header("location:../index.php");
}
