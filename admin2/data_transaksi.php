<?php 
require '../includes/functions.php';
$query = "SELECT tb_transaksi.id_transaksi, 
            tb_klien.nama_klien, 
            tb_jasa.nama_jasa, 
            tb_transaksi.tanggal, 
            tb_transaksi.jumlah_jasa, 
            tb_jasa.harga, 
            tb_transaksi.total_pembayaran
            FROM tb_klien INNER JOIN tb_transaksi ON tb_klien.id_klien = tb_transaksi.id_klien INNER JOIN tb_jasa ON tb_jasa.id_jasa = tb_transaksi.id_jasa";
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
    <a href="form_transaksi">Tambah Data</a>
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
            <th>Nama Pelanggan</th>
            <th>Nama Produk</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total Pembayaran</th>
            <th>Aksi</th>
        </tr>
        <?php foreach(getDatas($query) as $row): ?>
        <tr>
            <td><?= $row['id_transaksi'];?></td>
            <td><?= $row['nama_klien'];?></td>
            <td><?= $row['nama_jasa'];?></td>
            <td><?= $row['tanggal'];?></td>
            <td><?= $row['jumlah_jasa'];?></td>
            <td><?= $row['harga'];?></td>
            <td><?= $row['total_pembayaran'];?></td>
            <td>
                <a href="">Edit</a> |
                <a href="">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>