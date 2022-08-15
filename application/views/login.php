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
</head>

<body style="background-color: #232131">
	<br>
	<div class="container">
		<h4 class="text-center" style="color:white">
			Login Admin
		</h4>
		<div id="message">

		</div>

		<input id="username" type="text" class="form-control" placeholder="Username"> <br>
		<input id="password" type="password" class="form-control" placeholder="Password"> <br>
		<a href="#" id="btnshowpassword">Show Password</a>
		<hr>
		<button id="btnlogin" class="btn btn-primary">Login</button>

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

		var username = Vony({
			id: 'username',
			focus: true
		}).on('keydown', (e) => {
			if (e.keyCode == 13) {
				login();
			}
		});

		var password = Vony({
			id: 'password'
		}).on('keydown', (e) => {
			if (e.keyCode == 13) {
				login();
			}
		})

		var btnlogin = Vony({
			id: 'btnlogin'
		}).on('click', () => {
			login();
		});

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

		function login() {

			var $result = validateInput(username, password);

			if ($result) {
				Vony({
					url: server + 'admin/api_login',
					method: 'post',
					data: {
						username: username.get(),
						password: password.get(),
						_TOKEN_: _TOKEN_
					}
				}).ajax((response) => {
					var obj = JSON.parse(response);

					var result = obj.result;

					if (result == true) {
						message.set(message_success);
						setTimeout(() => {
							reload();
						}, 700);
					} else {
						message.set(message_failed);
					}
				})
			}
		}
	</script>

</body>

</html>
