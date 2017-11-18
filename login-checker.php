<?php
session_start();
if (!isset($_SESSION['userid'])) {
    return header("location:login.php?page=" . $_SERVER['PHP_SELF']);
}
?>