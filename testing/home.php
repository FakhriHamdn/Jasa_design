<?php 
session_start();


if(!isset($_SESSION['implem_image'])){
    $_SESSION['implem_image'] = [];
}

var_dump($_FILES);
// unset($_SESSION['imple_image']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
    <a href="index.php">Tambah Data</a>
    <table border="1" cellspacing="0.5" cellpadding="10">
        <tr>
            <td>Image</td>
            <td>Nama Barang</td>
            <td>Harga</td>
            <td>Aksi</td>
        </tr>
        <?php foreach($_SESSION['imple_image'] as $key => $row) : ?>
        <tr>
            <td><?= $row['image']?></td>
            <td><?= $row['nama_barang']?></td>
            <td><?= $row['harga']?></td>
            <td>
                <a href="action.php?delete_imple=<?= $key ?>">delete</a>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</body>
</html>