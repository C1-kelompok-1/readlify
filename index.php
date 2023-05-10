<?php

require 'helpers/auth.php';
require 'koneksi.php';
require 'episode_baru.php';
require 'genre_populer.php';
require 'novel_populer.php';
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
		<section class="hero-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-12">
						<div class="text-center mb-5 pb-2">
							<h1 class="text-white">Readify</h1>
							<p class="text-white">Baca di mana saja. Jelajahi novel favorit Anda.</p>
						</div>

						<div class="mb-5">
							<form action="cari.php" method="get" class="custom-form search-form flex-fill me-3">
								<div class="input-group input-group-lg">
									<input name="search" type="search" class="form-control" id="search" placeholder="Cari Novel"
										aria-label="Search">

									<button type="submit" class="form-control" id="submit">
										<i class="bi-search"></i>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Episode terbaru -->
		<section class="latest-podcast-section section-padding pb-0" id="section_2">
			<div class="container">
				<div class="row justify-content-center">

					<div class="col-lg-12 col-12">
						<div class="section-title-wrap mb-5 mt-5">
							<h4 class="section-title">Episode Terbaru</h4>
						</div>
					</div>

					<?php while ($row = mysqli_fetch_assoc($result_episode_baru)) { ?>
					<div class="col-lg-6 col-12 mb-4">
						<div class="custom-block d-flex h-100 mt-4">
							<div class="">
								<div class="custom-block-icon-wrap">
									<div class="section-overlay"></div>
									<a href="novel.php?slug=<?= $row['novel_slug']; ?>" class="custom-block-image-wrap">
										<img src="photos/<?php echo $row['photo_filename']; ?>" class="custom-block-image img-fluid" alt="<?= $row['novel_slug']; ?>">
									</a>
								</div>

								<div class="mt-2">
									<a href="episode.php?novel_slug=<?= $row['novel_slug']; ?>&episode_slug=<?= $row['slug']; ?>"
										class="btn custom-btn">
										Baca Sekarang
									</a>
								</div>
							</div>

							<div class="custom-block-info">
								<div class="custom-block-top d-flex mb-1">
									<small>Judul <span class="badge"><?php echo $row['judul']; ?></span></small>
								</div>

								<h5 class="mb-2">
									<a href="episode.php?novel_slug=<?= $row['novel_slug']; ?>&episode_slug=<?= $row['slug']; ?>">
										<?php echo $row['episode']; ?>
									</a>
								</h5>

								<div class="profile-block align-items-center d-flex mb-3">
									<img src="photos/<?php echo $row['avatar']; ?>" class="profile-block-image img-fluid" alt="">

									<strong><?php echo $row['username']; ?></strong>
								</div>

								<div class="custom-block-bottom d-flex justify-content-between mt-3">
									<a href="#" class="bi-heart me-1">
										<span><?php echo $row['jumlah_disukai']; ?></span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>

				</div>
			</div>
		</section>
		<!-- Genre Populer -->
		<section class="topics-section section-padding pb-0" id="section_3">
			<div class="container">
				<div class="row">

					<div class="col-lg-12 col-12">
						<div class="section-title-wrap mb-5">
							<h4 class="section-title">Genre terpopuler</h4>
						</div>
					</div>
					<?php while ($row = mysqli_fetch_assoc($result_genre_populer)) { ?>
					<div class="col-lg-3 col-md-6 col-12 mb-4">
						<div class="custom-block h-100">
							<div class="custom-block-info">
								<h6 class="mb-1">
									<a href="genre.php?genre=<?= $row['nama']; ?>">
										<?php echo $row['nama']; ?>
									</a>
								</h6>

								<p class="badge mb-0"><?php echo $row['jumlah_novel']; ?> novel</p>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</section>

		<!-- Novel Populer -->
		<section class="trending-podcast-section section-padding">
			<div class="container">
				<div class="row">

					<div class="col-lg-12 col-12">
						<div class="section-title-wrap mb-5">
							<h4 class="section-title">Populer</h4>
						</div>
					</div>


					<?php while ($row = mysqli_fetch_assoc($result_novel_populer)) { ?>
					<div class="col-lg-4 col-12 mb-4">
						<div class="custom-block custom-block-full h-100">
							<div class="custom-block-image-wrap">
								<a href="novel.php?slug=<?= $row['slug'] ?>">
									<img src="photos/<?php echo $row['photo_filename']; ?>" class="custom-block-image img-fluid" alt="<?= $row['judul']; ?>">
								</a>
							</div>

							<div class="custom-block-info">
								<h5 class="mb-2">
									<a href="novel.php?slug=<?= $row['slug'] ?>">
										<?php echo $row['judul']; ?>
									</a>
								</h5>

								<div class="profile-block d-flex align-items-center my-3">
									<img src="photos/<?php echo $row['avatar']; ?>" class="profile-block-image img-fluid"
										alt="<?= $row['judul']; ?>">

									<p class="mb-0"><?php echo $row['username']; ?></p>
								</div>

								<p class="mb-0"><?php echo $row['deskripsi']; ?></p>

								<div class="custom-block-bottom d-flex justify-content-between mt-3">
									<a href="#" class="bi-heart me-1">
										<span><?php echo $row['jumlah_disukai']; ?></span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>


				</div>
			</div>
		</section>
	</main>

	<?php require 'layouts/footer.php'; ?>

	<?php require 'layouts/scripts.php'; ?>

</body>

</html>