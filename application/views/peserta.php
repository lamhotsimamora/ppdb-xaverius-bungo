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
	<!-- navbar -->
	<nav class="navbar" role="navigation" aria-label="main navigation">
		<div class="navbar-brand">
			<a class="navbar-item" href=".">
				<img src="<?= base_url() ?>/public/img/xaverius.jpg" width="80" height="25">
			</a>

			<a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
				<span aria-hidden="true"></span>
				<span aria-hidden="true"></span>
				<span aria-hidden="true"></span>
			</a>
		</div>

		<div id="navbarBasicExample" class="navbar-menu">
			<div class="navbar-start">
				<a class="navbar-item">
					Home
				</a>
				<a class="navbar-item">
					Alur
				</a>
				<a class="navbar-item">
					Jadwal
				</a>
				<a class="navbar-item">
					Kontak
				</a>

				<div class="navbar-item has-dropdown is-hoverable">
					<a class="navbar-link">
						More
					</a>

					<div class="navbar-dropdown">
						<a class="navbar-item">
							About
						</a>
						<a class="navbar-item">
							Jobs
						</a>
						<a class="navbar-item">
							Contact
						</a>
						<hr class="navbar-divider">
						<a class="navbar-item">
							Report an issue
						</a>
					</div>
				</div>
			</div>

			<div class="navbar-end">
				<div class="navbar-item">
					<div class="buttons">
						<a class="button is-primary">
							<strong>Daftar</strong>
						</a>
						<a class="button is-light">
							Login
						</a>
					</div>
				</div>
			</div>
		</div>
	</nav>

	<!-- navbar -->

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
			<footer class="card-footer">
				
			</footer>
		</div>
	</div>

	<div class="container">
		<div class="card">
			<footer class="card-footer">
				<a href="#" class="card-footer-item">Login</a>
			</footer>
		</div>
	</div>

</body>

</html>
