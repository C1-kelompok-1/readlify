<?php

require "database.php";
require "helpers/alert.php";
require "helpers/auth.php";
require "helpers/input.php";

$id = $_GET['id'];
$coin = fetchOne('SELECT * FROM paket_koin WHERE id = :id', [':id' => $id]);

if (isset($_POST["update"])) {
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
    $coin = fetchOne('SELECT COUNT(id) AS sudah_ada FROM paket_koin WHERE jumlah = :jumlah AND id != :id', [':jumlah' => $jumlah, ':id' => $id]);

    if (!$coin['sudah_ada']) {
      try {
        query("UPDATE paket_koin SET jumlah = :jumlah, harga = :harga WHERE id = :id", [
          ':jumlah' => $jumlah,
          ':harga' => $harga,
          ':id' => $id
        ]);
    
        setAlert('success', 'Berhasil mengedit paket koin');
        redirect('koin.php');
      } catch (PDOException $error) {
        setAlert('danger', 'Gagal mengedit paket koin');
        redirect('update_koin.php?id='.$id);
      }
    } else {
      setAlert('danger', 'Paket koin dengan jumlah tersebut sudah ada');
      redirect('update_koin.php?id='.$id);
    }
  } else {
    setOldInputs();
    redirect('update_koin.php?id='.$id);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Edit Koin</title>
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
                <h5 class="card-title">Edit koin</h5>
                <a href="koin.php" class="btn btn-info mb-3">
                  <i class="fa fa-arrow-left"></i>
                  Kembali
                </a>
              </div>
              <form action="update_koin.php?id=<?= $id; ?>" method="POST">
                <div class="form-group">
                  <input type="number" class="form-control" name="jumlah" placeholder="Jumlah" value="<?= getOldInput('jumlah', $coin['jumlah']); ?>">
                  <?= getInputError('jumlah'); ?>
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" name="harga" placeholder="Harga" value="<?= getOldInput('harga', $coin['harga']); ?>">
                  <?= getInputError('harga'); ?>
                </div>
                <div class="form-group">
                  <button type="submit" name="update" class="btn btn-primary">Edit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>