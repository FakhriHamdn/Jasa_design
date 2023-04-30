<?php 
require '../includes/functions.php';

if(isset($_GET['id_transaction']) && $_GET['id_transaction'] > 0){
    $id_transaction = $_GET['id_transaction'];
    $row = getTransactionId($id_transaction);
    
    $id_transaction = $row['id_transaction'];
    $id_cust = $row['id_cust'];
    $id_product = $row['id_product'];
    $nama_cust = $row['nama_cust'];
    $nama_product = $row['nama_product'];
    $tanggal = $row['tanggal'];
    $jumlah_product = $row['jumlah_product'];
    $harga = $row['harga'];
    $total_pembayaran = $row['total_pembayaran'];
    $title = 'Admin | Update Data Transaction';
    $h1 = 'Form Update Data Transaction';
    $form_action = '../inludes/action.php?action=updateTransaction';

} else {
    $title = 'Admin | Tambah Data Transaction';
    $h1 = 'Form Tambah Data Transaction';
    $form_action = '../inludes/action.php?action=insertTransaction';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
</head>
<body>
    <h1><?=$h1?></h1>
    <form action="<?=$form_action?>" method="POST">
        <?php if ($row) : ?>
            <input type="hidden" name="id_transaction" value="<?= $row['id_transaction'] ?>">
        <?php endif; ?>
        <ul>
            <li>
                <label for="cust">customers</label>
                <input type="text" name="cust" id="cust" value="<?= ($row) ? $row['nama_cust'] : '' ?>">
            </li>
            <li>
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="<?= ($row) ? $row['alamat'] : '' ?>">
            </li>
            <li>
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="<?=$tanggal?>">
            </li>
            <li>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= ($row) ? $row['email'] : '' ?>">
            </li>
            <li>
                <button type="submit" name="cust_submit">Submit</button>
            </li>
        </ul>
    </form>

</body>
</html>

