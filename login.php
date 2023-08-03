<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <style class="">
      .divider:after,
      .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
        }
        .h-custom {
          height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
          .h-custom {
            height: 100%;
          }
        }
  </style>
  <link rel="icon" type="image/png" sizes="16x16" href="images/labkom_logo.png" />
  <title>Login</title>
</head>
<body>
  <script>
    const params = new URLSearchParams(window.location.search);
      if (params.has('peringatan')) {
        // Jika ada, hapus parameter "peringatan" dari URL tanpa me-refresh halaman
        params.delete('peringatan');
        const newURL = window.location.pathname + '?' + params.toString();
        window.history.replaceState({}, '', newURL);
        }
  </script>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="images/labkom_logo.png" class="img-fluid"
          alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST">
          <?php
              require_once "oop/class_login.php";
              if(isset($_POST['simpan'])){
                $username = $_POST['username'];
                $password = $_POST['password'];
                $login->logincheck($username,$password);
              }
            ?>
          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Login untuk memulai</p>
          </div>

          <!-- username input -->
          <div class="form-outline mb-4">
          <label class="form-label" for="form3Example3">Username</label>
          <input type="text" id="form3Example3" class="form-control form-control-lg"
            placeholder="Masukkan username" name="username" />
  
          <?php
          // Menampilkan pesan kesalahan untuk username
          if(isset($_POST['simpan']) && empty($_POST['username'])){
          echo '<p style="color: red;">Username harus diisi!</p>';
          }
          ?>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
          <label class="form-label" for="form3Example4">Password</label>
          <input type="password" id="form3Example4" class="form-control form-control-lg"
          placeholder="Masukkan password" name="password" />
          <?php

          // Menampilkan pesan kesalahan untuk password
          if(isset($_POST['simpan']) && empty($_POST['password'])){
          echo '<p style="color: red;">Password harus diisi!</p>';
          }
          ?>

          </div>
          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" name='simpan' class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div></div>
  <div  class="text-center p-3"
        style="background-color: #003366;
              position:fixed;
              bottom: 0;
              width:100%;
              color:white; ">
    </div>
</section>
</body>
</html>