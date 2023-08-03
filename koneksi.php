<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_labkom';

// Membuat koneksi ke database dengan mysqli
$conn = mysqli_connect($host, $username, $password, $database);

// Mengecek apakah koneksi berhasil atau tidak
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
