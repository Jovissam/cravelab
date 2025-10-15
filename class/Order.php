<!-- <pre> -->
<?php
require_once("connection.php");
class Order extends Database
{
    private function query($stmt){
        $result = $this->getconnection()->query($stmt);
        return $result;
    }
    public function getAllOrders($userId){
        $stmt = "SELECT * FROM orders WHERE userId = $userId";
        return $this->query($stmt);
    }
    // GET SUCCESSFUL ORDER
    public function getSuccessfulOrders(){
        $stmt = "SELECT * FROM orders WHERE status = 'successful'";
        return $this->query($stmt);
    }
    public function addOrder($userId, $addressId, $orderLabel, $totalPrice, $paymentMethod){
        $stmt = "INSERT INTO orders (userId, addressId, orderLabel, totalPrice, paymentMethod)
                 VALUES ('$userId', '$addressId', '$orderLabel', '$totalPrice', '$paymentMethod')";
        return $this->query($stmt);
    }

    public function getOrder($id){
        $stmt ="SELECT orders.orderLabel, orders.userId, orders.addressId, orders.orderDate, orders.status, orders.totalPrice, paymentMethods.id AS paymentId, paymentMethods.name AS paymentMethod
                FROM orders JOIN paymentMethods ON orders.paymentMethod = paymentmethods.id WHERE orders.id= $id";
        return $this->query($stmt);
    }
    // GET ORDERS WITH USER NAMES
    public function getUserOrders(){
        $stmt ="SELECT orders.id, orders.orderLabel, orders.status, orders.totalPrice, users.name AS userName
                FROM orders JOIN users ON orders.userId = users.id";
        return $this->query($stmt);
    }

    // APPROVE ORDER
    public function approveOrder($id, $status){
        $stmt ="UPDATE orders SET status = '$status' WHERE id = $id";
        return $this->query($stmt);
    }
    
}
