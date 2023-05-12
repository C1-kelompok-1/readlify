<?php

session_start();
require '../config.php';

if (!isset($_SESSION['user'])) {
  echo "<script>";
  echo "window.location = '/".BASE_URL."/login.php';";
  echo "</script>";
  die;
}

?>

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
      <a href="daftar_pengajuan.php">
        <i class="zmdi zmdi-grid"></i> <span>Pengajuan Penulis</span>
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
    <li>
      <a href="/<?= BASE_URL; ?>/logout.php">
        <i class="fa fa-sign-out"></i> <span>Keluar</span>
      </a>
    </li>

</div>
<!--End sidebar-wrapper-->