<pre>
<?php
session_start();
require_once("../class/Order.php");
require_once("../class/OrderItem.php");
require_once("../class/products.php");

$_SESSION["orderId"] = null;
if (isset($_POST["checkout"]) && isset($_POST["userId"]) && isset($_POST["totalPrice"]) && isset($_POST["paymentMethod"])) {
    $orderClass = new Order();
    // print_r($_POST);
    // return
        // get user id, address id, totalPrice
        $userId = $_POST["userId"];
    $addressId = $_POST["addressId"];
    $totalPrice = $_POST["totalPrice"];
    $paymentMethod = $_POST["paymentMethod"];

    // generating order label
    $stamp = date("is");
    $pre = ORDER_ID;
    $orderLabel =  "$pre$stamp$userId"; // ..

    // add to ORDER database
    $db = $orderClass->getconnection();
    if ($orderClass->addOrder($userId, $addressId, $orderLabel, $totalPrice, $paymentMethod)) {
        $orderId = $db->insert_id;
    } else {
        $_SESSION["error"] = "unable to add user";
        return header("location:../checkout.php");
    }

    // GETTING THE ORDER ITEMS

    $productiIds = array_values($_POST['product']['id']);
    $quantities = $_POST['product']['quantity'];

    // FETCH REQUESTED PRODUCTS
    $product = new Product();
    $requested_products = $product->getProducts(implode(",", $productiIds));

    $orderSuccess = null;
    $orderItem = new OrderItem();
    while ($row = $requested_products->fetch_assoc()) {
        $productId = $row['id'];
        $quantity = $quantities[$row['id']];
        $price = $row['price'];
        if ($orderItem->addOrderItems($orderId, $productId, $quantity, $price)) {
            $orderSuccess = true;
        }
    }
    if ($orderSuccess == true) {
        $_SESSION["orderId"] = $orderId;
        return header("location:../payOrder.php");
    }
} else {
    $_SESSION["error"] = "please choose Address and Payment Method";
    return header("location:../checkout.php");
}


