<?php
  $host = "localhost";
  $user = "root";
  $pass = "";
  $dbName = "budget-tracker";

  $conn = new mysqli($host, $user, $pass, $dbName);

  if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
  }
?>
