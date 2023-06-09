<?php
  session_start();
  include('database-connection.php');

  if (isset($_GET['transaction_id'])) {
    $sqlGetRemainingBalance = " SELECT remainingBalance from remaining_balance WHERE userID = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1 ";
    $result = $conn->query($sqlGetRemainingBalance);
    $row = $result->fetch_assoc();

    $sqlGetTransactionTotal = "SELECT `total` FROM `transactions` WHERE id = '".$_GET['transaction_id']."' ";
    $result1 = $conn->query($sqlGetTransactionTotal);
    $row1 = $result1->fetch_assoc();

    $sqlUpdateBalance = " UPDATE `remaining_balance` SET `remainingBalance` = '".$row['remainingBalance']+$row1['total']."' WHERE `remaining_balance`.`userID` = '".$_SESSION['id']."'  ";
    $conn->query($sqlUpdateBalance);

    $sql = " DELETE from `transactions` where id = ".$_GET['transaction_id']." ";

    if ($conn->query($sql) === true) {
      ?>
  		<script type="text/javascript">
  			window.top.location.reload("dashboard.php");
  		</script><?php
    }else{
      echo "Cannot Delete";
    }
  }

  if (isset($_GET['balance_id'])) {
    $sqlGetRemainingBalance = " SELECT remainingBalance from remaining_balance WHERE userID = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1 ";
    $result = $conn->query($sqlGetRemainingBalance);
    $row = $result->fetch_assoc();

    $sqlGetBalanceDeleted = " SELECT `balance` FROM `balance` WHERE id = '".$_GET['balance_id']."' ";
    $result1 = $conn->query($sqlGetBalanceDeleted);
    $row1 = $result1->fetch_assoc();

    $sqlUpdateBalance = " UPDATE `remaining_balance` SET `remainingBalance` = '".$row['remainingBalance']-$row1['balance']."' WHERE `remaining_balance`.`userID` = '".$_SESSION['id']."'  ";
    $conn->query($sqlUpdateBalance);

    $sql = " DELETE FROM `balance` WHERE id = ".$_GET['balance_id']." ";
    if ($conn->query($sql) === true) {
      ?>
  		<script type="text/javascript">
  			window.top.location.reload("dashboard.php");
  		</script><?php
    }else{
      echo "Cannot Delete";
    }
  }
?>
