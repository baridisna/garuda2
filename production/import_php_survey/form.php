<!--
-- Source Code from My Notes Code (www.mynotescode.com)
-- 
-- Follow Us on Social Media
-- Facebook : http://facebook.com/mynotescode/
-- Twitter  : http://twitter.com/code_notes
-- Google+  : http://plus.google.com/118319575543333993544
--
-- Terimakasih telah mengunjungi blog kami.
-- Jangan lupa untuk Like dan Share catatan-catatan yang ada di blog kami.
-->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Import Data Excel dengan PHP</title>

		<!-- Load File bootstrap.min.css yang ada difolder css -->
		<link href="import_php_survey/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
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
		
		<!-- Load File jquery.min.js yang ada difolder js -->
		<script src="import_php_survey/js/jquery.min.js"></script>
		
		<script>
		$(document).ready(function(){
			// Sembunyikan alert validasi kosong
			$("#kosong").hide();
		});
		</script>
	</head>
	<body>
		<!-- Membuat Menu Header / Navbar -->
		<!-- Content -->
		<div style="padding: 0 15px;">
			<!-- Buat sebuah tombol Cancel untuk kemabli ke halaman awal / view data -->
			<a href="import_php_survey/index.php" class="btn btn-danger pull-right">
				<span class="glyphicon glyphicon-remove"></span> Cancel
			</a>
			
			<h3>Form Import Data</h3>
			<hr>
			
			<!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
			<form method="post" action="" enctype="multipart/form-data">
				<a href="import_php_survey/dokumen.xlsx" class="btn btn-default">
					<span class="glyphicon glyphicon-download"></span>
					Download dokumen di sini
				</a><br><br>
				
				<!-- 
				-- Buat sebuah input type file
				-- class pull-left berfungsi agar file input berada di sebelah kiri
				-->
				<input type="file" name="file" class="pull-left">
				
				<button type="submit" name="preview" class="btn btn-success btn-sm">
					<span class="glyphicon glyphicon-eye-open"></span> Preview
				</button>
			</form>
			
			<hr>
			
			<!-- Buat Preview Data -->
			<?php
			// Jika user telah mengklik tombol Preview
			if(isset($_POST['preview'])){
				//$ip = ; // Ambil IP Address dari User
				$nama_file_baru = 'data.xlsx';
				
				// Cek apakah terdapat file data.xlsx pada folder tmp
				if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
					unlink('tmp/'.$nama_file_baru); // Hapus file tersebut
				
				$tipe_file = $_FILES['file']['type']; // Ambil tipe file yang akan diupload
				$tmp_file = $_FILES['file']['tmp_name'];
				
				// Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
				if($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
					// Upload file yang dipilih ke folder tmp
					// dan rename file tersebut menjadi data{ip_address}.xlsx
					// {ip_address} diganti jadi ip address user yang ada di variabel $ip
					// Contoh nama file setelah di rename : data127.0.0.1.xlsx
					move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
					
					// Load librari PHPExcel nya
					require_once 'PHPExcel/PHPExcel.php';
					
					$excelreader = new PHPExcel_Reader_Excel2007();
					$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
					
					// Buat sebuah tag form untuk proses import data ke database
					echo "<form method='post' action='import.php'>";
					
					// Buat sebuah div untuk alert validasi kosong
					echo "<div class='alert alert-danger' id='kosong'>
					Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
					</div>";
					
					echo "<table class='table table-bordered'>
					<tr>
						<th colspan='5' class='text-center'>Preview Data</th>
					</tr>
					<tr>
						<th>Nama Karyawan</th>
						<th>Tangibles</th>
						<th>Reliability</th>
						<th>Responsiivness</th>
						<th>Assurence</th>
						<th>Emphaty</th>
					</tr>";
					
					$numrow = 1;
					$kosong = 0;
					foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
						// Ambil data pada excel sesuai Kolom
						$nama_karyawan = $row['A']; // Ambil data NIS
						$tangibles = $row['B']; // Ambil data nama
						$reliability = $row['C']; // Ambil data jenis kelamin
						$responsiivness= $row['D']; // Ambil data telepon
						$assurence= $row['E']; // Ambil data alamat
						$emphaty= $row['F']; // Ambil data alamat
						
						// Cek jika semua data tidak diisi
						if(empty($nama_karyawan) && empty($tangibles) && empty($reliability) && empty($responsiivness) && empty($assurence)&& empty($emphaty))
							continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
						
						// Cek $numrow apakah lebih dari 1
						// Artinya karena baris pertama adalah nama-nama kolom
						// Jadi dilewat saja, tidak usah diimport
						if($numrow > 1){
							// Validasi apakah semua data telah diisi
							$nama_karyawan_td = ( ! empty($nama_karyawan))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
							$tangibles_td = ( ! empty($tangibles))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
							$realibility_td = ( ! empty($reliability))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
							$responsiivness_td = ( ! empty($responsiivness))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
							$assurence_td = ( ! empty($assurence))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							$emphaty_td = ( ! empty($emphaty))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							// Jika salah satu data ada yang kosong
							if(empty($nama_karyawan) or empty($tangibles) or empty($reliability) or empty($responsiivness) or empty($assurence)or empty($emphaty)){
								$kosong++; // Tambah 1 variabel $kosong
							}
							
							echo "<tr>";
							echo "<td".$nama_karyawan_td.">".$nama_karyawan."</td>";
							echo "<td".$tangibles.">".$tangibles."</td>";
							echo "<td".$realibility_td.">".$reliability."</td>";
							echo "<td".$responsiivness_td.">".$responsiivness."</td>";
							echo "<td".$assurence_td.">".$assurence."</td>";
							echo "<td".$emphaty_td.">".$emphaty."</td>";
							echo "</tr>";
						}
						
						$numrow++; // Tambah 1 setiap kali looping
					}
					
					echo "</table>";
					
					// Cek apakah variabel kosong lebih dari 1
					// Jika lebih dari 1, berarti ada data yang masih kosong
					if($kosong > 1){
					?>	
						<script>
						$(document).ready(function(){
							// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
							$("#jumlah_kosong").html('<?php echo $kosong; ?>');
							
							$("#kosong").show(); // Munculkan alert validasi kosong
						});
						</script>
					<?php
					}else{ // Jika semua data sudah diisi
						echo "<hr>";
						
						// Buat sebuah tombol untuk mengimport data ke database
						echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>";
					}
					
					echo "</form>";
				}else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
					// Munculkan pesan validasi
					echo "<div class='alert alert-danger'>
					Hanya File Excel 2007 (.xlsx) yang diperbolehkan
					</div>";
				}
			}
			?>
		</div>
	</body>
</html>

