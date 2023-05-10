<?php
require "koneksi.php";

if (!isset($_GET["id"])) {
  header("location: koin.php");
  exit;
}

$id = $_GET["id"];
$query = "SELECT * FROM paket_koin WHERE id = '$id' LIMIT 1";
$result = mysqli_query($conn, $query);
$coin = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) != 1) {
  header("location: koin.php");
  exit;
}

function ubah() {
  global $conn;

  $id = $_GET["id"];
  $jumlah = $_POST["jumlah"];
  $harga = $_POST["harga"];

  $query = "UPDATE paket_koin SET
    harga = '$harga',
    jumlah = '$jumlah'
    WHERE id = '$id'";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

if (isset($_POST["edit"])) {
  if (ubah() > 0) {
    echo "<script>
        alert('Berhasil update data');
        document.location.href = 'koin.php';
        </script>";
  } else {
    echo "<script>
        alert('Gagal update data');
        document.location.href = 'koin.php';
        </script>";
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
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Edit koin</h5>
                <a href="koin.php" class="btn btn-info mb-3">
                  <i class="fa fa-arrow-left"></i>
                  Kembali
                </a>
              </div>
              <form action="update_koin.php?id=<?= $_GET['id']; ?>" method="POST">
                <div class="form-group">
                  <input type="number" class="form-control" name="jumlah" placeholder="Jumlah" value="<?= $coin['jumlah']; ?>">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" name="harga" placeholder="Harga" value="<?= $coin['harga']; ?>">
                </div>
                <div class="form-group">
                  <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>