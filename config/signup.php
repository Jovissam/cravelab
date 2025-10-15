<?php
require("../class/users.php");

$db = new Database();

// Get the inputs
// Sanitize the input.

$name = mysqli_real_escape_string($db->getconnection(), strtolower($_POST["name"]));
$phoneNo = mysqli_real_escape_string($db->getconnection(), $_POST["phoneNo"]);
$email = mysqli_real_escape_string($db->getconnection(), $_POST["email"]);
$password = mysqli_real_escape_string($db->getconnection(), $_POST["password"]);

$hashedPassword = md5($password);

// Check if the input is valid or validate input
if (empty($name) || empty($phoneNo) || empty($email) || empty($password)) {
    $_SESSION["error"] = "please fill all fields";
    return header("location:../signup.php");
} else {
    session_start();
    $save = new users;
    // CHECK IF EMAIL EXISTS IN DATABASE
    $checkEmail = $save->checkEmail($email);
    if ($checkEmail->num_rows <= 0) {
        // Save the input to database

        $userId = $save->addUser($name, $phoneNo, $email, $hashedPassword);

        if ($userId) {
            $_SESSION["name"] = $name;
            $_SESSION["userId"] = $userId;
            $_SESSION["user"] = true;
            return header("location:../index.php");
        } else {
            $_SESSION["error"] = "unable to register you now try again later";
            return header("location:../signup.php");
        }
    } else {
        $_SESSION["error"] = "This Email has already been Registered";
        return header("location:../signup.php");
    }
}
