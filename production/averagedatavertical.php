
<?php
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

$query = "SELECT tipe FROM averagedatavertical";
$result = mysqli_query($link, $query);
if(empty($result))
 {
  $query  = "CREATE TABLE averagedatavertical (playerid int(10),
    tipe varchar(20)  ,percentage float(20)
    , PRIMARY KEY (playerid))";

  $hasil_query = mysqli_query($link, $query);

  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
//    echo "Tabel <b>'averagedatavertical'</b> berhasil dibuat... <br>";
  }
}

//tangibles
$result = mysqli_query($link, "SELECT AVG(tangibles) from datasurvey");
if (!$result) {
//    echo 'Could not run query: ' . mysql_error();
    exit;
}
$avgTangibles = mysqli_fetch_row($result);

//echo $avgTangibles[0];

//reliability
$result = mysqli_query($link, "SELECT AVG(reliability) from datasurvey");
if (!$result) {
//    echo 'Could not run query: ' . mysql_error();
    exit;
}
$avgReliability = mysqli_fetch_row($result);

//echo $avgReliability[0];

//responsiveness
$result = mysqli_query($link, "SELECT AVG(responsiveness) from datasurvey");
if (!$result) {
//    echo 'Could not run query: ' . mysql_error();
    exit;
}
$avgResponsiveness = mysqli_fetch_row($result);

//echo $avgResponsiveness[0];
//assurance
$result = mysqli_query($link, "SELECT AVG(assurance) from datasurvey");
if (!$result) {
//    echo 'Could not run query: ' . mysql_error();
    exit;
}
$avgAssurance = mysqli_fetch_row($result);

//echo $avgAssurance[0];
//empathy
$result = mysqli_query($link, "SELECT AVG(empathy) from datasurvey");
if (!$result) {
//    echo 'Could not run query: ' . mysql_error();
    exit;
}
$avgEmpathy = mysqli_fetch_row($result);

//echo $avgEmpathy[0];

$query = "SELECT playerid=1 FROM averagedatavertical";
$result = mysqli_query($link, $query);
if(empty($result))
 {

  //do nothing
  }
  else {
    $query = "DELETE FROM `averagedatavertical` WHERE `averagedatavertical`.`playerid` <= '5';";
    $hasil_query = mysqli_query($link, $query);
//    echo "Tabel <b>'averagedatavertical'</b> berhasil dibuat... <br>";
  }




// buat query untuk INSERT data ke tabel mahasiswa
  $query  = "INSERT INTO averagedatavertical (playerid,tipe,percentage) VALUES

    (1,'avgTangibles',$avgTangibles[0]),
    (2,'avgReliability',$avgReliability[0]),
    (3,'avgResponsiveness',$avgResponsiveness[0]),
    (4,'avgAssurance',$avgAssurance[0]),
    (5,'avgEmpathy',$avgEmpathy[0])";
  $hasil_query = mysqli_query($link, $query);

  if(!$hasil_query){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
//    echo "table <b>'averagedatavertical'</b> berhasil diupdate... <br>";
  }

 ?>
