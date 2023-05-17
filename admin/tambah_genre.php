<?php

require "database.php";
require "helpers/alert.php";
require "helpers/auth.php";
require "helpers/input.php";

if (isset($_POST["tambah"])) {
  $nama = $_POST["nama"];

  // cek nama
  if (!$nama) {
    setInputError('nama', 'Nama perlu diisi');
  }

  // cek nama
  if (strlen($nama) > 50) {
    setInputError('nama', 'Maksimal panjang nama hanya 50 karakter');
  }

  if (!isThereAnyInputError()) {
    $genre = fetchOne('SELECT COUNT(id) AS jumlah FROM genre WHERE nama = :nama', [':nama' => $nama]);

    if (!$genre['jumlah']) {
      try {
        query("INSERT INTO genre (id, nama) VALUES (null, :nama)", [':nama' => $nama]);
    
        setAlert('success', 'Berhasil menambah genre');
        redirect('genre.php');
      } catch (PDOException $error) {
        setAlert('danger', 'gagal menambah genre');
        redirect('tambah_genre.php');
      }
    } else {
      setAlert('danger', 'Genre tersebut sudah ada');
      redirect('tambah_genre.php');
    }
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
          <?= getAlert(); ?>
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
                  <?= getInputError('nama'); ?>
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