 <?php
  $servername = "localhost";  
  $username = "root";
  $password = "";
  $dbName = "survey";
  //establishing the connection to the db.
  $conn = new mysqli($servername, $username, $password, $dbName);
  //checking if there were any error during the last connection attempt
  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  }

  $number = count($_POST["dimensi"]);  
  if($number > 0)  
  {  
    for($i=0; $i<$number; $i++)  
    {  
           if(trim($_POST["dimensi"][$i] != ''))  
           {  
                $sql = "INSERT INTO dimensi(dimensi) VALUES('".mysqli_real_escape_string($conn, $_POST["dimensi"][$i])."')";  
                mysqli_query($conn, $sql);  
           }  
      }  
      echo "Data Inserted";  
 }  
 else  
 {  
      echo "Please Enter Name";  
 }  
 ?> 