<?php
  session_start();
  if($_SESSION['status']!="login")
  {
    header("location:login.php?peringatan=silahkanlogindulu");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" sizes="16x16" href="images/labkom_logo.png" />
  <title>Tentang</title>
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="plugins/icofont/icofont.min.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">
</head>
<?php include_once 'header_admin.php'; ?>
<body id="top">
<section class="section service gray-bg">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-12 text-center">
				<div class="section-title">
					<h2>SISTEM INVENTORY LAB KOMPUTER</h2>
					<div class="divider mx-auto my-4"></div>
					<p>
					</p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="service-item mb-4">
					<div class="icon d-flex align-items-center">
						<i class="icofont-people text-lg"></i>
						<h4 class="mt-3 mb-3">Pengembang Aplikasi</h4>
					</div>

					<div class="content">
						<p class="mb-4">
  							Nama : Muhammad Dias Firmansyah<br>
							NPM : 202043500318
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 w3-center">
				<div class="service-item mb-12 ">
					<div class="icon d-flex align-items ">
						<i class="icofont-ui-clip-board text-lg "></i>
						<h4 class="mt-6 mb-6">Tujuan Pembuatan Website</h4>
					</div>
					<div class="content">
						<p class="mb-4">Sebagai bukti menyelesaikan Tugas Besar Pemrograman Web lanjut</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include_once 'footer.php'; ?>
</body>
</html>
   