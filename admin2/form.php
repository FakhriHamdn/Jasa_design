<?php 
require_once '../includes/functions.php';

$query = "SELECT * FROM customers";
$query1 = "SELECT * FROM products";

if(isset($_GET['id_transaction']) && $_GET['id_transaction'] > 0){
    $id_transaction = $_GET['id_transaction'];
    $id_cust = $_POST['id_cust'] ?? '';
    $id_product = $_POST['id_product'] ?? '';
    $jumlah = $_POST['jumlah'] ?? '';

    $row = getTransactionId($id_transaction);
    if($row){
        $title = "Admin | Edit Data Transactions";
        $h1 = "Form Edit Data Transaction";
        $form_action = "../includes/action.php?action=updateTransaction";
    } 
} else {
    $id_transaction = '';
    $id_cust = '';
    $id_product = '';
    $jumlah = '';
    $title = "Admin | Tambah Data Transactions";
    $h1 = "Form Tambah Data Transaction";
    $form_action = "../includes/action.php?action=insertTransaction";
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
    <h1><?= $h1 ?></h1>
    <form action="<?= $form_action ?>" method="POST">
        <input type="hidden" name="id_transaction" value="<?= $id_transaction ?>">
        <ul>
            <li>
                <label for="nama_cust">Nama Customer</label>
                <select name="id_cust" id="id_cust">
                    <option disable selected>Pilih Nama Customer</option>
                    <?php foreach(getDatas($query) as $opsi) : ?>
                        <?php $select = $opsi['id_cust'] === $id_cust ? 'selected' : '';?>
                        <option value="<?= $opsi['id_cust'] ?>" <?= $select ?> ><?= $opsi['nama_cust']  . ' - ' . $opsi['alamat']  . ' - ' . $opsi['no_telp']?></option>
                    <?php endforeach; ?>
                </select>
            </li>
            
            <li>
                <label for="nama_product">Product</label>
                <select name="id_product" id="id_product">
                    <option disable selected>Pilih Product</option>
                    <?php foreach(getDatas($query1) as $opsi) : ?>
                        <?php $select = $opsi['id_product'] === $id_product ? 'selected' : '';?>
                        <option value="<?= $opsi['id_product'] ?>" <?= $select ?> ><?= $opsi['nama_product']  . ' ' . '- Rp ' . $opsi['harga']?>
                    <?php endforeach; ?>
                </select>
            </li>
            <li>
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="<?= $tanggal?>">
            </li>
            <li>
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" value="<?= $jumlah ?>">
            </li>
            <li>
                <button type="submit" name="transaction_submit">Submit</button>
            </li>
        </ul>
    </form>

</body>
</html>