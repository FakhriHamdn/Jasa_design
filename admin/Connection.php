<?php
class adminConnection {
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "db_jasadesign";
    public $conn;
    
    public function __construct() {
        // buat koneksi ke database
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->db_name);

        //check koneksi
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }  
    }

    public function getConnection() {
        return $this->conn;
    }
}



class adminAccess{
    
//UNTUK MENGAMBIL DATA DARI DATABASE tb_jasa
function getServices() {
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $sql = "SELECT * FROM tb_jasa";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}


function getServicesID($id_jasa){
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $sql = "SELECT * FROM tb_jasa WHERE id_jasa = '$id_jasa'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
//jadi klo manggil function ini, yang bakal diambil sama pemanggil itu yang $rownya???
}

function editServices($id_jasa, $nama_jasa, $harga){
    $adminConn = new adminConnection();
    $conn =$adminConn->getConnection();
    $result = mysqli_query($conn, "UPDATE tb_jasa SET nama_jasa = '$nama_jasa', harga ='$harga' WHERE id_jasa = '$id_jasa'");
    return $result;
}

// FUNCTION UNTUK MENAMBAHKAN JASA
function insertServices($nama_jasa, $harga) {
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $result = mysqli_query($conn, "INSERT INTO tb_jasa VALUES('', '$nama_jasa','$harga')");
    return $result;
}

function deleteServices($id_jasa){
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $result = mysqli_query($conn, "DELETE FROM tb_jasa WHERE id_jasa = '$id_jasa'");
    return $result;
}


//UNTUK MENGAMBIL DATA DARI DATABASE tb_klien
function getCustomer() {
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $sql = "SELECT * FROM tb_klien";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }
    return $rows;
}

//END MENGAMBI DATA tb_klien
function insertCustomer($nama_klien, $alamat, $no_telp, $email){
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $result = mysqli_query($conn, "INSERT INTO tb_klien VALUES ('', '$nama_klien', '$alamat', '$no_telp', '$email')");
    return $result;
}

function editCustomer($id_klien, $nama_klien, $alamat, $no_telp, $email){
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $result = mysqli_query($conn, "UPDATE tb_klien SET nama_klien = '$nama_klien', alamat = '$alamat', no_telp = '$no_telp', email = '$email' WHERE id_klien = '$id_klien'");
    return $result;
}

function getCustomerID($id_klien){
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $sql = "SELECT * FROM tb_klien WHERE id_klien = '$id_klien'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

function deleteCustomer($id_klien) {
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $result = mysqli_query($conn, "DELETE FROM tb_klien WHERE id_klien = '$id_klien'");
    return $result;
}

//MENGAMTIL DATA DARI DATABASE tb_transaksi
//dah bener
function getTransactions() {
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $sql = "SELECT tb_transaksi.id_transaksi, tb_klien.nama_klien, tb_jasa.nama_jasa, tb_transaksi.tanggal, tb_transaksi.jumlah_jasa, tb_jasa.harga, tb_transaksi.total_pembayaran FROM tb_klien INNER JOIN tb_transaksi ON tb_klien.id_klien = tb_transaksi.id_klien INNER JOIN tb_jasa ON tb_jasa.id_jasa = tb_transaksi.id_jasa";    
    
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }
    return $rows;
}

//udah bener
function insertTransactions($id_klien, $id_jasa, $tanggal, $jumlah_jasa, $harga, $total_pembayaran) {
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $result = mysqli_query($conn, "INSERT INTO tb_transaksi VALUES ('', '$id_klien', '$id_jasa', '$tanggal', '$jumlah_jasa', '$harga', '$total_pembayaran')");
    return $result;
}



//bagian ini coba ngapus row nya
// udah bener
function getTransactionsID($id_transaksi){
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $sql = "SELECT tb_transaksi.id_transaksi, tb_klien.id_klien, tb_jasa.id_jasa, tb_klien.nama_klien, tb_jasa.nama_jasa, tb_transaksi.tanggal, tb_transaksi.jumlah_jasa, tb_transaksi.harga, tb_transaksi.total_pembayaran FROM tb_klien INNER JOIN tb_transaksi ON tb_klien.id_klien = tb_transaksi.id_klien INNER JOIN tb_jasa ON tb_jasa.id_jasa = tb_transaksi.id_jasa WHERE tb_transaksi.id_transaksi = '$id_transaksi'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
}

//udah bener
function editTransactions($id_transaksi, $id_klien, $id_jasa, $tanggal, $jumlah_jasa, $harga, $total_pembayaran){
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $result = mysqli_query($conn, "UPDATE tb_transaksi SET id_klien = '$id_klien', id_jasa = '$id_jasa', tanggal = '$tanggal', jumlah_jasa = '$jumlah_jasa', harga = '$harga', total_pembayaran = '$total_pembayaran'  WHERE id_transaksi = '$id_transaksi'");
    return $result;
}

function deleteTransactions($id_transaksi) {
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $result = mysqli_query($conn, "DELETE FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'");
    return $result;
}
//udah bener
function fetchJasa(){
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $sql = "SELECT id_jasa, nama_jasa, harga FROM tb_jasa";
    $result = mysqli_query($conn, $sql);
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $options;
}

/** fungsi untuk mendapatkan nilai id_pelanggan, nama_pelanggan dan harga dari tabel pelanggan untuk digunakan sebagai option di form*/
//udah bener
function fetchCustomers(){
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $sql = "SELECT id_klien, nama_klien, alamat, no_telp FROM tb_klien";
    $result = mysqli_query($conn, $sql);
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $options;

}
// udah bener
function getHargaJasa($id_jasa){
    $adminConn = new adminConnection();
    $conn = $adminConn->getConnection();
    $sql = "SELECT harga FROM tb_jasa WHERE id_jasa = '$id_jasa'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    return $row;
    }



}
