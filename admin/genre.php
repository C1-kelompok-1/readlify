<?php

require "koneksi.php";

$query = "SELECT * FROM genre";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Genre</title>
  <link href="assets/css/pace.min.css" rel="stylesheet" />
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet" />
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet" />

</head>

<body class="bg-theme bg-theme1">

  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start sidebar-wrapper-->
    <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
      <div class="brand-logo">
        <a href="index.php">
          <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
          <h5 class="logo-text">Readify Admin</h5>
        </a>
      </div>
      <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header">MAIN NAVIGATION</li>
        <li>
          <a href="index.php">
            <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li>
          <a href="daftar_pgna.php">
            <i class="zmdi zmdi-accounts-alt"></i> <span>Daftar Pengguna</span>
          </a>
        </li>

        <li>
          <a href="daftar_nvl.php">
            <i class="zmdi zmdi-grid"></i> <span>Daftar Novel</span>
          </a>
        </li>

        <li>
          <a href="genre.php">
            <i class="zmdi zmdi-book-image"></i> <span>Genre</span>
          </a>
        </li>

        <li>
          <a href="koin.php">
            <i class="zmdi zmdi-balance"></i> <span>Koin</span>
          </a>
        </li>

    </div>
    <!--End sidebar-wrapper-->

    <!--Start topbar header-->
    <header class="topbar-nav">
      <nav class="navbar navbar-expand fixed-top">
        <ul class="navbar-nav mr-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link toggle-menu" href="javascript:void();">
              <i class="icon-menu menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <marquee>
              <h4> HI ADMIN READIFY </h4>
            </marquee>
          </li>
        </ul>
        </ul>

        </ul>
        </li>
        </ul>
      </nav>
    </header>
    <!--End topbar header-->

    <!-- Bootstrap core JavaScript-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- simplebar js -->
    <script src="assets/plugins/simplebar/js/simplebar.js"></script>
    <!-- sidebar-menu js -->
    <script src="assets/js/sidebar-menu.js"></script>
    <!-- loader scripts -->
    <script src="assets/js/jquery.loading-indicator.js"></script>
    <!-- Custom scripts -->
    <script src="assets/js/app-script.js"></script>

    <div class="content-wrapper">
      <div class="container-fluid">

        <div class="card mt-3">
          <center><h3> Genre </h3></center>
          <br>
          <a href="tambah_genre.php"> Tambah</a>
          <br>
          
          <table border="1" cellpadding="10" cellspacing="0">

            <tr>
              <th>Nama</th>
            </tr>
            <?php 

        while( $row = mysqli_fetch_assoc($result)) {?>

            <tr>

              <td><?php echo $row["nama"] ?></td>
              <td><a href="hapus_genre.php?id=<?php echo$row['id']?>">hapus</a> |
                <a href="update_genre.php?id=<?php echo$row['id']?>">update</a></td>
            </tr>
            <?php } ?>
          </table>
        </div>

</html>