<?php
// Memanggil koneksi.php
require_once 'koneksi.php';

// Fungsi untuk mengenerate ID baru dengan awalan "P" dan digit
function generateID($conn) {
    $sql = "SELECT MAX(ID) AS max_id FROM Pengguna";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // Jika tabel kosong, set ID awal menjadi P001
    $maxID = $row['max_id'];
    if ($maxID === null) {
        return 'P001';
    }
    // Mengekstrak angka dari ID terakhir dan menambahkan 1
    $number = intval(substr($maxID, 1)) + 1;
    // Menggabungkan "P" dengan digit angka, misal "P001"
    $newID = 'P' . str_pad($number, 3, '0', STR_PAD_LEFT);
    return $newID;
}

// Fungsi untuk menambah data pengguna
function addPengguna($conn, $Nama, $NPM, $Kelas, $No_hp)
{
    // Generate the new ID
    $ID = generateID($conn);

    //Cek NPM Apakah double
    $checkQuery = "SELECT COUNT(*) as count FROM Pengguna WHERE NPM = '$NPM'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $checkData = mysqli_fetch_assoc($checkResult);
    if ($checkData['count'] > 0) {
        echo "Error: NPM sudah terdaftar.";
        return;
    }

    // Insert the new record into the database
    $sql = "INSERT INTO Pengguna (ID, Nama, NPM, Kelas, No_hp) VALUES ('$ID', '$Nama', '$NPM', '$Kelas', '$No_hp')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Data pengguna berhasil ditambahkan.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Check if the form is submitted for adding a new user
if (isset($_POST['Nama']) && isset($_POST['NPM']) && isset($_POST['Kelas']) && isset($_POST['No_hp'])) {
    $Nama = $_POST['Nama'];
    $NPM = $_POST['NPM'];
    $Kelas = $_POST['Kelas'];
    $No_hp = $_POST['No_hp'];

    // Generate ID Baru
    $ID = generateID($conn);

    // Menambah Pengguna dengan ID Baru
    addPengguna($conn, $Nama, $NPM, $Kelas, $No_hp);
}
?>
