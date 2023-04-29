<?php
require '../includes/functions.php';


if(isset($_GET['id_product']) && $_GET['id_product'] > 0){
    $id_product = $_GET['id_product'];
    $row = getProductId($id_product);
    $title = 'Admin | Form Edit Data Product';
    $h1 = 'Form Edit Data Product';
} else {
    $row = [];
    $title = 'Admin | Form Tambah Data Product';
    $h1 = 'Form Tambah Data Product';
}


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
        <input type="hidden" name="action" value="insertProduct">
    
        <?php if($row) { ?>
            <input type="hidden" name="id_product" value="<?= $_GET['id_product']; ?>">
            <input type="hidden" name="action" value="editProduct">

        <?php } ?>


        <ul>
            <li>
                <label for="product">Produk</label>
                <input type="text" name="product" id="product" value="<?= ($row) ? $row['nama_product'] : ''; ?>">
            </li>
            <li>
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" value="<?= ($row) ? $row['harga'] : ''; ?>">
            </li>
            <li>
                <button type="submit" name="jasa_submit">Submit</button>
            </li>
        </ul>
    </form>

</body>
</html>