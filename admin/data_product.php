<?php
session_start();

//====== VALIDASI AKSES
if (!isset($_SESSION['status'])) {
    header('Location: ../index.php');
    exit;

} else if (!isset($_SESSION['verify'])) {
    header("location: ../auth/verify.php");
    exit;

} else if (isset($_SESSION['role'])) {
    if($_SESSION['role'] === 'admin'){
        $role_text = 'Admin';
        header("location:");

    } else if($_SESSION['role'] === 'operator'){
        $role_text = 'Operator';
        header("location:");

    } else {
        header('Location: ../index.php');
        exit;
    }
}
//======= END VALIDASI


//======= ACTION UNTUK BEBERAPA FITUR
require '../includes/functions.php';

$jumlahDataPerhalaman = 10;

// count menghitung panjang data di array associatif
$jumlahData = count(getDatas("SELECT * FROM products"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;

$dataAwal = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

$query = "SELECT * FROM products ORDER BY id_product ASC LIMIT $dataAwal, $jumlahDataPerhalaman";


if (isset($_GET['container']) && $_GET['container'] === 'product') {

    if (isset($_GET['id_product']) && $_GET['id_product'] > 0) {
        $id_product = $_GET['id_product'];
        $row = getProductId($id_product);

        $title = 'Admin | Form Edit Data Product';
        $h1 = 'Form Edit Data Product';
        $form_action = '../includes/action.php?action=updateProduct';
    } else {
        $row = [];

        $title = 'Admin | Form Tambah Data Product';
        $h1 = 'Form Tambah Data Product';
        $form_action = '../includes/action.php?action=addProduct';
    }
}

//======= END ACTION


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--======= LINK-LINK =======-->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../image/Logo-rofara2.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/admin.css" />
    <!--======= END =======-->

    <title><?= $role_text; ?> Dashboard | Data Products</title>
</head>


<body>
    <div class="container">
        <nav class="navbar_container">
            <div class="sidebar">

                <!--======= LOGO WRAPPPER =======-->
                <div class="logo_wrapper">
                    <img src="../image/rofaralogo.png" alt="Logo Rofara" style="width: 180.6px; height: 53.235px;">
                </div>
                <!--======= END LOGO =======-->

                <span class="vertical_line"></span>

                <!--======= SIDEBAR CONTENT =======-->
                <div class="sidebar-content">
                    <ul class="lists">
                        <li class="list">
                            <a href="data_product.php" class="nav-link">
                                <i class='bx bx-package icon'></i>
                                <span class="link">Data Products</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="data_cust.php" class="nav-link">
                                <i class='bx bx-group icon'></i>
                                <span class="link">Data Customers</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="data_user.php" class="nav-link">
                                <i class='bx bx-user icon'></i>
                                <span class="link">Data Users</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="data_transaction.php" class="nav-link">
                                <i class='bx bx-wallet icon'></i>
                                <span class="link">Data Transactions</span>
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
                <!--======= END SIDEBAR CONTENT =======-->
            </div>
        </nav>


        <!--============= MAIN CONTENT =============-->
        <section class="content">
                <h1 class="header_text"><?= $role_text; ?> | Data Product</h1>


            <!--======= SPACE OPERATOR IN ADMIN DATABASE =======-->
            <?php if($_SESSION['role'] === 'admin'):?>
                <div class="space_operator">
                    <div class="operator_wrapper">
                    <table border="1">
                            <tr>
                                <th class="id">Id</th>
                                <th>Product</th>
                                <th>Harga</th>
                                <th class="aksi">Aksi</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Banner X Ori</td>
                                <td>Rp. xxx</td>
                                <td>
                                    <a href="?view">view</a>
                                    <a href="">reject</a>|
                                    <a href="">accept</a>|
                                </td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
            <?php endif;?>
            <!--======= END SPACE OPERATOR =======-->


            <!--======= SPACE TABLE DATABASES =======-->
            <div class="table_container">
                <?php if (isset($_GET['container']) && $_GET['container'] === 'product') : ?>


                    <form action="<?= $form_action; ?>" method="POST" enctype="multipart/form-data">
                        <?php if ($row) : ?>
                            <input type="hidden" name="id_product" value="<?= $row['id_product']; ?>">
                        <?php endif; ?>

                        <ul>
                            <li>
                                <label for="product_image">Image</label>
                                <input type="file" name="product_image" id="product_image" value="<?= ($row) ? $row['product_image'] : ''; ?>">
                            </li>
                            <li>
                                <label for="product">Produk</label>
                                <input type="text" name="product" id="product" value="<?= ($row) ? $row['nama_product'] : ''; ?>">
                            </li>
                            <li>
                                <label for="harga">Harga</label>
                                <input type="number" name="harga" id="harga" value="<?= ($row) ? $row['harga'] : ''; ?>">
                            </li>
                            <li>
                                <button type="submit" name="product_submit">Submit</button>
                            </li>
                        </ul>
                    </form>

                <?php else : ?>
                    <?php if ($halamanAktif > 1) : ?>
                        <a href="?page=<?= $halamanAktif - 1 ?>">&laquo;</a>
                    <?php endif; ?>


                    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                        <?php if ($i == $halamanAktif) : ?>
                            <!-- href ini bakal tetep ke index.php karena kosong -->
                            <a href="?page=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
                        <?php else : ?>
                            <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($halamanAktif < $jumlahHalaman) : ?>
                        <a href="?page=<?= $halamanAktif + 1 ?>">&raquo;</a>
                    <?php endif; ?>
                    <a class="add_data" href="?container=product">Tambah Data</a>
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
                                        <?php if($_SESSION['role'] === 'admin'):?>
                                            <a class="edit" href="?id_product=<?= $row['id_product']; ?>&container=product">Edit</a>
                                            <a class="delete" href="../includes/action.php?id_delete=<?= $row['id_product']; ?>&page=product">Delete</a>
                                        <?php elseif($_SESSION['role'] === 'operator'):?>
                                            <a class="edit" href="?id_product=<?= $row['id_product']; ?>&container=product">Edit</a>
                                        <?php endif;?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                <?php endif; ?>
            </div>

            <!--======= END TABLE DATABASES =======-->

        </section>
        <!--======= END MAIN CONTENT =======-->
    </div>

</body>
</html>