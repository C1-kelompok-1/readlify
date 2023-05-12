<?php

require "koneksi.php";

$id = $_GET['id'];
$query = "SELECT
            pengajuan_penulis.*,
            pengguna.id AS id_pengguna,
            pengguna.username AS username_pengguna,
            pengguna.email As email_pengguna
          FROM pengajuan_penulis
          INNER JOIN pengguna ON pengguna.id = pengajuan_penulis.id_pengguna
          WHERE pengajuan_penulis.id = '$id' LIMIT 1";
$result = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($result);

if (isset($_GET['status'])) {
  $status = $_GET['status'];
  $userId = $result['id_pengguna'];

  try {
    $query = "UPDATE pengajuan_penulis SET status = $status WHERE id = '$id'";
    mysqli_query($conn, $query);
    mysqli_affected_rows($conn);
    
    if ((int) $status == 1) {
      $query = "UPDATE pengguna SET role = 'penulis' WHERE id = '$userId'";
      mysqli_query($conn, $query);
      mysqli_affected_rows($conn);
    }

    echo "<script>
            alert ('Status pengguna berhasil diedit');
            window.location.href = 'daftar_pengajuan.php';
            </script>";
  } catch (Exception $error) {
    echo "<script>
            alert ('Gagal mengedit status pengguna');
            </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Pengajuan Penulis</title>
    <?php require 'layouts/styles.php'; ?>
  </head>

  <body class="bg-theme bg-theme1">
    <div id="wrapper">
      <?php require 'layouts/sidebar.php'; ?>
      <?php require 'layouts/navbar.php'; ?>
      <?php require 'layouts/scripts.php'; ?>

      <div class="content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                <h5 class="card-title">Status</h5>
                  <?php if ($result['status'] != 1): ?>
                    <a href="pengajuan.php?id=<?= $id; ?>&status=1" class="btn btn-success" onclick="return confirm('Setujui pengajuan ini?')">
                      <i class="fa fa-check"></i>
                      Setujui
                    </a>
                    <a href="pengajuan.php?id=<?= $id; ?>&status=0" class="btn btn-danger" onclick="return confirm('Tolak pengajuan ini?')">
                      <i class="fa fa-times"></i>
                      Tolak
                    </a>
                  <?php else: ?>
                  <div class="badge badge-success">Disetujui</div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Pengguna</h5>
                  <table class="table">
                    <body>
                      <tr>
                        <td style="width: 200px;">Username</td>
                        <td><?= $result['username_pengguna']; ?></td>
                      </tr>
                      <tr>
                        <td style="width: 200px;">Email</td>
                        <td><?= $result['email_pengguna']; ?></td>
                      </tr>
                    </body>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Cerita</h5>
                  <div class="table-responsive">
                    <table class="table">
                      <body>
                        <tr>
                          <td style="width: 200px;">Judul</td>
                          <td><?= $result['judul']; ?></td>
                        </tr>
                        <tr>
                          <td style="width: 200px;">Deskripsi</td>
                          <td><?= $result['deskripsi']; ?></td>
                        </tr>
                        <tr>
                          <td style="width: 200px;"></td>
                          <td><?= $result['konten']; ?></td>
                        </tr>
                      </body>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>