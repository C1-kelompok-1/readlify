<?php

require "koneksi.php";

$query = "SELECT
            pengajuan_penulis.id,
            pengajuan_penulis.judul,
            pengajuan_penulis.status,
            pengajuan_penulis.tanggal,
            pengguna.username,
            pengguna.email
          FROM pengajuan_penulis
          INNER JOIN pengguna ON pengguna.id = pengajuan_penulis.id_pengguna
          ORDER BY pengajuan_penulis.tanggal DESC,
          IF (pengajuan_penulis.status != 1, 0, 1) ASC";
$result = mysqli_query($conn, $query);

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
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Pengajuan Penulis</h5>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Judul</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while( $row = mysqli_fetch_assoc($result)) { ?>
                      <tr>
                        <td><?php echo $row["judul"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["status"] == 1 ? 'Disetujui' : 'Ditolak / belum ditanggapi'; ?></td>
                        <td><?php echo $row["tanggal"]; ?></td>
                        <td class="text-right">
                          <a href="pengajuan.php?id=<?php echo $row['id']?>" class="btn btn-info">
                            <i class="fa fa-eye"></i>
                            Detail
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>