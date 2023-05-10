
<?php

require "koneksi.php";

$query = "SELECT * FROM genre";
$result = mysqli_query($conn, $query);

if (!isset($_GET["id"])) {
  header("location: genre.php");
  exit;
}

$id = $_GET["id"];
$query = "SELECT * FROM genre WHERE id = '$id' LIMIT 1";
$result = mysqli_query($conn, $query);
$genre = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) != 1) {
  header("location: genre.php");
  exit;
}

function ubah() {
  global $conn;

  $id = $_GET["id"];
  $nama = $_POST["nama"];

  $query = "UPDATE genre SET
    nama = '$nama'
    WHERE id = '$id'";
  $result = mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

if (isset($_POST["update"])) {
  if (ubah() > 0) {
    echo "<script>
        alert('Berhasil update data');
        document.location.href = 'genre.php';
        </script>";
  } else {
    echo "<script>
        alert('Gagal update data');
        document.location.href = 'genre.php';
        </script>";
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
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title">Edit genre</h5>
                <a href="genre.php" class="btn btn-info mb-3">
                  <i class="fa fa-arrow-left"></i>
                  Kembali
                </a>
              </div>
              <form action="update_genre.php?id=<?= $_GET['id']; ?>" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control" name="nama" placeholder="Nama genre" value="<?= $genre['nama']; ?>">
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