<?php
// Memanggil koneksi.php
require_once 'koneksi.php';

// Fungsi untuk menghapus data pengguna
function deleteElektronik($conn, $ID) {
    $sql = "DELETE FROM aset_elektronik WHERE id='$ID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Data pengguna berhasil dihapus.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET['id'])) {
        $ID = $_GET['id'];

        // Panggil fungsi deletePengguna() untuk menghapus data pengguna
        deleteElektronik($conn, $ID);
    } else {
        // Jika parameter id tidak ada, berikan pesan error
        echo "Error: ID not specified.";
    }
} else {
    // Jika halaman ini diakses secara langsung tanpa melalui request GET, berikan pesan error
    echo "Error: Forbidden.";
}
?>
