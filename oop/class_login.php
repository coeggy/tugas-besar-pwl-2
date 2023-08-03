<?php 
require_once 'koneksi.php';

class login {
    protected $db;

    public function __construct($con) {
        $this->db = $con;
    }

    public function logincheck($username, $password) {
        $loginuser = $this->db->prepare("SELECT * from login where username='$username' and password='$password'");
        $loginuser->execute();
        session_start();

        // Periksa jumlah baris yang ditemukan
        $rowCount = $loginuser->rowCount();

        // Tandai bahwa form sudah disubmit
        $isSubmitted = isset($_POST['simpan']);

        if ($rowCount == 1 && $isSubmitted) {
            // Jika berhasil login
            $row = $loginuser->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username'] = $username;
            $_SESSION['hak_akses'] = $row['hak_akses'];
            $_SESSION['status'] = "login";
            
            if ($_SESSION['hak_akses'] == 'admin') {
                header("location:index_admin.php");
            } elseif ($_SESSION['hak_akses'] == 'User') {
                header("location:index.php");
            }
        } elseif ($isSubmitted) {
            // Jika gagal login dan form sudah disubmit, tampilkan notifikasi dengan tulisan merah
            echo '<p style="color: red;">Username atau password salah!</p>';
        }
    }
}

$login = new login($con);
?>
