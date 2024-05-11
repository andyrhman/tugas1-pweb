<!-- 
    Dibuat oleh:
    NAMA: ANDY RAHMAN RAMADHAN
    NIM: 220401070404
    KELAS: IT403
-->

<?php
include_once "config/config.php";

class Database
{
    public $host = HOST;
    public $user = USER;
    public $password = PASSWORD;
    public $database = DATABASE;

    public $link;
    public $error;

    public function __construct()
    {
        $this->dbConnect();
    }

    public function dbConnect()
    {
        $this->link = mysqli_connect(
            $this->host,
            $this->user,
            $this->password,
            $this->database
        );
        if (!$this->link) {
            $this->error = "Koneksi ke database gagal.";
            return false;
        }
    }

    // Masukkan data
    public function masukkan($query)
    {
        $hasil = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);
        if ($hasil) {
            return $hasil;
        } else {
            return false;
        }
    }
    public function pilih($query)
    {
        $hasil = mysqli_query($this->link, $query) or die($this->link->error . __LINE__);
        if (mysqli_num_rows($hasil) > 0) {
            return $hasil;
        } else {
            return false;
        }
    }
}

?>