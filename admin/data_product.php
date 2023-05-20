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
$query = "SELECT * FROM products ORDER BY id_product DESC";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../styles/admin.css" />
    <title>Sidebar Menu | Side Navigation Bar</title>
</head>

<body>
    <div class="container">
    <nav>
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
                    <li class="list">
                        <a href="#" class="nav-link">
                            <i class="bx bx-folder-open icon"></i>
                            <span class="link">Files</span>
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
                        <a href="../auth/logout.php" class="nav-link">
                            <i class="bx bx-log-out icon"></i>
                            <span class="link">Logout</span>
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </nav>
    
    <section class="overlay">
        
        
        </section>
        <?php
        if (isset($_GET['message'])) {
            $msg = $_GET['message'];
            echo "<div class= 'notif'>$msg</div>";
        } ?>

        <section class="content">
        <h1>Data Product</h1>
    
        <br>
        <a href="form_product.php">Tambah Data</a>
    
        <table border="1" cellspacing="0.5" cellpadding="10">
            <tr>
                <th>Id</th>
                <th>Product</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
            <?php $no = 1;
            foreach (getDatas($query) as $row) : ?>
                <tr>
                    <td><?= $row['id_product']; ?></td>
                    <td><?= $row['nama_product']; ?></td>
                    <td><?= $row['harga']; ?></td>
                    <td>
                        <a href="form_product.php?id_product=<?= $row['id_product']; ?>">Edit</a> |
                        <a href="../includes/action.php?id_delete=<?= $row['id_product']; ?>&page=product">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
    </div>
</body>
</html>