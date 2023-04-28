<?php 
require '../includes/functions.php';

$query = "SELECT * FROM tb_klien";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Data Jasa</title>
</head>
<body>
    <h1>Data Jasa Produk</h1>
    <a href="form_klien.php">Tambah Data</a>
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
            <th>Pelanggan</th>
            <th>alamat</th>
            <th>No Telp</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php foreach(getDatas($query) as $row): ?>
        <tr>
            <td><?= $row['id_klien'];?></td>
            <td><?= $row['nama_klien'];?></td>
            <td><?= $row['alamat'];?></td>
            <td><?= $row['no_telp'];?></td>
            <td><?= $row['email'];?></td>
            <td>
                <a href="">Edit</a> |
                <a href="">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>