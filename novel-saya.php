<?php

require 'database.php';
require 'helpers/auth.php';

redirectIfNotAuthenticated('login.php');

$user = getLoginUser();

$novelSql = 'SELECT * FROM novel WHERE id_pengguna = :id_pengguna';
$novelParams = [':id_pengguna' => $user['id']];
$novels = fetchAll($novelSql, $novelParams);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Readify | Novel saya</title>

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
            <div class="col-12">
              <?= getAlert(); ?>
            </div>
            <div class="col-12 text-end mb-3">
              <a href="buat-novel.php" class="btn custom-btn">
                <i class="bi-plus"></i>
                Buat novel
              </a>
            </div>
            <?php if (count($novels)): ?>
              <?php foreach ($novels as $novel): ?>
                <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                  <div class="custom-block custom-block-full">
                    <div class="custom-block-image-wrap">
                      <a href="detail-novel-saya.php?slug=<?= $novel['slug']; ?>">
                        <img src="<?= 'photos/'.$novel['photo_filename']; ?>" class="custom-block-image img-fluid" alt="<?= $novel['judul']; ?>">
                      </a>
                    </div>

                    <div class="custom-block-info">
                      <!-- Judul -->
                      <h5 class="mb-2">
                        <a href="detail-novel-saya.php?slug=<?= $novel['slug']; ?>"><?= $novel['judul']; ?></a>
                      </h5>

                      <!-- Sipnosis -->
                      <p class="mb-0"><?= $novel['deskripsi']; ?></p>

                      <!-- Suka -->
                      <div class="custom-block-bottom d-flex justify-content-between mt-3">
                        <div class="bi-heart me-1">
                          <span>2.5k</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <strong class="text-center py-5">Tidak ada novel</strong>
            <?php endif; ?>
          </div>
        </div>
      </section>
    </main>

    <?php require 'layouts/footer.php'; ?>
    <?php require 'layouts/scripts.php'; ?>
  </body>
</html>