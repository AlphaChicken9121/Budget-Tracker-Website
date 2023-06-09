<?php
	session_start();
	include('database-connection.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Balance</title>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="icon" href="bt.ico">
	</head>
	<body class="body-padded">
		<h3>Balance: -</h3>
		<a class="button navbar-loggedin" href="add_balance.php">+Balance</a>
		<table>
			<tr>
				<th>Balance</th>
				<th>Category</th>
				<th>Date</th>
				<th>Options</th>
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
							<td>
								<a class="button small-button" href="deleteThings.php?balance_id=<?php echo $row['id'] ?>">Delete</a>
								<a class="button small-button" href="editThings.php?balance_id=<?php echo $row['id'] ?>">Edit</a>
								<a class="button small-button" href="redoThings.php?balance_id=<?php echo $row['id'] ?>">Redo</a>
							</td>
						</tr>

						<?php
					}
				}
			?>

		</table>
	</body>
</html>
