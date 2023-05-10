<?php

require 'helpers/auth.php';
require 'helpers/input.php';
require 'helpers/alert.php';

redirectIfNotAuthenticated('login.php');

$coins = fetchAll('SELECT * FROM paket_koin');
$paymentMethods = fetchAll('SELECT * FROM metode_pembayaran');

if (isset($_POST['beli'])) {
	$coinId = $_POST['coinId'];
	$paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : null;
	$number = $_POST['number'];

	// cek koin
  if (!$paymentMethod) {
    setInputError('paymentMethod', 'Pilih metode pembayaran');
  }

	// cek number
  if (!$number) {
    setInputError('number', 'Masukkan nomor telepon');
  }

	$coin = fetchOne('SELECT * FROM paket_koin WHERE id = :id', [':id' => $coinId]);
	$isThereAnyError = isThereAnyInputError();

	if (!$isThereAnyError) {
		$user = getLoginUser();

		beginTransaction();

		try {
			query('INSERT INTO pembelian_koin (id_pengguna, id_paket_koin, id_metode_pembayaran, nomor) VALUES (:id_pengguna, :id_paket_koin, :id_metode_pembayaran, :nomor)', [
				':id_pengguna' => $user['id'],
				':id_paket_koin' => $coinId,
				':id_metode_pembayaran' => $paymentMethod,
				':nomor' => $number,
			]);

			query('UPDATE pengguna SET koin = koin + :koin WHERE id = :id', [
				':id' => $user['id'],
				':koin' => $coin['jumlah']
			]);

			$_SESSION['user']['koin'] = $_SESSION['user']['koin'] + $coin['jumlah'];

			commit();
	
			setAlert('success', 'Koin berhasil dibeli');
			redirect('koin.php');
		} catch (PDOException $error) {
			rollBack();
			var_dump($error); die;
			setAlert('danger', 'Gagal membeli koin, silakan coba lagi');
			redirect('koin.php');
		} 
	} else {
		$coinAmount = $coin['jumlah'];
		$coinPrice = $coin['harga'];
	}
}

?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Beli koin</title>

		<?php require 'layouts/favicon.php'; ?>
		<?php require 'layouts/styles.php'; ?>
	</head>

	<body>
		<main>
			<?php require 'layouts/navbar.php'; ?>

			<header class="site-header d-flex flex-column justify-content-center align-items-center">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-12 text-center">
							<h2 class="mb-0">Koin Readify</h2>
						</div>
					</div>
				</div>
			</header>

			<section class="section-padding">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<?= getAlert(); ?>
						</div>
						<div class="col-12">
							<p>Koin saya: <strong><?= $user['koin']; ?></strong></p>
						</div>
						<?php foreach ($coins as $coin): ?>
							<div class="col-12 col-lg-4 d-flex justify-content-center mb-5">
								<div class="card w-100">
									<div class="card-body">
										<h5 class="card-title d-flex justify-content-center mb-0"><?= $coin['jumlah']; ?> koin</h5> <br>
										<button
											type="button"
											class="btn btn-primary w-100"
											data-bs-toggle="modal"
											data-bs-target="#coinModal"
											id="coinModalToggle"
											data-id-paket-koin="<?= $coin['id']; ?>"
											data-jumlah-paket-koin="<?= $coin['jumlah']; ?>"
											data-harga-paket-koin="<?= $coin['harga']; ?>"
										>
											Rp <?= $coin['harga']; ?>
										</button>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		</main>

		<!-- Modal -->
		<div class="modal fade" id="coinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<form action="koin.php" method="POST">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Pilih Metode Pembayaran</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="mb-4 mt-2">
								<p class="text-center mb-1">Beli <strong><span id="coinAmount"></span> koin</strong></p>
								<p class="text-center">Seharga <strong>Rp <span id="coinPrice"></span></strong></p>
							</div>
							<input type="hidden" name="coinId" id="coinId">
							<div class="form-group mb-3">
								<select id="paymentMethod" class="form-control w-100" name="paymentMethod">
									<option value="0" selected disabled>Pilih metode pembayaran</option>
									<?php foreach ($paymentMethods as $method): ?>
										<option value="<?= $method['id']; ?>"><?= $method['nama']; ?></option>
									<?php endforeach; ?>
								</select>
								<?php if ($error = getInputError('paymentMethod')): ?>
									<div class="mt-1"><?= $error; ?></div>
								<?php endif; ?>
							</div>
							<div class="input-group">
								<span class="input-group-text">+62</span>
								<input type="text" name="number" class="form-control" placeholder="Nomor telepon (82398765432)">
							</div>
							<?php if ($error = getInputError('number')): ?>
								<div class="mt-1"><?= $error; ?></div>
							<?php endif; ?>
						</div>
						<div class="modal-footer">
							<button type="submit" name="beli" class="btn btn-primary w-100">Beli</button>
						</div>
					</div>
				</div>
			</form>
		</div>

		<?php require 'layouts/footer.php'; ?>
		<?php require 'layouts/scripts.php'; ?>

		<script>
			$('button#coinModalToggle').on('click', function() {
				const coinId = $(this).data('id-paket-koin');
				const coinAmount = $(this).data('jumlah-paket-koin');
				const coinPrice = $(this).data('harga-paket-koin');
				
				$("#coinId").val(coinId);
				$("#coinAmount").text(coinAmount);
				$("#coinPrice").text(coinPrice);
			});
		</script>

		<?php if ($isThereAnyError): ?>
			<script>
				(new bootstrap.Modal(document.getElementById('coinModal'))).show()
			</script>

			<?php
				echo "<script>
					document.getElementById('coinId').value = $coinId;
					document.getElementById('coinAmount').textContent = 'Rp $coinAmount';
					document.getElementById('coinPrice').textContent = '$coinPrice';
				</script>";
			?>
		<?php endif; ?>
	</body>
</html>