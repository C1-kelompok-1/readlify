<?php
require "session.php";
include('koneksi.php');
// $db = new Database();

// $sql = 'UPDATE pengguna SET username = :username, email = :email, facebook_url = :facebook_url, instagram_url = :instagram_url, twitter_url = :twitter_url WHERE id = :id';
// $berhasil = $db->query($sql, [
//   ':username' => $_POST['username'],
//   ':email' => $_POST['email'],
//   ':facebook_url' => $_POST['facebook_url'],
//   ':instagram_url' => $_POST['instagram_url'],
//   ':twitter_url' => $_POST['twitter_url'],
//   ':id' => $id,
// ]);

// if ($berhasil) {
//   // berhasil
// } else {
//   // gagal
// }



if (isset($_POST['profil'])) {
  echo 'gambar dikirim';
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Readify</title>

  <?php require 'layouts/styles.php'; ?>

  <link rel="stylesheet" href="css/select2.min.css">

  <style>
    .foto-profil {
      cursor: pointer;
      width: 150px;
    }

    .foto-profil:hover {
      filter: brightness(1.2);
    }
  </style>


</head>

<body>

  <main>
    <?php require 'layouts/navbar.php'; ?>

    <header class="site-header site-header-no-title"></header>
    <div class="d-flex flex-column justify-content-center align-items-center mt-5">


      <div class="dropdown pe-auto">
        <img src="assets/images/profil/profil bawaan.svg" class="rounded-circle dropdown-toggle foto-profil" data-bs-toggle="dropdown" aria-expanded="false" alt="Profil" />
        <form action="" method="post">
          <ul class="dropdown-menu">
            <li><a class="dropdown-item bi bi-person-square fw-bold" href="#"><span class="ms-2">Lihat Foto Profil</span></a></li>
            <label for="profile-photo" class="dropdown-item bi bi-images fw-bold">
              <span class="ms-1">Perbarui Foto Profil</span>
              <input type="file" name="profil" id="profile-photo" class="custom-file-input d-none" accept="image/*">
            </label>
            <li><a class="dropdown-item bi bi-trash fw-bold" href="#"><span class="ms-2">Hapus Foto Profil</span></a></li>
          </ul>
        </form>
      </div>

      <h5 class="mb-2 mt-2"><strong><?php echo $_SESSION['user']; ?></strong></h5>
      <p class="text-muted"></p>
      <!-- <p class="text-muted"><?php echo $row["email"] ?></p> -->
    </div>


    <section class="section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12 text-end mb-3">
            <a href="detail-novel-saya.php" class="btn custom-btn">
              <i class="bi-arrow-left"></i>
              Kembali
            </a>
          </div>
          <div class="col-12">
            <div class="custom-block custom-block-full custom-block-no-hover">
              <div class="custom-block-info">
                <h5 class="mb-4">Profil</h5>

                <form action="#" method="get" class="custom-form me-3" role="search">
                  <div class="form-group">
                    <input name="username" type="text" class="form-control" id="username" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <input name="facebook_url" type="url" class="form-control" id="facebook_url" placeholder="URL Facebook">
                  </div>
                  <div class="form-group">
                    <input name="instagram_url" type="url" class="form-control" id="instagram_url" placeholder="URL Instagram">
                  </div>
                  <div class="form-group">
                    <input name="twitter_url" type="url" class="form-control" id="twitter_url" placeholder="URL Twitter">
                  </div>
                  <div class="form-group mt-3">
                    <button type="submit" class="btn custom-btn">Simpan</button>
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

  <!-- <script>
  // JavaScript
  document.getElementById("profile-photo").addEventListener("change", function(event) {
    var confirmUpload = confirm("Apakah Anda yakin ingin mengubah foto profil?");

    if (!confirmUpload) {
      event.preventDefault(); // Mencegah aksi default dari input file
    }
  });
</script> -->

<!-- <script>
  // JavaScript
  document.getElementById("profile-photo").addEventListener("change", function(event) {
    var confirmUpload = confirm("Apakah Anda yakin ingin mengubah foto profil?");

    if (!confirmUpload) {
      event.preventDefault(); // Mencegah aksi default dari input file
    } else {
      // Mengirim permintaan AJAX ke skrip PHP
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "database.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          alert(xhr.responseText); // Menampilkan pemberitahuan dari PHP
        }
      };
      xhr.send("profil=true");
    }
  });
</script> -->

</body>

</html>