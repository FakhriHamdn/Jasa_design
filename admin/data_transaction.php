<?php
require '../includes/functions.php';
$query = "SELECT transactions.id_transaction, 
            customers.nama_cust, 
            products.nama_product, 
            transactions.tanggal, 
            transactions.jumlah_product, 
            products.harga, 
            transactions.total_pembayaran
            FROM customers 
            INNER JOIN transactions ON customers.id_cust = transactions.id_cust 
            INNER JOIN products ON products.id_product = transactions.id_product
            ORDER BY transactions.id_transaction DESC";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/Logo-rofara2.png" type="image/x-icon">
    <title>Admin | Data Transaction</title>
</head>

<body>
    <?php
    if (isset($_GET['message'])) {
        $msg = $_GET['message'];
        echo "<div class= 'notif'>$msg</div>";
    } ?>
    <a href="../auth/logout.php">Logout</a>
    <h1>Data Transactions</h1>
    <a href="form_transaction.php">Tambah Data</a>
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
            <th>Nama Customer</th>
            <th>Nama Product</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total Pembayaran</th>
            <th>Aksi</th>
        </tr>
        <?php foreach (getDatas($query) as $row) : ?>
            <tr>
                <td><?= $row['id_transaction']; ?></td>
                <td><?= $row['nama_cust']; ?></td>
                <td><?= $row['nama_product']; ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td><?= $row['jumlah_product']; ?></td>
                <td><?= $row['harga']; ?></td>
                <td><?= $row['total_pembayaran']; ?></td>
                <td>
                    <a href="form_transaction.php?id_transaction=<?= $row['id_transaction']; ?>">Edit</a> |
                    <a href="../includes/action.php?id_delete=<?= $row['id_transaction']; ?>&page=transaction">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>