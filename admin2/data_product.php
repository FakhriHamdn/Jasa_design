<?php 
// require '../includes/action.php';
require '../includes/functions.php';

$query = "SELECT * FROM products";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Data Product</title>
</head>
<body>
    <h1>Data Product</h1>
    <a href="form_product.php">Tambah Data</a>
    <nav>
        <ul>
            <li><a href="data_product.php">Data Product</a></li>
            <li><a href="data_cust.php">Data Customer</a></li>
            <li><a href="data_transaction.php">Data Transaksi</a></li>
            <li><a href="data_user.php">Data Personal User</a></li>
        </ul>
    </nav>
    <table border="1" cellspacing="0.5" cellpadding="10">
        <tr>
            <th>Id</th>
            <th>Product</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1;
        foreach(getDatas($query) as $row): ?>
        <tr>
            <td><?= $no++;?></td>
            <td><?= $row['nama_product'];?></td>
            <td><?= $row['harga'];?></td>
            <td>
                <a href="form_product.php?idProduct=<?= $row['id_product'];?>" name="editJasa">Edit</a> |
                <a href="">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>