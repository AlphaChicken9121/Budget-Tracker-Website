<?php
	session_start();
	include('database-connection.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bills</title>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="icon" href="bt.ico">
  </head>
  <body class="body-padded">
		<h3>Add Bill</h3>
		<div class="">
			<form class="" action="#" method="post">
				<h4 style="display:inline">Bill: </h4>
				<input class="number-selector" type="text" name="billName" value="">
				<h4 style="display:inline">Ammount: </h4>
				<input class="number-selector" type="number" name="ammount" value="" step="any">
				<input class="button" type="submit" name="" value="Submit">
			</form>
			<?php
        if (isset($_POST['billName']) && isset($_POST['ammount'])) {

              $billName = $_POST['billName'];
              $ammount = $_POST['ammount'];
              $sql = " INSERT INTO `bills` (`billName`, `ammount`, `userID`)
              VALUES ('".$billName."','".$ammount."', '".$_SESSION['id']."')  ";

              if ($conn->query($sql) === TRUE) {
                echo "Bill Added";
              }else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
        }
      ?>
		</div>
		<br>
		<h3>Bills: -</h3>
		<table>
			<tr>
				<th>Bill</th>
				<th>Ammount</th>
				<th>Option</th>
			</tr>

			<?php
				$sql = "SELECT * FROM `bills` WHERE userID = '".$_SESSION['id']."' ";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $row['billName'] ?></td>
							<td><?php echo $row['ammount'] ?>Rs</td>
							<td>
								<a class="button small-button" href="payBill.php?bill_id=<?php echo $row['id'] ?>">Pay</a>
								<a class="button small-button" href="deleteBill.php?bill_id=<?php echo $row['id'] ?>">Delete</a>
							</td>
						</tr>
						<?php
					}
				}
			?>
		</table>
  </body>
</html>
