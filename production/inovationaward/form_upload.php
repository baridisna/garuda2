

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Import Data Excel dengan PHP</title>

		<!-- Load File bootstrap.min.css yang ada difolder css -->
		<link href="css_upload/bootstrap.min.css" rel="stylesheet">
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
		<script src="js_upload/jquery.min.js"></script>
		
		<script>
		$(document).ready(function(){
			// Sembunyikan alert validasi kosong
			$("#kosong").hide();
		});
		</script>
	</head>
		<body>
				<!-- Content -->
				<div style="padding: 0 15px;">
			<!-- Buat sebuah tombol Cancel untuk kemabli ke halaman awal / view data -->
			<a href="index_php.php" class="btn btn-danger pull-right">
				<span class="glyphicon glyphicon-remove"></span> Cancel
			</a>
			
			<h3>Welcome</h3>
			<hr>
			
			<!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
			<form method="post" action="" enctype="multipart/form-data">
	
				
				<h4>Download form dan isi terlebih dahulu sebelum mengupload. Klik choose file untuk memilih form yang telah anda isi.</h4>
				<br></br>
				<input type="file" name="file" class="pull-left">
			
				<a href="proses.php">
				<span class="glyphicon glyphicon-download"></span>
				Download Form
				</a><br><br>
				
			
				<button type="submit" name="preview" class="btn btn-success btn-sm">
					<span class="glyphicon glyphicon-eye-open"></span> Preview
				</button>
			</form>
			
			</hr>
			
			<!-- Buat Preview Data -->
			<?php
			// Jika user telah mengklik tombol Preview
			if(isset($_POST['preview'])){
				//$ip = ; // Ambil IP Address dari User
				$nama_file_baru = 'data.xlsx';
				
				// Cek apakah terdapat file data.xlsx pada folder tmp
				if(is_file('tmp_upload/'.$nama_file_baru)) // Jika file tersebut ada
				unlink('tmp_upload/'.$nama_file_baru); // Hapus file tersebut
				$tipe_file = $_FILES['file']['type']; // Ambil tipe file yang akan diupload
				$tmp_file = $_FILES['file']['tmp_name'];
				
				// Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
				if($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
					// Upload file yang dipilih ke folder tmp
					// dan rename file tersebut menjadi data{ip_address}.xlsx
					// {ip_address} diganti jadi ip address user yang ada di variabel $ip
					// Contoh nama file setelah di rename : data127.0.0.1.xlsx
					move_uploaded_file($tmp_file, 'tmp_upload/'.$nama_file_baru);
					
					// Load librari PHPExcel nya
					require_once 'PHPExcel/PHPExcel.php';
					
					$excelreader = new PHPExcel_Reader_Excel2007();
					$loadexcel = $excelreader->load('tmp_upload/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
					
					// Buat sebuah tag form untuk proses import data ke database
					echo "<form method='post' action='import_php.php'>";
					
					// Buat sebuah div untuk alert validasi kosong
					echo "<div class='alert alert-danger' id='kosong'>
					Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
					</div>";
					
					echo "<table class='table table-bordered'>
					<tr>
					<th colspan='6' class='text-center'>Preview Data</th>
					</tr>
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
					</tr>";
					
					$numrow = 1;
					$kosong = 0;
					foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
						// Ambil data pada excel sesuai Kolom
						$no = $row['A']; // Ambil data NIS
						$nama_pegawai = $row['B']; // Ambil data nama
						$nopeg= $row['C']; // Ambil data jenis kelamin
						$email= $row['D']; // Ambil data telepon
						$direktorat = $row['E']; // Ambil data alamat
						$unit = $row['F']; // Ambil data alamat
						$judul_inovasi= $row['G']; // Ambil data telepon
						$kategori_inovasi = $row['H']; // Ambil data alamat
						$lama_pelaksanaan = $row['I']; // Ambil data alamat
						$revenue = $row['J']; // Ambil data alamat
						$cost_saving = $row['K']; // Ambil data alamat
						
						// Cek jika semua data tidak diisi
						if(empty($no) && empty($nama_pegawai) && empty($nopeg) && empty($email) && empty($direktorat)&& empty($unit)&& empty($judul_inovasi)&& empty($kategori_inovasi)&& empty($lama_pelaksanaan)&& empty($revenue)&& empty($cost_saving))
						continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
						
						// Cek $numrow apakah lebih dari 1
						// Artinya karena baris pertama adalah nama-nama kolom
						// Jadi dilewat saja, tidak usah diimport
						if($numrow > 1){
							// Validasi apakah semua data telah diisi
							$no_td = ( ! empty($no))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
							$nama_pegawai_td = ( ! empty($nama_pegawai))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
							$nopeg_td = ( ! empty($nopeg))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
							$email_td = ( ! empty($email))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
							$direktorat_td = ( ! empty($direktorat))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							$unit_td = ( ! empty($unit))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							$judul_inovasi_td = ( ! empty($judul_inovasi))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
							$kategori_inovasi_td = ( ! empty($kategori_inovasi))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
							$lama_pelaksanaan_td = ( ! empty($lama_pelaksanaan))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
							$revenue_td = ( ! empty($revenue))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
							$cost_saving_td = ( ! empty($cost_saving))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
							// Jika salah satu data ada yang kosong
						if(empty($no) or empty($nama_pegawai) or empty($nopeg) or empty($email) or empty($direktorat)or empty($unit)or empty($judul_inovasi)or empty($kategori_inovasi)or empty($lama_pelaksanaan)or empty($revenue)or empty($cost_saving))
							{
								$kosong++; // Tambah 1 variabel $kosong
							}
							
							echo "<tr>";
							echo "<td".$no_td.">".$no."</td>";
							echo "<td".$nama_pegawai_td.">".$nama_pegawai."</td>";
							echo "<td".$nopeg_td.">".$nopeg."</td>";
							echo "<td".$email_td.">".$email."</td>";
							echo "<td".$direktorat_td.">".$direktorat."</td>";
							echo "<td".$unit_td.">".$unit."</td>";
							echo "<td".$judul_inovasi_td.">".$judul_inovasi."</td>";
							echo "<td".$kategori_inovasi_td.">".$kategori_inovasi."</td>";
							echo "<td".$lama_pelaksanaan_td.">".$lama_pelaksanaan."</td>";
							echo "<td".$revenue_td.">".$revenue."</td>";
							echo "<td".$cost_saving_td.">".$cost_saving."</td>";
							echo "</tr>";
						}
						
						$numrow++; // Tambah 1 setiap kali looping
					}
					echo "</table>";
					
					// Cek apakah variabel kosong lebih dari 1
					// Jika lebih dari 1, berarti ada data yang masih kosong
					if($kosong < 1){
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
						echo "<button type='submit' name='upload' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> upload</button>";
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

