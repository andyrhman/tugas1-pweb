<!-- 
    Dibuat oleh:
    NAMA: ANDY RAHMAN RAMADHAN
    NIM: 220401070404
    KELAS: IT403
-->

<?php 
include_once "lib/Database.php";

class Mahasiswa {
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function regisMahasiswa($data){
        $nama = mysqli_real_escape_string($this->db->link, $data['nama']);
        $nim = mysqli_real_escape_string($this->db->link, $data['nim']);
        $jenis_kelamin = mysqli_real_escape_string($this->db->link, $data['jenis_kelamin']);
        $kelas = mysqli_real_escape_string($this->db->link, $data['kelas']);
        $program_studi = mysqli_real_escape_string($this->db->link, $data['program_studi']);
        $angkatan = mysqli_real_escape_string($this->db->link, $data['angkatan']);

        if (empty($nama) || empty($nim) || empty($jenis_kelamin) || empty($kelas) 
        || empty($program_studi) || empty($angkatan)) {
            $msg = "Data tidak boleh kosong!";
            return $msg;
        }else {
            $query = "INSERT INTO `mahasiswa`(`nama`, `nim`, `jenis_kelamin`, `kelas`, `program_studi`, `angkatan`) 
            VALUES ('$nama', '$nim', '$jenis_kelamin', '$kelas', '$program_studi', '$angkatan')";

            $result = $this->db->masukkan($query);

            if ($result) {
                $msg = "Registrasi Berhasil";
                return $msg;
            } else {
                $msg = "Registration Failed";
                return $msg;
            }
        }
    }

    public function semuaMahasiswa($limit, $offset)
    {
        $query = "SELECT * FROM `mahasiswa` ORDER BY id ASC LIMIT $limit OFFSET $offset";
        $hasil = $this->db->pilih($query);
        return $hasil;
    }

    public function hitungMahasiswa()
    {
        $query = "SELECT COUNT(*) as count FROM `mahasiswa`";
        $hasil = $this->db->pilih($query);
        $row = mysqli_fetch_assoc($hasil);
        return $row['count'];
    }

}
?>