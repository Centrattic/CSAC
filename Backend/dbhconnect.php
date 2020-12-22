<?php
  $servername = "localhost";
  $dbUsername = "troopsho_yhuser";
  $dbPassword = "6ZFvFCUWHu9";
  $dbName = "troopsho_yh";

  //connecting to database
  $connection = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
  
  //error message if connection fails
  if(!$connection){
    die("Connection failed: ".mysqli_connect_error());
  }
?>
