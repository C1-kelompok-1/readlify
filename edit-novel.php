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
                    <h5 class="mb-4">Edit novel</h5>

                    <form action="#" method="get" class="custom-form me-3" role="search">
                      <div class="form-group">
                        <label class="mb-1" for="sampul">Foto sampul</label>
                        <input name="sampul" type="file" class="form-control" id="sampul" placeholder="Foto sampul">
                      </div>
                      <div class="form-group">
                        <input name="judul" type="text" class="form-control" id="judul" placeholder="Judul novel">
                      </div>
                      <div class="form-group">
                        <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="10" placeholder="Deskripsi (maksimal 2.500 karakter)"></textarea>
                      </div>
                      <div class="form-group">
                        <select id="genre" class="form-control" name="genre">
                          <option value="0" selected disabled>Pilih genre</option>
                          <option value="1">Aksi</option>
                          <option value="2">Drama</option>
                        </select>
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

    <script src="js/select2.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#genre').select2({
          placeholder: "Pilih genre"
        });
      });
    </script>

</body>

</html>