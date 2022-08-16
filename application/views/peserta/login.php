<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login |PPDB Online Xaverius Muara Bungo</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
	<script src="<?= base_url('') ?>public/assets/js/vony.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/sweet-alert.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/vue.js"></script>
</head>

<body>
	<?php include '@layout/navbar.php'; ?>
	
	<hr>

	<div id="app" class="container">
		<div class="card">
			<div class="card-content">
				<h2 class="title is-2">Login Peserta PPDB</h2>
				<hr>
				<div id="message"></div> <br>
				<input id="username" @keypress="enterDaftar" v-model="username" type="text" class="input is-primary" placeholder="Username"> <br> <br>
				<input id="password" @keypress="enterDaftar" v-model="password" type="password" class="input is-primary" placeholder="Password"> <br> <br>
				<button class="button is-success" @click="login">Login</button>

			</div>

		</div>
	</div>



	<script>
		var server = '<?= base_url('') ?>';

		var _TOKEN_ = '<?= $this->security->get_csrf_hash(); ?>';


		function messageSuccess() {
			return `<div class="notification is-primary">
						<button class="delete"></button>
						Login Peserta Berhasil!
			</div>`;
		}


		new Vue({
			el: '#app',
			data: {
				username: null,
				password: null
			},
			methods: {
				enterDaftar: function(e) {
					if (e.keyCode == 13) {
						this.login();
					}
				},
				login: function() {
					if (this.username == null || this.username === '') {
						Vony({
							id: 'username'
						}).focus();
						return;
					}
					if (this.password == null || this.password === '') {
						Vony({
							id: 'password'
						}).focus();
						return;
					}

					Vony({
						url: server + 'peserta/api_login',
						method: 'post',
						data: {
							_TOKEN_: _TOKEN_,
							username: this.username,
							password: this.password
						}
					}).ajax(($response) => {
						var obj = JSON.parse($response);
						var result = obj.result;
						var token = obj.token;

						if (result == true) {
							localStorage.setItem('token',token);
							Vony({
								id: 'message'
							}).set(messageSuccess())
							Vony({
								id: 'username'
							}).clear();
							Vony({
								id: 'password'
							}).clear();
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Login Gagal !',
								footer: '<a href="">Silahkan coba lagi</a>'
							})
						}
					});
				}
			},
		})
	</script>

</body>

</html>
