<?php
/*
-- Source Code from My Notes Code (www.mynotescode.com)
-- 
-- Follow Us on Social Media
-- Facebook : http://facebook.com/mynotescode/
-- Twitter  : http://twitter.com/code_notes
-- Google+  : http://plus.google.com/118319575543333993544
--
-- Terimakasih telah mengunjungi blog kami.
-- Jangan lupa untuk Like dan Share catatan-catatan yang ada di blog kami.
*/

// Load file koneksi.php
include "koneksi.php";

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
	$nama_file_baru = 'data.xlsx';
	
	// Load librari PHPExcel nya
	require_once 'PHPExcel/PHPExcel.php';
	
	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
	
	// Buat query Insert
	$sql = $pdo->prepare("INSERT INTO datasurvey VALUES(:id,:tangibles,:reliability,:responsiveness,:assurance,:empathy)");
	
	$numrow = 1;
	foreach($sheet as $row){
		// Ambil data pada excel sesuai Kolom
		$id = $row['A']; // Ambil data NIS
		$tangibles = $row['B']; // Ambil data nama
		$reliability= $row['C']; // Ambil data jenis kelamin
		$responsiveness= $row['D']; // Ambil data telepon
		$assurance = $row['E']; // Ambil data alamat
		$empathy = $row['F']; // Ambil data alamat
		
		// Cek jika semua data tidak diisi
		if(empty($id) && empty($tangibles) && empty($reliability) && empty($responsiveness) && empty($assurance)&& empty($empathy))
			continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
		
		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 1){
			// Proses simpan ke Database
			$sql->bindParam(':id', $id);
			$sql->bindParam(':tangibles', $tangibles);
			$sql->bindParam(':reliability', $reliability);
			$sql->bindParam(':responsiveness', $responsiveness);
			$sql->bindParam(':assurance', $assurance);
			$sql->bindParam(':empathy', $empathy);
			$sql->execute(); // Eksekusi query insert
		}
		
		$numrow++; // Tambah 1 setiap kali looping
	}
}

header('location: index.php'); // Redirect ke halaman awal
?>
