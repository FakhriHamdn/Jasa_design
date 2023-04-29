<?php 
require '../includes/functions.php';

if(isset($_GET['id_transaction']) && $_GET['id_transaction'] > 0){
    $id_transaction = $_GET['id_transaction'];
    $row = getTransactionId($id_transaction);
    if($row){
        $title = "Admin | Edit Data Transactions";
        $h1 = "Form Edit Data Transactions";
        $form_action = "../includes/action.php?action=updateTransaction";
    }

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
    <form action="<?= $form_action?>" method="POST">
        <input type="hidden" name="action" value="insertProduct">
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
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" value="<?= ($row) ? $row['harga'] : ''; ?>">
            </li>
            <li>
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" value="<?= ($row) ? $row['harga'] : ''; ?>">
            </li>
            <li>
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" value="<?= ($row) ? $row['harga'] : ''; ?>">
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