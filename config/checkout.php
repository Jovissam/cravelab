<pre>
<?php
require_once("../class/products.php");
// var_dump($_POST);
// return;
$ids = array_values($_POST['product']['id']);

$quantities = $_POST['product']['quantity'];



$product = new Product();
$total = 0;
$requested_products = $product->getProducts(implode(",", $ids));

while ($row = $requested_products->fetch_assoc()) {
    $total += $row['price'] * $quantities[$row['id']];
}
echo number_format($total, 2);
