<?php

require "database.php";
require "helpers/alert.php";
require "helpers/auth.php";
require "helpers/input.php";

if (isset($_POST["tambah"])) {
  $jumlah = $_POST["jumlah"];
  $harga = $_POST["harga"];

  // cek jumlah
  if (!$jumlah) {
    setInputError('jumlah', 'Jumlah perlu diisi');
  }

  // cek jumlah
  if ($jumlah <= 0) {
    setInputError('jumlah', 'Jumlah tidak valid');
  }

  // cek harga
  if (!$harga) {
    setInputError('harga', 'Harga perlu diisi');
  }

  // cek harga
  if ($harga <= 0) {
    setInputError('harga', 'Harga tidak valid');
  }

  if (!isThereAnyInputError()) {
    $coin = fetchOne('SELECT COUNT(id) AS sudah_ada FROM paket_koin WHERE jumlah = :jumlah', [':jumlah' => $jumlah]);

    if (!$coin['sudah_ada']) {
      try {
        query("INSERT INTO paket_koin (id, jumlah, harga) VALUES (null, :jumlah, :harga)", [
          ':jumlah' => $jumlah,
          ':harga' => $harga
        ]);
    
        setAlert('success', 'Berhasil menambah paket koin');
        redirect('koin.php');
      } catch (PDOException $error) {
        setAlert('danger', 'Gagal menambah paket koin');
        redirect('tambah_koin.php');
      }
    } else {
      setAlert('danger', 'Paket koin dengan jumlah tersebut sudah ada');
      redirect('tambah_koin.php');
    }
  } else {
    setOldInputs();
    redirect('tambah_koin.php');
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
          <?= getAlert(); ?>
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
                  <input type="number" class="form-control" name="jumlah" placeholder="Jumlah" value="<?= getOldInput('jumlah'); ?>">
                  <?= getInputError('jumlah'); ?>
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" name="harga" placeholder="Harga" value="<?= getOldInput('harga'); ?>">
                  <?= getInputError('harga'); ?>
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