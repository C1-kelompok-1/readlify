<?php

require 'database.php';
require 'helpers/auth.php';

redirectIfNotAuthenticated('login.php');

if (isset($_GET['slug'])) {
  $novelSql = 'SELECT novel.*,
                pengguna.username,
                pengguna.facebook_url,
                pengguna.instagram_url,
                pengguna.twitter_url
              FROM novel
              INNER JOIN pengguna ON pengguna.id = novel.id_pengguna
              WHERE slug = :slug';
  $novelParams = [':slug' => $_GET['slug']];
  $novel = fetchOne($novelSql, $novelParams);

  $genreSql = 'SELECT nama FROM genre WHERE id IN (SELECT id_genre FROM genre_novel WHERE id_novel = :id_novel)';
  $genreParams = [':id_novel' => $novel['id']];
  $genres = fetchAll($genreSql, $genreParams);

  $episodeSql = 'SELECT * FROM episode_novel WHERE id_novel = :id_novel';
  $episodeParams = [':id_novel' => $novel['id']];
  $episodes = fetchAll($episodeSql, $episodeParams);
  $firstEpisode = count($episodes) ? $episodes[0] : null;

  $likeSql = 'SELECT COUNT(episode_novel_disukai.id) AS jumlah_like
              FROM episode_novel_disukai
              INNER JOIN episode_novel ON episode_novel.id = episode_novel_disukai.id_episode_novel
              INNER JOIN novel ON novel.id = episode_novel.id_novel
              WHERE novel.id = :id
              GROUP BY novel.id';
  $likes = fetchOne($likeSql, [':id' => $novel['id']]);
  $episodeLikes = isset($likes['jumlah_like']) ? $likes['jumlah_like'] : 0;
}

function isEpisodeBought($episode) {
  $user = getLoginUser();
  if ($episode['harga_koin']) {
    $boughtEpisodeSql = 'SELECT id
                        FROM episode_novel_terbeli
                        WHERE id_episode_novel = :id_episode_novel
                          AND id_pengguna = :id_pengguna';
    return fetchOne($boughtEpisodeSql, [
      ':id_episode_novel' => $episode['id'],
      ':id_pengguna' => $user['id'],
    ]);
  }

  return true;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $novel['judul']; ?></title>

    <?php require 'layouts/favicon.php'; ?>
    <?php require 'layouts/styles.php'; ?>
  </head>

  <body>

    <main>
      <?php require 'layouts/navbar.php'; ?>

      <header class="site-header site-header-no-title d-flex flex-column justify-content-center align-items-center">
      </header>

      <section class="latest-podcast-section section-padding pb-0" id="section_2">
        <div class="container">
          <div class="row justify-content-center">

            <div class="col-lg-10 col-12"></div>
            <div class="row">
              <div class="col-lg-3 col-12">
                <div class="custom-block-image-wrap">
                  <a href="detail-novel-saya.php?slug=<?= $novel['slug']; ?>">
                    <img src="<?= 'photos/'.$novel['photo_filename']; ?>" class="custom-block-image img-fluid" alt="<?= $novel['judul']; ?>">
                  </a>
                </div>
              </div>

              <div class="col-lg-9 col-12">
                <div class="custom-block-info">
                  <div class="custom-block-top d-flex mb-3">
                    <!-- Genre -->
                    <?php foreach ($genres as $index => $genre): ?>
                      <div class="badge badge-info <?= $index < count($genres) ? 'me-2' : ''; ?>">
                        <?= $genre['nama']; ?>
                      </div>
                    <?php endforeach; ?>

                    <!-- Episode -->
                    <div class="ms-auto">
                      <div class="bi-heart badge d-inline-block me-3">
                        <span><?= $episodeLikes; ?></span>
                      </div>
                      <small><span class="badge"><?= count($episodes); ?></span> Episode</small>
                    </div>
                  </div>

                  <!-- Judul -->
                  <h2 class="mb-2"><?= $novel['judul']; ?></h2>

                  <!-- Sipnosis -->
                  <p><?= $novel['deskripsi']; ?></p>

                  <?php if ($firstEpisode): ?>
                    <a href="episode.php?novel_slug=<?= $novel['slug']; ?>&episode_slug=<?= $firstEpisode['slug']; ?>" class="btn custom-btn">Baca episode pertama</a>
                  <?php endif; ?>

                  <div class="profile-block profile-detail-block d-flex flex-wrap align-items-center mt-4">
                    <!-- Nama penulis -->
                    <div class="d-flex mb-3 mb-lg-0 mb-md-0">
                      <strong><?= $novel['username']; ?></strong>
                    </div>

                    <!-- Sosial media penulis -->
                    <ul class="social-icon ms-lg-auto ms-md-auto">
                      <li class="social-icon-item">
                        <a href="<?= $novel['facebook_url']; ?>" class="social-icon-link bi-facebook"></a>
                      </li>

                      <li class="social-icon-item">
                        <a href="<?= $novel['twitter_url']; ?>" class="social-icon-link bi-twitter"></a>
                      </li>

                      <li class="social-icon-item">
                        <a href="<?= $novel['instagram_url']; ?>" class="social-icon-link bi-instagram"></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        </div>
      </section>

      <!-- Episode -->
      <section class="related-podcast-section section-padding">
        <div class="container">
          <div class="row">

            <div class="col-lg-12 col-12">
              <div class="section-title-wrap mb-5">
                <h4 class="section-title">Episode</h4>
              </div>
            </div>

            <?php if (count($episodes)): ?>
              <?php foreach ($episodes as $index => $episode): ?>
                <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                  <a href="<?= isEpisodeBought($episode) ? 'episode' : 'beli-episode'; ?>.php?novel_slug=<?= $novel['slug']; ?>&episode_slug=<?= $episode['slug']; ?>" class="d-block h-100">
                    <div class="custom-block d-flex justify-content-center flex-column align-items-start h-100">
                      <p><strong><?= $episode['judul']; ?></strong></p>
                      <p class="badge mb-0">Episode <?= $index + 1; ?></p>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <strong class="text-center">Belum ada episode</strong>
            <?php endif; ?>

          </div>
        </div>
      </section>
    </main>

    <?php require 'layouts/footer.php'; ?>
    <?php require 'layouts/scripts.php'; ?>
  </body>
</html>