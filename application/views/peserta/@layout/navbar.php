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
					<a href="<?= base_url() ?>peserta/logout" class="navbar-item">
						Logout
					</a>
				</div>
			</div>
		</div>

		<div class="navbar-end">
			<div class="navbar-item">
				<div class="buttons">


					<?php

					if ($session_peserta == true) {
						echo '<button onclick="logout()" class="button is-danger">Logout</button>
							';
					} else {
						echo `
							<a href="peserta/daftar" class="button is-primary">
								<strong>Daftar</strong>
							</a>
							<a href="peserta/login" class="button is-light">
								Login
							</a>`;
					}

					?>

				</div>
			</div>
		</div>
	</div>
</nav>

<script>
	var server = '<?= base_url('') ?>';


function logout(){
	Vony({
		url : server+'peserta/logout'
	}).ajax((response)=>{
		reload();
	});
}
</script>
<!-- navbar -->
