<?php
// Memanggil koneksi.php
require_once 'koneksi.php';

// Fungsi untuk mengubah data Aset Elektronik
function updateElektronik($conn, $ID, $nama_barang, $kategori, $merk, $jumlah_unit) {
    $sql = "UPDATE aset_elektronik SET nama_barang='$nama_barang', kategori='$kategori', merk='$merk', jumlah_unit='$jumlah_unit' WHERE id='$ID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Data Aset berhasil diupdate.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form edit Aset Elektronik
    $ID = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $merk = $_POST['merk'];
    $jumlah_unit = $_POST['jumlah_unit'];
    // Panggil fungsi updateElektronik() untuk mengubah data Aset Elektronik
    updateElektronik($conn, $ID, $nama_barang, $kategori, $merk, $jumlah_unit);
} else {
    // Jika halaman ini diakses secara langsung tanpa melalui form edit Aset Elektronik, berikan pesan error
    echo "Error: Forbidden.";
}

// Jika form submit untuk mengubah data Aset Elektronik
if (isset($_POST['submit_update'])) {
    $ID = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $merk = $_POST['merk'];
    $jumlah_unit = $_POST['jumlah_unit'];

    updateElektronik($conn, $ID, $nama_barang, $kategori, $merk, $jumlah_unit);
}

?>
