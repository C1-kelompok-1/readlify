<?php

require "koneksi.php";

$query = "SELECT * FROM genre";
$result = mysqli_query($conn, $query);

if (isset($_POST["tambah"])){
  $nama = $_POST["nama"];

  $query = "INSERT INTO genre (id, nama) VALUES (null, '$nama')";
  $result = mysqli_query($conn,$query);

  if (!$result) {
      die('Error: ' . mysqli_error($conn));
  } else {
      echo "<script>
          alert ('Data berhasil ditambahkan');
          window.location.href = 'genre.php';
          </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tambah Genre</title>
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
                <h5 class="card-title">Tambah genre</h5>
                <a href="genre.php" class="btn btn-info mb-3">
                  <i class="fa fa-arrow-left"></i>
                  Kembali
                </a>
              </div>
              <form action="tambah_genre.php" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control" name="nama" placeholder="Nama genre">
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