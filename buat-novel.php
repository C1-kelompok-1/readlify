<?php
require 'database.php';
require 'helpers/input.php';
require 'helpers/string.php';
require 'helpers/auth.php';
require 'helpers/base.php';

redirectIfNotAuthenticated('login.php');

$genreOptions = fetchAll('SELECT id, nama FROM genre');

if (isset($_POST['submit'])) {
  $thumbnail = isset($_FILES['thumbnail']) ? $_FILES['thumbnail'] : null;
  $title = $_POST['title'];
  $description = $_POST['description'];
  $genres = isset($_POST['genres']) ? $_POST['genres'] : [];

  $thumbnailExt = pathinfo($thumbnail['name'], PATHINFO_EXTENSION);

  // cek thumbnail
  if (!$thumbnail['size']) {
    setInputError('thumbnail', 'Foto sampul harus diisi');
  }
  
  // cek jenis file
  if (!in_array($thumbnailExt, ['png', 'jpg', 'jpeg'])) {
    setInputError('thumbnail', 'Mohon masukkan gambar dengan ekstensi png atau jpg');
  }

  // cek ukuran file
  if ($thumbnail['size'] > 5000000) {
    setInputError('thumbnail', 'Maksimal ukuran gambar hanya 5MB');
  }

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

  // cek genre
  if (count($genres) <= 0) {
    setInputError('genres', 'Pilih setidaknya satu jenis genre');
  }

  if (!isThereAnyError()) {
    // simpan dan ubah ukuran thumbnail
    $tmpPath = $thumbnail['tmp_name'];
      
    if ($thumbnailExt == 'jpg') {
      $image = imagecreatefromjpeg($tmpPath);
    }

    if ($thumbnailExt == 'png') {
      $image = imagecreatefrompng($tmpPath);
    }

    $imgResized = imagescale($image , 290, 210);
    $filename = generateRandomString().'.'.$thumbnailExt;

    if ($thumbnailExt == 'jpg') {
      imagejpeg($imgResized, 'photos/'.$filename);
    }

    if ($thumbnailExt == 'png') {
      imagepng($imgResized, 'photos/'.$filename);
    }

    beginTransaction();

    try {
      // buat novel
      $user = getLoginUser();

      $novelSql = 'INSERT INTO novel (id_pengguna, judul, slug, deskripsi, photo_filename) VALUES (:id_pengguna, :judul, :slug, :deskripsi, :photo_filename)';
      $slug = slugify($title);
      $novelParams = [
        ':id_pengguna' => $user['id'],
        ':judul' => $title,
        ':slug' => $slug,
        ':deskripsi' => $description,
        ':photo_filename' => $filename,
      ];
      $novelId = query($novelSql, $novelParams);

      // buat genre novel
      $genreSql = 'INSERT INTO genre_novel (id_novel, id_genre) VALUES (:id_novel, :id_genre)';
      foreach ($genres as $genreId) {
        $genreParams = [':id_novel' => $novelId, ':id_genre' => $genreId];
        query($genreSql, $genreParams);
      }

      commit();

      setAlert('success', 'Novel berhasil dibuat');
      redirect('detail-novel-saya.php?slug='.$slug);
    } catch (PDOException $error) {
      rollBack();
      setAlert('danger', 'Gagal membuat novel');
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

    <title>Readify | Buat novel</title>

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
            <div class="col-12 text-end mb-3">
              <a href="novel-saya.php" class="btn custom-btn">
                <i class="bi-arrow-left"></i>
                Kembali
              </a>
            </div>
            <div class="col-12">
              <div class="custom-block custom-block-full custom-block-no-hover">
                <div class="custom-block-info">
                  <h5 class="mb-4">Buat novel</h5>

                  <form action="buat-novel.php" method="post" class="custom-form me-3" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="mb-1" for="thumbnail">Foto sampul</label>
                      <input name="thumbnail" type="file" class="form-control" id="thumbnail" placeholder="Foto sampul">
                      <?= getInputError('thumbnail'); ?>
                    </div>
                    <div class="form-group">
                      <input name="title" type="text" class="form-control" id="title" placeholder="Judul novel"
                        value="<?= getOldInput('title'); ?>">
                      <?= getInputError('title'); ?>
                    </div>
                    <div class="form-group">
                      <textarea name="description" class="form-control" id="description" cols="30" rows="10"
                        placeholder="Deskripsi (maksimal 2.500 karakter)"><?= getOldInput('description'); ?></textarea>
                      <?= getInputError('description'); ?>
                    </div>
                    <div class="form-group">
                      <select id="genres" class="form-control" name="genres[]" multiple>
                        <option value="0" disabled>Pilih genre</option>
                        <?php $oldGenres = getOldInput('genres', []); ?>
                        <?php foreach ($genreOptions as $genre): ?>
                        <option value="<?= $genre['id']; ?>" <?= in_array($genre['id'], $oldGenres)
                                  ? 'selected'
                                  : '';
                                ?>>
                          <?= $genre['nama']; ?>
                        </option>
                        <?php endforeach; ?>
                      </select>
                      <?= getInputError('genres'); ?>
                    </div>
                    <div class="form-group mt-3">
                      <button type="submit" name="submit" class="btn custom-btn">Buat novel</button>
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

    <script src="js/select2.min.js"></script>

    <script>
      $(document).ready(function () {
        $('#genres').select2({
          placeholder: "Pilih genre"
        });
      });
    </script>
  </body>
</html>