<?php

require 'database.php';
require 'session.php';
require 'helpers/alert.php';
require 'helpers/auth.php';
require 'helpers/file.php';

$user = $_SESSION['user'];

$appeal = fetchOne('SELECT * FROM pengajuan_penulis WHERE id_pengguna = :id_pengguna', [
  ':id_pengguna' => $user['id']
]);

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $facebookUrl = $_POST['facebook_url'];
  $instagramUrl = $_POST['instagram_url'];
  $twitterUrl = $_POST['twitter_url'];
  $avatar = $_FILES['avatar'];

  try {
    $userSql = "UPDATE pengguna
                SET
                  avatar = :avatar,
                  username = :username,
                  email = :email,
                  facebook_url = :facebook_url,
                  instagram_url = :instagram_url,
                  twitter_url = :twitter_url
                WHERE id = :id";

    $avatar = saveAndResizeImage($avatar, 80, 80);

    query($userSql, [
      ':avatar' => $avatar,
      ':username' => $username,
      ':email' => $email,
      ':facebook_url' => $facebookUrl,
      ':instagram_url' => $instagramUrl,
      ':twitter_url' => $twitterUrl,
      ':id' => $user['id']
    ]);

    $_SESSION['user'] = [
      ...$_SESSION['user'],
      'avatar' => $avatar,
      'username' => $username,
      'email' => $email,
      'facebook_url' => $facebookUrl,
      'instagram_url' => $instagramUrl,
      'twitter_url' => $twitterUrl,
    ];

    setAlert('success', 'Profil berhasil diedit');
    redirect('profil.php');
  } catch (PDOException $error) {
    setAlert('danger', 'Gagal mengubah profil');
  }
}

// if (isset($_POST['submit'])) {
//   $username = $_POST['username'];
//   $email = $_POST['email'];
//   $facebookUrl = $_POST['facebook_url'];
//   $instagramUrl = $_POST['instagram_url'];
//   $twitterUrl = $_POST['twitter_url'];
//   $avatar = $_FILES['avatar'];
//   $deleteAvatar = isset($_POST['delete_avatar']);

//   try {
//     $userSql = "UPDATE pengguna
//                 SET
//                   avatar = :avatar,
//                   username = :username,
//                   email = :email,
//                   facebook_url = :facebook_url,
//                   instagram_url = :instagram_url,
//                   twitter_url = :twitter_url
//                 WHERE id = :id";

//     if ($deleteAvatar) {
//       $avatar = null;
//     } else {
//       $avatar = saveAndResizeImage($avatar, 80, 80);
//     }

//     query($userSql, [
//       ':avatar' => $avatar,
//       ':username' => $username,
//       ':email' => $email,
//       ':facebook_url' => $facebookUrl,
//       ':instagram_url' => $instagramUrl,
//       ':twitter_url' => $twitterUrl,
//       ':id' => $user['id']
//     ]);

//     $_SESSION['user'] = [
//       ...$_SESSION['user'],
//       'avatar' => $avatar,
//       'username' => $username,
//       'email' => $email,
//       'facebook_url' => $facebookUrl,
//       'instagram_url' => $instagramUrl,
//       'twitter_url' => $twitterUrl,
//     ];

