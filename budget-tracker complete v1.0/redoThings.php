<?php
  session_start();
  include('database-connection.php');

  if (isset($_GET['transaction_id'])) {
    $sqlGetTransactionValues = " SELECT `price`, `category`, `itemName`, `quantity`, `date`, `total`, `userID` FROM `transactions` WHERE id = '".$_GET['transaction_id']."' ";
    $result1 = $conn->query($sqlGetTransactionValues);
    $row1 = $result1->fetch_assoc();

    $sql = " INSERT INTO `transactions` (`price`, `category`, `itemName`, `quantity`, `date`, `total`, `userID`)
    VALUES ('".$row1['price']."','".$row1['category']."','".$row1['itemName']."','".$row1['quantity']."','".date("Y-m-d")."','".$row1['total']."','".$row1['userID']."') ";
    $conn->query($sql);

    $sqlGetRemainingBalance = " SELECT remainingBalance from remaining_balance WHERE userID = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1 ";
    $result = $conn->query($sqlGetRemainingBalance);
    $row = $result->fetch_assoc();
    $sqlUpdateBalance = " UPDATE `remaining_balance` SET `remainingBalance` = '".$row['remainingBalance']-$row1['total']."' WHERE `remaining_balance`.`userID` = '".$_SESSION['id']."'  ";
    $conn->query($sqlUpdateBalance);
    ?><script type="text/javascript">
      window.top.location.reload("dashboard.php");
    </script>
    <?php
  }

  if (isset($_GET['balance_id'])) {
    $sqlGetBalanceValues = " SELECT `balance`, `category`, `date`, `userID` FROM `balance` WHERE id = '".$_GET['balance_id']."' ";
    $result1 = $conn->query($sqlGetBalanceValues);
    $row1 = $result1->fetch_assoc();

    $sql = " INSERT INTO `balance` (`balance`, `category`, `date`, `userID`) VALUES ('".$row1['balance']."', '".$row1['category']."', '".date("Y-m-d")."', '".$row1['userID']."') ";
    $conn->query($sql);

    $sqlGetRemainingBalance = " SELECT remainingBalance from remaining_balance WHERE userID = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1 ";
    $result = $conn->query($sqlGetRemainingBalance);
    $row = $result->fetch_assoc();
    $sqlUpdateBalance = " UPDATE `remaining_balance` SET `remainingBalance` = '".$row['remainingBalance']+$row1['balance']."' WHERE `remaining_balance`.`userID` = '".$_SESSION['id']."'  ";
    $conn->query($sqlUpdateBalance);
    ?><script type="text/javascript">
      window.top.location.reload("dashboard.php");
    </script>
    <?php
  }
?>
