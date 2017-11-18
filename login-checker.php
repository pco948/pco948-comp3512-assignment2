<?php
session_start();
if (!isset($_SESSION['username'])) {
    return header("location:login.php");
}
?>