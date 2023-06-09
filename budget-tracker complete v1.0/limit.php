<?php
  session_start();
  include('database-connection.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Limiter</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="bt.ico">
  </head>
  <body class="body-padded">
    <div class="">
      <form class="" action="#" method="post">
        Set Limit: <input class="number-selector" type="number" name="limit">
        <input class="button" type="submit" name="" value="Submit">
      </form>
      <?php
        if (isset($_POST['limit'])) {
          $sql = " INSERT INTO `limit`(`limit`, `userID`) VALUES ('".$_POST['limit']."', '".$_SESSION['id']."') ";
          if ($conn->query($sql) === TRUE) {
            echo "Limit Set";
          }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
      ?>
      <h3>Remaining Till Limit Reached: <?php
        $sqlGetLimit = " SELECT `limit` FROM `limit` WHERE userID = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1 ";
        $result = $conn->query($sqlGetLimit);
        $row = $result->fetch_assoc();
        if (isset($row)) {
          echo $row['limit'];
        }
      ?>Rs</h3>
    </div>
  </body>
</html>
