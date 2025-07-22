<pre>
<?php
require_once("../class/products.php");
$productId = $_POST["productId"];


$values = "(" . implode(',', $productId) . ")";

$product = new Product();
$total = $product->getPrice($values);
if ($total) {
    $total = $total->fetch_assoc();
    $totalPrice = $total["total"];
} else {
    $totalPrice = 0;
}

echo number_format($totalPrice, 2);
