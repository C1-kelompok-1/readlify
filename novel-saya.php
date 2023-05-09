<?php

require 'database.php';
require 'helpers/auth.php';

redirectIfNotAuthenticated('login.php');

$user = getLoginUser();

$novelSql = 'SELECT * FROM novel WHERE id_pengguna = :id_pengguna';
$novelSql = 'SELECT
                novel.id,
                novel.slug,
                IF(LENGTH(novel.judul) > 30, CONCAT(TRIM(SUBSTRING(novel.judul, 1, 30)), "..."), novel.judul) AS judul,
                novel.photo_filename,
                IF(LENGTH(novel.deskripsi) > 100, CONCAT(TRIM(SUBSTRING(novel.deskripsi, 1, 100)), "..."), novel.deskripsi) AS deskripsi,
                COUNT(episode_novel_disukai.id) AS jumlah_like
              FROM novel
              INNER JOIN pengguna ON pengguna.id = novel.id_pengguna
              LEFT JOIN episode_novel ON episode_novel.id_novel = novel.id
              LEFT JOIN episode_novel_disukai ON episode_novel_disukai.id_episode_novel = episode_novel.id
              WHERE pengguna.id = :id_pengguna
              GROUP BY novel.id;';
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
                <div class="col-lg-4 col-12 d-flex align-items-stretch mb-4 mb-lg-0">
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
                      <div class="custom-block-bottom">
                        <div class="bi-heart me-1 mt-3">
                          <span><?= $novel['jumlah_like']; ?></span>
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