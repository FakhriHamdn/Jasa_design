<?php 
require 'Connection.php';
$add_access = new adminAccess();

$id_klien = $_GET["id_klien"] ?? 0;

if($id_klien > 0) {
    $row = $add_access->getCustomerID($id_klien);

    // buat yang diformnya
    $id_klien = $row['id_klien'];
    $nama_klien = $row['nama_klien'];
    $alamat = $row['alamat'];
    $no_telp = $row['no_telp'];
    $email = $row['email'];

    $form_action = "action.php?action=update_klien";
    $title = " Admin | Form Edit Pelanggan";
    $main_title = "Form Edit Data Pelanggan";

} else {
    $id_klien = '';
    $nama_klien = '';
    $alamat = '';
    $no_telp = '';
    $email = '';
    $form_action = "action.php?action=insertCustomer";
    $title = " Admin | Form Tambah Pelanggan";
    $main_title = "Form Tambah Data Pelanggan";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/lock_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/admin.css">
    <title><?=$title?></title>
</head>
<body>
    <div class="box">
        <h2 style="text-align: center; margin: 30px 0 25px 0;"><?=$main_title?></h2>
        <table>
            <form action="<?php echo $form_action ?>" method="POST">
            <tr>  
                <td><input type="hidden" name="id_klien" value="<?php echo $id_klien?>"></td>
            </tr>  
                <tr>
                    <td>Nama Customer :</td>
                    <td><input type="text" name="nama_klien" placeholder="nama klien" value="<?php echo $nama_klien ?>"></td>
                </tr>
                <tr>
                    <td>Alamat :</td>
                    <td><input type="text" name="alamat" placeholder="alamat" value="<?php echo $alamat ?>"></td>
                </tr>
                <tr>
                    <td>No Telp :</td>
                <td><input type="number" name="no_telp" placeholder="no telp" value="<?php echo $no_telp ?>"></td>
                </tr>
                <tr>
                    <td>email :</td>
                    <td><input type="email" name="email" placeholder="email" value="<?php echo $email ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="Simpan"></td>
                </tr>
            </form>
        </table>
    </div>
</body>
</html>