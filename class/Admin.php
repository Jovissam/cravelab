<?php
require_once("connection.php");

class Admin extends Database
{
    private function query($stmt)
    {
        $result = $this->getconnection()->query($stmt);
        return $result;
    }
    // SELECT USER WITH EMAIL
    public function selectAdminEmail($email)
    {
        $stmt = "SELECT * FROM admin WHERE email = '$email'";
        return $this->query($stmt);
    }
    
}
