<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PPDB Online Xaverius Muara Bungo</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>

<body>
<?php include '@layout/navbar.php'; ?>

	<hr>

	<div class="container">
		<div class="card">
			<div class="card-content">

				<p class="title">
					SELAMAT Datang ! PPDB Online
				</p>
				<p class="subtitle">

					Laman Resmi Penerimaan Peserta Didik Baru Xaverius Bungo
				</p>
				<hr>
				<figure class="image is-128x128">
					<img class="is-rounded" src="<?= base_url() ?>/public/img/xaverius-image.jpg">
				</figure>
			</div>
			
		</div>
	</div>

	<div class="container">
		<div class="card">
			<footer class="card-footer">
				<a href="<?= base_url() ?>peserta/login" class="card-footer-item">Login</a>
			</footer>
		</div>
	</div>

</body>

</html>
