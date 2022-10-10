<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Upload Berkas PPDB Online</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
	<script src="<?= base_url('') ?>public/assets/js/vony.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/upload.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/sweet-alert.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/vue.js"></script>
	<link rel="icon" type="image/x-icon" href="<?= base_url() ?>/public/img/favicon.ico">
</head>

<body>
	<?php include '@layout/navbar.php'; ?>

	<hr>

	<div class="container">
		<div class="card">
			<div class="card-content">
				<h2 class="title is-2">Upload Berkas Peserta PPDB Online 
				<strong style="color: #6c5ce7"><?= $data_sekolah['name'] ?></strong>
				</h2>
			</div>
		</div>
	</div>

	<div id="app" class="container">
		<div class="card">
			<div class="card-content">
				<center v-if="loading">
					<figure class="image is-48x48">
						<img class="is-rounded" src="<?= base_url() ?>public/img/loading.gif">
					</figure>
				</center>
				<hr>
				<center>
				<figure class="image is-96x96">
					<img id="" class="is-square" :src="image_preview">
				</figure>
				</center>

				<br> <br>
				<label for="">File Kartu Keluarga</label>

				<input id="file_kartu_keluarga" accept="image/*" @change="selectFoto" name="file_kartu_keluarga" class="input is-rounded" type="file" placeholder="Upload Kartu Keluarga">
				<hr>
				<a v-if="show_file" :href="link_file" target="_blank">Lihat File</a>
				<hr>

				<button @click="uploadFile" class="button is-primary" @click="">Upload</button>
				<br><br>
				<a href="<?= base_url() ?>peserta/">Back</a>
			</div>

		</div>
	</div>



	<script>
		var server = '<?= base_url('') ?>';

		var _TOKEN_ = '<?= $this->security->get_csrf_hash(); ?>';
		var _ID_PESERTA = '<?= $id_peserta ?? null ?>';

		var file = Vony({
			id: 'file_kartu_keluarga'
		});

		var _READY_UPLOAD_FOTO_ = false;
		const $typefile_allowed = ['image/png', 'image/jpeg'];

		const NO_IMAGE = server + 'public/img/no-image.png';

		new Vue({
			el: '#app',
			data: {
				file_kartu_keluarga: null,
				loading: false,
				link_file: false,
				show_file: false,
				image_preview: NO_IMAGE
			},
			mounted() {
				this.loadFile()
			},
			methods: {
				selectFoto: function(event) {

					if (event.target.files && event.target.files[0]) {
						const obj_file = event.target.files[0];

						var image = URL.createObjectURL(obj_file);

						const fileName = obj_file.name;

						var sizeFile = obj_file.size / 1000;
						sizeFile = Math.floor(sizeFile);
						const typefile = obj_file.type;

						var $typefile_not_allowed = false;

						// check ukuran file jika lebih dari 2.5 mb maka akan ditolak
						if (sizeFile > 1500) {
							Swal.fire({
								title: 'Uppz!',
								text: 'Maximum size file is 1.5 Mb',
								icon: 'error',
								confirmButtonText: 'Ok'
							})
							_READY_UPLOAD_FOTO_ = false;
							this.image_preview = NO_IMAGE;
							return;
						}

						if (typefile === $typefile_allowed[0] ||
							typefile === $typefile_allowed[1]) {
							$typefile_not_allowed = true;
						}

						// check jenis file apakah file gambar atau bukan
						if ($typefile_not_allowed) {
							_READY_UPLOAD_FOTO_ = true;
							console.log("Ready To Upload");
							this.image_preview = image;
						} else {
							_READY_UPLOAD_FOTO_ = false;
							Swal.fire({
								title: 'Uppz!',
								text: 'File extension is not allowed',
								icon: 'error',
								confirmButtonText: 'Ok'
							});
							this.image_preview = NO_IMAGE;
						}
					} else {
						_READY_UPLOAD_FOTO_ = false;
						Swal.fire({
							title: 'Uppz!',
							text: 'Foto belum dipilih :)',
							icon: 'error',
							confirmButtonText: 'Ok'
						});

						this.image_preview = NO_IMAGE;
					}

				},
				loadFile: function() {
					Vony({
						url: server + 'peserta/api_load_file',
						method: 'post',
						data: {
							id_peserta: _ID_PESERTA,
							_TOKEN_: _TOKEN_
						}
					}).ajax((response) => {
						var obj = JSON.parse(response);

						var result = obj.file_kartu_keluarga;

						if (result == null) {
							this.show_file = false;
						} else {
							this.show_file = true;
						}

						var link_file = server + "public/file/" + result;

						this.link_file = link_file
					})

				},
				uploadFile: function() {
					if (_READY_UPLOAD_FOTO_==false){
						console.log("Not ready")
						return;
					}
					this.loading = true;
					new Upload({
						// Array
						el: ['file_kartu_keluarga'],
						// String
						url: server + '/peserta/api_upload_file',
						// String
						data: _ID_PESERTA,
						// String
						token: _TOKEN_
					}).start(($response) => {
						var obj = JSON.parse($response);

						if (obj) {
							var result = obj.result;

							if (result == true) {
								Swal.fire({
									icon: 'success',
									title: 'Success',
									text: 'File Berhasil Diupload !',
									footer: '<a href=""></a>'
								});
								this.loadFile()
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: 'File Gagal Diupload !',
									footer: '<a href="">Silahkan coba lagi</a>'
								})
							}
							this.loading = false;
						}
					});
				}
			},
		});
	</script>

</body>

</html>
