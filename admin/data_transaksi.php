<?php 
require 'Connection.php';
$add_access = new adminAccess;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/lock_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/admin.css">
    <!-- <script src="script.js"></script> -->
    <title> Admin | Data Transaksi </title>
</head>
<body>
<header class="header">
        <div class="logo-wrapper">
            <img src="../image/rofaralogo.png" alt="Logo Rofara">
        </div>
        <nav class="container_wrapper">
            <div class="navigation_wrapper">
            <ul class="navigation-menu">
                <li><a href="data_jasa.php" class="smooth-scroll">Data Jasa</a></li>
                <li><a href="data_klien.php" class="smooth-scroll">Data User</a></li>
                <li><a href="data_transaksi.php" class="smooth-scroll">Data Transaksi</a></li>
            </ul>
            </div>
        </nav>
        <div class="logout">
            <button><a class="href-logout" href="../index.php">Home</a></button>
        </div>
    </header>



    <br><br><br>
    <div class="text-h2">
        <h2>Database Data Transaksi</h2>
    </div>
    <div class="table_container">
    <main class="table">
        <section class="table_header">
            <p>Data Transaksi Jasa</p>
        </section>
        <div class="header_tambah">
            <a href="form_transaksi.php?" class="tambah_jasa">Tambah Data</a>
        </div>
        <section class="table_body">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Jasa</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($add_access->getTransactions() as $row ) {?>
                        <tr>
                            <td><?php echo $row ['id_transaksi']?></td>
                            <td><?php echo $row ['nama_klien']?></td>
                            <td><?php echo $row ['nama_jasa']?></td>
                            <td><?php echo $row ['tanggal']?></td>
                            <td><?php echo $row ['jumlah_jasa']?></td>
                            <td><?php echo $row ['harga']?></td>
                            <td><?php echo $row ['total_pembayaran']?></td>
                            <td>
                            <a href="form_transaksi.php?id_transaksi=<?=$row['id_transaksi']?>" class="edit-button">Edit</a>
                            <a href="action.php?id_transaksi=<?=$row['id_transaksi']?>&action=delete_transactions" class="del-button">Hapus</a>
                            </td>
                        </tr>
                    <?php };?>
                </tbody>
            </table>
        </section>
    </main>
</div>

<br><br><br>
<br><br><br>
<br><br><br>
</body>
</html>