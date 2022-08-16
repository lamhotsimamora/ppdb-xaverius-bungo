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
			<input id="nama_lengkap" v-model="nama_lengkap" class="input is-rounded" type="text" placeholder="Nama Lengkap"> <br> <br>
			
			<select name="" id="" v-model="agama" class="input">
				<option value="1" selected>Kristen Protestan</option>
				<option value="2">Kristen Katolik</option>
				<option value="3">Islam</option>
				<option value="4">Budha</option>
				<option value="5">Hindu</option>
			</select>
			
			<br> <br>
			<input id="alamat" v-model="alamat" class="input is-rounded" type="text" placeholder="Alamat"> <br> <br>
			<input id="asal_sekolah" v-model="asal_sekolah" class="input is-rounded" type="text" placeholder="Asal Sekolah"> <br> <br>
			<input id="ayah" v-model="ayah" class="input is-rounded" type="text" placeholder="Nama Ayah"> <br> <br>
			<input id="ibu" v-model="ibu" class="input is-rounded" type="text" placeholder="Nama Ibu"> <br> <br>
			<input id="hp" v-model="hp" class="input is-rounded" type="text" placeholder="Nomor Whatsapp"> <br> <br>

			<center>
			<button @click="save" class="button is-info">Save</button>
			</center>
			<br>
			<br>
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
			el : '#app',
			data : {
				nama_lengkap: null,
				alamat : null,
				asal_sekolah:null,
				umur : null,
				ayah:null,
				ibu: null,
				hp : null,
				agama:null
			},
			mounted() {
				this.loadData()
			},
			methods: {
				loadData: function(){
					Vony({
						url : server+ 'peserta/loadData_byId',
						method : 'post',
						data : {
							id_peserta : _ID_PESERTA
						}
					}).ajax((response=>{
							var obj  = JSON.parse(response);

							if (obj){
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
							}
					}));
				},
				save : function(){
					if (this.nama_lengkap == null || this.nama_lengkap === '') {
						Vony({id:'nama_lengkap'}).focus();
						return;
					}
					if (this.agama==null){
						alert("Pilih Agama Terlebih Dahulu");
						return;
					}
					if (this.alamat == null || this.alamat === '') {
						Vony({id:'alamat'}).focus();
						return;
					}
					if (this.asal_sekolah == null || this.asal_sekolah === '') {
						Vony({id:'asal_sekolah'}).focus();
						return;
					}
					if (this.ayah == null || this.ayah === '') {
						Vony({id:'ayah'}).focus();
						return;
					}
					if (this.ibu == null || this.ibu === '') {
						Vony({id:'ibu'}).focus();
						return;
					}
					if (this.hp == null || this.hp === '') {
						Vony({id:'hp'}).focus();
						return;
					}

					Vony({
						url: server + 'peserta/api_save_data',
						method: 'post',
						data: {
							_TOKEN_: _TOKEN_,
							nama_lengkap : this.nama_lengkap,
							alamat : this.alamat,
							asal_sekolah : this.asal_sekolah,
							ayah: this.ayah,
							ibu: this.ibu,
							hp: this.hp,
							agama:this.agama,
							id_peserta:_ID_PESERTA
						}
					}).ajax(($response) => {
						var obj = JSON.parse($response);
						var result = obj.result;

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
