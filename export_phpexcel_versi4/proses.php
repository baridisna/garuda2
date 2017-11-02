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
             ->setTitle("Data Karyawan")
             ->setSubject("Karyawan")
             ->setDescription("Laporan Semua Data Karyawan")
             ->setKeywords("Data Karyawan");
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
$excel->setActiveSheetIndex(0)->setCellValue('A1', "Tabel Pertanyaan"); // Set kolom A1 dengan tulisan "DATA KARYAWAN"
$excel->getActiveSheet()->mergeCells('A1:C1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->mergeCells('A2:C2');
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A1

$excel->setActiveSheetIndex(0)->setCellValue('I1', "Tabel Penilaian"); // Set kolom A1 dengan tulisan "DATA KARYAWAN"
$excel->getActiveSheet()->mergeCells('I1:N1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->mergeCells('I2:N2');


$excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A1

$excel->setActiveSheetIndex(0)->setCellValue('E1', "Intruksi Penilaian"); // Set kolom A1 dengan tulisan "DATA KARYAWAN"
$excel->getActiveSheet()->mergeCells('E1:F1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->mergeCells('E2:F2');
$excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A1

$excel->setActiveSheetIndex(0)->setCellValue('E3', "WAJIB DIBACA"); // Set kolom A1 dengan tulisan "DATA KARYAWAN"
$excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
$excel->getActiveSheet()->getStyle('E3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Set text center untuk kolom A1
$excel->getActiveSheet()->getStyle('E3')->getFont()->setBold(TRUE); // Set bold kolom A1

$excel->setActiveSheetIndex(0)->setCellValue('E4', "Berilah nilai 1-6 untuk setiap pertanyaan pada Tabel Pertanyaan, di mana setiap pertanyaan tsb telah dikategorikan ke beberapa dimensi seperti yang anda lihat"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('E5', "Letakan nilai di bawah kolom-kolom dimensi pada Tabel Penilaian"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('E6', "Untuk dimensi yang memiliki lebih dari satu pertanyaan, silahkan beri nilai tepat di bawah kolom penilaian sebelumnya"); // Set kolom C3 dengan tulisan "NAMA"


$excel->setActiveSheetIndex(0)->setCellValue('F3', "NILAI"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('F4', "1"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('F5', "2"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('F6', "3"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('F7', "4"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('F8', "5"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('F9', "6"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('G3', "KETERANGAN"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('G4', "Sangat Tidak Setuju"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('G5', "Tidak Setuju"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('G6', "Agak Tidak Setuju"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('G7', "Agak Setuju"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('G8', "Setuju"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('G9', "Sangat Setuju"); // Set kolom C3 dengan tulisan "NAMA"

$excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_row);

$excel->getActiveSheet()->getStyle('E4')->getAlignment()->setWraptext(TRUE);
$excel->getActiveSheet()->getStyle('E5')->getAlignment()->setWraptext(TRUE);
$excel->getActiveSheet()->getStyle('E6')->getAlignment()->setWraptext(TRUE);
$excel->getActiveSheet()->getStyle('E4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); // Set text center untuk kolom A1
$excel->getActiveSheet()->getStyle('E5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); // Set text center untuk kolom A1
$excel->getActiveSheet()->getStyle('E6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); // Set text center untuk kolom A1
$excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A1
$excel->getActiveSheet()->getStyle('E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A1
$excel->getActiveSheet()->getStyle('E6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A1
$excel->getActiveSheet()->getStyle('E4')->getFont()->setSize(9); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('E5')->getFont()->setSize(9); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('E6')->getFont()->setSize(9); // Set font size 15 untuk kolom A1



$excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('F7')->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('F8')->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('F9')->applyFromArray($style_row);

$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('G7')->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('G8')->applyFromArray($style_row);
$excel->getActiveSheet()->getStyle('G9')->applyFromArray($style_row);


$excel->setActiveSheetIndex(0)->setCellValue('I3', "ID KARYAWAN"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('J3', "TANGIBLES"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('K3', "RELIABILITY"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
$excel->setActiveSheetIndex(0)->setCellValue('L3', "RESPONSIVENESS"); // Set kolom E3 dengan tulisan "TELEPON"
$excel->setActiveSheetIndex(0)->setCellValue('M3', "ASSURANCE"); // Set kolom F3 dengan tulisan "ALAMAT"
$excel->setActiveSheetIndex(0)->setCellValue('N3', "EMPATHY"); // Set kolom F3 dengan tulisan "ALAMAT"


$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('I4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('K4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('L4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('M4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('N4')->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J5')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('L5')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('M5')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('N5')->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('I6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('K6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('L6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('M6')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('N6')->applyFromArray($style_col);

$excel->getActiveSheet()->getStyle('I7')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J7')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('K7')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('L7')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('M7')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('N7')->applyFromArray($style_col);

// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('B3', "DIMENSI"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('C3', "PERTANYAAN"); // Set kolom C3 dengan tulisan "NAMA"

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);


// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('9')->setRowHeight(50);




// Buat query untuk menampilkan semua data karyawan
$sql = $pdo->prepare("SELECT * FROM pertanyaan");
$sql->execute(); // Eksekusi querynya

$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql

  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data['id']);
  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['dimensi']);
  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['pertanyaan']);
 
  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('C'.$numrow)->getAlignment()->setWraptext(TRUE);
  $excel->getActiveSheet()->getStyle('C'.$numrow)->getAlignment()->setWraptext(TRUE);
  $excel->getActiveSheet()->getStyle('C'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(50);
  
   // Tambah 1 setiap kali looping
  $numrow++; // Tambah 1 setiap kali looping
}
// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(35); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(5); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(35); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(25); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(5); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(25); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(25); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(25); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(25); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(25); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('N')->setWidth(25); // Set width kolom D

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