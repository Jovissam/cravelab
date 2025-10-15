<?php
session_start();
if ($_SESSION["user"] == true || $_SESSION["admin"] == true) {
    session_destroy();
}
return header("location:../index.php");
?>