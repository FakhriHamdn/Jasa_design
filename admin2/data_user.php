<?php 
require '../includes/functions.php';

$query = "SELECT * FROM users";




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
    <a href="form_user">Tambah Data</a>
    <nav>
        <ul>
            <li><a href="data_jasa.php">Data Produk</a></li>
            <li><a href="data_klien.php">Data Klien</a></li>
            <li><a href="data_transaksi.php">Data Transaksi</a></li>
            <li><a href="data_user.php">Data Personal User</a></li>
        </ul>
    </nav>
    <table border="1" cellspacing="0.5" cellpadding="10">
        <tr>
            <th>Id</th>
            <th>Email</th>
            <th>Password</th>
            <th>Fullname</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php foreach(getDatas($query) as $row): ?>
        <tr>
            <td><?= $row['id_user'];?></td>
            <td><?= $row['email'];?></td>
            <td><?= $row['password'];?></td>
            <td><?= $row['fullname'];?></td>
            <td><?= $row['role'];?></td>
            <td>
                <a href="">Edit</a> |
                <a href="">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>