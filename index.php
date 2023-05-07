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

		<section class="latest-podcast-section section-padding pb-0" id="section_2">
			<div class="container">
				<div class="row justify-content-center">

					<div class="col-lg-12 col-12">
						<div class="section-title-wrap mb-5 mt-5">
							<h4 class="section-title">Terakhir dibaca</h4>
						</div>
					</div>

					<div class="col-lg-6 col-12">
						<div class="custom-block d-flex">
							<div class="">
								<div class="custom-block-icon-wrap">
									<div class="section-overlay"></div>
									<a href="detail-page.php" class="custom-block-image-wrap">
										<img src="assets/images/novel/Twilight.jpeg" class="custom-block-image img-fluid" alt="">
									</a>
								</div>

								<div class="mt-2">
									<a href="#" class="btn custom-btn">
										Lanjut baca
									</a>
								</div>
							</div>

							<div class="custom-block-info">
								<div class="custom-block-top d-flex mb-1">
									<small>Episode <span class="badge">72</span></small>
								</div>

								<h5 class="mb-2">
									<a href="detail-page.php">
										Twilight
									</a>
								</h5>

								<div class="profile-block align-items-center d-flex mb-3">
									<img src="assets/images/pengarang/Stephenie Meyer.jpg" class="profile-block-image img-fluid" alt="">

									<strong>Stephenie Meyer</strong>
								</div>

								<p class="mb-0">
									Bella pindah ke Forks dan bertemu keluarga Cullen yang misterius. Edward yang
									awalnya kasar pada Bella, tiba-tiba menyelamatkannya dari kecelakaan dan memiliki
									kekuatan super. Bella yakin Edward menyembunyikan sesuatu.</p>

								<div class="custom-block-bottom d-flex justify-content-between mt-3">
									<a href="#" class="bi-heart me-1">
										<span>24jt</span>
									</a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-6 col-12">
						<div class="custom-block d-flex">
							<div class="">
								<div class="custom-block-icon-wrap">
									<div class="section-overlay"></div>
									<a href="detail-page.php" class="custom-block-image-wrap">
										<img src="assets/images/novel/bumi.jpg" class="custom-block-image img-fluid" alt="">
									</a>
								</div>

								<div class="mt-2">
									<a href="#" class="btn custom-btn">
										Lanjut baca
									</a>
								</div>
							</div>

							<div class="custom-block-info">
								<div class="custom-block-top d-flex mb-1">
									<small>Episode <span class="badge">35</span></small>
								</div>

								<h5 class="mb-2">
									<a href="detail-page.php">
										Bumi
									</a>
								</h5>

								<div class="profile-block align-items-center d-flex mb-3">
									<img src="assets/images/pengarang/tere liye.jpeg" class="profile-block-image img-fluid" alt="">
									<strong>Tere Liye</strong>
								</div>

								<p class="mb-0">Raib adalah seorang gadis berumur 15 tahun. Secara umum, tidak ada yang
									berbeda dari Raib dengan remaja pada umumnya. Namun, Raib memiliki rahasia yang ia
									simpan sendiri sejak kecil, yakni kemampuan untuk menghilangkan diri. </p>

								<div class="custom-block-bottom d-flex justify-content-between mt-3">
									<a href="#" class="bi-heart me-1">
										<span>2jt</span>
									</a>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>

		<section class="topics-section section-padding pb-0" id="section_3">
			<div class="container">
				<div class="row">

					<div class="col-lg-12 col-12">
						<div class="section-title-wrap mb-5">
							<h4 class="section-title">Genre</h4>
						</div>
					</div>

					<div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
						<div class="custom-block custom-block-overlay">
							<div class="custom-block-info custom-block-overlay-info">
								<h5 class="mb-1">
									<a href="genre.php">
										Romantis
									</a>
								</h5>

								<p class="badge mb-0">20 Novel</p>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
						<div class="custom-block custom-block-overlay">
							<div class="custom-block-info custom-block-overlay-info">
								<h5 class="mb-1">
									<a href="genre.php">
										Misteri
									</a>
								</h5>

								<p class="badge mb-0">12 Novel</p>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
						<div class="custom-block custom-block-overlay">
							<div class="custom-block-info custom-block-overlay-info">
								<h5 class="mb-1">
									<a href="genre.php">
										Fantasi
									</a>
								</h5>

								<p class="badge mb-0">25 Novel</p>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
						<div class="custom-block custom-block-overlay">
							<div class="custom-block-info custom-block-overlay-info">
								<h5 class="mb-1">
									<a href="genre.php">
										Petualangan
									</a>
								</h5>

								<p class="badge mb-0">22 Novel</p>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>

		<section class="trending-podcast-section section-padding">
			<div class="container">
				<div class="row">

					<div class="col-lg-12 col-12">
						<div class="section-title-wrap mb-5">
							<h4 class="section-title">Populer</h4>
						</div>
					</div>

					<div class="col-lg-4 col-12 mb-4 mb-lg-0">
						<div class="custom-block custom-block-full">
							<div class="custom-block-image-wrap">
								<a href="detail-page.php">
									<img src="assets/images/novel/cantik itu luka2.png" class="custom-block-image img-fluid" alt="">
								</a>
							</div>

							<div class="custom-block-info">
								<h5 class="mb-2">
									<a href="detail-page.php">
										Cantik Itu Luka
									</a>
								</h5>

								<div class="profile-block d-flex">
									<img src="assets/images/pengarang/eka kurniawan.jpg" class="profile-block-image img-fluid" alt="">

									<p>Eka Kurniawan
										<strong>Pengarang</strong>
									</p>
								</div>

								<p class="mb-0">Di akhir masa kolonial, seorang perempuan dipaksa menjadi pelacur.
									Kehidupan itu terus dijalaninya hingga ia memiliki tiga anak gadis yang kesemuanya
									cantik. Ketika mengandung anaknya yang keempat, ia berharap anak itu akan lahir
									buruk rupa. Itulah yang terjadi, meskipun secara ironik ia memberinya nama si
									Cantik.

								</p>

								<div class="custom-block-bottom d-flex justify-content-between mt-3">
									<a href="#" class="bi-heart me-1">
										<span>15k</span>
									</a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-12 mb-4 mb-lg-0">
						<div class="custom-block custom-block-full">
							<div class="custom-block-image-wrap">
								<a href="detail-page.php">
									<img src="assets/images/novel/ancika.jpg" class="custom-block-image img-fluid" alt="">
								</a>
							</div>

							<div class="custom-block-info">
								<h5 class="mb-2">
									<a href="detail-page.php">
										Ancika 1995
									</a>
								</h5>

								<div class="profile-block d-flex">
									<img src="assets/images/pengarang/pidi baiq.jpg" class="profile-block-image img-fluid" alt="">

									<p>Pidi Baiq
										<strong>Pengarang</strong>
									</p>
								</div>

								<p class="mb-0">Ancika 1995 menceritakan kisah cinta Dilan setelah putus dengan Milea.
									Dilan yang kuliah di Bandung jatuh cinta dengan Ancika, gadis 17 tahun yang awalnya
									merasa kesal dengannya. Namun, Ancika mulai merasakan ketertarikan pada Dilan ketika
									mereka sering bertemu.
								</p>

								<div class="custom-block-bottom d-flex justify-content-between mt-3">
									<a href="#" class="bi-heart me-1">
										<span>25k</span>
									</a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-12 mb-4 mb-lg-0">
						<div class="custom-block custom-block-full">
							<div class="custom-block-image-wrap">
								<a href="detail-page.php">
									<img src="assets/images/novel/nebula.jpg" class="custom-block-image img-fluid" alt="">
								</a>
							</div>

							<div class="custom-block-info">
								<h5 class="mb-2">
									<a href="detail-page.php">
										Nebula
									</a>
								</h5>

								<div class="profile-block d-flex">
									<img src="assets/images/pengarang/tere liye.jpeg" class="profile-block-image img-fluid" alt="">

									<p>Tere Liye
										<strong>Pengarang</strong>
									</p>
								</div>

								<p class="mb-0">Nebula adalah kelanjutan dari novel Selena. Di sana, Selena membantu
									Bibi Leh menyiapkan pernikahan, sementara persahabatan tiga mahasiswa diuji dengan
									pengkhianatan. Dua buku ini menceritakan tentang Akademi Bayangan Tingkat Tinggi dan
									orangtua Raib. Mereka juga memperkenalkan karakter kuat di dunia paralel dan membuka
									portal menuju Klan Aldebaran.
								</p>

								<div class="custom-block-bottom d-flex justify-content-between mt-3">
									<a href="#" class="bi-heart me-1">
										<span>15k</span>
									</a>
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