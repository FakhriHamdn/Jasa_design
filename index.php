<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="image/Logo-rofara2.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/home1.css">
    <title>Home Page</title>
</head>

<body>
    <main>
        <nav class="nav_container">
            <div class="logo_wrapper">
                <img src="image/rofaralogo.png" alt="Logo Rofara" style="width: 180.6px; height: 53.235px;">
            </div>
            <div class="nav_wrapper">
                <ul class="nav_menu">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Kontak</a></li>
                    <li><a href="#">Marketplace</a></li>
                </ul>
            </div>
            
            <?php if (isset($_SESSION['status'])) : ?>
                <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'operator') : ?>
                    <button><a href="admin/data_product.php">Tabel Database</a></button>
                    <?php endif; ?>
                    <button><a href="#">Profil</a></button>
                <?php else : ?>
                    <div class="auth">
                        <button><a href="auth/login.php" class="login">Login</a></button>
                        <button><a href="auth/register.php" class="register">Register</a></button>
                    </div>
                <?php endif; ?>
                <button><a href="auth/logout.php">Logout</a></button>

        </nav>
    </main>
</body>

</html>