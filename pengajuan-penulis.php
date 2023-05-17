<?php
require 'database.php';
require 'helpers/input.php';
require 'helpers/string.php';
require 'helpers/auth.php';
require 'helpers/alert.php';
require 'helpers/file.php';

redirectIfNotAuthenticated('login.php');

$user = getLoginUser();

$appeal = fetchOne('SELECT * FROM pengajuan_penulis WHERE id_pengguna = :id_pengguna', [
  ':id_pengguna' => $user['id']
]);

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $content = $_POST['content'];

  // cek judul
  if (!$title) {
    setInputError('title', 'Judul novel harus diisi');
  }

  // cek deskripsi
  if (!$description) {
    setInputError('description', 'Deskripsi harus diisi');
  }

  // cek panjang deskripsi
  if (strlen($description) > 2500) {
    setInputError('description', 'Maksimal panjang deskripsi hanya 2.500 karakter');
  }

  // cek konten
  if (!$content) {
    setInputError('content', 'Konten cerita harus diisi');
  }

  if (!isThereAnyInputError()) {
    if ($appeal) {
      try {
        $novelSql = 'UPDATE pengajuan_penulis SET judul = :judul, deskripsi = :deskripsi, konten = :konten WHERE id_pengguna = :id_pengguna';
        $novelParams = [
          ':id_pengguna' => $user['id'],
          ':judul' => htmlspecialchars($title),
          ':deskripsi' => htmlspecialchars($description),
          ':konten' => $content,
        ];
        $novelId = query($novelSql, $novelParams);
  
        setAlert('success', 'Cerita berhasil diedit');
        redirect('pengajuan-penulis.php');
      } catch (PDOException $error) {
        setAlert('danger', 'Gagal mengedit cerita');
      }
    } else {
      try {
        $novelSql = 'INSERT INTO pengajuan_penulis (id_pengguna, judul, deskripsi, konten) VALUES (:id_pengguna, :judul, :deskripsi, :konten)';
        $novelParams = [
          ':id_pengguna' => $user['id'],
          ':judul' => htmlspecialchars($title),
          ':deskripsi' => htmlspecialchars($description),
          ':konten' => $content,
        ];
        $novelId = query($novelSql, $novelParams);
  
        setAlert('success', 'Cerita berhasil diajukan, anda hanya perlu menunggu sampai cerita anda disetujui oleh admin.');
        redirect('profil.php');
      } catch (PDOException $error) {
        setAlert('danger', 'Gagal membuat pengajuan');
      }
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

    <title>Buat pengajuan sebagai penulis</title>

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
            <div class="col-12 text-end mb-3">
              <a href="profil.php" class="btn custom-btn">
                <i class="bi-arrow-left"></i>
                Kembali
              </a>
            </div>
            <div class="col-12">
              <?= getAlert(); ?>
            </div>
            <?php if ($appeal): ?>
              <div class="col-12">
                <div class="alert alert-info" role="alert">
                  <p class="mb-0">Harap tunggu sampai pengajuan anda ditanggapi oleh admin.</p>
                </div>
              </div>
            <?php endif; ?>
            <div class="col-12">
              <div class="custom-block custom-block-full custom-block-no-hover">
                <div class="custom-block-info">
                  <h5 class="mb-4">Pengajuan penulis</h5>
                  <p>Buat cerita singkat sebagai acuan admin menjadikan anda seorang penulis.</p>

                  <form action="pengajuan-penulis.php" method="post" class="custom-form me-3">
                    <div class="form-group">
                      <input name="title" type="text" class="form-control" id="title" placeholder="Judul novel"
                        value="<?= getOldInput('title', $appeal ? $appeal['judul'] : null); ?>">
                      <?= getInputError('title'); ?>
                    </div>
                    <div class="form-group">
                      <textarea name="description" class="form-control" id="description" cols="30" rows="10"
                        placeholder="Deskripsi (maksimal 2.500 karakter)"><?= getOldInput('description', $appeal ? $appeal['deskripsi'] : null); ?></textarea>
                      <?= getInputError('description'); ?>
                    </div>
                    <div class="form-group mb-3">
                      <textarea name="content" id="content"><?= getOldInput('content', $appeal ? $appeal['konten'] : null); ?></textarea>
                      <?= getInputError('content'); ?>
                    </div>
                    <div class="form-group mt-3">
                      <button type="submit" name="submit" class="btn custom-btn">Buat cerita</button>
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
    </script>
  </body>
</html>