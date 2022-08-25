<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Peserta | Admin | Yayasan Xaverius Palembang</title>
	<link rel="stylesheet" href="<?= base_url('') ?>public/assets/css/bootstrap.min.css">
	<script src="<?= base_url('') ?>public/assets/js/jquery-1.9.1.min.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/vony.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/vue.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/bootstrap.min.js"></script>

	<script src="<?= base_url('') ?>public/assets/js/sweet-alert.js"></script>

	<link rel="icon" type="image/x-icon" href="<?= base_url() ?>/public/img/xaverius.jpg">

</head>

<body style="background-color: #2311">

	<!-- navbar  -->
	<?php include('@layout/navbar.php'); ?>


	<br>
	<div class="container" id="app">

		<div class="card">
			<div class="card-body">
				Master Data Peserta PPDB Online Yayasan Xaverius Palembang
			</div>
		</div>
		<br>

		<div class="card">

			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">Search...</span>
				<input v-model="search" id="search" @keypress="enterSearch" type="text" class="form-control" placeholder="..." aria-label="Username" aria-describedby="basic-addon1">
			</div>

			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Username</th>
							<th scope="col">Nama Lengkap</th>
							<th scope="col">Alamat</th>
							<th scope="col">Ayah</th>
							<th scope="col">Ibu</th>
							<th scope="col">Agama</th>
							<th scope="col">Asal Sekolah</th>
							<th scope="col">Whatsapp</th>
							<th scope="col">Kartu Keluarga</th>
							<th>
								@
							</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(d,i) in data_peserta">
							<th scope="row">{{ i+1 }}</th>
							<td>{{ d.username }}</td>
							<td>{{ d.nama_lengkap }}</td>
							<td>{{ d.alamat }}</td>
							<td>{{ d.ayah }}</td>
							<td>{{ d.ibu }}</td>
							<td>{{ fixAgama(d.agama) }}</td>
							<td>{{ d.asal_sekolah }}</td>
							<td>{{ d.hp }}</td>
							<td>
								<a target="_blank" :href="getLinkFile(d.file_kartu_keluarga)">Lihat File</a>
							</td>
							<td>
								<button v-on:click="deleteData(d.id_peserta)" class="btn btn-danger btn-sm">x</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>


	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

	<script>
		var server = '<?= base_url('') ?>';

		var _TOKEN_ = '<?= $this->security->get_csrf_hash(); ?>';

		new Vue({
			el: '#app',
			data: {
				data_peserta: null,
				search: null
			},
			methods: {
				getLinkFile: function(v){
					return server+'public/file/'+v;
				},
				searchData: function() {
					if (this.search == null || this.search === '') {
						Vony({
							id: 'search'
						}).focus();
						return;
					}

					Vony({
						url: server + 'admin/api_search_data',
						method: 'post',
						data: {
							_TOKEN_: _TOKEN_,
							search: this.search
						}
					}).ajax(($response) => {
						var obj = JSON.parse($response);

						this.data_peserta = obj;
					});
				},
				enterSearch: function(e) {
					if (e.keyCode == 13) {
						this.searchData()
					}
				},
				moneyFormat: function(v) {
					return moneyFormat(v);
				},
				fixAgama: function(v) {
					switch (v) {
						case '1':
							return 'Kristen Protestan';
							break;
						case '2':
							return 'Kristen Katolik';
						case '3':
							return 'Islam';
						case '4':
							return 'Budha';
						case '5':
							return 'Hindu';

						default:
							return '-';
							break;
					}
				},
				deleteData: function(data_id) {
					Swal.fire({
						title: 'Yakin mau hapus data ini ?',
						text: "Data yang dihapus tidak bisa dikembalikan",
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
						if (result.isConfirmed) {
							Vony({
								url: server + 'admin/api_delete_data',
								method: 'post',
								data: {
									_TOKEN_: _TOKEN_,
									id_peserta: data_id
								}
							}).ajax(($response) => {

								this.loadData();
								Swal.fire(
									'Deleted!',
									'Data has been deleted.',
									'success'
								)
							});

						}
					})

				},
				loadData: function() {
					Vony({
						url: server + 'admin/api_load_data',
						method: 'post',
						data: {
							_TOKEN_: _TOKEN_
						}
					}).ajax(($response) => {
						var obj = JSON.parse($response);

						this.data_peserta = obj;
					});
				}
			},
			mounted() {
				this.loadData()
			},
		})
	</script>

</body>

</html>
