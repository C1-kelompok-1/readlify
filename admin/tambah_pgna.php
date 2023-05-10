<?php

require "koneksi.php";

$query = "SELECT * FROM pengguna";
$result = mysqli_query($conn, $query);

if (isset($_POST["tambah"])){
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $query = "INSERT INTO pengguna (id, username, email, password, role) VALUES (null, '$username', '$email', '$password', 'admin')";
  $result = mysqli_query($conn,$query);

  if (!$result) {
      die('Error: ' . mysqli_error($conn));
  } else {
      echo "<script>
          alert ('Admin berhasil ditambahkan');
          window.location.href = 'daftar_pgna.php';
          </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tambah admin</title>
    <?php require 'layouts/styles.php'; ?>
  </head>

  <body class="bg-theme bg-theme1">
    <div id="wrapper">
      <?php require 'layouts/sidebar.php'; ?>
      <?php require 'layouts/navbar.php'; ?>
      <?php require 'layouts/scripts.php'; ?>
      
      <div class="content-wrapper">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Tambah admin</h5>
                <a href="genre.php" class="btn btn-info mb-3">
                  <i class="fa fa-arrow-left"></i>
                  Kembali
                </a>
              </div>
              <form action="tambah_pgna.php" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>