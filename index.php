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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="shortcut icon" href="image/Logo-rofara2.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/home1.css">
    <title>Home Page</title>
</head>

<body>
    <main class="main_container">
        <nav class="nav_container">
            <div class="nav_wrapper">
                <div class="logo_wrapper">
                    <img src="image/rofaralogo.png" alt="Logo Rofara" style="width: 180.6px; height: 53.235px;">
                </div>
                <ul class="nav_menu">
                    <li><a href="">Home</a></li>
                    <li><a href="">About Us</a></li>
                    <li><a href="">Contact</a></li>
                    <li><a href="marketplace.php">Marketplace</a></li>
                </ul>
                <div class="auth">
                    <?php if (isset($_SESSION['status'])) : ?>
                        <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'operator') : ?>
                            <a href="admin/data_product.php">
                                <i class='bx bx-data'></i></a>
                        <?php endif; ?>
                        <button class="btn_profil"><a href="#"><img src="image/logo-rofara.png" alt=""></a></button>
                        <button><a href="auth/logout.php">Logout</a></button>
                    <?php else : ?>
                        <button class="login"><a href="auth/login.php"><i class="fas fa-sign-in-alt"></i>Login</a></button>
                        <button class="register"><a href="auth/register.php"><i class="far fa-user"></i>Register</a></button>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <content class="content_container">

        </content>



        <br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br>

        <i class='bx bx-data'></i>
    </main>




















    <!-- <main>
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
                    <button><a href="auth/logout.php">Logout</a></button>
                <?php else : ?>
                    <div class="auth">
                        <button><a href="auth/login.php" class="login">Login</a></button>
                        <button><a href="auth/register.php" class="register">Register</a></button>
                    </div>
                <?php endif; ?>

        </nav>
    </main> -->
</body>

</html>