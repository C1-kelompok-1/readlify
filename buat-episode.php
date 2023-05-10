<?php

require 'database.php';
require 'helpers/alert.php';
require 'helpers/input.php';
require 'helpers/string.php';
require 'helpers/auth.php';

$slug = $_GET['slug'];
$novel = fetchOne('SELECT id, slug FROM novel WHERE slug = :slug', [':slug' => $slug]);

if (!$novel) {
  redirect('404.html');
}

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $isPaid = isset($_POST['isPaid']) ? $_POST['isPaid'] : null;
  $coin = isset($_POST['coin']) ? $_POST['coin'] : null;
  $content = $_POST['content'];

  // cek judul
  if (!$title) {
    setInputError('title', 'Mohon masukkan judul episode');
  }

  // cek koin
  if ($isPaid && !$coin) {
    setInputError('coin', 'Mohon masukkan harga koin');
  }

  // cek nominal koin
  if ($isPaid && $coin <= 0) {
    setInputError('coin', 'Mohon masukkan harga koin');
  }

  // cek konten
  if (!$content) {
    setInputError('content', 'Mohon masukkan konten');
  }

  if (!isThereAnyInputError()) {
    beginTransaction();

    try {
      $episodeSql = 'INSERT INTO episode_novel (id_novel, judul, slug, konten, harga_koin) VALUES (:id_novel, :judul, :slug, :konten, :harga_koin)';
      $slug = slugify(htmlspecialchars($title));
      $episodeParams = [
        ':id_novel' => $novel['id'],
        ':judul' => htmlspecialchars($title),
        ':slug' => $slug,
        ':konten' => $content,
        ':harga_koin' => $coin ?: null
      ];
      $episode = query($episodeSql, $episodeParams);

      commit();

      setAlert('success', 'Episode berhasil dibuat');
      redirect('episode-novel.php?novel_slug='.$novel['slug'].'&episode_slug='.$slug);
    } catch (PDOException $error) {
      rollBack();
      setAlert('danger', 'Gagal membuat episode');
    }
  } else {
    setOldInputs();
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Buat episode</title>

    <?php require 'layouts/favicon.php'; ?>
    <?php require 'layouts/styles.php'; ?>
    <link rel="stylesheet" href="css/select2.min.css">
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
              <a href="detail-novel-saya.php?slug=<?= $novel['slug']; ?>" class="btn custom-btn">
                <i class="bi-arrow-left"></i>
                Kembali
              </a>
            </div>
            <div class="col-12">
              <div class="custom-block custom-block-full custom-block-no-hover">
                <div class="custom-block-info">
                  <h5 class="mb-4">Buat episode</h5>

                  <form action="buat-episode.php?slug=<?= $slug; ?>" method="POST" class="custom-form me-3">
                    <div class="form-group">
                      <input name="title" type="text" class="form-control" id="title" placeholder="Judul episode" value="<?= getOldInput('title'); ?>">
                      <?= getInputError('title'); ?>
                    </div>

                    <?php $isPaid = getOldInput('isPaid'); ?>

                    <div class="form-group">
                      <div class="form-check mb-1" style="user-select: none;">
                        <input class="form-check-input" name="isPaid" type="checkbox" id="isPaid" style="cursor: pointer;" <?= $isPaid ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="isPaid" style="cursor: pointer;">
                          Berbayar
                        </label>
                      </div>
                      <input name="coin" type="number" class="form-control" id="coin" placeholder="Harga koin" value="<?= getOldInput('coin'); ?>" <?= $isPaid != 'on' ? 'disabled' : ''; ?>>
                      <?= getInputError('coin'); ?>
                    </div>
                    <div class="form-group mb-3">
                      <textarea name="content" id="content"><?= getOldInput('content'); ?></textarea>
                      <?= getInputError('content'); ?>
                    </div>
                    <div class="form-group mt-3">
                      <button type="submit" name="submit" class="btn custom-btn">Buat episode</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <?php require 'layouts/footer.php'; ?>
    <?php require 'layouts/scripts.php'; ?>

    <script src="js/ckeditor.js"></script>

    <script>
      ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
          console.error(error);
        });

      $('#isPaid').change(function(event) {
        $('#coin').attr('disabled', !event.target.checked);
      });
    </script>
  </body>
</html>