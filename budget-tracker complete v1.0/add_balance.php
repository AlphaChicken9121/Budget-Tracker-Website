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
  <body class="body-padded">
    <h3>Remaining Balance: 0.00Rs</h3>
    <h3>Add Balance: -</h3>

    <div class="">
      <form class="" action="#" method="post">
        <table>
          <tr>
            <th>Balance</th>
            <th>Balance Category</th>
            <th>Date</th>
            <th>Option</th>
          </tr>
          <tr>
            <td><input class="number-selector" type="number" name="balance" value="" step="any"></td>
            <td>
              <input class="number-selector" type="text" name="category" value="">
            </td>
            <td><input class="button" type="date" name="date" value="" placeholder="Select Date"> </td>
            <td><input class="button" type="submit" name="" value="Submit"> </td>
          </tr>
        </table>
      </form>
      <?php
        if (isset($_POST['balance']) && isset($_POST['category']) && isset($_POST['date'])) {

              $balance = $_POST['balance'];
              $category = $_POST['category'];
              $date = $_POST['date'];
              $sql = " INSERT INTO `balance` (`balance`, `category`, `date`, `userID`)
              VALUES (".$balance.", '".$category."','".$date."', '".$_SESSION['id']."')  ";

              if ($conn->query($sql) === TRUE) {
                echo "Balance Added";
              }else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
							$sqlGetRemainingBalance = " SELECT remainingBalance from remaining_balance WHERE userID = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1 ";
							$result = $conn->query($sqlGetRemainingBalance);
							$row = $result->fetch_assoc();
							$sqlUpdateBalance = " UPDATE `remaining_balance` SET `remainingBalance` = '".$row['remainingBalance']+$balance."' WHERE `remaining_balance`.`userID` = '".$_SESSION['id']."'  ";
							$conn->query($sqlUpdateBalance);
							?><script type="text/javascript">
									window.top.location.reload("dashboard.php");
								</script>
							<?php
        }
      ?>
    </div>
  </body>
</html>
