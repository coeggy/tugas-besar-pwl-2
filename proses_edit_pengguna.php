<?php
// Memanggil koneksi.php
require_once 'koneksi.php';

// Fungsi untuk mengubah data pengguna
function updatePengguna($conn, $ID, $Nama, $NPM, $Kelas, $No_hp) {
    $sql = "UPDATE Pengguna SET nama='$Nama', npm='$NPM', kelas='$Kelas', no_hp='$No_hp' WHERE id='$ID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Data pengguna berhasil diupdate.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari form edit pengguna
    $ID = $_POST['id'];
    $Nama = $_POST['nama'];
    $NPM = $_POST['npm'];
    $Kelas = $_POST['kelas'];
    $No_hp = $_POST['no_hp'];
    // Panggil fungsi updatePengguna() untuk mengubah data pengguna
    updatePengguna($conn, $ID, $Nama, $NPM, $Kelas, $No_hp);
} else {
    // Jika halaman ini diakses secara langsung tanpa melalui form edit pengguna, berikan pesan error
    echo "Error: Forbidden.";
}

// Jika form submit untuk mengubah data pengguna
if (isset($_POST['submit_update'])) {
    $ID = $_POST['id'];
    $Nama = $_POST['nama'];
    $NPM = $_POST['npm'];
    $Kelas = $_POST['kelas'];
    $No_hp = $_POST['no_hp'];

    updatePengguna($conn, $ID, $Nama, $NPM, $Kelas, $No_hp);
}

?>
