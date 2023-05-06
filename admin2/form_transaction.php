<?php 
require '../includes/functions.php';


if(isset($_GET['id_transaction']) && $_GET['id_transaction'] > 0){
    $id_transaction = $_GET['id_transaction'];
    $row = getTransactionId($id_transaction);
        
    $id_transaction = $row['id_transaction'];
    $id_product = $row['id_product'];
    $id_cust = $row['id_cust'];

    $title = 'Admin | Update Data Transaction';
    $h1 = 'Form Update Data Transaction';
    $form_action = '../includes/action.php?action=updateTransaction';
    
} else {
    $row = [];
    $title = 'Admin | Tambah Data Transaction';
    $h1 = 'Form Tambah Data Transaction';
    $form_action = '../includes/action.php?action=addTransaction';
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
        <?php if($row) : ?>
            <input type="hidden" name="id_transaction" value="<?= $id_transaction; ?>">
        <?php endif; ?>
        <ul>
            <li>
                <label for="nama_cust">Customer</label>
                <select name="id_cust" id="nama_cust">
                    <option disabled selected>Pilih Customer</option> 
                    
                    <?php foreach(fetchCustomer() as $opsi) : ?>
                        <?php $selected = $opsi['id_cust'] == $id_cust ? 'selected' : '' ;?>
                        <option value="<?= $opsi['id_cust'];?>" <?= $selected?> ><?= $opsi['nama_cust'] . ' - ' . $opsi['no_telp'];?></option>
                    <?php endforeach;?>

                </select>
            </li>
            <li>
                <label for="product">Product</label>
                <select name="id_product" id="nama_product">
                    <option disabled selected>Pilih Product</option>   

                    <?php foreach(fetchProduct() as $opsi) : ?>
                        <?php $selected = $opsi['id_product'] == $id_product ? 'selected' : '';?>
                        <option value="<?= $opsi['id_product'];?>" <?= $selected?> ><?= $opsi['nama_product'] . ' -Rp ' . $opsi['harga'];?></option>
                    <?php endforeach;?>
                </select>
            </li>
            <li>
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" value="<?= ($row) ? $row['tanggal'] : '' ?>">
            </li>
            <li>
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" value="<?= ($row) ? $row['jumlah_product'] : '' ?>">
            </li>
            <li>
                <button type="submit" name="transaction_submit">Submit</button>
            </li>
        </ul>
    </form>

</body>
</html>

