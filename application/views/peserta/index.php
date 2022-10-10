<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Official Web PPDB Online</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
	<script src="<?= base_url('') ?>public/assets/js/vony.js"></script>
	
	<link rel="icon" type="image/x-icon" href="<?= base_url() ?>/public/img/favicon.ico">
</head>

<body>
	<?php include '@layout/navbar.php'; ?>

	<hr>

	<div class="container">
		<div class="card">
			<div class="card-content">

				<p class="title">
					SELAMAT Datang di Website PPDB Online <?= $data_sekolah['name'] ?>.
				</p>
				<hr>
				<p class="subtitle">
					Website Resmi Penerimaan Peserta Didik Baru Online
				</p>

			</div>

		</div>
	</div>

	<br>

	<div class="container">
		<div class="card">
			<div class="card-content">
				<div class="content">
					
					<?= $data_sekolah['info'] ?>

					<hr>
					<a href="<?= base_url() ?>peserta/daftar" class="button is-primary">
							<strong>Daftar</strong>
					</a>
					<a href="<?= base_url() ?>peserta/login" class="button is-success">
							<strong>Login</strong>
					</a>
					<hr>
					<a href="<?= base_url() ?>admin" target="_blank">Admin</a>
				</div>
			</div>
		</div>
	</div>

</body>

</html>
