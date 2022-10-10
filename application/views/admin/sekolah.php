<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Sekolah | Admin</title>
	<link rel="stylesheet" href="<?= base_url('') ?>public/assets/css/bootstrap.min.css">
	<script src="<?= base_url('') ?>public/assets/js/jquery-1.9.1.min.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/vony.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/vue.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/bootstrap.min.js"></script>

	<script src="<?= base_url('') ?>public/assets/js/sweet-alert.js"></script>

	<link rel="icon" type="image/x-icon" href="<?= base_url() ?>/public/img/favicon.ico">

</head>

<body style="background-color: #2311">

	<!-- navbar  -->
	<?php include('@layout/navbar.php'); ?>


	<br>
	<div class="container" id="app">

		<div class="card">
			<div class="card-body">
				Master Data Sekolah PPDB Online
			</div>
		</div>
		<br>

		<div class="card">

		<br><br>

			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">Nama Sekolah</span>
				<input v-model="name" ref="name" type="text" class="form-control" placeholder="..." aria-label="Username" aria-describedby="basic-addon1">
			</div>

			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1">Informasi</span>
				<textarea v-model="info" ref="info" class="form-control" name="" id="" cols="30" rows="10"></textarea>
			</div>

			<button @click="save" class="btn btn-success btn-md">Save</button>

		</div>


	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

	<script>
		var server = '<?= base_url('') ?>';

		var _TOKEN_ = '<?= $this->security->get_csrf_hash(); ?>';
		const id_school = 1;

		new Vue({
			el: '#app',
			data: {
				name: null,
				info : null
			},
			methods: {
				save : function(){
					if (this.name == null || this.name === '') {
						this.$refs.name.focus()
						return;
					}
					if (this.info == null || this.info === '') {
						this.$refs.info.focus()
						return;
					}

					Vony({
						url: server + 'sekolah/update',
						method: 'post',
						data: {
							_TOKEN_: _TOKEN_,
							name : this.name,
							info: this.info,
							id_school:id_school
						}
					}).ajax(($response) => {
						var obj = JSON.parse($response);
						if (obj){
							
							if (obj.result){
								Swal.fire({
									icon: 'success',
									title: 'Success',
									text: 'Data berhasil disimpan',
									footer: '<a href=""></a>'
								});
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: 'Data gagal disimpan',
									footer: '<a href="">Silahkan coba lagi</a>'
								})
							}

						}
					});
				},
				loadData: function() {
					Vony({
						url: server + 'sekolah/show',
						method: 'post',
						data: {
							_TOKEN_: _TOKEN_
						}
					}).ajax(($response) => {
						var obj = JSON.parse($response);
						if (obj){
							this.name = obj.name;
							this.info = obj.info;
						}
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
