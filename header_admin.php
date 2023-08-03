<!-- header.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Inventory Lab Komputer</title>
</head>
<body>
<header>
	<nav class="navbar navbar-expand-lg navigation" id="navbar">
		<div class="container">
		 	 <a class="navbar-brand" href="index_admin.php">
			  	<img src="images/labkom_logo.png" width="80px" alt="" class="img-fluid">
			  </a>

		  	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
			<span class="icofont-navigation-menu"></span>
		  </button>
	  
		  <div class="collapse navbar-collapse" id="navbarmain">
			<ul class="navbar-nav ml-auto">
			  <li class="nav-item active">
				<a class="nav-link" href="index_admin.php">Home</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="kelola_pengguna.php">Kelola Pengguna</a>
			  </li>
			    <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kelola Aset <i class="icofont-thin-down"></i></a>
					<ul class="dropdown-menu" aria-labelledby="dropdown01">
						<li><a class="dropdown-item" href="kelola_aset_elektronik.php">Aset Elektronik</a></li>
						<li><a class="dropdown-item" href="kelola_aset_non_elektronik.php">Aset Non Elektronik</a></li>
					</ul>
			  	</li>
         	<li class="nav-item"><a class="nav-link" href="tentang.php">Tentang</a></li>
			<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
			</ul>
		  </div>
		</div>
	</nav>
		<div class="header-top-bar" >
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<ul class="top-bar-info list-inline-item pl-0 mb-0">	
						<li class="list-inline-item">Inventory Lab Komputer</li>
					</ul>
				</div>
				<div class="col-lg-6">
					<div class="text-lg-right top-right-bar mt-2 mt-lg-0">
						<a href="" >
							<span>Universitas Indraprasta PGRI</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
