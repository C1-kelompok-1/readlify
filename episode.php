<?php

require 'database.php';
require 'helpers/auth.php';
require 'helpers/alert.php';

redirectIfNotAuthenticated('login.php');

$user = getLoginUser();
$novelSlug = $_GET['novel_slug'];
$episodeSlug = $_GET['episode_slug'];

$episodeSql = 'SELECT episode_novel.*,
              novel.judul AS novel_judul,
              pengguna.username
              FROM episode_novel
              INNER JOIN novel ON episode_novel.id_novel = novel.id
              INNER JOIN pengguna ON pengguna.id = novel.id_pengguna
              WHERE novel.slug = :novel_slug AND episode_novel.slug = :episode_slug';
$episodeParams = [':novel_slug' => $novelSlug, ':episode_slug' => $episodeSlug];
$episode = fetchOne($episodeSql, $episodeParams);

// cek episode
if (!$episode) {
  redirect('404.html');
}

// cek episode terbeli
if ($episode['harga_koin']) {
  $boughtEpisodeSql = 'SELECT id
                      FROM episode_novel_terbeli
                      WHERE id_episode_novel = :id_episode_novel
                        AND id_pengguna = :id_pengguna';
  $isEpisodeBought = fetchOne($boughtEpisodeSql, [
    ':id_episode_novel' => $episode['id'],
    ':id_pengguna' => $user['id'],
  ]);

  if (!$isEpisodeBought) {
    redirect('beli-episode.php?novel_slug='.$novelSlug.'&episode_slug='.$episodeSlug);
  }
}

// cek apakah episode sudah dilike
$likedEpisode = fetchOne('SELECT COUNT(id) AS jumlah FROM episode_novel_disukai WHERE id_episode_novel = :id_episode_novel AND id_pengguna = :id_pengguna', [
  ':id_episode_novel' => $episode['id'],
  ':id_pengguna' => $user['id'],
]);

// like episode
if (isset($_POST['like'])) {
  try {
    if ($likedEpisode['jumlah']) {
      query('DELETE FROM episode_novel_disukai WHERE id_episode_novel = :id_episode_novel AND id_pengguna = :id_pengguna', [
        ':id_episode_novel' => $episode['id'],
        ':id_pengguna' => $user['id'],
      ]);
    } else {
      query('INSERT INTO episode_novel_disukai (id_episode_novel, id_pengguna) VALUES (:id_episode_novel, :id_pengguna)', [
        ':id_episode_novel' => $episode['id'],
        ':id_pengguna' => $user['id'],
      ]);
    }

    redirect('episode.php?novel_slug='.$novelSlug.'&episode_slug='.$episodeSlug);    
  } catch (PDOException $error) {
    var_dump($error);
  }
}

$prevEpisode = fetchOne('SELECT slug, judul FROM episode_novel WHERE id < :id_episode ORDER BY id DESC LIMIT 1', [':id_episode' => $episode['id']]);
$nextEpisode = fetchOne('SELECT slug, judul FROM episode_novel WHERE id > :id_episode ORDER BY id LIMIT 1', [':id_episode' => $episode['id']]);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $episode['judul']; ?></title>

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
            <div class="col-12">
              <div class="row">
                <div class="col-12 d-flex justify-content-end">
                <a href="novel.php?slug=<?= $novelSlug; ?>" class="btn custom-btn ">
                  <i class="bi-arrow-left"></i>
                  Kembali
                </a>
                </div>
                <div class="col-12 mb-5">
                  <div class="mt-3">
                    <?= getAlert(); ?>
                  </div>

                  <div class="profile-block profile-detail-block d-flex flex-wrap align-items-center mt-4">
                    <!-- Judul novel -->
                    <div class="d-flex mb-3 mb-lg-0 mb-md-0">
                      <a href="novel.php?slug=<?= $novelSlug; ?>">
                        <strong><?= $episode['novel_judul']; ?></strong>
                      </a>
                    </div>

                    <!-- Nama penulis -->
                    <div class="social-icon ms-lg-auto ms-md-auto">
                      oleh <strong><?= $episode['username']; ?></strong>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-block-info">
                    <!-- Judul -->
                    <h2 class="text-center mb-5"><?= $episode['judul']; ?></h2>

                    <!-- Konten -->
                    <div class="mb-5 episode-content">
                      <?= $episode['konten']; ?>
                    </div>

                    <div class="d-flex justify-content-between">
                      <?php if (isset($prevEpisode)): ?>
                        <a href="episode.php?novel_slug=<?= $novelSlug ?>&episode_slug=<?= $prevEpisode['slug']; ?>" class="btn custom-btn me-auto">Sebelumnya: <?= strlen($prevEpisode['judul']) > 10 ? substr($prevEpisode['judul'], 0, 10).'...' : $prevEpisode['judul']; ?></a>
                      <?php endif; ?>
                      <?php if (isset($nextEpisode)): ?>
                        <a href="episode.php?novel_slug=<?= $novelSlug ?>&episode_slug=<?= $nextEpisode['slug']; ?>" class="btn custom-btn ms-auto">Selanjutnya: <?= strlen($nextEpisode['judul']) > 10 ? substr($nextEpisode['judul'], 0, 10).'...' : $nextEpisode['judul']; ?></a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>
    </main>

    <form action="episode.php?novel_slug=<?= $novelSlug ?>&episode_slug=<?= $episodeSlug ?>" method="post">
      <button type="submit" name="like" class="btn custom-btn position-fixed bottom-0 end-0 mb-4 me-4" style="z-index: 100;">
        <div class="bi-heart">
          <span><?= $likedEpisode['jumlah']; ?></span>
        </div>
      </button>
    </form>

    <?php require 'layouts/footer.php'; ?>
    <?php require 'layouts/scripts.php'; ?>
  </body>
</html>