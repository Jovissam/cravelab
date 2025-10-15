<!-- <pre> -->
<?php
require_once("connection.php");
class PaymentMethod extends Database
{
    private function query($stmt){
        $result = $this->getconnection()->query($stmt);
        return $result;
    }
    public function getPaymentMethods(){
        $stmt ="SELECT * FROM paymentmethods";
        return $this->query($stmt);
    }

    public function getPaymentMethod($id){
        $stmt ="SELECT * FROM paymentmethods WHERE id = $id";
        return $this->query($stmt);
    }
    
    public function addPayment($orderId, $imageurl){
        $stmt ="INSERT INTO payments (orderId, imageUrl) VALUES('$orderId', '$imageurl')";
        return $this->query($stmt);
    }

    public function getPayments(){
        $stmt ="SELECT orders.id, orders.orderLabel, payments.imageUrl, orders.orderDate, orders.totalPrice, orders.paymentMethod, orders.status FROM payments JOIN orders ON payments.orderId = orders.id ORDER BY orders.orderDate DESC ";
        return $this->query($stmt);
    }
    
}
