<?php
class myConnection {
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "jasa_design";
    private $conn;
    
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

