<?php
    require "koneksi.php";

    $sql = "SELECT * FROM tb_klien";
    $result = mysqli_query ($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Database Klien Jasa Design</title>
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
    <center>
    <h2 class="judul">DATA KLIEN</h2>
    <table border=1 cellpadding="10" cellspacing="0">
        <tr>
            <th>Id Klien</th>
            <th>Nama Klien</th>
            <th>Alamat</th>
            <th>No telp</th>
            <th>Email</th>
        </tr>
        <?php while ($row=mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?=$row['id_klien']?></td>
            <td><?=$row['nama_klien']?></td>
            <td><?=$row['alamat']?></td>
            <td><?=$row['no_telp']?></td>
            <td><?=$row['email']?></td>
        </tr>
        <?php endwhile ?>
    </table>
    </center>
</body>
</html>