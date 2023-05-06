<?php
require 'helpers/auth.php';
require 'helpers/base.php';
?>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand me-lg-5 me-0" href="index.php">
      <img src="assets/images/readify logo.svg" class="logo-image img-fluid" alt="templatemo pod talk">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-lg-auto">
        <li class="nav-item">
          <a class="nav-link <?= getPageName() == 'index.php' ? 'active' : '' ?>" href="index.php">Beranda</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= getPageName() == 'genre.php' ? 'active' : '' ?>" href="genre.php">Genre</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= getPageName() == 'novel-saya.php' ? 'active' : '' ?>" href="novel-saya.php">Cerita Saya</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="koin.php">Beli Koin</a>
        </li>
      </ul>

      <div class="ms-4">
        <?php if ($user = getLoginUser()) { ?>
          <div class="dropdown">
            <a href="login.php" class="dropdown-toggle text-white fw-bold fs-5" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $user['username']; ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="profil.php">Profil</a></li>
              <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
            </ul>
          </div>
        <?php } else { ?>
          <div>
            <a class="btn custom-btn custom-border-btn smoothscroll " href="login.php">Masuk</a> 
          </div>
        <?php } ?>

      </div>
    </div>
    
  </div>
</nav>