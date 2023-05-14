<?php 
session_start();
session_destroy();
// setcookie('id', '', time()-3600);

$msg = "You have logged out from our page";
header("Location: login.php?message=" . urlencode($msg));

?>