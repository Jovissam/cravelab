<pre>
<?php
require("../class/users.php");
$db = new Database();
// accept user input

$email = mysqli_real_escape_string($db->getconnection(), $_POST["email"]);
$password = mysqli_real_escape_string($db->getconnection(), $_POST["password"]);


// retrieve users from database with same name
if (!empty($email) || !empty($password)) {
    $qry = new users();
    $users = $qry->selectUser($email);
    session_start();
    if ($users->num_rows > 0) {
        $user = null;
        while ($rows = $users->fetch_assoc()) {
            // compare the data to ensure its the right user
            if ($rows["email"] == $email && $rows["password"] == $password) {
                $user = $rows;
                $_SESSION["name"] = $rows["name"];
                $_SESSION["email"] = $rows["email"];
                $_SESSION["user"] = true;
                return header("location:../index.php");
            }
        }
        if (!$user) {
            $_SESSION["error"] = "invalid password or email";
            return header("location:../login.php");
        }
    } else {
        $_SESSION["error"] = "no user found";
        return header("location:../login.php");
    }
} else {
    return header("location:../login.php");
}
// print_r($user);
