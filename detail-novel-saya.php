<?php

require 'database.php';
require 'helpers/auth.php';

redirectIfNotAuthenticated('login.php');

// hapus novel
if (isset($_POST['hapus'])) {
  $novelId = $_POST['id_novel'];

  beginTransaction();

  try {
    $deleteNovelSql = 'DELETE FROM novel WHERE id = :id';
    $deleteNovelParams = [':id' => $novelId];
    query($deleteNovelSql, $deleteNovelParams);

    commit();

    setAlert('success', 'Novel berhasil dihapus');
    redirect('novel-saya.php');
  } catch (PDOException $error) {
    rollBack();
    setAlert('danger', 'Gagal menghapus novel');
  }
}

$slug = $_GET['slug'];

$novelSql = 'SELECT * FROM novel WHERE slug = :slug';
$novelParams = [':slug' => $slug];
$novel = fetchOne($novelSql, $novelParams);

$genreSql = 'SELECT nama FROM genre WHERE id IN (SELECT id_genre FROM genre_novel WHERE id_novel = :id_novel)';
$genreParams = [':id_novel' => $novel['id']];
$genres = fetchAll($genreSql, $genreParams);

if (!$novel) {
  redirect('404.html');
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

  <link rel="stylesheet" href="css/sweetalert2.min.css">
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
          <div class="col-12 d-flex justify-content-between mb-3">
            <a href="novel-saya.php" class="btn custom-btn">
              <i class="bi-arrow-left"></i>
              Kembali
            </a>

            <div>
              <button id="hapus" class="btn custom-btn">
                <i class="bi-trash"></i>
                Hapus
              </button>
              <a href="edit-novel.php?slug=<?= $novel['slug']; ?>" class="btn custom-btn">
                <i class="bi-pencil"></i>
                Edit
              </a>
            </div>
          </div>

          <div class="col-12 mb-5">
            <div class="custom-block custom-block-full custom-block-no-hover">
              <div class="row">
                <div class="col-lg-3 col-12">
                  <div class="custom-block-icon-wrap">
                    <div class="custom-block-info custom-block-image-detail-page">
                      <img src="<?= 'photos/'.$novel['photo_filename']; ?>" class="custom-block-image img-fluid" alt="">
                    </div>
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
                          <span>2.5k</span>
                        </div>
                        <small><span class="badge">3</span> Episode</small>
                      </div>
                    </div>

                    <!-- Judul -->
                    <h2 class="mb-2"><?= $novel['judul']; ?></h2>

                    <!-- Sipnosis -->
                    <p><?= $novel['deskripsi']; ?></p>
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

  <form action="detail-novel-saya.php" id="submit-hapus" method="post" hidden>
    <input type="hidden" name="hapus" />
    <input type="hidden" name="id_novel" value="<?= $novel['id']; ?>" />
  </form>

  <?php require 'layouts/footer.php'; ?>

  <script src="js/sweetalert2.all.min.js"></script>
  <?php require 'layouts/scripts.php'; ?>
  <script>
    $('#hapus').click(function() {
      Swal.fire({
        title: '<h6>Apakah anda yakin ingin menghapus novel ini?</h6>',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Hapus',
        confirmButtonColor: 'red',
      }).then((result) => {
        if (result.isConfirmed) {
          $("form#submit-hapus").submit();
        }
      })
    })
  </script>

</body>

</html>