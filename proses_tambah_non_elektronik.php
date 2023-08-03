<?php
// Memanggil koneksi.php
require_once 'koneksi.php';

// Fungsi untuk generate ID baru dengan awalan "NE" dan digit
function generateID($conn) {
    $sql = "SELECT MAX(CAST(SUBSTRING(ID, 3) AS UNSIGNED)) AS max_id FROM aset_non_elektronik";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Jika tabel kosong, set ID awal menjadi NE001
    $maxID = $row['max_id'];
    if ($maxID === null) {
        return 'NE001';
    }

    // Mengekstrak angka dari ID terakhir dan menambahkan 1
    $number = $maxID + 1;

    // Menggabungkan "NE" dengan digit angka, misal "NE001"
    $newID = 'NE' . str_pad($number, 3, '0', STR_PAD_LEFT);
    return $newID;
}

// Fungsi untuk menambah data aset_non_elektronik
function addNonElektronik($conn, $nama_barang, $kategori, $merk, $jumlah_unit)
{
    // Generate the new ID
    $ID = generateID($conn);

    // Check if the nama_bnarang already exists in the database
    $checkQuery = "SELECT COUNT(*) as count FROM aset_non_elektronik WHERE nama_barang = '$nama_barang'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $checkData = mysqli_fetch_assoc($checkResult);
    if ($checkData['count'] > 0) {
        echo "Error: Nama Barang Sudah ada";
        return;
    }

    // Insert the new record into the database
    $sql = "INSERT INTO aset_non_elektronik (ID, nama_barang, kategori, merk, jumlah_unit) VALUES ('$ID', '$nama_barang', '$kategori', '$merk', '$jumlah_unit')";
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
    addNonElektronik($conn, $nama_barang, $kategori, $merk, $jumlah_unit);
}
?>
