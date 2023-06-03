<?php
session_start();

//====== VALIDASI AGAR USER TIDAK BISA ASAL MASUK
if(isset($_SESSION['role']) && $_SESSION['role'] !== 'admin'){
    header('Location: ../index.php');
    exit;
} else if(!isset($_SESSION['status'])){
    header('Location: ../index.php');
    exit;
}
//======= END VALIDASI


require '../includes/functions.php';

if(isset($_GET['id_product']) && $_GET['id_product'] > 0){
    $id_product = $_GET['id_product'];
    $row = getProductId($id_product);

    $title = 'Admin | Form Edit Data Product';
    $h1 = 'Form Edit Data Product';
    $form_action = '../includes/action.php?action=updateProduct';
} else {
    $row = [];
    
    $title = 'Admin | Form Tambah Data Product';
    $h1 = 'Form Tambah Data Product';
    $form_action = '../includes/action.php?action=addProduct';
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
    <form action="<?= $form_action; ?>" method="POST" enctype="multipart/form-data">
        <?php if($row) : ?>
            <input type="hidden" name="id_product" value="<?= $row['id_product']; ?>">
        <?php endif; ?>

        <ul>
            <li>
                <label for="product_image">Image</label>
                <input type="file" name="product_image" id="product_image" value="<?= ($row) ? $row['product_image'] : ''; ?>">
            </li>
            <li>
                <label for="product">Produk</label>
                <input type="text" name="product" id="product" value="<?= ($row) ? $row['nama_product'] : ''; ?>">
            </li>
            <li>
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" value="<?= ($row) ? $row['harga'] : ''; ?>">
            </li>
            <li>
                <button type="submit" name="product_submit">Submit</button>
            </li>
        </ul>
    </form>

</body>
</html>