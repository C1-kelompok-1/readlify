<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Readify</title>

  <?php require 'layouts/styles.php'; ?>

</head>

<body>

  <main>
    <?php require 'layouts/navbar.php'; ?>
  
    <header class="site-header site-header-no-title d-flex flex-column justify-content-center align-items-center">
    </header>

    <section class="latest-podcast-section section-padding pb-0" id="section_2">
      <div class="container">
        <div class="row justify-content-center">

          <div class="col-12">
            <div class="row">
              <div class="col-12 mb-5">
              <div class="profile-block profile-detail-block d-flex flex-wrap align-items-center mt-4">
                  <!-- Judul novel -->
                  <div class="d-flex mb-3 mb-lg-0 mb-md-0">
                    <a href="detail-page.php">
                      <strong>Bedebah Diujung Tanduk</strong>
                    </a>
                  </div>

                  <!-- Nama penulis -->
                  <div class="social-icon ms-lg-auto ms-md-auto">
                    oleh <strong>Tere Liye</strong>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="custom-block-info">
                  <!-- Judul -->
                  <h2 class="text-center mb-5">Serangan Mematikan</h2>

                  <div class="profile-block profile-detail-block d-flex flex-column align-items-center justify-content-center my-5">
                    <h6 class="mb-4">Beli episode seharga <span class="text-warning">10 koin</span></h6>
                    <a href="#" class="btn custom-btn px-5">Beli</a>
                  </div>

                  <div class="d-flex justify-content-between">
                    <a href="#" class="btn custom-btn">Sebelumnya: Duel</a>
                    <a href="#" class="btn custom-btn">Selanjutnya: Apa yang sedang kau lakukan, Thomas?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Episode -->
    <section class="related-podcast-section section-padding">
      <div class="container">
        <div class="row">

          <div class="col-lg-12 col-12">
            <div class="section-title-wrap mb-5">
              <h4 class="section-title">Episode</h4>
            </div>
          </div>

          <div class="col-lg-4 col-12 mb-4 mb-lg-0">
            <div class="custom-block">
              <a href="detail-page.php">
                <div class="custom-block-info custom-block-overlay-info">
                  <!-- Judul episode -->
                  <h5 class="mb-1">
                    <a href="listing-page.php">
                      Duel
                    </a>
                  </h5>
  
                  <!-- Nomor episode -->
                  <p class="badge mb-0">Episode 1</p>
                </div>
              </a>
            </div>
          </div>

          <div class="col-lg-4 col-12 mb-4 mb-lg-0">
            <div class="custom-block">
              <a href="detail-page.php">
                <div class="custom-block-info custom-block-overlay-info">
                  <!-- Judul episode -->
                  <h5 class="mb-1">
                    <a href="listing-page.php">
                      Serangan Mematikan
                    </a>
                  </h5>

                  <!-- Nomor episode -->
                  <p class="badge mb-0">Episode 2</p>
                </div>
              </a>
            </div>
          </div>

          <div class="col-lg-4 col-12 mb-4 mb-lg-0">
            <div class="custom-block">
              <a href="detail-page.php">
                <div class="custom-block-info custom-block-overlay-info">
                  <!-- Judul episode -->
                  <h5 class="mb-1">
                    <a href="listing-page.php">
                      Apa yang sedang kau lakukan, Thomas?
                    </a>
                  </h5>

                  <!-- Nomor episode -->
                  <p class="badge mb-0">Episode 3</p>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <a href="#" class="btn custom-btn position-fixed bottom-0 end-0 mb-4 me-4" style="z-index: 100;">
    <div class="bi-heart">
      <span>2.5k</span>
    </div>
  </a>

  <?php require 'layouts/footer.php'; ?>
  <?php require 'layouts/scripts.php'; ?>

</body>

</html>