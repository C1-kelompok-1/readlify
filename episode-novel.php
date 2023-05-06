<?php

require 'helpers/auth.php';

redirectIfNotAuthenticated('login.php');

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Readify</title>

    <?php require 'layouts/favicon.php'; ?>
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
            <div class="col-12 d-flex justify-content-between mb-3">
              <a href="detail-novel-saya.php" class="btn custom-btn">
                <i class="bi-arrow-left"></i>
                Kembali
              </a>

              <a href="edit-episode.php" class="btn custom-btn">
                <i class="bi-pencil"></i>
                Edit
              </a>
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