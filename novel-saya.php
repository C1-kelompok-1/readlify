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

        <header class="site-header site-header-no-title"></header>
        
        <section class="section-padding">
          <div class="container">
            <div class="row">
              <div class="col-12 text-end mb-3">
                <a href="buat-novel.php" class="btn custom-btn">
                  <i class="bi-plus"></i>
                  Buat novel
                </a>
              </div>
              <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                <div class="custom-block custom-block-full">
                  <div class="custom-block-image-wrap">
                    <a href="detail-novel-saya.php">
                      <img src="https://cdn.gramedia.com/uploads/items/9786239726218.jpg" class="custom-block-image img-fluid" alt="">
                    </a>
                  </div>
  
                  <div class="custom-block-info">
                    <!-- Judul -->
                    <h5 class="mb-2">
                      <a href="detail-novel-saya.php">
                        Bedebah Diujung Tanduk
                      </a>
                    </h5>
  
                    <!-- Sipnosis -->
                    <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>
  
                    <!-- Suka -->
                    <div class="custom-block-bottom d-flex justify-content-between mt-3">
                      <div class="bi-heart me-1">
                        <span>2.5k</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                <div class="custom-block custom-block-full">
                  <div class="custom-block-image-wrap">
                    <a href="detail-novel-saya.php">
                      <img src="https://cdn.gramedia.com/uploads/items/9786239726218.jpg" class="custom-block-image img-fluid" alt="">
                    </a>
                  </div>
  
                  <div class="custom-block-info">
                    <!-- Judul -->
                    <h5 class="mb-2">
                      <a href="detail-novel-saya.php">
                        Bedebah Diujung Tanduk
                      </a>
                    </h5>
  
                    <!-- Sipnosis -->
                    <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>
  
                    <!-- Suka -->
                    <div class="custom-block-bottom d-flex justify-content-between mt-3">
                      <div class="bi-heart me-1">
                        <span>2.5k</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    </main>

    <?php require 'layouts/footer.php'; ?>

    <?php require 'layouts/scripts.php'; ?>

</body>

</html>