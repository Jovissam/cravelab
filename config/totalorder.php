<?php
session_start();
require_once("../class/products.php");

$_SESSION["totalPrice"] = null;
if (isset($_POST['product']['id'])) {
    $ids = array_values($_POST['product']['id']);

    $quantities = $_POST['product']['quantity'];

    $product = new Product();
    $requested_products = $product->getProducts(implode(",", $ids));
    $totalPrice = 0;
    // calculate the quantity
    while ($row = $requested_products->fetch_assoc()) {
        $totalPrice += $row['price'] * $quantities[$row['id']];
    }
    if ($_SESSION["totalPrice"] = $totalPrice) {
        return header("location:../checkout.php");
    }
}
echo $totalPrice;
