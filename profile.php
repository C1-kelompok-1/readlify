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

</head>

<body>

    <main>
        <?php require 'layouts/navbar.php'; ?>

        <header class="site-header site-header-no-title"></header>

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

    <script>
      ClassicEditor
        .create(document.querySelector('#konten'))
        .catch(error => {
          console.error( error );
        });
    </script>

</body>

</html>