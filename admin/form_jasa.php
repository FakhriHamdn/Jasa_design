<?php 
require 'Connection.php';
$add_access = new adminAccess();


//jadi variable $id_jasa ini teh dapetinnya dari parameternya getServicesID
//nah variable id_jasa ini dia menyimpan query sring id_jasa yang akan muncul di url
$id_jasa = $_GET["id_jasa"] ?? 0 ;

//yg if juga sama, dia menggil id_jasa ngikut dari pemanggilan parameter diatas
if ($id_jasa > 0) {
    $row = $add_access->getServicesID($id_jasa); //klo id jasa ini dia tuh argument jadinya

    //INI BUAT YANG DIFROM
    $id_jasa = $row['id_jasa'];
    $nama_jasa = $row['nama_jasa'];
    $harga = $row['harga'];
    
    $form_action = "action.php?action=update_services";
    $title = " Admin | Form Edit Jasa Design";
    $main_title = "Form Edit Data Jasa";
}

//TAMBAH BERHASIL
else {
    $id_jasa = '';
    $nama_jasa = '';
    $harga = '';
    $form_action = "action.php?action=insert_services";
    $title = " Admin | Form Tambah Jasa Design";
    $main_title = "Form Tambah Data Jasa";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/lock_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/form_admin.css">
    <title><?=$title?></title>
</head>
<body>
<div class="container">
    <div class="box">
        <div class="main_title">
            <h2><?=$main_title?></h2>
        </div>

        <table>
            <form action="<?=$form_action?>" method="POST">
                <!-- klo data yang diinput ngk masuk tanpa ada error, berarti masalahnya id jasa ini, PENTING WOIIIIIII -->
                <tr>
                    <td><input type="hidden" name="id_jasa" value="<?=$id_jasa?>"></td>
                </tr>
                <tr>
                    <td><label for="nama_jasa" class="label">Nama Jasa :</label></td>
                    <td><input type="text" id="nama_jasa" name="nama_jasa" placeholder="nama jasa" value="<?=$nama_jasa?>"></td>
                </tr>
                <tr>
                    <td><label for="harga" class="label">Harga Jasa :</label></td>
                    <td><input type="text" id="harga" name="harga" placeholder="harga" value="<?=$harga?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="Simpan"></td>
                </tr>
            </form>
        </table>
    </div>
</div>

</body>
</html>