<?php
session_start();
// unset($_SESSION['cart']);
require 'includes/functions.php';

// VALIDASI HARUS LOGIN TERLEBIH DAHULU
if (!isset($_SESSION['email'])) {
    header('Location: index.php?message=login dulu');
    exit;
}

// Buat keranjang belanja kosong jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Implementasi Keranjang</title>
</head>

<body>
    <h1>Implementasi Keranjang</h1>
    <?php if (count($_SESSION['cart']) > 0) : ?>
        <table border="1">
            <tr>
                <th>id</th>
                <th>Product</th>
                <th>Harga</th>
                <th>Checkout</th>
                <th>Hapus</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $key => $product_id) : ?>
                <?php $row = getProductId($product_id); ?>
                <tr class="data_table">
                    <td><?= $row['id_product']; ?></td>
                    <td><?= $row['nama_product']; ?></td>
                    <td><?= $row['harga']; ?></td>
                    <td><a href="checkout.php">Checkout</a></td>
                    <td><a href="includes/action.php?remove_from_cart=<?= $key; ?>">Hapus</a></td>
                </tr>
            <?php endforeach; ?>

        </table>
    <?php else : ?>
        <h1>Keranjang Kosong</h1>
    <?php endif; ?>

    
</body>

</html>