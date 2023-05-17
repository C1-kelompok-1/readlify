<?php

require "database.php";
require "helpers/string.php";
require "helpers/alert.php";

$query = "SELECT * FROM paket_koin";
$result = fetchAll($query);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Paket koin</title>
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
                <h5 class="card-title">Paket koin</h5>
                <a href="tambah_koin.php" class="btn btn-info mb-3">
                  <i class="fa fa-plus"></i>
                  Tambah
                </a>
              </div>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Jumlah</th>
                      <th>Harga</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($result as $row) { ?>
                      <tr>
                        <td><?php echo $row["jumlah"]; ?></td>
                        <td><?php echo 'Rp'.formatNumber($row["harga"]); ?></td>
                        <td class="text-right">
                          <a href="hapus_koin.php?id=<?php echo$row['id']?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                            <i class="fa fa-trash"></i>
                            Hapus
                          </a>
                          <a href="update_koin.php?id=<?php echo$row['id']?>" class="btn btn-info">
                            <i class="fa fa-pencil"></i>
                            Edit
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