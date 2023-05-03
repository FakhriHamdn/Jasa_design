<?php 

session_destroy();
setcookie('id', '', time()-3600);

header('Location: login.php?message=You have logged out from our page');

?>