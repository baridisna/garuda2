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
    
    <h3>Tabel Favorable dan Unfavorable</h3>
    
  
    
    <table border="1" cellpadding="5">
      <tr>
	   <th>No</th>
	    <th>Question</th>
        <th>Unfavorable</th>
        <th>Favorable</th>
       
      </tr>
      <?php
      // Load file koneksi.php
      include "koneksi.php";
      
      // Buat query untuk menampilkan semua data siswa
      $sql = $pdo->prepare("SELECT * FROM tb_favorable");
      $sql->execute(); // Eksekusi querynya
      
      $no = 1; // Untuk penomoran tabel, di awal set dengan 1
      while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
        echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$data['question']."</td>";
        echo "<td>".$data['unfavorable']."</td>";
        echo "<td>".$data['favorable']."</td>";
	
        echo "</tr>";
        
        $no++; // Tambah 1 setiap kali looping
      }
      ?>
    </table>
  </body>
</html>