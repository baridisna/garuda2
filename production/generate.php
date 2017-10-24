<?php

  // buat koneksi dengan database mysql
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $link = mysqli_connect($dbhost,$dbuser,$dbpass);

  //periksa koneksi, tampilkan pesan kesalahan jika gagal
  if(!$link){
    die ("Koneksi dengan database gagal: ".mysqli_connect_errno().
         " - ".mysqli_connect_error());
  }




  //buat database kampusku jika belum ada
  $query = "CREATE DATABASE IF NOT EXISTS survey";
  $result = mysqli_query($link, $query);

  if(!$result){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
  //  echo "Database <b>'survey'</b> berhasil dibuat... <br>";
  }

  //pilih database kampusku
  $result = mysqli_select_db($link, "survey");

  if(!$result){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
//    echo "Database <b>'survey'</b> berhasil dipilih... <br>";
  }

  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $link = mysqli_connect($dbhost,$dbuser,$dbpass);

  $result = mysqli_select_db($link, "survey");

  if(!$result){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
  //  echo "Database <b>'survey'</b> berhasil dipilih... <br>";
  }
  $query = "SELECT username FROM users";
  $result = mysqli_query($link, $query);


  if(empty($result))
   {
    $query  = "CREATE TABLE `users` (
      `id` int(11) NOT NULL,
      `username` varchar(100) NOT NULL,
      `email` varchar(100) NOT NULL,
      `password` varchar(100) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

    $hasil_query = mysqli_query($link, $query);

    if(!$hasil_query){
        die ("Query Error: ".mysqli_errno($link).
             " - ".mysqli_error($link));
    }
    else {
  //    echo "Tabel <b>'averagedata'</b> berhasil dibuat... <br>";
    }
  }


  if(isset($_POST['submit'])){
    
    $valTangibles = (isset($_POST['tangibles']) ? $_POST['tangibles'] : null);
    $valReliability = (isset($_POST['reliability']) ? $_POST['reliability'] : null);
    $valResponsiveness = (isset($_POST['responsiveness']) ? $_POST['responsiveness'] : null);
    $valAssurance =(isset($_POST['assurance']) ? $_POST['assurance'] : null);
    $valEmpathy= (isset($_POST['empathy']) ? $_POST['empathy'] : null);

  // buat query untuk INSERT data ke tabel mahasiswa
    $query  = "INSERT INTO datasurvey (tangibles,reliability,responsiveness,assurance,empathy) VALUES ($valTangibles,$valReliability
      ,$valResponsiveness,$valAssurance,$valEmpathy)";
    $hasil_query = mysqli_query($link, $query);

    if(!$hasil_query){
        die ("Query Error: ".mysqli_errno($link).
             " - ".mysqli_error($link));
    }
    else {
  //    echo "Tabel <b>'datasurvey'</b> berhasil diisi... <br>";
    }
}

  // tutup koneksi dengan database mysql
  mysqli_close($link);
?>
<?php include ('averagedatavertical.php') ?>
