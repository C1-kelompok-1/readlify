<?php

require "database.php";
require "helpers/alert.php";
require "helpers/auth.php";
require "helpers/input.php";

$id = $_GET['id'];
$query = "SELECT * FROM genre WHERE id = :id";
$result = fetchOne($query, [':id' => $id]);

if (isset($_POST["update"])) {
  $nama = $_POST["nama"];

  // cek nama
  if (!$nama) {
    setInputError('nama', 'Nama perlu diisi');
  }

  if (!isThereAnyInputError()) {
    $genre = fetchOne('SELECT COUNT(id) AS jumlah FROM genre WHERE nama = :nama AND id != :id', [':nama' => $nama, ':id' => $id]);

    if (!$genre['jumlah']) {
      try {
        query("UPDATE genre SET nama = :nama WHERE id = :id", [':nama' => $nama, ':id' => $id]);
    
        setAlert('success', 'Berhasil mengedit genre');
        redirect('update_genre.php?id='.$id);
      } catch (PDOException $error) {
        setAlert('danger', 'Gagal mengedit genre');
        redirect('update_genre.php?id='.$id);
      }
    } else {
      setAlert('danger', 'Genre tersebut sudah ada');
      redirect('update_genre.php?id='.$id);
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Edit Genre</title>
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
                <h5 class="card-title">Edit genre</h5>
                <a href="genre.php" class="btn btn-info mb-3">
                  <i class="fa fa-arrow-left"></i>
                  Kembali
                </a>
              </div>
              <form action="update_genre.php?id=<?= $id; ?>" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control" name="nama" placeholder="Nama genre" value="<?= $result['nama']; ?>">
                  <?= getInputError('nama'); ?>
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