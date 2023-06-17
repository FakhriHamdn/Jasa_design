<?php
session_start();

require '../../includes/functions.php';
$query = "SELECT * FROM products";


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
    <link rel="shortcut icon" href="../../image/Logo-rofara2.png" type="image/x-icon">
    <link rel="stylesheet" href="../../styles/home.css">
    <title> Marketplace | Rofara Store </title>
</head>

<body>
    <main class="main_container">
        <nav class="nav_container">
            <div class="nav_wrapper">
                <div class="logo_wrapper">
                    <img src="../../image/rofaralogo.png" alt="Logo Rofara" style="width: 180.6px; height: 53.235px;">
                </div>
                <ul class="nav_menu">
                    <li><a href="../../index.php">Home</a></li>
                    <li><a class="active" href="../aboutUs.php">About Us</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                    <li><a href="">Marketplace</a></li>
                </ul>
                <div class="auth">

                    <!-- NAVBAR ICON -->
                    <div class="nav_icon">
                        <a href="../../keranjang.php"><i class='bx bx-cart'></i></a>
                        <a href=""><i class='bx bx-envelope'></i></a>
                        <a href=""><i class='bx bx-bell'></i></a>
                    </div>

                    <span class="vertical_line"></span>

                    <?php if (isset($_SESSION['status'])) : ?>
                        <?php if ($_SESSION['role'] === 'admin') : ?>
                            <div class="after_auth">
                                <a class="dashboard" href="../../admin/data_product.php?dash=admin">
                                    <i class='bx bx-data'></i>
                                </a>
                            <?php elseif ($_SESSION['role'] === 'operator') : ?>
                                <a class="dashboard" href="../../operator/data_product.php">
                                    <i class='bx bx-data'></i>
                                </a>
                            <?php endif; ?>
                            <div class="profile">
                                <button class="profile-button">
                                    <img class="profile-image" src="../../image/no-picture.jpg" alt="Profile Photo">
                                    <span class="arrow-down"></span>
                                </button>
                                <div class="dropdown-content">
                                    <div class="sign_info">
                                        <p>Signed in as</p>
                                        <p class="fullname"><?= $_SESSION['fullname'] ?></p>
                                    </div>

                                    <a class="dropdown" href="#">Your profil</a>
                                    <a class="dropdown" href="#">Purchase</a>
                                    <a class="dropdown" href="#">Wishlist</a>
                                    <a class="dropdown" href="#">Help</a>
                                    <a class="dropdown" href="#">Settings</a>

                                    <?php if ($_SESSION['role'] === 'admin') : ?>
                                        <a class="dropdown" href="#">Admin Power</a>
                                    <?php elseif ($_SESSION['role'] === 'operator') : ?>
                                        <a class="dropdown" href="#">Operator Power</a>
                                    <?php endif; ?>
                                    <a class="dropdown" href="../../auth/logout.php">Sign out</a>

                                </div>
                            </div>
                            </div>
                        <?php else : ?>
                            <a class="auth_login" href="../../auth/login.php"><i class="fas fa-sign-in-alt"></i>Login</a>
                            <a class="auth_register" href="../../auth/register.php"><i class="far fa-user"></i>Register</a>
                        <?php endif; ?>
                </div>
            </div>
        </nav>
        <section class="content_container">
            <div class="content_header">
                <div class="main_image">
                    <p></p>
                </div>
                
                <div class="product_display">
                    <?php foreach (getDatas($query) as $row) : ?>
                        <div class="card_wrapper">
                            <div class="card_box">
                                <div class="image_display">
                                    <img src="../../image/product/<?= $row['product_image']; ?>" alt="foto" style="width: 100%; height: 100%;">
                                </div>
                                <div class="info_product">
                                    <p><?= $row['nama_product']; ?></p>
                                    <p style="font-weight: 700;">Rp. <?= $row['harga']; ?></p>
                                </div>
                                <div class="product_wrapper">
                                    <a href="checkout.php?id_product=<?= $row['id_product']; ?>">Beli</a> |
                                    <a href="../../includes/action.php?add_to_cart=<?= $row['id_product']; ?>"><i class='bx bx-cart'></i></a>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>


    </main>


    <script src="../../script.js"></script>

</body>

</html>