<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Type Rumah | Admin</title>
	<link rel="stylesheet" href="<?= base_url('') ?>public/assets/css/bootstrap.min.css">
	<script src="<?= base_url('') ?>public/assets/js/jquery-1.9.1.min.js"></script>

	<script src="<?= base_url('') ?>public/assets/js/bootstrap.min.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/vony.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/sweet-alert.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/vue.js"></script>

</head>

<body style="background-color: #2311">

	<!-- navbar  -->
	<?php include('@layout/navbar.php'); ?>


	<br>
	<div class="container" id="app">

		<div class="card">
			<div class="card-body">
				Add Type Rumah
				<hr>
				
			
				<input v-model="type" type="text" class="form-control" placeholder="Type Rumah" id="t_type">
				<br>
				
				<button @click="addData" class="btn btn-success">Save</button>
			</div>
		</div>
		<br>

		<div class="card">
			
		</div>


	</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  

	<script>
		var server = '<?= base_url('') ?>';

		var _TOKEN_ = '<?=  $this->security->get_csrf_hash(); ?>';
		
		new Vue({
			el : '#app',
			data : {
				type : null
			},
			methods: {
			
				addData :function(){
					if (this.type==null || this.type===''){
						Vony({id:'t_type'}).focus();
						return;
					}

					Vony({
						url : server+'type/addData',
						method : 'post',
						data : {
							_TOKEN_ : _TOKEN_,
							type: this.type
						}
					}).ajax(($response)=>{
						var obj = JSON.parse($response);
						var result = obj.result;

						if (result==true){
							alert("Data Type Berhasil Ditambahkan");
							reload(server+'admin/type');
						}else{
							alert("Data Type Gagal Ditambahkan")
						}
					});
				}
			},
			mounted() {
			
			},
		})
	</script>

</body>

</html>
