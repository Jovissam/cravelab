<?php
require("../class/users.php");
$db = new Database;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateUserProfile"])) {
    session_start();

    $id = mysqli_real_escape_string($db->getconnection(), $_POST["id"]);
    $name = mysqli_real_escape_string($db->getconnection(), strtolower($_POST["name"]));
    $phoneNo = mysqli_real_escape_string($db->getconnection(), $_POST["phoneNo"]);
    $email = mysqli_real_escape_string($db->getconnection(), $_POST["email"]);
    $confirmEmail = mysqli_real_escape_string($db->getconnection(), $_POST["confirmEmail"]);

    if (empty($id) || empty($name) || empty($phoneNo) || empty($email) || empty($confirmEmail)) {
        $_SESSION["error"] = "please fill all fields";
        return header("location:../profile-settings.php");
    } else {
        // CROSS CHECK EMAIL
        if ($email == $confirmEmail) {
            $updateUser = new users;
            $updateUser->updateUser($id, $name, $phoneNo, $email);
            $_SESSION["success"] = "Profile Updated successfully";
            return header("location:../profile-settings.php");
        } else {
            session_start();
            $_SESSION["error"] = "email not matching";
            return header("location:../profile-settings.php");
        }
    }
}
