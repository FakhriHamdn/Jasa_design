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

$jumlahDataPerhalaman = 10;

// count menghitung panjang data di array associatif
$jumlahData = count(getDatas("SELECT * FROM products"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;

$dataAwal = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

$query = "SELECT * FROM products ORDER BY id_product ASC LIMIT $dataAwal, $jumlahDataPerhalaman";






?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--===== LINK-LINK =====-->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../image/Logo-rofara2.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/admin.css" />
    <!--===== END =====-->

    <title>Admin Dashboard | Data Products</title>
</head>


<body>
    <div class="container">
        <nav class="navbar_container">
            <div class="sidebar">

                <!--===== LOGO WRAPPPER =====-->
                <div class="logo_wrapper">
                    <img src="../image/rofaralogo.png" alt="Logo Rofara" style="width: 180.6px; height: 53.235px;">
                </div>
                <!--===== END LOGO =====-->
                
                <span class="vertical_line"></span>

                <!--===== SIDEBAR CONTENT =====-->
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
                    <!-- BOTTOM CONTENT -->
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
                    <!-- END BOTTOM -->
                </div>
                <!--===== END CONTENT =====-->
            </div>
        </nav>

        <!--===== MAIN CONTENT =====-->
        <section class="content">
            <?php
            if (isset($_GET['message'])) {
                $msg = $_GET['message'];
                echo "<div class= 'notif'>$msg</div>";
            }?>

            <h1 class="header_text">Admin | Data Product</h1>

            <div class="notif_operator">
                <p></p>
            </div>

            <div class="table_container">
            <?php if($halamanAktif > 1): ?>
                        <a href="?page=<?= $halamanAktif - 1?>">&laquo;</a>
                    <?php endif; ?>


                    <?php for($i = 1; $i <= $jumlahHalaman; $i++): ?>
                        <?php if( $i == $halamanAktif) : ?>
                            <!-- href ini bakal tetep ke index.php karena kosong -->
                            <a href="?page=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i;?></a>
                        <?php else : ?>
                            <a href="?page=<?= $i; ?>"><?= $i;?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if($halamanAktif < $jumlahHalaman): ?>
                        <a href="?page=<?= $halamanAktif + 1?>">&raquo;</a>
                    <?php endif; ?>
                <a class="add_data" href="form_product.php">Tambah Data</a>
                    <table border="1">
                        <tr>
                            <th class="id">Id</th>
                            <th>Product</th>
                            <th>Harga</th>
                            <th class="aksi">Aksi</th>
                        </tr>
                        <?php $no = 1;
                        foreach (getDatas($query) as $row) : ?>
                            <tr class="data_table">
                                <td class="id"><?= $row['id_product']; ?></td>
                                <td><?= $row['nama_product']; ?></td>
                                <td>Rp. <?= $row['harga']; ?></td>
                                <td class="aksi">
                                    <div class="aksi_wrapper">
                                        <a class="edit" href="form_product.php?id_product=<?= $row['id_product']; ?>">Edit</a>
                                        <a class="delete" href="../includes/action.php?id_delete=<?= $row['id_product']; ?>&page=product">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                
            </div>

        </section>
        <!--===== END MAIN =====-->
    </div>
</body>

</html>