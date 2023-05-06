<?php
require 'database.php';
require 'helpers/input.php';
require 'helpers/string.php';
require 'helpers/auth.php';
require 'helpers/base.php';

redirectIfNotAuthenticated('login.php');

$user = getLoginUser();

$novelSlug = $_GET['slug'];

$novel = fetchOne('SELECT * FROM novel WHERE slug = :slug', [':slug' => $novelSlug]);
$novelGenres = fetchAll('SELECT id_genre FROM genre_novel WHERE id_novel = :id_novel', [':id_novel' => $novel['id']]);
$novelGenres = array_map(fn ($genre) => $genre['id_genre'], $novelGenres);

$genreOptions = fetchAll('SELECT id, nama FROM genre');

// cek novel
if (!$novel) {
  redirect('404.html');
}

if (isset($_POST['submit'])) {
  $thumbnail = isset($_FILES['thumbnail']) ? $_FILES['thumbnail'] : null;
  $title = $_POST['title'];
  $description = $_POST['description'];
  $genres = isset($_POST['genres']) ? $_POST['genres'] : [];

  $thumbnailExt = pathinfo($thumbnail['name'], PATHINFO_EXTENSION);

  // cek thumbnail
  if ($thumbnail['size']) {
    // cek jenis file
    if (!in_array($thumbnailExt, ['png', 'jpg', 'jpeg'])) {
      setInputError('thumbnail', 'Mohon masukkan gambar dengan ekstensi png atau jpg');
    }
  
    // cek ukuran file
    if ($thumbnail['size'] > 5000000) {
      setInputError('thumbnail', 'Maksimal ukuran gambar hanya 5MB');
    }
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
    if ($thumbnail['size']) {
      // simpan dan ubah ukuran thumbnail
      $tmpPath = $thumbnail['tmp_name'];
        
      if ($thumbnailExt == 'jpg') {
        $image = imagecreatefromjpeg($tmpPath);
      }

      if ($thumbnailExt == 'png') {
        $image = imagecreatefrompng($tmpPath);
      }

      $imgResized = imagescale($image , 500, 400);
      $filename = generateRandomString().'.'.$thumbnailExt;

      if ($thumbnailExt == 'jpg') {
        imagejpeg($imgResized, 'photos/'.$filename);
      }

      if ($thumbnailExt == 'png') {
        imagepng($imgResized, 'photos/'.$filename);
      }
    }

    beginTransaction();

    try {
      // edit novel
      $novelSql = 'UPDATE novel SET id_pengguna = :id_pengguna, judul = :judul, slug = :slug, deskripsi = :deskripsi, photo_filename = :photo_filename WHERE id = :id';
      $slug = slugify($title);
      $novelParams = [
        ':id_pengguna' => $user['id'],
        ':judul' => $title,
        ':slug' => $slug,
        ':deskripsi' => $description,
        ':photo_filename' => $thumbnail['size'] ? $filename : $novel['photo_filename'],
        ':id' => $novel['id']
      ];
      query($novelSql, $novelParams);

      query('DELETE FROM genre_novel WHERE id_novel = :id_novel', [':id_novel' => $novel['id']]);

      // buat genre novel
      foreach ($genres as $genre) {
        query(
          'INSERT INTO genre_novel (id_novel, id_genre) VALUES (:id_novel, :id_genre)',
          [':id_novel' => $novel['id'], ':id_genre' => $genre]
        );
      }

      commit();

      setAlert('success', 'Novel berhasil diedit');
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

  <title>Readify | Edit novel</title>

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
            <a href="<?= 'detail-novel-saya.php?slug='.$novel['slug']; ?>" class="btn custom-btn">
              <i class="bi-arrow-left"></i>
              Kembali
            </a>
          </div>
          <div class="col-12">
            <div class="custom-block custom-block-full custom-block-no-hover">
              <div class="custom-block-info">
                <h5 class="mb-4">Edit novel</h5>

                <form action="edit-novel.php?slug=<?= $novel['slug']; ?>" method="post" class="custom-form me-3" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="mb-1" for="thumbnail">Foto sampul</label>
                    <input name="thumbnail" type="file" class="form-control" id="thumbnail" placeholder="Foto sampul">
                    <?= getInputError('thumbnail'); ?>
                  </div>
                  <div class="form-group">
                    <input name="title" type="text" class="form-control" id="title" placeholder="Judul novel"
                      value="<?= getOldInput('title', $novel['judul']); ?>">
                    <?= getInputError('title'); ?>
                  </div>
                  <div class="form-group">
                    <textarea name="description" class="form-control" id="description" cols="30" rows="10"
                      placeholder="Deskripsi (maksimal 2.500 karakter)"><?= getOldInput('description', $novel['deskripsi']); ?></textarea>
                    <?= getInputError('description'); ?>
                  </div>
                  <div class="form-group">
                    <select id="genres" class="form-control" name="genres[]" multiple>
                      <option value="0" disabled>Pilih genre</option>
                      <?php $oldGenres = getOldInput('genres', $novelGenres); ?>
                      <?php foreach ($genreOptions as $genre): ?>
                      <option
                        value="<?= $genre['id']; ?>"
                        <?= in_array($genre['id'], $oldGenres)
                          ? 'selected'
                          : '';
                        ?>
                      >
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