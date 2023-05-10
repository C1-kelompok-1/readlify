<?php

require "koneksi.php";

$sql1 = "SELECT COUNT(id) AS total FROM novel";
$result1 = mysqli_query($conn, $sql1);
$total1 = mysqli_fetch_assoc($result1)['total'];

$sql2 = "SELECT COUNT(id) AS total FROM pengguna WHERE role='penulis'";
$result2 = mysqli_query ($conn,$sql2);
$total2 = mysqli_fetch_assoc($result2)['total'];

$sql3 = "SELECT COUNT(id) AS total FROM pengguna WHERE role='pembaca'";
$result3 = mysqli_query($conn, $sql3);
$total3 = mysqli_fetch_assoc($result3)['total'];

$sql4 = "SELECT SUM(harga) AS total FROM pembelian_koin";
$result4 = mysqli_query($conn, $sql4);
$total4 = mysqli_fetch_assoc($result4)['total'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dashboard</title>
  <?php require 'layouts/styles.php'; ?>
</head>

<body class="bg-theme bg-theme1">
  <div id="wrapper">
    <?php require 'layouts/sidebar.php'; ?>
    <?php require 'layouts/navbar.php'; ?>
    <?php require 'layouts/scripts.php'; ?>

    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="card mt-3">
          <div class="card-content">
            <div class="row row-group m-0">
              <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white">
                    <?= $total1 ?: 0; ?>
                    <span class="float-right"><i class="fa fa-book"></i></span>
                  </h5>
                  <p class="mb-0 text-white small-font">Jumlah novel</p>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white">
                    <?= $total2 ?: 0; ?>
                    <span class="float-right"><i class="fa fa-pencil"></i></span>
                  </h5>
                  <p class="mb-0 text-white small-font">Jumlah penulis</p>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white">
                    <?= $total3 ?: 0; ?>
                    <span class="float-right"><i class="fa fa-eye"></i></span>
                  </h5>
                  <p class="mb-0 text-white small-font">Jumlah pembaca</p>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white">
                    Rp <?= $total4 ?: 0; ?>
                    <span class="float-right"><i class="fa fa-dollar"></i></span>
                  </h5>
                  <p class="mb-0 text-white small-font">Jumlah pendapatan koin</p>
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