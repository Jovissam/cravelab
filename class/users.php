<?php
require_once("connection.php");

class users extends Database
{
    private function query($stmt)
    {
        $result = $this->getconnection()->query($stmt);
        return $result;
    }
    public function getAllUsers()
    {
        $stmt = "SELECT * FROM users";
        return $this->query($stmt);
    }

    public function addUser($name, $phoneNo, $email, $password)
    {
        $stmt = "INSERT INTO users (name, phoneNo, email, password)";
        $stmt .= "VALUES ('$name', '$phoneNo', '$email', '$password')";
        $result = $this->query($stmt);

        if ($result) {
            return $this->getconnection()->insert_id;
        } else {
            return false;
        }
    }
    public function checkEmail($email)
    {
        $stmt = "SELECT email FROM users WHERE email = '$email'";
        return $this->query($stmt);
    }
    public function selectUser($id)
    {
        $stmt = "SELECT * FROM users WHERE id = $id";
        return $this->query($stmt);
    }
    // SELECT USER WITH EMAIL
    public function selectUserEmail($email)
    {
        $stmt = "SELECT * FROM users WHERE email = '$email'";
        return $this->query($stmt);
    }
    public function updateUser($id, $name, $phoneNo, $email)
    {
        $stmt = "UPDATE users SET name = '$name', phoneNo = '$phoneNo', email = '$email'
                WHERE id = $id";
        return $this->query($stmt);
    }
}

class Address extends Database
{
    private function query($stmt)
    {
        $result = $this->getconnection()->query($stmt);
        return $result;
    }

    public function getAddress($key)
    {
        $stmt = "SELECT addresses.id, addresses.userId, addresses.state,
                 addresses.city, addresses.homeAddress, addresses.additionalInformation, addresses.defaultAddress
                FROM addresses JOIN users ON addresses.userId = users.id WHERE users.id = '$key'";
        return $this->query($stmt);
    }
    // GET ADDRESS WITH ID
    public function getOneAddress($id)
    {
        $stmt = "SELECT * FROM addresses WHERE id = $id";
        return $this->query($stmt);
    }

    public function addAddress($userId, $state, $city, $homeAddress, $additionalInfo)
    {
        $stmt = "INSERT INTO addresses (userId, state, city, homeAddress, additionalinformation)";
        $stmt .= "VALUES ('$userId', '$state', '$city', '$homeAddress', '$additionalInfo')";
        return $this->query($stmt);
    }

    public function deleteAddress($id)
    {
        $stmt = "DELETE FROM addresses WHERE id = $id";
        return $this->query($stmt);
    }

    public function checkDefaultAddress($userId)
    {
        $stmt = "UPDATE addresses SET defaultAddress = 'false'  WHERE userId = '$userId'";
        return $this->query($stmt);
    }

    public function setDefaultAddress($id)
    {
        $stmt = "UPDATE addresses SET defaultAddress = 'true'  WHERE id = '$id'";
        return $this->query($stmt);
    }
}
// $nn = new users();
// $bb = $nn->checkEmail();

// print_r($bb);