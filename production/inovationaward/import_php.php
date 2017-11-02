<?php

// Load file koneksi.php
include "koneksi_php.php";

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
	$nama_file_baru = 'data.xlsx';
	
	// Load librari PHPExcel nya
	require_once 'PHPExcel/PHPExcel.php';
	
	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('tmp_upload/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
	
	// Buat query Insert
	$sql = $pdo->prepare("INSERT INTO hasil VALUES(:no,:nama_pegawai,:nopeg,:email,:direktorat,:unit,:judul_inovasi,:kategori_inovasi,:lama_pelaksanakan,:revenue,:cost_saving)");
	
	$numrow = 1;
	foreach($sheet as $row){
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
			// Proses simpan ke Database
			$sql->bindParam(':no', $no);
			$sql->bindParam(':nama_pegawai', $nama_pegawai);
			$sql->bindParam(':nopeg', $nopeg);
			$sql->bindParam(':email', $email);
			$sql->bindParam(':direktorat', $direktorat);
			$sql->bindParam(':unit', $unit);
			$sql->bindParam(':judul_inovasi', $judul_inovasi);
			$sql->bindParam(':kategori_inovasi', $kategori_inovasi);
			$sql->bindParam(':lama_pelaksanaan', $lama_pelaksanaan);
			$sql->bindParam(':revenue', $revenue);
			$sql->bindParam(':cost_saving', $cost_saving);

			$sql->execute(); // Eksekusi query insert
		}
		
		$numrow++; // Tambah 1 setiap kali looping
	}
}

header('location: index_php.php'); // Redirect ke halaman awal
?>
