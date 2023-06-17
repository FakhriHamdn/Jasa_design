<?php
session_start();
// unset($_SESSION['cart']);
require 'includes/functions.php';

// VALIDASI HARUS LOGIN TERLEBIH DAHULU
if (!isset($_SESSION['status'])) {
    header('Location: public/marketplace/marketplace.php?message=login dulu');
    exit;
}

$userIdentity = $_SESSION['email'];

// Buat keranjang belanja kosong jika belum ada
if (!isset($_SESSION['cart'][$userIdentity])) {
    $_SESSION['cart'][$userIdentity] = [];
}

if (isset($_GET['deleteAll'])) {
    unset($_SESSION['cart'][$userIdentity]);
    header("location: keranjang.php");
}

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
    <link rel="stylesheet" href="styles/cart.css">
    <title> Cart | Rofara Store </title>
</head>

<body>
    <main class="main_container">
        <nav class="nav_container">
            <div class="nav_wrapper">
                <div class="logo_wrapper">
                    <img src="image/rofaralogo.png" alt="Logo Rofara" style="width: 180.6px; height: 53.235px;">
                </div>
                <ul class="nav_menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a class="active" href="public/aboutUs.php">About Us</a></li>
                    <li><a href="public/contact.php">Contact</a></li>
                    <li><a href="public/marketplace/marketplace.php">Marketplace</a></li>
                </ul>
                <div class="auth">

                    <!-- NAVBAR ICON -->
                    <div class="nav_icon">
                        <a href="keranjang.php?cart"><i class='bx bx-cart'></i></a>
                        <a href=""><i class='bx bx-envelope'></i></a>
                        <a href=""><i class='bx bx-bell'></i></a>
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
                                    <img class="profile-image" src="image/no-picture.jpg" alt="Profile Photo">
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
        <section class="content_container">

            <?php if (count($_SESSION['cart'][$userIdentity]) > 0) : ?>

                <div class="content_header">
                    <div class="cart_container">
                        <div class="cart_list">
                            <h1>Your Shopping Cart</h1>
                            <form class="checkbox_items" action="" method="POST">
                                <div class="checkbox_all_items">
                                    <input type="checkbox" name="cart">
                                    <label for="cart">Select All</label>
                                </div>
                                <a href="?deleteAll">Delete All</a>
                            </form>

                            <div class="cart_wrapper">
                                <span class="bold_horizontal_line"></span>
                                <?php foreach ($_SESSION['cart'][$userIdentity] as $key => $product_id) : ?>
                                    <?php $row = getProductId($product_id); ?>
                                    <div class="container_cart_items">
                                        <div class="product_container">
                                            <div class="cart_items">
                                                <form action="" method="POST">
                                                    <input type="checkbox" name="cart">
                                                </form>
                                            </div>
                                            <img class="img_product" src="image/product/<?php echo $row['product_image']; ?>" width="65" height="65">
                                            <!-- <img class="img_product" src="image/logo-rofara.png" width="65" height="65"> -->
                                            <div class="product_detail">
                                                <p><?= $row['nama_product']; ?></p>
                                                <p class="harga">Rp <?= $row['harga']; ?></p>
                                            </div>
                                        </div>
                                        <div class="manage_cart">
                                            <a class="note" href="">Add a Note</a>
                                            <div class="manage_items">
                                                <p>Add to Wishlist</p>
                                                <a href="includes/action.php?remove_from_cart=<?= $key; ?>"><i class='bx bx-trash'></i></a>
                                                <span class="vertical_line"></span>
                                                <a href=""><i class='bx bx-minus-circle'></i></a>
                                                <p>0</p>
                                                <a href=""><i class='bx bx-plus-circle'></i></a>

                                            </div>
                                        </div>
                                    </div>
                                    <span class="bold_horizontal_line"></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="checkout_content">
                        <div class="card_container">
                            <div class="card_information">
                            </div>
                            <span class="horizontal_line"></span>
                            <div class="card_checkout">
                                <h3>Shopping Summary</h3>
                                <div class="summary_wrapper">
                                <p>Total Price (0 Items)</p>
                                <p>Rp0</p>
                                </div>

                                <span class="horizontal_line"></span>
                                <div class="price_wrapper">
                                <h3>Total Price</h3>
                                <h3>-</h3>
                                </div>
                                <a href="checkout.php">Checkout()</a>
                            </div>
                        </div>
                    </div>



                </div>
            <?php else : ?>
                <div class="empty_message">
                    <p>Your Shopping Cart is Empty</p>
                    <a href="public/marketplace/marketplace.php">Explore our product</a>
                </div>
            <?php endif; ?>
        </section>

        <script src="script.js"></script>
</body>

</html>