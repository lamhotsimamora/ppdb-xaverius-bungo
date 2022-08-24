<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Admin</title>
	<link rel="stylesheet" href="<?= base_url('') ?>public/assets/css/bootstrap.min.css">
	<script src="<?= base_url('') ?>public/assets/js/jquery-1.9.1.min.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/bootstrap.min.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/vony.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/sweet-alert.js"></script>

	<script src="<?= base_url('') ?>public/assets/js/vue.js"></script>
	
	<link rel="icon" type="image/x-icon" href="<?= base_url() ?>/public/img/xaverius.jpg">
</head>

<body>
	<br>
	<div id="app" class="container">
		<h4 class="text-center">
			Login Admin

		</h4>
		<hr>
		<h3 class="text-center">
			PPDB Xaverius Muara Bungo
		</h3>
		<hr>
		<div v-html="message">
		</div>
		<center>

			<img v-if="loading" width="80" height="80" class="img-thumbnail" src="<?= base_url() ?>public/img/loading.gif">

		</center>

		<input id="username" v-model="username" @keypress="enterLogin" type="text" class="form-control" placeholder="Username"> <br>
		<input id="password" v-model="password" type="password" @keypress="enterLogin" class="form-control" placeholder="Password"> <br>
		<a href="#" id="btnshowpassword">Show Password</a>
		<hr>
		<button id="btnlogin" @click="login" class="btn btn-primary">Login</button>

	</div>

	<script>
		var server = '<?= base_url('') ?>';
		var _TOKEN_ = '<?= $this->security->get_csrf_hash(); ?>';


		const message_failed = `<div id="message_failed" class="alert alert-danger" role="alert">
		Maaf ! Login Gagal ! Silahkan ulangi kembali !
		</div>`;
		const message_success = `<div id="message_success" class="alert alert-success" role="alert">
		Login Berhasil !
		</div>`;

		var message = Vony({
			id: 'message'
		});

		var app = new Vue({
			el: '#app',
			data: {
				loading: false,
				username: null,
				password: null,
				message : null
			},
			methods: {
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
					this.loading = true;
					Vony({
						url: server + 'admin/api_login',
						method: 'post',
						data: {
							username: this.username,
							password: this.password,
							_TOKEN_: _TOKEN_
						}
					}).ajax((response) => {
						this.loading = false;
						var obj = JSON.parse(response);

						var result = obj.result;

						if (result == true) {
							this.message = message_success
							setTimeout(() => {
								reload();
							}, 700);
						} else {
							this.message = message_failed
						}
					});
				},
				enterLogin: function(e) {
					if (e.keyCode == 13) {
						this.login()
					}
				}
			},
		})

		var password = Vony({id:'password'})


		var btnshowpassword = Vony({
			id: 'btnshowpassword'
		}).on('click', () => {
			if (password.get('type') === 'password') {
				password.change('type', 'text')
				btnshowpassword.set('Hide Password')
			} else {
				password.change('type', 'password')
				btnshowpassword.set('Show Password')
			}
		});

	
	</script>

</body>

</html>
