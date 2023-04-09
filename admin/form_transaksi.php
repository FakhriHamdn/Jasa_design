<?php
require 'Connection.php';
$add_access = new adminAccess();

$id_transaksi = $_GET['id_transaksi'] ?? 0;

if ($id_transaksi > 0) {
    $row = $add_access->getTransactionsID($id_transaksi);

    $id_transaksi = $row['id_transaksi'];
    $id_klien = $row['id_klien'];
    $id_jasa = $row['id_jasa'];
    $nama_klien = $row['nama_klien'];
    $nama_jasa = $row['nama_jasa'];
    $tanggal = $row['tanggal'];
    $jumlah_jasa = $row['jumlah_jasa'];
    $harga = $row['harga'];
    $total_pembayaran = $row['total_pembayaran'];
    $form_action = "action.php?action=update_transactions";
    $title = " Admin | Form Edit Transaksi";
    $main_title = "Form Tambah Data Transaksi";
    
} else {
    $id_transaksi = '';
    $id_klien = '';
    $id_jasa = '';
    $nama_klien = '';
    $nama_jasa = '';
    $tanggal = '';
    $jumlah_jasa = '';
    $harga = '';
    $total_pembayaran = '';
    $form_action = "action.php?action=insertTransactions";
    $title = " Admin | Form Tambah Transaksi";
    $main_title = "Form Tambah Data Transaksi";
}



?>
<!-- udah bener -->
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
        <h2 style="text-align: center; margin: 30px 0 25px 0;"><?=$main_title;?></h2>
        <table>
            <form action="<?php echo $form_action ?>" method="POST">
                <input type="hidden" name="id_transaksi" value="<?php echo $id_transaksi  ?>">
                <tr>
                    <label for="nama_klien">Nama Pelanggan</label>
                    <select name="id_klien" id="nama_klien">
                        <option disabled selected>Pilih Nama Pelanggan</option>
                        <?php foreach ($add_access->fetchCustomers() as $options) {
                            //tanda (?) untuk if, tanda (:) untuk else
                            $selected = $options['id_klien'] == $id_klien ? 'selected' : ''; ?>
                            <option value="<?= $options['id_klien'] ?>" <?= $selected ?> ><?= $options['nama_klien']  . ' ' . '- ' . $options['alamat']  . ' ' . '- ' . $options['no_telp']?>
                            </option>
                        <?php } ?>
                        
                    </select>
                </tr>
                <tr>
                    <label for="nama_jasa">Nama Jasa</label>
                    <select name="id_jasa" id="nama_jasa">
                        <option disabled selected>Pilih nama Jasa</option>
                        <?php foreach ($add_access->fetchJasa() as $options) {
                            $selected = $options['id_jasa'] == $id_jasa ? 'selected' : '';
                        ?>
                            <option value="<?= $options['id_jasa'] ?>" <?= $selected ?> ><?= $options['nama_jasa']  . ' ' . '- Rp ' . $options['harga']?>
                            </option>
                        <?php } ?>
                    </select>
                </tr>
                <tr>
                    <td>Tanggal :</td>
                    <td><input type="date" name="tanggal" value="<?=$tanggal?>"></td>
                </tr>
                <tr>
                    <td>Jumlah Jasa :</td>
                    <td><input type="text" name="jumlah_jasa" placeholder="jumlah jasa" value="<?=$jumlah_jasa?>"></td>
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