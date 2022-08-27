<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cetak Data Peserta PPDB Online Xaverius Bungo | Yayasan Xaverius Palembang</title>

	<link rel="stylesheet" href="<?= base_url('') ?>public/assets/css/paper.css">
</head>

<body>

	<div class="section">
		<div class="paper container margin-bottom-large">
			<h4>Nama : <span class="badge warning"><?= $nama_lengkap ?></span></h4>
			<h4>Alamat : <span class="badge warning"><?= $alamat ?></span></h4>
			<h4>Ayah : <span class="badge warning"><?= $ayah ?></span></h4>
			<h4>Ibu : <span class="badge warning"> <?= $ibu ?> </span></h4>
			<?php
			$final_agama = '';
			switch ($agama) {
				case '1':
					$final_agama = 'Kristen Protestan';
					break;
				case '2':
					$final_agama = 'Kristen Katolik';
					break;
				case '3':
					$final_agama = 'Islam';
					break;
				case '4':
					$final_agama = 'Budha';
					break;
				case '5':
					$final_agama = 'Hindu';
					break;
				default:
					# code...
					break;
			}

			?>
			<h4>Agama : <span class="badge warning"> <?= $final_agama ?> </span></h4>
			<h4>Asal Sekolah : <span class="badge warning"><?= $asal_sekolah ?></span></h4>
			<h4>Whatsapp : <span class="badge warning"><?= $hp ?></span></h4>

		</div>
	</div>

	<script>
		window.print()
	</script>

</body>

</html>
