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
    <link href="/your-path-to-fontawesome/css/solid.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="image/Logo-rofara2.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/home.css">
    <title>Home | Rofara Store </title>
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
                    <li><a class="active" href="public/aboutUs.php">About Us</a></li>
                    <li><a href="public/contact.php">Contact</a></li>
                    <li><a href="public/marketplace/marketplace.php">Marketplace</a></li>
                </ul>
                <div class="auth">
                    
                    <!-- NAVBAR ICON -->
                    <div class="nav_icon">
                        <i class='bx bx-cart'></i>
                        <i class='bx bx-envelope'></i>
                        <i class='bx bx-bell'></i>
                    </div>
                    
                    <span class="vertical_line"></span>

                    <?php if (isset($_SESSION['status'])) : ?>
                        <?php if ($_SESSION['role'] === 'admin') : ?>
                            <div class="after_auth">
                                <a class="dashboard" href="admin/data_product.php?dash=admin">
                                    <i class='bx bx-data'></i>
                                </a>
                            <?php elseif ($_SESSION['role'] === 'operator') : ?>
                                <a class="dashboard" href="operator/data_product.php">
                                    <i class='bx bx-data'></i>
                                </a>
                            <?php endif; ?>
                            <div class="profile">
                                <button class="profile-button">
                                    <img class="profile-image" src="image/profile.jpg" alt="Profile Photo">
                                    <span class="arrow-down"></span>
                                </button>
                                <div class="dropdown-content">
                                    <a class="dropdown" href="#">Your profil</a>
                                    <a class="dropdown" href="#">Help</a>
                                    <a class="dropdown" href="#">Settings</a>

                                    <?php if($_SESSION['role'] === 'admin') :?>
                                        <a class="dropdown" href="#">Admin Power</a>
                                        <?php elseif($_SESSION['role'] === 'operator') :?>
                                            <a class="dropdown" href="#">OP POWER</a>
                                        <?php endif; ?>
                                    <a class="dropdown" href="auth/logout.php">Sign out</a>

                                </div>
                            </div>
                            </div>
                        <?php else : ?>
                            <a class="auth_login" href="auth/login.php"><i class="fas fa-sign-in-alt"></i>Login</a>
                            <a class="auth_register" href="auth/register.php"><i class="far fa-user"></i>Register</a>
                        <?php endif; ?>
                </div>
            </div>
        </nav>

        <content class="content_container">

        </content>



        <br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br>
    </main>






    <script>
        // Tambahkan kode berikut untuk mengaktifkan dropdown saat foto profil diklik
        const profileButton = document.querySelector('.profile-button');
        const profile = document.querySelector('.profile');

        profileButton.addEventListener('click', () => {
            profile.classList.toggle('active');
        });
        // Event listener untuk menutup dropdown ketika mengklik di luar elemen profil
        document.addEventListener('click', (event) => {
            const targetElement = event.target;
            // Periksa apakah elemen yang diklik berada di luar elemen profil
            if (!profile.contains(targetElement)) {
                profile.classList.remove('active');
            }
        });
    </script>

</body>
</html>