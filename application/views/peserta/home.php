<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home |PPDB Online Xaverius Muara Bungo</title>
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
				<h2 class="title is-2">Home Peserta PPDB</h2>

			</div>


		</div>
		<br>
		<div class="card">
			<center>
				<figure class="image is-128x128">
					<img src="https://bulma.io/images/placeholders/128x128.png">
				</figure>
			</center>

			<hr>
			<input v-model="nama_lengkap" class="input is-rounded" type="text" placeholder="Nama Lengkap"> <br> <br>
			<input v-model="alamat" class="input is-rounded" type="text" placeholder="Alamat"> <br> <br>
			<input v-model="ayah" class="input is-rounded" type="text" placeholder="Nama Ayah"> <br> <br>
			<input v-model="ibu" class="input is-rounded" type="text" placeholder="Nama Ibu"> <br> <br>
			<input v-model="hp" class="input is-rounded" type="text" placeholder="Nomor Whatsapp"> <br> <br>

			<button @click="save" class="button is-info">Save</button>
			<br>
			<br>
		</div>
	</div>



	<script>
		var server = '<?= base_url('') ?>';

		var _TOKEN_ = '<?= $this->security->get_csrf_hash(); ?>';

		new Vue({
			el : '#app',
			data : {
				nama_lengkap: null,
				alamat : null,
				asal_sekolah:null,
				umur : null,
				ayah:null,
				ibu: null,
				hp : null
			},
			methods: {
				save : function(){
					
				}
			},
		})
	</script>

</body>

</html>
