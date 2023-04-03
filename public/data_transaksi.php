<?php 
require "koneksi.php";

$sql_transaksi = "SELECT 
                    tb_transaksi.id_transaksi, 
                    tb_klien.nama_klien, 
                    tb_jasa.nama_jasa, 
                    tb_transaksi.tanggal, 
                    tb_transaksi.jumlah_jasa, 
                    tb_transaksi.harga, 
                    tb_transaksi.total_pembayaran
                FROM tb_jasa INNER JOIN tb_transaksi ON tb_jasa.id_jasa = tb_transaksi.id_jasa 
                INNER JOIN tb_klien ON tb_klien.id_klien = tb_transaksi.id_klien";
$result_transaksi = mysqli_query ($conn, $sql_transaksi);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Table Database Transaksi</title>
</head>
<body>
<header> 
        <h2 class="logo">Jasa Design</h2>
    
    <nav>
        <ul class="nav_links">
            <li><a href="home.php">Home</a></li>
            <li><a href="data_jasa.php">Data Jasa</a></li>
            <li><a href="data_klien.php">Data Klien</a></li>
            <li><a href="data_transaksi.php">Data Transaksi</a></li>
        </ul>
    </nav>

    <a class="cta" href="#"><button>Contact</button></a>
    </header>
    <h2 class="judul">DATA TRANSAKSI</h2>
        <table border="1" style="border-collapse: collapse;">
            <tr>
                <th>Id Transaksi</th>
                <th>Nama KLien</th>
                <th>Nama Jasa</th>
                <th>Tanggal Pembelian</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total Pembayaran</th>
            </tr>
            <?php while ($row=mysqli_fetch_assoc($result_transaksi)):
                $total_pembayaran = $row['jumlah_jasa']*$row['harga'] ?> 
                <tr>
                    <td><?=$row['id_transaksi']?></td>
                    <td><?=$row['nama_klien']?></td>
                    <td><?=$row['nama_jasa']?></td>
                    <td><?=$row['tanggal']?></td>
                    <td><?=$row['jumlah_jasa']?></td>
                    <td><?=$row['harga']?></td>
                    <td><?=$row['total_pembayaran']?></td>
                </tr>
                <?php endwhile ?>
            </table>
</body>
</html>