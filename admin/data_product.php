<?php
session_start();

//====== VALIDASI AKSESIBILITY
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
//======= END AKSESIBILITY


//======= COMPONENT PENDUKUNG 
if ($_SESSION['role'] === 'admin') {
    $actionUpdate = 'updateProduct';
    $actionAdd = 'addProduct';
    $formButtonName = 'product_submit';
    $textFormButton = 'Accept';
} elseif ($_SESSION['role'] === 'operator') {
    $actionUpdate = 'requestUpdateProduct';
    $actionAdd = 'requestAddProduct';
    $formButtonName = 'request_operator_submit';
    $textFormButton = 'Request Changes';
}
//======= END COMPONENT


require '../includes/functions.php';


//======= STATEMENT FOR PAGINATION
$jumlahDataPerhalaman = 10;

// count menghitung panjang data di array associatif
$jumlahData = count(getDatas("SELECT * FROM products"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$dataAwal = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

$query = "SELECT * FROM products ORDER BY id_product ASC LIMIT $dataAwal, $jumlahDataPerhalaman";
//======= END PAGINATION


//======= ACTION FOR CURD DATA PRODUCT
if (isset($_GET['container']) && $_GET['container'] === 'product') {

    if (isset($_GET['id_product']) && $_GET['id_product'] > 0) {
        $id_product = $_GET['id_product'];
        $row = getProductId($id_product);

        $title = 'Admin | Form Edit Data Product';
        $h3 = 'Update Data Product';
        $form_action = '../includes/action.php?action=' . $actionUpdate;
    } else {
        $row = [];

        $title = 'Admin | Form Tambah Data Product';
        $h3 = 'Add Data Product';
        $form_action = '../includes/action.php?action=' . $actionAdd;
    }
}
//======= END CRUD PRODUCT


//======= VALIDASI FOR REQUEST OPERATORS
if ($_SESSION['role'] === 'operator') {
    if (!isset($_SESSION['request'])) {
        $_SESSION['request'] = [];
    }
}
//======= END VALIDASI REQUEST 


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
                <h1 class="header_text"><?= $role_text; ?> Dashboard > Product </h1>


                <!--=============== NOTIFICATION  -->
                <?php if (isset($_GET['message'])) : ?>
                    <?php if (isset($_GET['auth'])) : ?>
                        <div class="notif" style="background: #2EDBE3; color: #24242a;">
                            <i class='bx bx-user-check icon-msg'></i>
                            <span class='msg-text'>
                                <?= $_GET['auth']; ?>
                        </div>

                    <?php elseif (isset($_GET['warning'])) : ?>
                        <div class="notif" style="background: #bf202f; color: #fff;">
                            <i class='bx bx-message-x icon-msg'></i>
                            <span class='msg-text'>
                                <?= $_GET['warning']; ?>
                        </div>

                    <?php elseif (isset($_GET['changes'])) : ?>
                        <div class="notif" style="background: #fec112; color: #24242a;">
                            <i class='bx bx-message-check icon-msg'></i>
                            <span class='msg-text'>
                                <?= $_GET['changes']; ?>
                        </div>

                    <?php elseif (isset($_GET['success'])) : ?>
                        <div class="notif" style="background: #029400; color: #fff;">
                            <i class='bx bx-message-add icon-msg'></i>
                            <span class='msg-text'>
                                <?= $_GET['success']; ?>
                        </div>

                    <?php endif; ?>
                <?php endif; ?>
                <!--=============== END NOTIFICATION  -->


                <div class="main_dashboard_container">
                    <!--======= SPACE OPERATOR IN ADMIN DATABASE =======-->
                    <?php if ($_SESSION['role'] === 'admin') : ?>
                        <?php if (isset($_GET['container']) && $_GET['container'] === 'product') : ?>
                        <?php else : ?>

                            <div class="space_operator">
                                <div class="operator_wrapper">
                                    <?php if (count($_SESSION['request']) > 0) : ?>

                                        <?php if (isset($_GET['details_request'])) : ?>
                                            <?php $detailRequest = $_GET['details_request']; ?>

                                            <div class="form_container">
                                                <?php
                                                $key_request = $_GET['key_request'];
                                                $req_product = $_SESSION['request'][$key_request];
                                                ?>

                                                <div class="request_information_container">


                                                    <div class="title_form_request">
                                                        <div class="detail_form_request">
                                                            <a href="data_product.php" class="back_request"><i class="bx bx-log-out icon"></i>Back</a>
                                                            <h3>Details Request ></h3>


                                                        </div>
                                                        <div class="main_title_request">
                                                            <h2><?= $req_product['title_request'] ?></h3>

                                                                <?php if ($req_product['status'] === 'Update') : ?>
                                                                    <p class="id_request">(ID: <?= $req_product['id']; ?>)</p>
                                                                    <span class="statusUpdateRequest"><?= $req_product['status'] ?></span>
                                                                <?php elseif ($req_product['status'] === 'New') : ?>
                                                                    <span class="statusNewRequest"><?= $req_product['status'] ?></span>
                                                                <?php endif; ?>
                                                        </div>
                                                    </div>

                                                    <?php
                                                    if ($req_product['status'] === 'Update') {
                                                        $id_realProduct = $req_product['id'];
                                                        $realProduct = getProductId($id_realProduct);
                                                    }
                                                    $emailOperator =  $req_product['nama_sender'];
                                                    $getOperatorData = getUsersByEmail($emailOperator);
                                                    ?>


                                                    <form action="../includes/action.php?key_accept_request=<?= $key_request ?>" method="POST" enctype="multipart/form-data">
                                                        <?php if ($req_product['status'] === 'Update') : ?>
                                                            <input type="hidden" name="id_product" value="<?= $req_product['id']; ?> ">
                                                        <?php endif; ?>

                                                        <div class="info_sender">
                                                            <div class="description_request">
                                                                <div class="request_profile_wrapper">
                                                                    <div class="profile_wrapper">
                                                                        <img class="profile-image" src="../image/no-picture.jpg" alt="Profile Photo">
                                                                        <div class="profile_information">
                                                                            <p class="name_sender"><?= $getOperatorData['fullname']; ?> <span class="email_sender">&lt;<?= $req_product['nama_sender']; ?>&gt;</span></p>
                                                                            <p class="role_sender"><?= $getOperatorData['role']; ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="date_request">
                                                                        <p><?= $req_product['send_time']; ?></p>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="notes_request">
                                                                <p class="message">Message:</p>
                                                                <p class="text_notes">... <?= $req_product['notes']; ?></p>
                                                            </div>
                                                        </div>
                                                </div>


                                                <div class="form_request_wrapper">
                                                    <div class="form_image_preview">
                                                        <?php if ($req_product['status'] === 'Update') : ?>

                                                            <?php if ($realProduct['product_image'] !== $req_product['product_image']) : ?>
                                                                <div class="image_request_wrap">
                                                                    <div class="real_image_product">
                                                                        <label for="product_image" class="label_product_image">
                                                                            <span class="upload_label">Upload Images</span>
                                                                            <img src="../image/product/<?= $realProduct['product_image']; ?>" height="170" width="170">
                                                                        </label>
                                                                        <input type="file" name="product_image" class="product_image" id="product_image" placeholder="Choose image" disabled>
                                                                    </div>

                                                                    <i class='bx bx-right-arrow-alt'></i>
                                                                    <div class="request_image_product">
                                                                        <label for="product_image" class="label_product_image">
                                                                            <span class="upload_label">Upload Images</span>
                                                                            <img src="../image/product/<?= $req_product['product_image'] ?>" height="170" width="170">
                                                                        </label>
                                                                        <input type="file" name="product_image" class="product_image" id="product_image" placeholder="Choose image">
                                                                        <input type="hidden" name="old_product_image" class="product_image" id="product_image" placeholder="Choose image" value="<?= $realProduct['product_image'];?>">
                                                                    </div>
                                                                </div>

                                                            <?php else : ?>
                                                                <div class="real_image_product">
                                                                    <label for="product_image" class="label_product_image">
                                                                        <span class="upload_label">Upload Images</span>
                                                                        <img src="../image/product/<?= $realProduct['product_image']; ?>" height="170" width="170">
                                                                    </label>
                                                                    <input type="file" name="product_image" class="product_image" id="product_image" placeholder="Choose image" disabled>
                                                                    <input type="hidden" name="old_product_image" class="product_image" id="product_image" placeholder="Choose image" value="<?= $realProduct['product_image']?>">
                                                                </div>

                                                                <!-- <i class='bx bx-right-arrow-alt'></i> -->

                                                                <!-- <div class="request_image_product">
                                                                    <label for="product_image" class="label_product_image">
                                                                        <span class="upload_label">Upload Images</span>
                                                                        <img src="../image/product/<?= $req_product['product_image'] ?>" height="170" width="170">
                                                                    </label>
                                                                    <input type="file" name="product_image" class="product_image" id="product_image" placeholder="Choose image">
                                                                </div> -->

                                                            <?php endif; ?>
                                                        <?php else : ?>
                                                            <div class="request_image_product">
                                                                <label for="product_image" class="label_product_image">
                                                                    <span class="upload_label">Upload Images</span>
                                                                    <img src="../image/product/<?= $req_product['product_image'] ?>" height="170" width="170">
                                                                </label>
                                                                <input type="file" name="product_image" class="product_image" id="product_image" placeholder="Choose image">
                                                                <input type="hidden" name="new_product_image" class="product_image" value="<?= $req_product['product_image'] ?>">

                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                    <!-- <div class="form_input_data"> -->
                                                    <ul class="ul_form_input">
                                                        <div class="form_input_wrapper">
                                                            <li>
                                                                <label for="product">Product</label>
                                                                <div class="selectData">
                                                                    <?php if ($req_product['status'] === 'Update') : ?>

                                                                        <?php if ($realProduct['nama_product'] !== $req_product['nama_product']) : ?>
                                                                            <input type="text" name="product" id="product" placeholder="Input product" value="<?= $realProduct['nama_product']; ?>" disabled>
                                                                            <i class='bx bx-right-arrow-alt'></i>
                                                                            <input type="text" name="product" id="product" placeholder="Input product" value="<?= $req_product['nama_product']; ?>">

                                                                        <?php else : ?>
                                                                            <input type="hidden" name="product" id="product" placeholder="Input product" value="<?= $realProduct['nama_product']; ?>">
                                                                            <input type="text" name="product" id="product" placeholder="Input product" value="<?= $req_product['nama_product']; ?>" disabled>

                                                                        <?php endif; ?>

                                                                    <?php else : ?>
                                                                        <input type="text" name="product" id="product" placeholder="Input product" value="<?= $req_product['nama_product']; ?>">
                                                                    <?php endif; ?>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <label for="harga">Price (Rp.)</label>
                                                                <div class="selectData">
                                                                    <?php if ($req_product['status'] === 'Update') : ?>

                                                                        <?php if ($realProduct['harga'] != $req_product['harga']) : ?>
                                                                            <input type="number" name="harga" id="harga" placeholder="Rp. xxx" value="<?= $realProduct['harga'] ?>" disabled>
                                                                            <i class='bx bx-right-arrow-alt'></i>
                                                                            <input type="number" name="harga" id="harga" placeholder="Rp. xxx" value="<?= $req_product['harga'] ?>">

                                                                        <?php else : ?>
                                                                            <input type="hidden" name="harga" id="harga" placeholder="Rp. xxx" value="<?= $req_product['harga'] ?>">
                                                                            <input type="number" name="harga" id="harga" placeholder="Rp. xxx" value="<?= $realProduct['harga'] ?>" disabled>

                                                                        <?php endif; ?>

                                                                    <?php else : ?>
                                                                        <input type="number" name="harga" id="harga" placeholder="Rp. xxx" value="<?= $req_product['harga'] ?>">
                                                                    <?php endif; ?>
                                                                </div>
                                                            </li>
                                                        </div>
                                                        <li class="aksi">
                                                            <?php if ($req_product['status'] === 'New') : ?>
                                                                <button type="submit" name="accept_new_request"><?= $textFormButton; ?></button>

                                                            <?php elseif ($req_product['status'] === 'Update') : ?>
                                                                <button type="submit" name="accept_update_request"><?= $textFormButton; ?></button>

                                                            <?php endif; ?>
                                                            <!-- <a href="data_product.php" class="reject">Cancel</a> -->
                                                            <a href="../includes/action.php?key_reject_request=<?= $key_request ?>" class="reject">Reject</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                </form>
                                            </div>

                                            <?php ?>

                                        <?php else : ?>
                                            <div class="title_operator_wrapper">
                                                <div class="title_operator">
                                                    <h3>Operator Request's</h3>
                                                </div>
                                            </div>
                                            <div class="operator_table">
                                                <table>
                                                    <tr>
                                                        <th class="id">No</th>
                                                        <th>Senders</th>
                                                        <th class="date">Date</th>
                                                        <th>Details</th>
                                                        <th class="status">Status</th>
                                                        <th class="aksi">Actions</th>
                                                    </tr>
                                                    <?php $id = 1 ?>
                                                    <?php foreach ($_SESSION['request'] as $keys => $rows) : ?>
                                                        <?php
                                                        if ($rows['status'] === 'Update') {
                                                            $id_realProduct = $rows['id'];
                                                            $realProduct = getProductId($id_realProduct);
                                                        }
                                                        ?>
                                                        <tr class="data_table">
                                                            <td class="id"><?= $id++ ?></td>
                                                            <td class="nama_sender"><?= $rows['nama_sender'] ?></td>
                                                            <td class="date"><?= $rows['send_time'] ?></td>

                                                            <?php if ($rows['status'] === 'New') : ?>
                                                                <td><?= $rows['title_request'] ?></td>
                                                                <td class="status">
                                                                    <p class="statusNew"><?= $rows['status'] ?></p>
                                                                </td>

                                                            <?php elseif ($rows['status'] === 'Update') : ?>
                                                                <td><?= $rows['title_request']; ?> - <?= $realProduct['nama_product']; ?></td>
                                                                <td class="status">
                                                                    <p class="statusUpdate"><?= $rows['status'] ?></p>
                                                                </td>
                                                            <?php endif; ?>

                                                            <td class="aksi">
                                                                <div class="aksi_wrapper">
                                                                    <a href="?key_request=<?= $keys ?>&details_request" class="details_operator"><i class='bx bx-detail dash-aksi'></i></a>
                                                                    <a href="../includes/action.php?key_accept_request=<?= $keys ?>&accept_from_table" class="accept_operator"><i class='bx bx-check-square dash-aksi'></i></a>
                                                                    <a href="../includes/action.php?key_reject_request=<?= $keys ?>" class="reject_operator"><i class='bx bxs-x-square dash-aksi'></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>

                                                </table>
                                            </div>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <!-- <div class="operator_table">
                                                <table>
                                                    <tr class="tr_no_request">
                                                        <th class="id">No</th>
                                                        <th>Senders</th>
                                                        <th class="date">Date</th>
                                                        <th>changes</th>
                                                        <th class="status">Status</th>
                                                        <th class="aksi">Actions</th>
                                                    </tr>
                                                </table>
                                        </div> -->
                                        <div class="no_request_wrapper">
                                            <p class="no_request">No operator requests received</h5>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!--======= END SPACE OPERATOR =======-->


                    <!--======= SPACE TABLE DATABASES =======-->
                    <div class="table_container">
                        <div class="table_wrapper">

                            <?php if (isset($_GET['container']) && $_GET['container'] === 'product') : ?>

                                <div class="form_container">
                                    <div class="form_data_wrapper">

                                    <div class="detail_form">
                                        <a href="data_product.php" class="back_request"><i class="bx bx-log-out icon"></i>Back</a>
                                        <?php if($row):?>
                                            <h3><?= $h3; ?> (ID: <?= $row['id_product']; ?>)</h3>
                                        <?php else: ?>
                                            <h3><?= $h3; ?></h3>
                                        <?php endif; ?>
                                    </div>
                                    <form action="<?= $form_action; ?>" method="POST" enctype="multipart/form-data">
                                        <?php if ($row) : ?>
                                            <input type="hidden" name="id_product" value="<?= $row['id_product']; ?> ">
                                        <?php endif; ?>
                                        <div class="form_wrapper">
                                            <div class="product_image_preview">
                                                <div class="product_image_wrap">
                                                    <label for="product_image" class="label_product_image">
                                                        <span class="upload_label">Upload Images</span>
                                                        <?php if($row) : ?>
                                                            <div class="image_card">
                                                                <img src="../image/product/<?= $row['product_image'];?>" height="170" width="170">
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="image_card">
                                                                <p>Upload Image</p>
                                                            </div>
                                                        <?php endif; ?>
                                                    </label>
                                                    <input type="file" name="product_image" class="product_image" id="product_image" placeholder="Choose image" >
                                                    <input type="hidden" name="old_product_image" class="product_image" id="product_image" placeholder="Choose image" value="<?= ($row) ? $row['product_image'] : ''; ?>">
                                                </div>
                                            </div>
                                            <!-- <div class="form_input_data"> -->
                                            <ul class="ul_form_input">
                                                <div class="form_input_wrapper">
                                                    <?php if ($_SESSION['role'] === 'operator') : ?>
                                                        <li>
                                                            <label for="title_request">Title Request</label>
                                                            <textarea name="title_request" class="title_request" id="title_request" cols="30" rows="2" placeholder="Title..." required></textarea>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li>
                                                        <label for="product">Product</label>
                                                        <input type="text" name="product" id="product" placeholder="Input product" value="<?= ($row) ? $row['nama_product'] : ''; ?>" required>
                                                    </li>
                                                    <li>
                                                        <label for="harga">Price (Rp.)</label>
                                                        <input type="number" name="harga" id="harga" placeholder="Rp. xxx" value="<?= ($row) ? $row['harga'] : ''; ?>" required>
                                                    </li>
                                                    <?php if ($_SESSION['role'] === 'operator') : ?>
                                                        <li>
                                                            <label for="area_notes">Notes</label>
                                                            <textarea name="notes" class="notes" id="area_notes" cols="30" rows="5" placeholder="Request Notes..."></textarea>
                                                        </li>
                                                    <?php endif; ?>
                                                </div>
                                                <li class="aksi">
                                                    <button type="submit" name="<?= $formButtonName; ?>"><?= $textFormButton; ?></button>
                                                    
                                                    <?php if($row): ?>
                                                        <a class="form_delete" href="../includes/action.php?id_delete=<?= $row['id_product']; ?>&page=product&type=form"><i class='bx bx-trash dash-aksi'></i></a>
                                                    <?php endif;?>
                                                </li>
                                            </ul>

                                            <!-- </div> -->
                                        </div>
                                    </form>
                                </div>
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
                                        <input type="text" class="search_bar" placeholder="Search datas...">
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

            // Dapatkan parameter URL saat ini
            const urlParams = new URLSearchParams(window.location.search);

            // Hapus parameter 'message' dan 'warning' dari URL
            urlParams.delete('message');
            urlParams.delete('success');
            urlParams.delete('changes');
            urlParams.delete('warning');
            urlParams.delete('auth');
            urlParams.delete('id_product');

            // Bangun kembali URL tanpa parameter yang dihapus
            const urlWithoutParams = window.location.origin + window.location.pathname + '?' + urlParams.toString();

            // Ubah URL menggunakan replaceState()
            history.replaceState({}, document.title, urlWithoutParams);
        }, 6000);
    });
</script>


</body>

</html>