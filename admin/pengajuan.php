<?php

require "database.php";
require "helpers/alert.php";
require "helpers/auth.php";

$id = $_GET['id'];
$query = "SELECT
            pengajuan_penulis.*,
            pengguna.id AS id_pengguna,
            pengguna.username AS username_pengguna,
            pengguna.email As email_pengguna
          FROM pengajuan_penulis
          INNER JOIN pengguna ON pengguna.id = pengajuan_penulis.id_pengguna
          WHERE pengajuan_penulis.id = '$id' LIMIT 1";
$result = fetchOne($query);

if (isset($_GET['status'])) {
  $status = $_GET['status'];
  $userId = $result['id_pengguna'];

  try {
    $query = "UPDATE pengajuan_penulis SET status = $status WHERE id = '$id'";
    query($query);
    
    if ((int) $status == 1) {
      $query = "UPDATE pengguna SET role = 'penulis' WHERE id = '$userId'";
      query($query);
    }

    if ($status) {
      setAlert('success', 'Pengguna telah menjadi penulis');
    } else {
      setAlert('success', 'Pengguna telah ditolak');
    }
    
    redirect('pengajuan.php?id='.$id);
  } catch (Exception $error) {
    setAlert('danger', 'Gagal mengubah status');
    redirect('pengajuan.php?id='.$id);
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
            <div class="col-12 mb-3">
              <a href="daftar_pengajuan.php" class="btn btn-info">
                <i class="fa fa-arrow-left"></i>
                Kembali
              </a>
            </div>
            <div class="col-12">
              <?= getAlert(); ?>
            </div>
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
                  <table class="table">
                    <body>
                      <tr>
                        <td style="width: 200px;">Judul</td>
                        <td style="white-space: normal;"><?= $result['judul']; ?></td>
                      </tr>
                      <tr>
                        <td style="width: 200px;">Deskripsi</td>
                        <td style="white-space: normal;"><?= $result['deskripsi']; ?></td>
                      </tr>
                      <tr>
                        <td style="width: 200px;"></td>
                        <td style="white-space: normal; text-align: justify;"><?= $result['konten']; ?></td>
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
  </body>
</html>