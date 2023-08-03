<?php
  session_start();
  if($_SESSION['status']!="login")
  {
    header("location:login.php?peringatan=silahkanlogindulu");
  }

// Get the logged-in username from the session
$loggedInUsername = $_SESSION['username'];

require_once 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" sizes="16x16" href="images/labkom_logo.png" />
  <title>Halaman Utama</title>
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
  <style>
    /* Custom CSS for the layout */
    .greeting {
      text-align: center;
      margin: 30px 0;
    }

    .status {
      display: flex;
      justify-content: space-between;
    }

    .status-item {
      flex-basis: 30%;
      padding: 10px;
      background-color: #f0f0f0;
      border-radius: 5px;
      text-align: center;
    }

    .assets-list {
      padding: px;
    }

    .assets-list li {
      margin-bottom: 10px;
    }
  </style>
</head>
<?php include_once 'header_admin.php'; ?>
<body>
<!-- Display the logged-in username -->
<h2>Halo, <?php echo $loggedInUsername; ?></h2>
<?php

// Fetch the data from the database
$query = "SELECT COUNT(*) as total_idle FROM komputer_lab WHERE status = 'idle'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalIdlePCs = $row['total_idle'];

$query = "SELECT COUNT(*) as total_active FROM komputer_lab WHERE status = 'active'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalActivePCs = $row['total_active'];
?>

<?php
// Fetch the number of users
$query = "SELECT COUNT(*) as total_users FROM pengguna";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalUsers = $row['total_users'];

// Fetch the electronic assets data and sum jumlah_unit for the same brand/merk
$query = "SELECT merk, SUM(jumlah_unit) as total_units FROM aset_elektronik GROUP BY merk";
$result = mysqli_query($conn, $query);
$sumElectronicAssets = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch the non-electronic assets data (merk and unit)
$query = "SELECT merk, SUM(jumlah_unit) as total_units FROM aset_non_elektronik GROUP BY merk";
$result = mysqli_query($conn, $query);
$sumNonElectronicAssets = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="status">
      <div class="status-item">
        <!-- Display the PC status -->
        <h5>Total Idle PCs: <?php echo $totalIdlePCs; ?></h5>
      </div>
      <div class="status-item">
        <!-- Display the PC status -->
        <h5>Total Active PCs: <?php echo $totalActivePCs; ?></h5>
      </div>
      <div class="status-item">
        <!-- Display the number of users -->
        <h5>Total Users: <?php echo $totalUsers; ?></h5>
      </div>
    </div>
<br>
<div class="status">
    <!-- Display the electronic assets -->
    <div class="status-item">
    <h3>Electronic Assets</h3>
    <ul class="assets-list">
      <?php foreach ($sumElectronicAssets as $asset) { ?>
        <li>Merk: <?php echo $asset['merk']; ?>, Total Units: <?php echo $asset['total_units']; ?></li>
      <?php } ?>
    </ul>
    </div>

    <!-- Display the non-electronic assets -->
    <div class="status-item">
    <h3>Non-electronic Assets</h3>
    <ul class="assets-list">
      <?php foreach ($sumNonElectronicAssets as $asset) { ?>
        <li>Merk: <?php echo $asset['merk']; ?>, Total Units: <?php echo $asset['total_units']; ?></li>
      <?php } ?>
    </ul>
  </div>
</div>
<br>
<?php include_once 'footer.php'; ?>
    <!-- 
    Essential Scripts
    =====================================-->
    <!-- Main jQuery -->
    <script src="plugins/jquery/jquery.js"></script>
    <!-- Bootstrap 4.3.2 -->
    <script src="plugins/bootstrap/js/popper.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/counterup/jquery.easing.js"></script>
    <!-- Slick Slider -->
    <script src="plugins/slick-carousel/slick/slick.min.js"></script>
    <!-- Counterup -->
    <script src="plugins/counterup/jquery.waypoints.min.js"></script>
    
    <script src="plugins/shuffle/shuffle.min.js"></script>
    <script src="plugins/counterup/jquery.counterup.min.js"></script>
    <!-- Google Map -->
    <script src="plugins/google-map/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&callback=initMap"></script>    
    
    <script src="js/script.js"></script>
    <script src="js/contact.js"></script>

  </body>
  </html>
   