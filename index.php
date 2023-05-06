<?php 
session_start();
if(!isset($_SESSION['status'])) {
  header("Location: auth/login.php");
  exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/Logo-rofara2.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/home.css">
    <title>Home Page Jasa Design</title>
</head>
<body>
    <header class="header">
        <div class="logo-wrapper">
          <img src="image/rofaralogo.png" alt="Logo Rofara" style="width: 180.6px; height: 53.235px;">
        </div>
        <nav class="navigation-wrapper">
          <ul class="navigation-menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Tentang Kami</a></li>
            <li><a href="#">Kontak</a></li>
            <li><a href="#">Marketplace</a></li>
          </ul>
        </nav>
        <a href="auth/logout.php">Logout</a>
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') : ?>
        
        <div class="login-register">
            <button><a class="login" href="auth/login.php">Login</a></button>
            <button><a class="register" href="auth/register.php">Register</a></button>
        </div>
        <?php endif; ?>
    </header>

<!-- Background Image -->
<div class="content-bg">
  <div class="bg-image">
    <img src="image/backgroundhome.jpg" alt="background">
  </div>
  <div class="container-h1">
    <!-- <h1 class="head-text">Ingin <span style="color:#fec112;">Designmu </span>menarik seperti ini?</h1> -->
  </div>
</div>

<div class="container-content">
</div>

</body>
</html>