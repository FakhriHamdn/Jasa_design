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
    <title> Admin | Data Pelanggan </title>
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
        <h2>Database Data User</h2>
    </div>
    <div class="table_container">
    <main class="table">
        <section class="table_header">
            <p>Data User</p>
        </section>
        <div class="header_tambah">
            <a href="form_klien.php" class="tambah_jasa">Tambah Data</a>
        </div>
        <section class="table_body">
            <table>
                <thead>
                    <tr>
                        <th>Id klien</th>
                        <th>Nama klien</th>
                        <th>Alamat</th>
                        <th>no telp</th>
                        <th>email</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                <tbody>
                    <?php $no=1; foreach($add_access->getCustomer() as $row ) {?>
                        <tr>
                            <td><?php echo $row['id_klien']?></td>
                            <td><?php echo $row['nama_klien']?></td>
                            <td><?php echo $row['alamat']?></td>
                            <td><?php echo $row['no_telp']?></td>
                            <td><?php echo $row['email']?></td>
                            <td class="button-aksi">
                                <a href="form_klien.php?id_klien=<?php echo $row['id_klien']?>" class="edit-button">Edit</a>
                                <a href="action.php?id_klien=<?php echo $row['id_klien']?>& action=delete_klienID" class="del-button">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
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