//     setAlert('success', 'Profil berhasil diedit');
//     redirect('profil.php');
//   } catch (PDOException $error) {
//     setAlert('danger', 'Gagal mengubah profil');
//   }
// }


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Edit profil</title>

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
          <div class="col-12 col-lg-8">
            <div class="custom-block custom-block-full custom-block-no-hover">
              <div class="custom-block-info">
                <h5 class="mb-4">Profil</h5>
                <form action="profil.php" method="post" class="custom-form me-3" enctype="multipart/form-data">
                  <div class="form-group">
                    <input name="avatar" type="file" class="form-control" placeholder="Avatar">
                  </div>
                  <div class="form-group">
                    <input name="username" type="text" class="form-control" id="username" placeholder="Username" value="<?= $user['username']; ?>">
                  </div>
                  <div class="form-group">
                    <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="<?= $user['email']; ?>">
                  </div>
                  <div class="form-group">
                    <input name="facebook_url" type="url" class="form-control" id="facebook_url" placeholder="URL Facebook" value="<?= $user['facebook_url']; ?>">
                  </div>
                  <div class="form-group">
                    <input name="instagram_url" type="url" class="form-control" id="instagram_url" placeholder="URL Instagram" value="<?= $user['instagram_url']; ?>">
                  </div>
                  <div class="form-group">
                    <input name="twitter_url" type="url" class="form-control" id="twitter_url" placeholder="URL Twitter" value="<?= $user['twitter_url']; ?>">
                  </div>
                  <div class="form-group mt-3">
                    <button type="submit" name="submit" class="btn custom-btn">Simpan</button>
                  </div>
                </form>
                <!-- <form action="profil.php" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus avatar?');">
                  <div>
                    <input type="hidden" name="delete_avatar" value="1">
                    <button type="submit" name="submit" class="btn custom-btn">Hapus Avatar</button>
                  </div>
                </form> -->
              </div>
            </div>
          </div>

          <div class="col-12 col-lg-4">
            <div class="d-flex flex-column justify-content-center align-items-center mt-5">
              <div class="dropdown pe-auto">
                <img src="photos/<?= $user['avatar']; ?>" class="rounded-circle dropdown-toggle foto-profil w-5 h-5" id="profil-image" data-bs-toggle="dropdown" aria-expanded="false" alt="Profil" />

                <form action="profil.php" method="post" class="custom-form me-3" enctype="multipart/form-data">
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item bi bi-person-square fw-bold" href="#">
                        <span class="ms-2">Lihat Foto Profil</span>
                      </a>
                    </li>
                    <label for="avatar" class="dropdown-item bi bi-images fw-bold">
                      <span class="ms-1">Perbarui Foto Profil</span>
                      <input type="file" name="avatar" id="avatar" class="custom-file-input d-none form-control" accept="image/*">
                    </label>
                    <li>
                      <a class="dropdown-item bi bi-trash fw-bold" href="#">
                        <span class="ms-2" for="delete_avatar">Hapus Foto Profil</span>
                        <input type="checkbox" class="custom-file-input d-none" name="delete_avatar" id="delete_avatar">
                      </a>
                    </li>
                  </ul>
                </form>
              </div>

              <h5 class="mb-2 mt-3">
                <strong><?php echo $user['username']; ?></strong>
              </h5>
              <p class="text-muted"><?php echo $user["email"] ?></p>
              <?php if ($user['role'] == 'pembaca'): ?>
                <a href="pengajuan-penulis.php" class="btn custom-btn">Ajukan diri sebagai penulis</a>
              <?php else: ?>
                <div class="alert alert-info">
                  <p class="mb-0">Selamat, pengajuanmu telah diterima dan kamu bisa menulis cerita sekarang, selamat berkarya.</p>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script>
    document.getElementById('avatar').addEventListener('change', function() {
      var file = this.files[0];
      var reader = new FileReader();

      reader.onload = function(e) {
        var img = new Image();
        img.src = e.target.result;

        img.onload = function() {
          var canvas = document.createElement('canvas');
          var ctx = canvas.getContext('2d');
          var maxDim = 80;
          var squareSize = Math.min(img.width, img.height);
          var startX = (img.width - squareSize) / 2;
          var startY = (img.height - squareSize) / 2;

          canvas.width = maxDim;
          canvas.height = maxDim;

          ctx.drawImage(img, startX, startY, squareSize, squareSize, 0, 0, maxDim, maxDim);

          document.getElementById('profil-image').src = canvas.toDataURL('image/jpeg');
        };
      };

      reader.readAsDataURL(file);
    });
  </script>

  <?php require 'layouts/footer.php'; ?>
  <?php require 'layouts/scripts.php'; ?>
</body>

</html>