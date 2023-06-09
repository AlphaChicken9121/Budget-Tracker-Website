<?php
	session_start();
	include('database-connection.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Transactions</title>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="icon" href="bt.ico">
	</head>
	<body class="body-padded">
		<h3>Transactions: -</h3>
		<a class="navbar-loggedin button" href="add_transaction.php">+Transaction</a>
		<table>
			<tr>
				<th>Ammount</th>
				<th>Category</th>
				<th>Item Name</th>
				<th>Quantity</th>
				<th>Date</th>
				<th>Total</th>
				<th>Options</th>
			</tr>

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
							<td>
								<a class="button small-button" href="deleteThings.php?transaction_id=<?php echo $row['id'] ?>">Delete</a>
								<a class="button small-button" href="editThings.php?transaction_id=<?php echo $row['id'] ?>">Edit</a>
								<a class="button small-button" href="redoThings.php?transaction_id=<?php echo $row['id'] ?>">Redo</a>
							</td>
						</tr>
						<?php
					}
				}
			?>
		</table>
	</body>
</html>
