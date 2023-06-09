<?php
  session_start();
  include('database-connection.php');

  if (isset($_GET['bill_id'])) {
    $sqlGetBillValues = " SELECT `billName`, `ammount` FROM `bills` WHERE id = '".$_GET['bill_id']."' ";
    $result1 = $conn->query($sqlGetBillValues);
    $row1 = $result1->fetch_assoc();

    $sqlPay = "  INSERT INTO `transactions` (`price`, `category`, `itemName`, `quantity`, `date`, `total`, `userID`)
    VALUES ('".$row1['ammount']."','Bills','".$row1['billName']."','1','".date("Y-m-d")."','".$row1['ammount']."','".$_SESSION['id']."')  ";
    $conn->query($sqlPay);

    $sqlGetRemainingBalance = " SELECT remainingBalance from remaining_balance WHERE userID = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1 ";
    $result = $conn->query($sqlGetRemainingBalance);
    $row = $result->fetch_assoc();
    $sqlUpdateBalance = " UPDATE `remaining_balance` SET `remainingBalance` = '".$row['remainingBalance']-$row1['ammount']."' WHERE `remaining_balance`.`userID` = '".$_SESSION['id']."'  ";
    $conn->query($sqlUpdateBalance);
    ?><script type="text/javascript">
      window.top.location.reload("dashboard.php");
    </script>
    <?php
  }
?>
