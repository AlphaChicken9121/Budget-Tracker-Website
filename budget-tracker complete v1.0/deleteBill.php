<?php
  session_start();
  include('database-connection.php');

  if (isset($_GET['bill_id'])) {
    $sql = "DELETE FROM `bills` WHERE id = '".$_GET['bill_id']."' ";
    $conn->query($sql);
    header("location:bills.php");
  }
?>
