<?php
session_start();

//====== VALIDASI AGAR USER TIDAK BISA ASAL MASUK
if (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
} else if (!isset($_SESSION['status'])) {
    header('Location: ../index.php');
    exit;
}
//======= END VALIDASI


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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../image/Logo-rofara2.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/admin.css" />
    <title>Admin Dashboard | Data Transactions</title>
</head>

<body>
    <div class="container">
        <nav class="navbar_container">
            <div class="sidebar">
                <div class="logo_wrapper">
                    <img src="../image/rofaralogo.png" alt="Logo Rofara" style="width: 180.6px; height: 53.235px;">
                </div>

                <div class="sidebar-content">
                    <ul class="lists">
                        <li class="list">
                            <a href="data_product.php" class="nav-link">
                                <i class="bx bx-home-alt icon"></i>
                                <span class="link">Data Products</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="data_cust.php" class="nav-link">
                                <i class="bx bx-bar-chart-alt-2 icon"></i>
                                <span class="link">Data Customers</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="data_user.php" class="nav-link">
                                <i class="bx bx-bell icon"></i>
                                <span class="link">Data Users</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="data_transaction.php" class="nav-link">
                                <i class="bx bx-message-rounded icon"></i>
                                <span class="link">Data Transactions</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="#" class="nav-link">
                                <i class="bx bx-pie-chart-alt-2 icon"></i>
                                <span class="link">Analytics</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="#" class="nav-link">
                                <i class="bx bx-heart icon"></i>
                                <span class="link">Likes</span>
                            </a>
                        </li>

                    </ul>

                    <div class="bottom-cotent">
                        <li class="list">
                            <a href="#" class="nav-link">
                                <i class="bx bx-cog icon"></i>
                                <span class="link">Settings</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="../index.php" class="nav-link">
                                <i class="bx bx-log-out icon"></i>
                                <span class="link">Back Home</span>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
        </nav>

        <section class="content">
            <?php
            if (isset($_GET['message'])) {
                $msg = $_GET['message'];
                echo "<div class= 'notif'>$msg</div>";
            } ?>
            <a href="../auth/logout.php">Logout</a>
            <h1>Data Transactions</h1>
            <a href="form_transaction.php">Tambah Data</a>
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
        </section>
    </div>

</body>

</html>