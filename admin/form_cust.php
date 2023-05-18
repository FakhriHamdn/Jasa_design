<?php 
session_start();

if(isset($_SESSION['role']) && $_SESSION['role'] !== 'admin'){
    header('Location: ../index.php');
    exit;
}


require '../includes/functions.php';

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <h1><?= $h1; ?></h1>
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

</body>
</html>