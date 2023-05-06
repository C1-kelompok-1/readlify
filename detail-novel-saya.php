<?php

require 'helpers/auth.php';

redirectIfNotAuthenticated('login.php');

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Readify</title>

  <?php require 'layouts/favicon.php'; ?>
  <?php require 'layouts/styles.php'; ?>
</head>

<body>

  <main>
    <?php require 'layouts/navbar.php'; ?>

    <header class="site-header site-header-no-title"></header>

    <section class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12 d-flex justify-content-between mb-3">
            <a href="novel-saya.php" class="btn custom-btn">
              <i class="bi-arrow-left"></i>
              Kembali
            </a>

            <a href="edit-novel.php" class="btn custom-btn">
              <i class="bi-pencil"></i>
              Edit
            </a>
          </div>

          <div class="col-12 mb-5">
            <div class="custom-block custom-block-full custom-block-no-hover">
              <div class="row">
                <div class="col-lg-3 col-12">
                  <div class="custom-block-icon-wrap">
                    <div class="custom-block-info custom-block-image-detail-page">
                      <img src="https://cdn.gramedia.com/uploads/items/9786239726218.jpg"
                        class="custom-block-image img-fluid" alt="">
                    </div>
                  </div>
                </div>
                <div class="col-lg-9 col-12">
                  <div class="custom-block-info">
                    <div class="custom-block-top d-flex mb-3">
                      <!-- Genre -->
                      <div class="badge badge-info me-2">Aksi</div>
                      <div class="badge badge-info">Drama</div>

                      <!-- Episode -->
                      <div class="ms-auto">
                        <div class="bi-heart badge d-inline-block me-3">
                          <span>2.5k</span>
                        </div>
                        <small><span class="badge">3</span> Episode</small>
                      </div>
                    </div>

                    <!-- Judul -->
                    <h2 class="mb-2">Bedebah Diujung Tanduk</h2>

                    <!-- Sipnosis -->
                    <p>Di Negeri di Ujung Tanduk, pencuri, perampok, berkeliaran menjadi penegak hukum. Di depan, di
                      belakang, mereka tidak malu-malu lagi. Tapi setidaknya, Kawan, dalam situasi apapun, petarung
                      sejati akan terus memilih kehormatan hidupnya. Bahkan ketika nasib di ujung tanduk. Dia akan terus
                      bertarung habis-habisan, bersama sahabat sejati. Karena esok, matahari akan terbit sekali lagi.
                      Bersama harapan.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 mb-3">
          <a href="buat-episode.php" class="btn custom-btn">
            <i class="bi-plus"></i>
            Buat episode
          </a>
        </div>

        <div class="col-lg-4 col-12 mb-4 mb-lg-0">
          <div class="custom-block">
            <a href="episode-novel.php">
              <div class="custom-block-info custom-block-overlay-info">
                <!-- Judul episode -->
                <h5 class="mb-1">
                  <a href="episode-novel.php">
                    Duel
                  </a>
                </h5>

                <!-- Nomor episode -->
                <p class="badge mb-0">Episode 1</p>
              </div>
            </a>
          </div>
        </div>
      </div>
      </div>
    </section>
  </main>

  <?php require 'layouts/footer.php'; ?>

  <?php require 'layouts/scripts.php'; ?>

</body>

</html>