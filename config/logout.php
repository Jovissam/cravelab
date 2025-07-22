<?php
session_start();
if ($_SESSION["user"] == true) {
    session_destroy();
}
return header("location:../index.php");
?>