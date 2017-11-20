<?php
//Checks to see if a session variable for userid is set. If not, it will redirect to the login page.
session_start();
if (!isset($_SESSION['userid'])) {
    return header("location:login.php?page=" . $_SERVER['PHP_SELF']);
}
?>