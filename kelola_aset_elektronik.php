<?php
  session_start();
  if($_SESSION['status']!="login")
  {
    header("location:login.php?peringatan=silahkanlogindulu");
  }
?>
<?php
// Memanggil koneksi.php
require_once 'koneksi.php';

// Fungsi untuk menampilkan data pengguna
function show_elektronik($conn) {
    $sql = "SELECT * FROM aset_elektronik";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-container'>";
        echo "<table class='table' border='1'>";
        echo "<tr style='background-color: #003366; color: white;'><th>ID</th><th>Nama Barang</th><th>Kategori</th><th>Merk</th><th>Jumlah Unit</th><th>Action</th></tr>";
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $count++;
            if ($count % 2 == 0) {
                echo "<tr style='background-color: #ffffff; color: #333333;'>";
            } else {
                echo "<tr style='background-color: #f2f2f2; color: #333333;'>";
            }
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nama_barang'] . "</td>";
            echo "<td>" . $row['kategori'] . "</td>";
            echo "<td>" . $row['merk'] . "</td>";
            echo "<td>" . $row['jumlah_unit'] . "</td>";
            echo "<td>
            <button class='btn btn-sm btn-info edit-btn' data-id='" . $row['id'] . "' data-nama_barang='" . $row['nama_barang'] . "' data-kategori='" . $row['kategori'] . "' data-merk='" . $row['merk'] . "' data-jumlah_unit='" . $row['jumlah_unit'] . "'>Edit</button>
            <button class='btn btn-sm btn-danger delete-btn' data-id='" . $row['id'] . "'>Hapus</button>
            </td>";
            echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        }else {
            echo "Tidak ada data pengguna.";
            }
    }

    // Fungsi untuk menambah data pengguna
    function addPengguna($conn, $nama_barang, $kategori, $merk, $jumlah_unit){

    // Check if the NPM already exists in the database
    $checkQuery = "SELECT COUNT(*) as count FROM aset_elektronik WHERE NAMA_BARANG = '$nama_barang'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $checkData = mysqli_fetch_assoc($checkResult);
    if ($checkData['count'] > 0) {
        echo "Error: Barang sudah ada pada database";
        return;
    }

    // Menambahkan data baru ke database
    $sql = "INSERT INTO aset_elektronik (nama_barang, kategori, merk, jumlah_unit) VALUES ('$nama_barang', '$kategori', '$merk', '$jumlah_unit')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Data pengguna berhasil ditambahkan.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    }
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" sizes="16x16" href="images/labkom_logo.png" />
  <title>Kelola Aset Elektronik</title>
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="plugins/icofont/icofont.min.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">
  <!-- Load jQuery library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Load Bootstrap JavaScript library -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<?php include_once 'header_admin.php'; ?>
<body>
    <h1>Kelola Aset Elektronik</h1>
    <?php show_elektronik($conn); ?>
<!-- Modal untuk menampilkan form edit aset elektronik -->
<div class="modal fade" id="editElektronikModal" tabindex="-1" role="dialog" aria-labelledby="editElektronikModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPenggunaModalLabel">Edit Barang Elektronik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tempatkan form edit aset elektronik di sini -->
                    <form id="form-edit-pengguna">
                        <div class="form-group">
                            <input type="hidden" id="editID" name="id">
                            <label for="editNama_Barang">Nama Barang:</label>
                            <input type="text" class="form-control" id="editNama_Barang" name="nama_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="editKategori">Kategori:</label>
                            <input type="text" class="form-control" id="editKategori" name="kategori" required>
                        </div>
                        <div class="form-group">
                            <label for="editMerk">Merk:</label>
                            <input type="text" class="form-control" id="editMerk" name="merk" required>
                        </div>
                        <div class="form-group">
                            <label for="editJumlah_Unit">Jumlah Unit:</label>
                            <input type="text" class="form-control" id="editJumlah_Unit" name="jumlah_unit" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tombol "Tambah Pengguna" -->
    <button class="btn btn-primary custom-btn" id="tambah-elektronik-btn" style="width: 200px; height: 40px; font-size: 12px;">Tambah Aset</button>
    <!-- Modal for adding a new user -->
    <div class="modal fade" id="addElektronikModal" tabindex="-1" role="dialog" aria-labelledby="addElektronikModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addElektronikModalLabel">Tambah Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to add a new user -->
                <form id="form-add-elektronik">
                    <div class="form-group">
                        <label for="addNama_Barang">Nama Barang:</label>
                        <input type="text" class="form-control" id="addNama_barang" name="nama_barang" required>
                    </div>
                    <div class="form-group">
                        <label for="addKategori">Kategori:</label>
                        <input type="text" class="form-control" id="addKategori" name="kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="addMerk">Merk:</label>
                        <input type="text" class="form-control" id="addKelas" name="merk" required>
                    </div>
                    <div class="form-group">
                        <label for="addJumlah_Unit">Jumlah Unit:</label>
                        <input type="text" class="form-control" id="addJumlah_Unit" name="jumlah_unit" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<br><?php include_once 'footer.php'; ?>
</body>
<script>
    $(document).ready(function() {
        // Handle aksi klik tombol "Edit" untuk membuka modal
        $(".edit-btn").click(function() {
            var id = $(this).data('id');
            var nama_barang = $(this).data('nama_barang');
            var kategori = $(this).data('kategori');
            var merk = $(this).data('merk');
            var jumlah_unit = $(this).data('jumlah_unit');

            // Isi nilai form edit pengguna dengan data pengguna yang dipilih
            $("#editID").val(id);
            $("#editNama_Barang").val(nama_barang);
            $("#editKategori").val(kategori);
            $("#editMerk").val(merk);
            $("#editJumlah_Unit").val(jumlah_unit);

            // Buka modal
            $("#editElektronikModal").modal("show");
        });

        // Handle aksi submit form edit pengguna menggunakan Ajax
        $("#form-edit-pengguna").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "proses_edit_elektronik.php",
                data: formData,
                success: function(response) {
                    alert(response); // Tampilkan pesan sukses atau error dari server
                    $("#editElektronikModal").modal("hide"); // Tutup modal setelah sukses
                    location.reload(); // Reload halaman setelah edit pengguna berhasil
                },
                error: function() {
                    alert("Terjadi kesalahan dalam mengirim data.");
                }
            });
        });

        // Handle aksi klik tombol "Tambah Elektronik" untuk membuka modal
        $("#tambah-elektronik-btn").click(function() {
            // Buka modal
            $("#addElektronikModal").modal("show");
        });

        // Handle aksi submit form tambah elektronik menggunakan Ajax
        $("#form-add-elektronik").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "proses_tambah_elektronik.php",
                data: formData,
                success: function(response) {
                    alert(response); // Tampilkan pesan sukses atau error dari server
                    $("#addElektronikModal").modal("hide"); // Tutup modal setelah sukses
                    location.reload(); // Reload halaman setelah tambah pengguna berhasil
                },
                error: function() {
                    alert("Terjadi kesalahan dalam mengirim data.");
                }
            });
        });
        // Handle aksi hapus pengguna menggunakan Ajax
        $(".delete-btn").click(function() {
            var id = $(this).data('id');
        var confirmation = confirm("Apakah Anda yakin ingin menghapus pengguna ini?");
        if (confirmation) {
            $.ajax({
                type: "GET",
                url: "proses_hapus_elektronik.php",
                data: { id: id }, // Kirim data ID pengguna dalam request GET
                success: function(response) {
                    alert(response); // Tampilkan pesan sukses atau error dari server
                    location.reload(); // Reload halaman setelah hapus pengguna berhasil
                },
                error: function() {
                    alert("Terjadi kesalahan dalam menghapus data.");
                }
            });
                }
            });   
    });
</script>
</script>
</html>
