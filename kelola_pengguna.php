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
function showPengguna($conn) {
    $sql = "SELECT * FROM pengguna";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-container'>";
        echo "<table class='table' border='1'>";
        echo "<tr style='background-color: #003366; color: white;'><th>ID</th><th>Nama</th><th>NPM</th><th>Kelas</th><th>No HP</th><th>Action</th></tr>";
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $count++;
            if ($count % 2 == 0) {
                echo "<tr style='background-color: #ffffff; color: #333333;'>";
            } else {
                echo "<tr style='background-color: #f2f2f2; color: #333333;'>";
            }
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['npm'] . "</td>";
            echo "<td>" . $row['kelas'] . "</td>";
            echo "<td>" . $row['no_hp'] . "</td>";
            echo "<td>
            <button class='btn btn-sm btn-info edit-btn' data-id='" . $row['id'] . "' data-nama='" . $row['nama'] . "' data-npm='" . $row['npm'] . "' data-kelas='" . $row['kelas'] . "' data-no_hp='" . $row['no_hp'] . "'>Edit</button>
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
    function addPengguna($conn, $Nama, $NPM, $Kelas, $No_hp){

    // Check if the NPM already exists in the database
    $checkQuery = "SELECT COUNT(*) as count FROM Pengguna WHERE NPM = '$NPM'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $checkData = mysqli_fetch_assoc($checkResult);
    if ($checkData['count'] > 0) {
        echo "Error: NPM already exists in the database.";
        return;
    }

    // Menambahkan data baru ke database
    $sql = "INSERT INTO Pengguna (Nama, NPM, Kelas, No_hp) VALUES ('$Nama', '$NPM', '$Kelas', '$No_hp')";
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
  <title>Kelola Pengguna</title>
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
    <h1>Kelola Pengguna</h1>
    <?php showPengguna($conn); ?>
<!-- Modal untuk menampilkan form edit pengguna -->
<div class="modal fade" id="editPenggunaModal" tabindex="-1" role="dialog" aria-labelledby="editPenggunaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPenggunaModalLabel">Edit Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tempatkan form edit pengguna di sini -->
                    <form id="form-edit-pengguna">
                        <div class="form-group">
                            <input type="hidden" id="editID" name="id">
                            <label for="editNama">Nama:</label>
                            <input type="text" class="form-control" id="editNama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="editNPM">NPM:</label>
                            <input type="text" class="form-control" id="editNPM" name="npm" required>
                        </div>
                        <div class="form-group">
                            <label for="editKelas">Kelas:</label>
                            <input type="text" class="form-control" id="editKelas" name="kelas" required>
                        </div>
                        <div class="form-group">
                            <label for="editNo_hp">No HP:</label>
                            <input type="text" class="form-control" id="editNo_hp" name="no_hp" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tombol "Tambah Pengguna" -->
    <button class="btn btn-primary custom-btn" id="tambah-pengguna-btn" style="width: 200px; height: 40px; font-size: 12px;">Tambah Pengguna</button>
    <!-- Modal for adding a new user -->
<div class="modal fade" id="addPenggunaModal" tabindex="-1" role="dialog" aria-labelledby="addPenggunaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPenggunaModalLabel">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to add a new user -->
                <form id="form-add-pengguna">
                    <div class="form-group">
                        <label for="addNama">Nama:</label>
                        <input type="text" class="form-control" id="addNama" name="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="addNPM">NPM:</label>
                        <input type="text" class="form-control" id="addNPM" name="NPM" required>
                    </div>
                    <div class="form-group">
                        <label for="addKelas">Kelas:</label>
                        <input type="text" class="form-control" id="addKelas" name="Kelas" required>
                    </div>
                    <div class="form-group">
                        <label for="addNo_hp">No HP:</label>
                        <input type="text" class="form-control" id="addNo_hp" name="No_hp" required>
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
            var nama = $(this).data('nama');
            var npm = $(this).data('npm');
            var kelas = $(this).data('kelas');
            var no_hp = $(this).data('no_hp');

            // Isi nilai form edit pengguna dengan data pengguna yang dipilih
            $("#editID").val(id);
            $("#editNama").val(nama);
            $("#editNPM").val(npm);
            $("#editKelas").val(kelas);
            $("#editNo_hp").val(no_hp);

            // Buka modal
            $("#editPenggunaModal").modal("show");
        });

        // Handle aksi submit form edit pengguna menggunakan Ajax
        $("#form-edit-pengguna").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "proses_edit_pengguna.php",
                data: formData,
                success: function(response) {
                    alert(response); // Tampilkan pesan sukses atau error dari server
                    $("#editPenggunaModal").modal("hide"); // Tutup modal setelah sukses
                    location.reload(); // Reload halaman setelah edit pengguna berhasil
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
                    url: "proses_hapus_pengguna.php",
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
        // Handle aksi klik tombol "Tambah Pengguna" untuk membuka modal
        $("#tambah-pengguna-btn").click(function() {
            // Buka modal
            $("#addPenggunaModal").modal("show");
        });

        // Handle aksi submit form tambah pengguna menggunakan Ajax
        $("#form-add-pengguna").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "proses_tambah_pengguna.php",
                data: formData,
                success: function(response) {
                    alert(response); // Tampilkan pesan sukses atau error dari server
                    $("#addPenggunaModal").modal("hide"); // Tutup modal setelah sukses
                    location.reload(); // Reload halaman setelah tambah pengguna berhasil
                },
                error: function() {
                    alert("Terjadi kesalahan dalam mengirim data.");
                }
            });
        });
        });
</script>
</html>
