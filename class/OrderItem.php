<!-- <pre> -->
<?php
require_once("connection.php");
class OrderItem extends Database
{
    private function query($stmt){
        $result = $this->getconnection()->query($stmt);
        return $result;
    }
    public function addOrderItems($orderId, $productId, $quantity, $price){
        $stmt = "INSERT INTO orderItems (orderId, productId, quantity, price) VALUES ('$orderId', '$productId', '$quantity', '$price')";
        return $this->query($stmt);
    }

    public function getOrderItem($orderId){
        $stmt ="SELECT * FROM orderItems WHERE orderId = '$orderId'";
        return $this->query($stmt);
    }
    
}
