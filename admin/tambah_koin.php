<?php

require "koneksi.php";

if (isset($_POST["tambah"])){
    $jumlah = $_POST["jumlah"];
    $harga = $_POST["harga"];

    $query = "INSERT INTO paket_koin (id, jumlah, harga) VALUES (null, '$jumlah','$harga')";
    $result = mysqli_query($conn,$query);

    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    } else {
        echo "<script>
            alert ('Data berhasil ditambahkan');
            window.location.href = 'koin.php';
            </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tambah Koin</title>
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
                <h5 class="card-title">Tambah koin</h5>
                <a href="koin.php" class="btn btn-info mb-3">
                  <i class="fa fa-arrow-left"></i>
                  Kembali
                </a>
              </div>
              <form action="tambah_koin.php" method="POST">
                <div class="form-group">
                  <input type="number" class="form-control" name="jumlah" placeholder="Jumlah">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" name="harga" placeholder="Harga">
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