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
    if ($_SESSION['role'] === 'admin') {
        $role_text = 'Admin';
        header("location:");
    } else if ($_SESSION['role'] === 'operator') {
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
        $h1 = 'Edit Data Product';
        if ($_SESSION['role'] === 'admin') {
            $form_action = '../includes/action.php?action=updateProduct';
        } elseif ($_SESSION['role'] === 'operator') {
            $form_action = '../includes/action.php?action=request_updateProduct';
        }
    } else {
        $row = [];

        $title = 'Admin | Form Tambah Data Product';
        $h1 = 'Tambah Data Product';
        $form_action = '../includes/action.php?action=addProduct';
    }
}
//======= END ACTION
// $operator_request = $_SESSION['email'];

if ($_SESSION['role'] === 'operator') {
    if (!isset($_SESSION['request'])) {
        $_SESSION['request'] = [];
    }
}
// $operator = 'nabilazifa@gmail.com';


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
                        <!-- <li class="list">
                            <a href="#" class="nav-link">
                                <i class="bx bx-cog icon"></i>
                                <span class="link">Settings</span>
                            </a>
                        </li> -->
                        <li class="list">
                            <a href="../index.php" class="nav-link">
                                <i class='bx bx-home icon'></i>
                                <span class="link">Back Home</span>
                            </a>
                        </li>

                        <span class="vertical_line"></span>

                        <li class="list">
                            <a href="../auth/logout.php" class="nav-link">
                                <i class="bx bx-log-out icon"></i>
                                <span class="link">Log out</span>
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
            <div class="content_wrapper">
                <h1 class="header_text"><?= $role_text; ?> | Data Products</h1>

                <!--=============== NOTIFICATION  -->
                <?php if (isset($_GET['message'])) : ?>
                    <?php if (isset($_GET['auth_message'])) : ?>
                        <div class="notif" style="background: #2EDBE3; color: #24242a;">
                            <i class='bx bx-user-check icon-msg'></i>
                            <span class='msg-text'>
                                <?= $_GET['auth_message']; ?>
                        </div>

                    <?php elseif (isset($_GET['delete_message'])) : ?>
                        <div class="notif" style="background: #bf202f; color: #fff;">
                            <i class='bx bx-message-x icon-msg'></i>
                            <span class='msg-text'>
                                <?= $_GET['delete_message']; ?>
                        </div>

                    <?php elseif (isset($_GET['update_message'])) : ?>
                        <div class="notif" style="background: #fec112; color: #24242a;">
                            <i class='bx bx-message-check icon-msg'></i>
                            <span class='msg-text'>
                                <?= $_GET['update_message']; ?>
                        </div>

                    <?php elseif (isset($_GET['add_message'])) : ?>
                        <div class="notif" style="background: #029400; color: #fff;">
                            <i class='bx bx-message-add icon-msg'></i>
                            <span class='msg-text'>
                                <?= $_GET['add_message']; ?>
                        </div>

                    <?php endif; ?>
                <?php endif; ?>
                <!--=============== END NOTIFICATION  -->

                <div class="main_dashboard_container">
                    <!--======= SPACE OPERATOR IN ADMIN DATABASE =======-->
                    <?php if ($_SESSION['role'] === 'admin') : ?>
                        <div class="space_operator">
                            <div class="operator_wrapper">

                                <?php //var_dump($_SESSION['request']); ?>
                                <?php //unset($_SESSION['request']);
                                ?>

                                <?php if (count($_SESSION['request']) > 0) : ?>

                                    <?php if (isset($_GET['details_op'])) : ?>

                                        <?php else:?>
                                    <div class="title_operator">
                                        <h3>Operator Request's</h3>

                                        <div class="data_management_container">
                                            <div class="search_container">
                                                <input type="text" class="search_bar" placeholder="Search datas..." autofocus>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="operator_table">
                                        <table border="1">
                                            <tr>
                                                <th class="id">No</th>
                                                <th>Senders</th>
                                                <th class="date">Date</th>
                                                <th>changes</th>
                                                <th class="aksi">Actions</th>
                                            </tr>
                                            <?php $id = 1 ?>
                                            <?php foreach ($_SESSION['request'] as $keys => $rows) : ?>
                                                <tr class="data_table">
                                                    <td class="id"><?= $id++ ?></td>
                                                    <td><?= $rows['nama_sender'] ?></td>
                                                    <td class="date"><?= $rows['send_time'] ?></td>
                                                    <td><?= $rows['nama_product'] ?></td>
                                                    <td class="aksi">
                                                        <div class="aksi_wrapper">
                                                            <a href="?id_request=<?= $keys ?>&details_op" class="details_operator"><i class='bx bx-detail dash-aksi'></i></a>
                                                            <a href="../includes/action.php?accept_request=<?= $keys ?>" class="accept_operator"><i class='bx bx-check-square dash-aksi'></i></a>
                                                            <a href="../includes/action.php?reject_request=<?= $keys ?>" class="reject_operator"><i class='bx bxs-x-square dash-aksi'></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            
                                                
                                            
                                        </table>
                                    </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <h5>Tidak ada request dari operator</h5>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!--======= END SPACE OPERATOR =======-->


                    <!--======= SPACE TABLE DATABASES =======-->
                    <div class="table_container">
                        <div class="table_wrapper">

                            <?php if (isset($_GET['container']) && $_GET['container'] === 'product') : ?>

                                <div class="form_container">
                                    <h3><?= $h1; ?></h3>
                                    <form action="<?= $form_action; ?>" method="POST" enctype="multipart/form-data">
                                        <?php if ($row) : ?>
                                            <input type="hidden" name="id_product" value="<?= $row['id_product']; ?> ">
                                        <?php endif; ?>
                                        <div class="form_wrapper">
                                            <div class="form_image_preview">
                                                <label for="product_image">Image</label>
                                                <input type="file" name="product_image" id="product_image" placeholder="Choose image" value="<?= ($row) ? $row['product_image'] : ''; ?>">
                                            </div>

                                            <!-- <div class="form_input_data"> -->
                                            <ul class="ul_form_input">
                                                <li>
                                                    <label for="product">Product</label>
                                                    <input type="text" name="product" id="product" placeholder="Input product" value="<?= ($row) ? $row['nama_product'] : ''; ?>">
                                                </li>
                                                <li>
                                                    <label for="harga">Price (Rp.)</label>
                                                    <input type="number" name="harga" id="harga" placeholder="Rp. xxx" value="<?= ($row) ? $row['harga'] : ''; ?>">
                                                </li>
                                                <li class="aksi">

                                                    <?php if ($_SESSION['role'] === 'admin') : ?>
                                                        <button type="submit" name="product_submit">Accept changes</button>

                                                    <?php elseif ($_SESSION['role'] === 'operator') : ?>
                                                        <button type="submit" name="request_operator_submit">Accept Changes</button>

                                                    <?php endif; ?>

                                                    <a href="data_product.php" class="reject">Reject</a>
                                                </li>
                                            </ul>

                                            <!-- </div> -->
                                        </div>
                                    </form>
                                </div>

                            <?php else : ?>

                                <div class="pagination_container">
                                    <?php if ($halamanAktif > 1) : ?>
                                        <a href="?page=<?= $halamanAktif - 1 ?>">&laquo;</a>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                        <?php if ($i == $halamanAktif) : ?>
                                            <!-- href ini bakal tetep ke index.php karena kosong -->
                                            <a href="?page=<?= $i; ?>" style="font-weight: bold; color: #bf202f;"><?= $i; ?></a>
                                        <?php else : ?>
                                            <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                                        <?php endif; ?>
                                    <?php endfor; ?>

                                    <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                        <a href="?page=<?= $halamanAktif + 1 ?>">&raquo;</a>
                                    <?php endif; ?>
                                </div>

                                <div class="data_management_container">
                                    <a class="add_data" href="?container=product">Add Data</a>
                                    <div class="search_container">
                                        <input type="text" class="search_bar" placeholder="Search datas..." autofocus>
                                    </div>
                                </div>




                                <div class="table_data_wrapper">
                                    <table>
                                        <tr>
                                            <th></th>
                                            <th class="id">Id</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th class="aksi">Actions</th>
                                        </tr>
                                        <?php $no = 1;
                                        foreach (getDatas($query) as $row) : ?>
                                            <tr class="data_table">
                                                <td><input type="checkbox" name="check_product" class="checkbox"></td>
                                                <td class="id"><?= $row['id_product']; ?></td>
                                                <td class="product"><?= $row['nama_product']; ?></td>
                                                <td class="harga">Rp. <?= $row['harga']; ?></td>
                                                <td class="aksi">
                                                    <div class="aksi_wrapper">
                                                        <?php if ($_SESSION['role'] === 'admin') : ?>
                                                            <a class="edit" href="?id_product=<?= $row['id_product']; ?>&container=product"><i class='bx bx-edit dash-aksi'></i></a>
                                                            <a class="delete" href="../includes/action.php?id_delete=<?= $row['id_product']; ?>&page=product"><i class='bx bx-trash dash-aksi'></i></a>
                                                        <?php elseif ($_SESSION['role'] === 'operator') : ?>
                                                            <a class="edit" href="?id_product=<?= $row['id_product']; ?>&container=product"><i class='bx bx-edit dash-aksi'></i></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!--======= END TABLE DATABASES =======-->
            </div>
        </section>
        <!--======= END MAIN CONTENT =======-->
    </div>



    <!-- Script JavaScript untuk mengatur animasi notifikasi -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil element notifikasi
            const notification = document.querySelector('.notif');

            // Atur opacity notifikasi menjadi 1 agar tampil dengan animasi
            notification.style.opacity = 1;

            // Atur timeout untuk menghilangkan notifikasi setelah 5 detik
            setTimeout(function() {
                // Atur opacity notifikasi menjadi 0 agar menghilang dengan animasi
                notification.style.opacity = 0;

                // Hapus parameter 'message' dari URL dengan redirect menggunakan replaceState()
                const urlWithoutMessage = window.location.pathname;
                history.replaceState({}, document.title, urlWithoutMessage);
            }, 6000);
        });
    </script>

</body>

</html>