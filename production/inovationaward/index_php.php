

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Import Data Excel dengan PHP</title>

		<!-- Load File bootstrap.min.css yang ada difolder css -->
		<link href="css_upload/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js_upload"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js_upload/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- Style untuk Loading -->
		<style>
        #loading{
			background: whitesmoke;
			position: absolute;
			top: 140px;
			left: 82px;
			padding: 5px 10px;
			border: 1px solid #ccc;
		}
		</style>
	</head>
	<body>
		<!-- Membuat Menu Header / Navbar -->
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#" style="color: white;"><b>Import Data Excel dengan PHP</b></a>
				</div>
				<p class="navbar-text navbar-right hidden-xs" style="color: white;padding-right: 10px;">
					FOLLOW US ON &nbsp;
					<a target="_blank" style="background: #3b5998; padding: 0 5px; border-radius: 4px; color: #f7f7f7; text-decoration: none;" href="https://www.facebook.com/mynotescode">Facebook</a> 
					<a target="_blank" style="background: #00aced; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="https://twitter.com/code_notes">Twitter</a> 
					<a target="_blank" style="background: #d34836; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="https://plus.google.com/118319575543333993544">Google+</a>
				</p>
			</div>
		</nav>
		
		<!-- Content -->
		<div style="padding: 0 15px;">
			<!-- 
			-- Buat sebuah tombol untuk mengarahkan ke form import data
			-- Tambahkan class btn agar terlihat seperti tombol
			-- Tambahkan class btn-success untuk tombol warna hijau
			-- class pull-right agar posisi link berada di sebelah kanan
			-->
			<a href="form_upload.php" class="btn btn-success pull-right">
				<span class="glyphicon glyphicon-upload"></span> Import Data
			</a>
			
			<h3>Data Hasil Import</h3>
			
			<hr>
			
			<!-- Buat sebuah div dan beri class table-responsive agar tabel jadi responsive -->
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th>No</th>
						<th>Nama Pegawai</th>
						<th>Nomor Pegawai</th>
						<th>Alamat Email</th>
						<th>Direktorat</th>
						<th>Unit</th>
						<th>Judul Inovasi</th>
						<th>Kategori Inovasi</th>
						<th>Lama Pelaksanakan</th>
						<th>Potensi Revenue (Rp)</th>
						<th>Potensi Cost Saving (Rp)</th>
					</tr>
					<?php
					// Load file koneksi.php
					include "koneksi_php.php";
					
					// Buat query untuk menampilkan semua data survey
					$sql = $pdo->prepare("SELECT * FROM hasil");
					$sql->execute(); // Eksekusi querynya
					
					$no = 1; // Untuk penomoran tabel, di awal set dengan 1
					while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
						echo "<tr>";
						echo "<td>".$data['no']."</td>";
						echo "<td>".$data['nama_pegawai']."</td>";
						echo "<td>".$data['nopeg']."</td>";
						echo "<td>".$data['email']."</td>";
						echo "<td>".$data['direktorat']."</td>";
						echo "<td>".$data['unit']."</td>";
						echo "<td>".$data['judul_inovasi']."</td>";
						echo "<td>".$data['kategori_inovasi']."</td>";
						echo "<td>".$data['lama_pelaksanaan']."</td>";
						echo "<td>".$data['revenue']."</td>";
						echo "<td>".$data['cost_saving']."</td>";
						echo "</tr>";
						$no++; // Tambah 1 setiap kali looping
					}
					?>
				</table>
			</div>
		</div>
	</body>
</html>
