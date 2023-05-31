<?php 
session_start();


unset($_SESSION['status']);
unset($_SESSION['role']);
unset($_SESSION['fullname']);

setcookie('id', '', time()-3600, "/");

$msg = "You have logged out from our page";
header("Location: login.php?message=" . urlencode($msg));
/* - Fakhri Hamdan -  */
?>