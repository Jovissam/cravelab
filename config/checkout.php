<pre>
<?php
$productId = $_POST["productId"];
print_r($_POST["productId"]);

// $newkey = null;
foreach ($productId as $key => $value) {
    $idkey = "$value,";
    $newkey = rtrim($idkey, ",");
    echo $idkey;
    
}