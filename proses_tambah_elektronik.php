<?php
// Memanggil koneksi.php
require_once 'koneksi.php';

// Fungsi untuk mengenerate ID baru dengan awalan "E" dan digit
function generateID($conn) {
    $sql = "SELECT MAX(ID) AS max_id FROM aset_elektronik";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // Jika tabel kosong, set ID awal menjadi E001
    $maxID = $row['max_id'];
    if ($maxID === null) {
        return 'E001';
    }
    // Mengekstrak angka dari ID terakhir dan menambahkan 1
    $number = intval(substr($maxID, 1)) + 1;
    // Menggabungkan "P" dengan digit angka, misal "P001"
    $newID = 'E' . str_pad($number, 3, '0', STR_PAD_LEFT);
    return $newID;
}

// Fungsi untuk menambah data aset_elektronik
function addElektronik($conn, $nama_barang, $kategori, $merk, $jumlah_unit)
{
    // Generate the new ID
    $ID = generateID($conn);

    // Check if the nama_bnarang already exists in the database
    $checkQuery = "SELECT COUNT(*) as count FROM aset_elektronik WHERE nama_barang = '$nama_barang'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $checkData = mysqli_fetch_assoc($checkResult);
    if ($checkData['count'] > 0) {
        echo "Error: Nama Barang Sudah ada";
        return;
    }

    // Insert the new record into the database
    $sql = "INSERT INTO aset_elektronik (ID, nama_barang, kategori, merk, jumlah_unit) VALUES ('$ID', '$nama_barang', '$kategori', '$merk', '$jumlah_unit')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Data Aset berhasil ditambahkan.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


// Check if the form is submitted for adding a new user
if (isset($_POST['nama_barang']) && isset($_POST['kategori']) && isset($_POST['merk']) && isset($_POST['jumlah_unit'])) {
    $nama_barang = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $merk = $_POST['merk'];
    $jumlah_unit = $_POST['jumlah_unit'];

    // Generate the new ID
    $ID = generateID($conn);

    // Add the user with the generated ID
    addElektronik($conn, $nama_barang, $kategori, $merk, $jumlah_unit);
}
?>
