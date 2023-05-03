<?php 
require '../includes/functions.php';

$query = "SELECT * FROM customers";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin | Data Jasa</title>
</head>
<body>
<?php
    if (isset($_GET['message'])) {
        $msg = $_GET['message'];
        echo "<div class= 'notif'>$msg</div>";
    } ?>
    <a href="logout.php">Logout</a>
    <h1>Data Jasa Produk</h1>
    <a href="form_cust.php">Tambah Data</a>
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
            <th>Customer</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php foreach(getDatas($query) as $row): ?>
        <tr>
            <td><?= $row['id_cust'];?></td>
            <td><?= $row['nama_cust'];?></td>
            <td><?= $row['alamat'];?></td>
            <td><?= $row['no_telp'];?></td>
            <td><?= $row['email'];?></td>
            <td>
                <a href="form_cust.php?id_cust=<?= $row['id_cust'];?>">Edit</a> |
                <a href="../includes/action.php?id_delete=<?= $row['id_cust']?>&page=customer">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>