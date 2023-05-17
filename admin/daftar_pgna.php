<?php

require "database.php";
require "helpers/string.php";
require "helpers/alert.php";

$query = "SELECT * FROM pengguna ORDER BY IF (role IN ('pembaca', 'penulis'), 0, 1)";
$result = fetchAll($query);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Daftar Pengguna</title>
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
                    <?php foreach ($result as $row) { ?>
                      <tr>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["role"]; ?></td>
                        <td><?php echo formatNumber($row["koin"]); ?></td>
                        <td>
                          <a href="<?= $row['facebook_url']; ?>" target="_blank"><i class="fa fa-facebook mr-3"></i></a>
                          <a href="<?= $row['instagram_url']; ?>" target="_blank"><i class="fa fa-instagram mr-3"></i></a>
                          <a href="<?= $row['twitter_url']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                        </td>
                        <td class="text-right">
                          <?php if ($row['role'] != 'admin'): ?>
                            <a href="hapus_pgna.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                              <i class="fa fa-trash"></i>
                              Hapus
                            </a>
                          <?php endif; ?>
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