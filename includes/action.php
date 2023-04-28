<?php 
require 'functions.php';





$idProduct = $_GET['product'];

var_dump('halo');


// if('jasa_submit'){
//     $title = 'Admin | Tambah Data Product';
//     $main_title = 'Form Tambah Data Product';
//     $form_action = '../includes/action.php?action=insertJasa';
//     if(isset($_POST['jasa_submit'])){
//             // $id_product = ($_POST['id_product']);
//             $nama_product = htmlspecialchars($_POST['product']);
//             $harga = htmlspecialchars($_POST['harga']);
//             $result = insertDataJasa($nama_jasa, $harga);
            
//             if($result) {
//                 header("Location: ../admin2/data_jasa.php");
//             } else{
//                 echo 'gagal menambahkan data produk';
//             }
    // } else{
    //     // $id_jasa = $_GET['jasaId'];

    //     if(isset($_GET['jasaId'])) {
    //         $row = getJasaId($id_jasa);
            
    //         $id_jasa = $row['id_jasa'];
    //         $nama_jasa = htmlspecialchars($row['nama_jasa']);
    //         $harga = htmlspecialchars($row['harga']);
            
    //         $form_action = "action.php?action=update_services";
    //         $title = " Admin | Form Edit Jasa Design";
    //         $main_title = "Form Edit Data Jasa";
            
    //         $result2 = updateDataJasa($id_jasa, $produk, $harga);


    //     }
//     }
// }





// if(isset($_POST['jasa_submit'])) {
//     $dataJasa = $_GET['action'] ?? 0;

//     if($dataJasa === 'insertJasa' || $dataJasa === 0){
//         $produk = htmlspecialchars($_POST['produk']);
//         $harga = htmlspecialchars($_POST['harga']);

//         $result = insertDataJasa($produk, $harga);
        
//         if($result) {
//             header("Location: ../admin2/data_jasa.php");
//         } else{
//             echo 'gagal menambahkan data';
//         }
//     } else {
//         $row = getJasaId($dataJasa);
//         $id_jasa = $row['id_jasa'];
//         $nama_jasa = $row['nama_jasa'];
//         $harga = $row['harga'];
        
//         $form_action = "action.php?action=update_services";
//         $title = " Admin | Form Edit Jasa Design";
//         $main_title = "Form Edit Data Jasa";
//     }
// }
?>
