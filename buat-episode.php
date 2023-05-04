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
                    <h5 class="mb-4">Buat episode</h5>

                    <form action="#" method="get" class="custom-form me-3" role="search">
                      <div class="form-group">
                        <input name="judul" type="text" class="form-control" id="judul" placeholder="Judul episode">
                      </div>
                      <div class="form-group">
                        <input name="harga_koin" type="number" class="form-control" id="harga_koin" placeholder="Harga koin">
                      </div>
                      <div class="form-group mb-3">
                        <textarea name="konten" id="konten"></textarea>
                      </div>
                      <div class="form-group mt-3">
                        <button type="submit" class="btn custom-btn">Buat novel</button>
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