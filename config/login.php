<!-- <pre> -->
<?php
session_start();
require_once("../class/users.php");
require_once("../class/Admin.php");
session_destroy();
$db = new Database();
// accept user input

$email = mysqli_real_escape_string($db->getconnection(), $_POST["email"]);
$password = mysqli_real_escape_string($db->getconnection(), $_POST["password"]);
$hashedPassword = md5($password);

$user = null;
$admin = null;

// retrieve users from  users database with same info
if (empty($email) || empty($password)) {
    return header("location:../login.php");
}
 else {
    session_start();
    $qry = new users();
    $users = $qry->selectUserEmail($email);
    if ($users->num_rows > 0) {
        $user = true;
        while ($rows = $users->fetch_assoc()) {
            // compare the data to ensure its the right user
            if ($rows["email"] == $email && $rows["password"] == $hashedPassword) {
                $_SESSION["name"] = $rows["name"];
                $_SESSION["userId"] = $rows["id"];
                $_SESSION["user"] = true;
                return header("location:../index.php");
            }
        }
    }

    // retrieve users from  ADMIN database with same info
    $adminQry = new Admin();
    $admins = $adminQry->selectAdminEmail($email);
    if ($admins->num_rows > 0) {
        $admin = true;
        while ($row = $admins->fetch_assoc()) {
            if ($row["email"] == $email && $row["password"] == $hashedPassword) {
                $_SESSION["name"] = $row["name"];
                $_SESSION["userId"] = $row["id"];
                $_SESSION["admin"] = true;
                return header("location:../admin/dashboard.php");
            }
        }
    }

    if (!$user && !$admin) {
        $_SESSION["error"] = "no user found";
        return header("location:../login.php");
    }

    if (isset($_SESSION["user"]) && isset($_SESSION["admin"])) {
    } else {
        $_SESSION["error"] = "invalid email or password";
        return header("location:../login.php");
    }
}
