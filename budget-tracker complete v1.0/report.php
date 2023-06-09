<?php
	session_start();
	include('database-connection.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Report</title>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="icon" href="bt.ico">
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	</head>
	<body class="body-padded">
		<div id="piechart" style="width: 900px; height: 500px;"></div>
		<div id="chart_div"></div>
		<h4>Spending Details:-</h4>
		<table>
			<tr>
				<th>Ammount</th>
				<th>Category</th>
				<th>Item Name</th>
				<th>Quantity</th>
				<th>Date</th>
				<th>Total</th>
			</tr>

			<h5>Transactions:-</h5>
			<?php
				$sql = "SELECT * FROM `transactions` WHERE userID = '".$_SESSION['id']."' ";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						?>
						<tr>
							<td><?php echo $row['price'] ?>Rs</td>
							<td><?php echo $row['category'] ?></td>
							<td><?php echo $row['itemName'] ?></td>
							<td><?php echo $row['quantity'] ?></td>
							<td><?php echo $row['date'] ?></td>
							<td><?php echo $row['total'] ?>Rs</td>
						</tr>
						<?php
					}
				}
			?>
		</table>
		<br>
		<h5>Balances:-</h5>
		<table>
			<tr>
				<th>Balance</th>
				<th>Category</th>
				<th>Date</th>
			</tr>

			<?php
				$sql = "SELECT * FROM `balance` WHERE userID = '".$_SESSION['id']."' ";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						?>

						<tr>
							<td><?php echo $row['balance'] ?>Rs</td>
							<td><?php echo $row['category'] ?></td>
							<td><?php echo $row['date'] ?></td>
						</tr>

						<?php
					}
				}
			?>

		</table>
	</body>
	<script type="text/javascript" src="js/charts.js"></script>
</html>
