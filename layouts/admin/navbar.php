<?php

require '../../helpers.php';

$user = getLoggedUser();

?>

<!-- Navbar -->
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav align-items-center mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
      <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      <div class="d-sm-none d-lg-inline-block">Hai, John</div></a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-divider"></div>
        <a href="logout.php" class="dropdown-item has-icon text-danger">
          <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
      </div>
    </li>
  </ul>
</nav>