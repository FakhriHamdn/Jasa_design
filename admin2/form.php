<?php
require '../includes/functions.php';

$id_product = isset($_GET['id_product']) && $_GET['id_product'] > 0 ? $_GET['id_product'] : null;
$product = null;
if($id_product) {
    $product = getProductId($id_product);
}

$title = $product ? 'Admin | Form Edit Data Product' : 'Admin | Form Tambah Data Product';
$h1 = $product ? 'Form Edit Data Product' : 'Form Tambah Data Product';

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
    <h1><?= $h1; ?></h1>
    <form action="../includes/action.php" method="POST">
        <input type="hidden" name="action" value="<?= $product ? 'editProduct' : 'insertProduct' ?>">
    
        <?php if($product): ?>
            <input type="hidden" name="id_product" value="<?= $id_product ?>">
        <?php endif; ?>

        <ul>
            <li>
                <label for="product">Produk</label>
                <input type="text" name="product" id="product" value="<?= $product ? $product['nama_product'] : '' ?>">
            </li>
            <li>
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" value="<?= $product ? $product['harga'] : '' ?>">
            </li>
            <li>
                <button type="submit" name="jasa_submit">Submit</button>
            </li>
        </ul>
    </form>

</body>
</html>
