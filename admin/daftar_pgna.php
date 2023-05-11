<?php

require "koneksi.php";

$query = "SELECT * FROM pengguna WHERE role IN ('pembaca', 'penulis')";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Pengguna</title>
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
                <h5 class="card-title">Pengguna</h5>
                <a href="tambah_pgna.php" class="btn btn-info mb-3">
                  <i class="fa fa-plus"></i>
                  Tambah admin
                </a>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Koin</th>
                      <th>Sosial media</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while( $row = mysqli_fetch_assoc($result)) { ?>
                      <tr>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["role"]; ?></td>
                        <td><?php echo $row["koin"]; ?></td>
                        <td>
                          <a href="<?= $row['facebook_url']; ?>" target="_blank"><i class="fa fa-facebook mr-3"></i></a>
                          <a href="<?= $row['instagram_url']; ?>" target="_blank"><i class="fa fa-instagram mr-3"></i></a>
                          <a href="<?= $row['twitter_url']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                        </td>
                        <td class="text-right">
                          <?php if ($row['role'] == 'pembaca'): ?>
                            <a href="role_pgna.php?id=<?php echo $row['id']; ?>" class="btn btn-success" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                              <i class="fa fa-user"></i>
                              Jadikan Penulis
                            </a>
                          <?php endif; ?>
                          <a href="hapus_pgna.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                            <i class="fa fa-trash"></i>
                            Hapus
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