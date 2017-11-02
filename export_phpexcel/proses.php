<?php
// Load file koneksi.php
include "koneksi.php";
// Load plugin PHPExcel nya
require_once 'PHPExcel/PHPExcel.php';
// Panggil class PHPExcel nya
$excel = new PHPExcel();
// Settingan awal file excel
$excel->getProperties()->setCreator('My Notes Code')
             ->setLastModifiedBy('My Notes Code')
             ->setTitle("Data Survey")
             ->setSubject("Survey")
             ->setDescription("Laporan Semua Data Survey")
             ->setKeywords("Data Survey");
// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = array(
  'font' => array('bold' => true), // Set font nya jadi bold
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	
  ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  )
);
// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
  'alignment' => array(
   'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (left)
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER// Set text jadi di tengah secara vertical (middle)
  ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  )
);
$excel->setActiveSheetIndex(0)->setCellValue('A1', "KETERANGAN"); // Set kolom A1 dengan tulisan "DATA KARYAWAN"
$excel->getActiveSheet()->mergeCells('A1:B1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A1

$excel->setActiveSheetIndex(0)->setCellValue('F1', "FORM SURVEY"); // Set kolom A1 dengan tulisan "DATA KARYAWAN"
$excel->getActiveSheet()->mergeCells('F1:G1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('F3', "NO"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('G3', "ID KARYAWAN"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('H3', "TANGIBLES"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('I3', "RELIABILITY"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
$excel->setActiveSheetIndex(0)->setCellValue('J3', "RESPONSIIVNESS"); // Set kolom E3 dengan tulisan "TELEPON"
$excel->setActiveSheetIndex(0)->setCellValue('K3', "ASSURENCE"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('L3', "EMPATHY"); // Set kolom F3 dengan tulisan "ALAMAT"
// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);


// Buat header tabel nya pada baris ke 6
$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('B3', "ID KARYAWAN"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('C3', "DIMENSI"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('D3', "PERTANYAAN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setWrapText(true);


// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

// Buat query untuk menampilkan semua data karyawan
$sql = $pdo->prepare("SELECT * FROM pertanyaan");
$sql->execute(); // Eksekusi querynya

$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['id']);
  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['dimensi']);
  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['pertanyaan']);
  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(30);
  $excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setWrapText(true);
  $excel->getActiveSheet()->getStyle('B'.$numrow)->getAlignment()->setWrapText(true);
  $excel->getActiveSheet()->getStyle('C'.$numrow)->getAlignment()->setWrapText(true);
  $excel->getActiveSheet()->getStyle('D'.$numrow)->getAlignment()->setWrapText(true);
  $no++; // Tambah 1 setiap kali looping
  $numrow++; // Tambah 1 setiap kali looping
  
}

// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(5); // Set width kolom F
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom F
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(30); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(30); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(30); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(30); // Set width kolom E
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(30); // Set width kolom F
$excel->getActiveSheet()->getColumnDimension('N')->setWidth(30); // Set width kolom F
// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Laporan Data Survey");
$excel->setActiveSheetIndex(0);
// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data Survey.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');
$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
?>