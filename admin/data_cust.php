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
$query = "SELECT * FROM customers ORDER BY id_cust DESC";


if (isset($_GET['container']) && $_GET['container'] === 'customers'){
    if(isset($_GET['id_cust']) && ($_GET['id_cust'] > 0)){
        $id_cust = $_GET['id_cust'];
        $row = getCustomerId($id_cust);
    
        $form_action = '../includes/action.php?action=updateCustomer';
        $title = 'Admin | Edit Data Customers';
        $h1 = 'Form Edit Data Customers';
    } else {
        $row = [];
        $form_action = '../includes/action.php?action=addCustomer';
        $title = 'Admin | Tambah Data Customers';
        $h1 = 'Form Tambah Data Customers';
    }
}
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
    <title>Admin Dashboard | Data Customers</title>
</head>

<body>
    <div class="container">
        <nav class="navbar_container">
            <div class="sidebar">
                <div class="logo_wrapper">
                    <img src="../image/rofaralogo.png" alt="Logo Rofara" style="width: 180.6px; height: 53.235px;">
                </div>

                <span class="vertical_line"></span>

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
            <h1>Admin | Data Customers</h1>

            <div class="notif_operator">
                <p></p>
            </div>

            <div class="table_container">
                <?php if (isset($_GET['container']) && $_GET['container'] === 'customers') : ?>

                    <form action="<?= $form_action ?>" method="POST">
        <?php if ($row) : ?>
            <input type="hidden" name="id_cust" value="<?= $row['id_cust'] ?>">
        <?php endif; ?>
        <ul>
            <li>
                <label for="cust">customers</label>
                <input type="text" name="cust" id="cust" value="<?= ($row) ? $row['nama_cust'] : '' ?>">
            </li>
            <li>
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="<?= ($row) ? $row['alamat'] : '' ?>">
            </li>
            <li>
                <label for="no_telp">No Telp</label>
                <input type="number" name="no_telp" id="no_telp" value="<?= ($row) ? $row['no_telp'] : '' ?>">
            </li>
            <li>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= ($row) ? $row['email'] : '' ?>">
            </li>
            <li>
                <button type="submit" name="cust_submit">Submit</button>
            </li>
        </ul>
    </form>

                <?php else : ?>
                    <a class="add_data" href="?container=customers">Tambah Data</a>
                    <table border="1">
                        <tr>
                            <th class="id">Id</th>
                            <th>Customer</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Email</th>
                            <th class="aksi">Aksi</th>
                        </tr>
                        <?php foreach (getDatas($query) as $row) : ?>
                            <tr class="data_table">
                                <td class="id"><?= $row['id_cust']; ?></td>
                                <td><?= $row['nama_cust']; ?></td>
                                <td><?= $row['alamat']; ?></td>
                                <td><?= $row['no_telp']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td class="aksi">
                                    <div class="aksi_wrapper">
                                        <a class="edit" href="?id_cust=<?= $row['id_cust']; ?>&container=customers">Edit</a>
                                        <a class="delete" href="../includes/action.php?id_delete=<?= $row['id_cust'] ?>&page=customer">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </div>
        </section>
    </div>
</body>

</html>