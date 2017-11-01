<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>Export Data ke Excel dengan PHPExcel</title>
  </head>
  <body>
    <!-- HEADER
    -- SKRIP HANYA UNTUK HEADER
    -- HAPUS SAJA JIKA TIDAK DIPERLUKAN
    -->
    <div style="background: whitesmoke;padding: 10px;">
      <h1 style="margin-top: 0;">Export Data ke Excel dengan PHPExcel</h1>
      <p>
        FOLLOW US ON  
        <a target="_blank" style="background: #3b5998; padding: 0 5px; border-radius: 4px; color: #f7f7f7; text-decoration: none;" href="https://www.facebook.com/mynotescode">Facebook</a> 
        <a target="_blank" style="background: #00aced; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="https://twitter.com/mynotescode">Twitter</a> 
        <a target="_blank" style="background: #d34836; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="https://plus.google.com/118319575543333993544">Google+</a>
        <a target="_blank" style="background: black; padding: 0 5px; border-radius: 4px; color: #ffffff; text-decoration: none;" href="https://www.youtube.com/channel/UCO394itv-u7Tn4CgI3bMYIg">YouTube</a>
      </p>
    </div>
    <!-- END HEADER -->
    
    <h3>Data Survey</h3>
    
    <a href="proses.php">Download</a><br><br>
    
    <table border="1" cellpadding="5">
      <tr>
	    <th>No</th>
        <th>ID Karyawan</th>
        <th>Dimensi</th>
        <th>Pertanyaan</th> 
      </tr>
      <?php
      // Load file koneksi.php
      include "koneksi.php";
      
      // Buat query untuk menampilkan semua data siswa
      $sql = $pdo->prepare("SELECT * FROM pertanyaan");
      $sql->execute(); // Eksekusi querynya
      
      $no = 1; // Untuk penomoran tabel, di awal set dengan 1
      while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
        echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$data['id']."</td>";
        echo "<td>".$data['dimensi']."</td>";
        echo "<td>".$data['pertanyaan']."</td>";
        echo "</tr>";
        
        $no++; // Tambah 1 setiap kali looping
      }
      ?>
    </table>
  </body>
</html>