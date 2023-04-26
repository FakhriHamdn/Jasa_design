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
    <link href="https://fonts.googleapis.com/css2?family=Poppins|Montserrat&display=swap" rel="stylesheet">
    
    <title> Admin | Data Jasa Design </title>

</head>
<body>
    <header class="header">
        <div class="logo-wrapper">
            <img src="../image/rofaralogo.png" alt="Logo Rofara">
        </div>
        <nav class="container_wrapper">
            <div class="navigation_wrapper">
                <ul class="navigation-menu">
                <li><a href="data_jasa.php" class="active">Data Jasa</a></li>
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
        <h2>Database Data Jasa</h2>
    </div>
<div class="table_container">
    <main class="table">
        <section class="table_header">
            <p>Data Jasa Design</p>
        </section>
        <div class="header_tambah">
            <a href="form_jasa.php" class="tambah_jasa">Tambah Data</a>
        </div>
            <section class="table_body">
            <table>
                <thead>
                    <tr class="data-tr">
                        <th>ID Jasa</th>
                        <th>Jenis Jasa</th>
                        <th>Harga</th>
                        <th class="th-aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($add_access->getServices() as $row ) : ?>
                        <tr>
                            <!-- pake $no++ biar pas input sesuai nomor urutnya di browser -->
                            <td><?php echo $row['id_jasa']?></td>
                            <td><?php echo $row['nama_jasa']?></td>
                            <td><?php echo $row['harga']?></td>
                            <td class="button-aksi">
                                <a href="form_jasa.php?id_jasa=<?= $row['id_jasa']?>" class="edit-button">Edit</a>
                                <a href="action.php?id_jasa=<?= $row['id_jasa']?>&action=delete_service" class="del-button">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</div>
<script src="script.js"></script>
</body>
</html>
