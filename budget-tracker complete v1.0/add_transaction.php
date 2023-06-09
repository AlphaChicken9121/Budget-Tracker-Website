<?php
	session_start();
	include('database-connection.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Transaction</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="bt.ico">
  </head>
  <body class="body-padded" style="text-align:center">
    <h3>Add Transaction</h3>
    <br>

    <div>
      <form class="" action="#" method="post">
        <div class="addTransactionDiv">
          <h3 class="inputLabel">Price: </h3>
          <input class="number-selector floatRight" type="number" name="price" step="any">
          <br>
          <h3 class="inputLabel">Category: </h3>
          <input class="number-selector floatRight" type="text" name="category">
          <br>
          <h3 class="inputLabel">Item: </h3>
          <input class="number-selector floatRight" type="text" name="item">
          <br>
          <h3 class="inputLabel">Quantity: </h3>
          <input class="number-selector floatRight" type="number" name="qty">
          <br>
          <h3 class="inputLabel" style="margin-top:30px">Date: </h3>
          <input class="button floatRight" type="date" name="date">
        </div>
        <br> <br>
        <input type="submit" class="button submitTransaction" value="Submit">
      </form>
      <?php
        if (isset($_POST['price']) && isset($_POST['category']) && isset($_POST['item'])
            && isset($_POST['qty']) && isset($_POST['date'])) {

              $price = $_POST['price'];
              $category = $_POST['category'];
              $item = $_POST['item'];
              $qty = $_POST['qty'];
              $date = $_POST['date'];
              $sql = " INSERT INTO `transactions` (`price`, `category`, `itemName`, `quantity`, `date`, `total`, `userID`)
              VALUES (".$price.", '".$category."', '".$item."', ".$qty.", '".$date."', '".$price*$qty."', '".$_SESSION['id']."')  ";

              if ($conn->query($sql) === TRUE) {
                echo "Transaction Added";
              }else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }

							$sqlGetTotal = " SELECT `total` from `transactions` where `id` = (SELECT id from transactions WHERE userID = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1) ";
							$result1 = $conn->query($sqlGetTotal);
							$row1 = $result1->fetch_assoc();

							$sqlGetRemainingBalance = " SELECT remainingBalance from remaining_balance WHERE userID = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1 ";
							$result = $conn->query($sqlGetRemainingBalance);
							$row = $result->fetch_assoc();
							$sqlUpdateBalance = " UPDATE `remaining_balance` SET `remainingBalance` = '".$row['remainingBalance']-$row1['total']."' WHERE `remaining_balance`.`userID` = '".$_SESSION['id']."'  ";
							$conn->query($sqlUpdateBalance);

							$sqlGetLimit = " SELECT * FROM `limit` WHERE userID = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1 ";
							$result2 = $conn->query($sqlGetLimit);
							$row2 = $result2->fetch_assoc();

							$sqlUpdateLimit = "UPDATE `limit` SET `limit`='".$row2['limit']-$row1['total']."' WHERE `limit`.`userID` = ".$_SESSION['id']." ";
							$conn->query($sqlUpdateLimit);

							?><script type="text/javascript">
								window.top.location.reload("dashboard.php");
							</script>
							<?php
        }
      ?>

    </div>
  </body>
</html>
