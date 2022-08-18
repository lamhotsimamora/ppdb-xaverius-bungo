<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Upload Berkas | PPDB Online Xaverius Muara Bungo</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
	<script src="<?= base_url('') ?>public/assets/js/vony.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/upload.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/sweet-alert.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/vue.js"></script>
	<link rel="icon" type="image/x-icon" href="<?= base_url() ?>/public/img/xaverius.jpg">
</head>

<body>
	<?php include '@layout/navbar.php'; ?>

	<hr>

	<div class="container">
		<div class="card">
			<div class="card-content">
				<h2 class="title is-2">Data Peserta PPDB</h2>
			</div>
		</div>
	</div>

	<div id="app" class="container">
		<div class="card">
			<div class="card-content">
				<label for="">File Kartu Keluarga</label>
				<input id="file_kartu_keluarga" name="file_kartu_keluarga" class="input is-rounded" type="file" placeholder="Upload Kartu Keluarga">
				<br><br>

				<button @click="uploadFile" class="button is-primary" @click="">Upload</button>

			</div>

		</div>
	</div>



	<script>
		var server = '<?= base_url('') ?>';

		var _TOKEN_ = '<?= $this->security->get_csrf_hash(); ?>';
		var _ID_PESERTA = '<?= $id_peserta ?? null ?>';


		new Vue({
			el:'#app',
			data :{

			},methods: {
				uploadFile:function(){
					new Upload({
						// Array
						el: ['file_kartu_keluarga'],
						// String
						url: server+'/fileberkas/api_upload_file',
						// String
						data: _ID_PESERTA,
						// String
						token: _TOKEN_
					}).start(($response) => {
						console.log($response);
					});
				}
			},
		});
	</script>

</body>

</html>
