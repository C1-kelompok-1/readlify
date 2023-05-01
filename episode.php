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

                  <!-- Konten -->
                  <div class="mb-5">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus praesentium nisi asperiores aut voluptate deleniti, eum et earum sunt quis id ut inventore quia incidunt voluptatem dolores omnis! In iure perspiciatis possimus nemo nam, atque sequi ipsa error ullam eum fugit recusandae labore quod reprehenderit distinctio debitis. Earum corporis repudiandae, autem possimus eos nihil dicta esse, culpa ea reiciendis iusto nam, nisi provident magnam odit dolorem fuga magni eius quam dolor numquam animi. Inventore, recusandae molestias voluptatum iste pariatur quas, similique doloribus maiores eum adipisci deleniti soluta. Ipsam iste ea porro fugit quod maiores atque explicabo, numquam repellendus esse quidem!</p>

                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus praesentium nisi asperiores aut voluptate deleniti, eum et earum sunt quis id ut inventore quia incidunt voluptatem dolores omnis! In iure perspiciatis possimus nemo nam, atque sequi ipsa error ullam eum fugit recusandae labore quod reprehenderit distinctio debitis. Earum corporis repudiandae, autem possimus eos nihil dicta esse, culpa ea reiciendis iusto nam, nisi provident magnam odit dolorem fuga magni eius quam dolor numquam animi. Inventore, recusandae molestias voluptatum iste pariatur quas, similique doloribus maiores eum adipisci deleniti soluta. Ipsam iste ea porro fugit quod maiores atque explicabo, numquam repellendus esse quidem!</p>

                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus praesentium nisi asperiores aut voluptate deleniti, eum et earum sunt quis id ut inventore quia incidunt voluptatem dolores omnis! In iure perspiciatis possimus nemo nam, atque sequi ipsa error ullam eum fugit recusandae labore quod reprehenderit distinctio debitis. Earum corporis repudiandae, autem possimus eos nihil dicta esse, culpa ea reiciendis iusto nam, nisi provident magnam odit dolorem fuga magni eius quam dolor numquam animi. Inventore, recusandae molestias voluptatum iste pariatur quas, similique doloribus maiores eum adipisci deleniti soluta. Ipsam iste ea porro fugit quod maiores atque explicabo, numquam repellendus esse quidem!</p>
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
            <a href="detail-page.php" class="d-block h-100">
              <div class="custom-block d-flex justify-content-center flex-column align-items-start h-100">
                <p><strong>Duel</strong></p>
                <p class="badge mb-0">Episode 1</p>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-12 mb-4 mb-lg-0">
            <a href="detail-page.php" class="d-block h-100">
              <div class="custom-block d-flex justify-content-center flex-column align-items-start h-100">
                <p><strong>Serangan Mematikan</strong></p>
                <p class="badge mb-0">Episode 2</p>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-12 mb-4 mb-lg-0">
            <a href="detail-page.php" class="d-block h-100">
              <div class="custom-block d-flex justify-content-center flex-column align-items-start h-100">
                <p><strong>Thomas, apa yang sedang kau lakukan?</strong></p>
                <p class="badge mb-0">Episode 3</p>
              </div>
            </a>
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