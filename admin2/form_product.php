<?php
require '../includes/functions.php';


// if(isset($_GET['action']) === 'editProduct'){
//     $id_product = $_GET['product'];

//     var_dump($id_product);
// }
// ambil id produk dari query string
// if (isset($_GET['product'])) {
//     $id_product = $_GET['product'];
// }

// // ambil data produk berdasarkan id
// $product = getDataById('products', $id_product);

// // cek jika data produk ditemukan
// if ($product) {
//     $title = 'Edit Produk';
// } else {
//     // tampilkan pesan error jika produk tidak ditemukan
//     echo 'Error: Produk tidak ditemukan';
//     exit;
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <h1>Edit Produk</h1>
    <form action="../includes/action.php" method="POST">
        <input type="hidden" name="action" value="insertProduct">
    
        <?php if(isset($_GET['action']) && $_GET['action'] === 'editProduct'): ?>
        <input type="hidden" name="id_product" value="<?= $_GET['product'] ?>">
        <input type="hidden" name="action" value="editProduct">
        <?php endif; ?>


        <ul>
            <li>
                <label for="product">Produk</label>
                <input type="text" name="product" id="product" value="<?= $product['nama_product'] ?>">
            </li>
            <li>
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" value="<?= $product['harga'] ?>">
            </li>
            <li>
                <button type="submit" name="jasa_submit">Submit</button>
            </li>
        </ul>
    </form>

</body>
</html>