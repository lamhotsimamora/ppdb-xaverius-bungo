<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home | PPDB Online Xaverius Muara Bungo</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
	<script src="<?= base_url('') ?>public/assets/js/vony.js"></script>
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

				<a href="<?= base_url() ?>peserta/upload">Upload Berkas</a>


				<hr>
				<input id="nama_lengkap" @keypress="enterDaftar" v-model="nama_lengkap" class="input is-rounded" type="text" placeholder="Nama Lengkap"> <br> <br>

				<span class="is-size-5">
					Pilih Agama
				</span>
				<div class="select">
					<select v-model="agama">
						<option v-for="(d,index) in data_agama" :value="d.angka">{{d.agama}}</option>
					</select>
				</div>
				<br>
				<br>
				<input id="alamat" @keypress="enterDaftar" v-model="alamat" class="input is-rounded" type="text" placeholder="Alamat"> <br> <br>
				<input id="asal_sekolah" @keypress="enterDaftar" v-model="asal_sekolah" class="input is-rounded" type="text" placeholder="Asal Sekolah"> <br> <br>
				<input id="ayah" @keypress="enterDaftar" v-model="ayah" class="input is-rounded" type="text" placeholder="Nama Ayah"> <br> <br>
				<input id="ibu" @keypress="enterDaftar" v-model="ibu" class="input is-rounded" type="text" placeholder="Nama Ibu"> <br> <br>
				<input id="hp" @keypress="enterDaftar" v-model="hp" class="input is-rounded" type="text" placeholder="Nomor Whatsapp"> <br> <br>

				<center v-if="loading">
					<figure class="image is-48x48">
						<img class="is-rounded" src="<?= base_url() ?>public/img/loading.gif">
					</figure>
				</center>
				<hr>
				<center>
					<button @click="save" class="button is-info">Save</button>
				</center>

			</div>

		</div>
	</div>
	<script>
		var server = '<?= base_url('') ?>';

		var _TOKEN_ = '<?= $this->security->get_csrf_hash(); ?>';
		var _ID_PESERTA = '<?= $id_peserta ?? null ?>';

		function messageSuccess() {
			return `<div class="notification is-primary">
						<button class="delete"></button>
						Data Berhasil Disimpan !
			</div>`;
		}

		new Vue({
			el: '#app',
			data: {
				nama_lengkap: null,
				alamat: null,
				asal_sekolah: null,
				umur: null,
				ayah: null,
				ibu: null,
				hp: null,
				agama: null,
				loading: false,
				data_agama: [{
						agama: "Kristen Protestan",
						angka: 1
					},
					{
						agama: "Kristen Katolik",
						angka: 2
					},
					{
						agama: "Islam",
						angka: 3
					},
					{
						agama: "Budha",
						angka: 4
					},
					{
						agama: "Hindu",
						angka: 5
					},
				]
			},
			mounted() {
				this.loadData()
			},
			methods: {
				enterDaftar: function(e) {
					if (e.keyCode == 13) {
						this.save()
					}
				},
				loadData: function() {
					Vony({
						url: server + 'peserta/loadData_byId',
						method: 'post',
						data: {
							id_peserta: _ID_PESERTA
						}
					}).ajax((response => {
						var obj = JSON.parse(response);

						if (obj) {
							var nama = obj.nama_lengkap;
							var agama = obj.agama;
							var alamat = obj.alamat;
							var ayah = obj.ayah;
							var ibu = obj.ibu;
							var hp = obj.hp;
							var asal_sekolah = obj.asal_sekolah

							this.nama_lengkap = nama;
							this.alamat = alamat;
							this.ayah = ayah;
							this.ibu = ibu;
							this.hp = hp;
							this.asal_sekolah = asal_sekolah
							console.log(agama);
							this.agama = agama
						}
					}));
				},
				save: function() {
					if (this.nama_lengkap == null || this.nama_lengkap === '') {
						Vony({
							id: 'nama_lengkap'
						}).focus();
						return;
					}
					console.log(this.agama)
					if (this.agama == null || this.agama == 0) {
						alert("Pilih Agama Terlebih Dahulu");
						return;
					}
					if (this.alamat == null || this.alamat === '') {
						Vony({
							id: 'alamat'
						}).focus();
						return;
					}
					if (this.asal_sekolah == null || this.asal_sekolah === '') {
						Vony({
							id: 'asal_sekolah'
						}).focus();
						return;
					}
					if (this.ayah == null || this.ayah === '') {
						Vony({
							id: 'ayah'
						}).focus();
						return;
					}
					if (this.ibu == null || this.ibu === '') {
						Vony({
							id: 'ibu'
						}).focus();
						return;
					}
					if (this.hp == null || this.hp === '') {
						Vony({
							id: 'hp'
						}).focus();
						return;
					}
					this.loading = true;
					Vony({
						url: server + 'peserta/api_save_data',
						method: 'post',
						data: {
							_TOKEN_: _TOKEN_,
							nama_lengkap: this.nama_lengkap,
							alamat: this.alamat,
							asal_sekolah: this.asal_sekolah,
							ayah: this.ayah,
							ibu: this.ibu,
							hp: this.hp,
							agama: this.agama,
							id_peserta: _ID_PESERTA
						}
					}).ajax(($response) => {
						var obj = JSON.parse($response);
						var result = obj.result;
						this.loading = false;
						if (result == true) {
							Swal.fire({
								icon: 'success',
								title: 'Success',
								text: 'Data Berhasil Disimpan !',
								footer: '<a href=""></a>'
							})
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
