<?php

require 'helpers/auth.php';

redirectIfNotAuthenticated('login.php');

if (isset($_GET['search'])) {
  $keyword = htmlspecialchars($_GET['search']);
  $novelSql = 'SELECT
                novel.id,
                IF(LENGTH(novel.judul) > 30, CONCAT(TRIM(SUBSTRING(novel.judul, 1, 30)), "..."), novel.judul) AS judul,
                novel.slug,
                novel.photo_filename,
                IF(LENGTH(novel.deskripsi) > 100, CONCAT(TRIM(SUBSTRING(novel.deskripsi, 1, 100)), "..."), novel.deskripsi) AS deskripsi,
                pengguna.username,
                pengguna.avatar,
                COUNT(episode_novel_disukai.id) AS jumlah_like
              FROM novel
              LEFT JOIN episode_novel ON episode_novel.id_novel = novel.id
              LEFT JOIN episode_novel_disukai ON episode_novel_disukai.id_episode_novel = episode_novel.id
              INNER JOIN pengguna ON pengguna.id = novel.id_pengguna
              WHERE novel.judul LIKE :judul
              GROUP BY novel.id;';
  $novels = fetchAll($novelSql, [':judul' => "%$keyword%"]);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cari novel "<?= $keyword; ?>"</title>

    <?php require 'layouts/favicon.php'; ?>
    <?php require 'layouts/styles.php'; ?>
  </head>
  <body>
    <main>
      <?php require 'layouts/navbar.php'; ?>

      <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-12 text-center">
              <h2>Cari novel "<?= $keyword; ?>"</h2>
            </div>
          </div>
        </div>
      </header>

      <section class="section-padding">
        <div class="container">
          <div class="row">
            <div class="col-12 mb-5">
              <form action="cari.php" method="get" class="custom-form search-form bordered-search-form flex-fill me-3"
                role="search">
                <div class="input-group input-group-lg">
                  <input name="search" type="search" class="form-control" id="search" placeholder="Cari Novel" value="<?= $keyword; ?>">

                  <button type="submit" class="form-control" id="submit">
                    <i class="bi-search"></i>
                  </button>
                </div>
              </form>
            </div>
            <?php if (count($novels) > 0): ?>
              <?php foreach ($novels as $novel): ?>
                <div class="col-lg-4 col-12 d-flex align-items-stretch mb-4 mb-4">
                  <div class="custom-block custom-block-full">
                    <div class="custom-block-image-wrap">
                      <a href="novel.php?slug=<?= $novel['slug']; ?>">
                        <img src="<?= 'photos/'.$novel['photo_filename']; ?>"
                          class="custom-block-image img-fluid" alt="<?= $novel['judul']; ?>">
                      </a>
                    </div>
  
                    <div class="custom-block-info">
                      <!-- Judul -->
                      <h5 class="mb-2">
                        <a href="novel.php?slug=<?= $novel['slug']; ?>">
                          <?= $novel['judul']; ?>
                        </a>
                      </h5>
  
                      <!-- Nama penulis -->
                      <div class="profile-block d-flex align-items-center my-3">
                        <img src="photos/<?= $novel['avatar']; ?>" class="rounded-circle me-2" style="width: 40px; height: 40px;" alt="<?= $novel['username']; ?>">
                        <strong><?= $novel['username']; ?></strong>
                      </div>
  
                      <!-- Sipnosis -->
                      <p class="mb-0"><?= strlen($novel['deskripsi']) > 100 ? substr($novel['deskripsi'], 0, 100) : $novel['deskripsi']; ?></p>
  
                      <!-- Suka -->
                      <div class="custom-block-bottom d-flex justify-content-between mt-3">
                        <div class="bi-heart me-1">
                          <span><?= $novel['jumlah_like']; ?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <strong class="text-center py-5">Novel tidak ditemukan</strong>
            <?php endif; ?>
          </div>
        </div>
      </section>
    </main>

    <?php require 'layouts/footer.php'; ?>

    <?php require 'layouts/scripts.php'; ?>

  </body>
</html>