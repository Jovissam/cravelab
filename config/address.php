<?php
require("../class/users.php");
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addAddress"])) {
    print_r($_POST);

    $userId = mysqli_real_escape_string($db->getconnection(), $_POST["id"]);
    $state = mysqli_real_escape_string($db->getconnection(), $_POST["state"]);
    $city = mysqli_real_escape_string($db->getconnection(), $_POST["city"]);
    $homeAddress = mysqli_real_escape_string($db->getconnection(), $_POST["homeAddress"]);
    $additionalInfo = mysqli_real_escape_string($db->getconnection(), $_POST["additionalInformation"]);

    if (empty($userId) || empty($state) || empty($city) || empty($homeAddress) || empty($additionalInfo)) {
        $_SESSION["error"] = "unable to register you now try again later";
        return header("location:../profile-settings.php");
    } else {
        $address = new Address();
        $address->addAddress($userId, $state, $city, $homeAddress, $additionalInfo);

        $_SESSION["success"] = "Address successfully Added";
        return header("location:../profile-settings.php");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $deleteAddress = new Address();
    if ($deleteAddress->deleteAddress($id)) {
        $_SESSION["success"] = "Address successfully Deleted";
        return header("location:../profile-settings.php");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("content-type: application/json");
    // converting the stringified json objects to php array
    $data = json_decode(file_get_contents("php://input"), true);
    
    $id = $data["id"];
    $userId = $data["userId"];
    if ($data["postType"] == "setDefaultAddress") {
        $address = new Address();
        if ($address->checkDefaultAddress($userId)) {
            if ($address->setDefaultAddress($id)) {
                echo json_encode([
                    "status" => "successful"
                ]);
            } else {
                echo json_encode([
                    "status" => "unable to set default"
                ]);
            }
        }
    }
}
