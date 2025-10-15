<!-- <pre> -->
<?php
require_once("connection.php");
class Feedback extends Database
{
    private function query($stmt){
        $result = $this->getconnection()->query($stmt);
        return $result;
    }
    public function addFeedback($productId, $message, $sendername){
        $stmt = "INSERT INTO feedbacks (productId, message, senderName) VALUES ('$productId', '$message', '$sendername')";
        return $this->query($stmt);
    }
    public function getFeedback($id) {
        $stmt = "SELECT feedbacks.id, feedbacks.create_time AS date, feedbacks.message, feedbacks.senderName
                 FROM feedbacks JOIN products ON feedbacks.productId = products.id WHERE feedbacks.productId = $id";
        return $this->query($stmt);
    }
    public function all() {
        $stmt = "SELECT * FROM feedbacks";
        return $this->query($stmt);
    }

    public function delete($id) {
        $stmt = "DELETE FROM feedbacks WHERE id = $id";
        return $this->query($stmt);
    }
}
