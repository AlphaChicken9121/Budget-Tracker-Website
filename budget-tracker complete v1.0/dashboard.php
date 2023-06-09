<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("location: login.php");
	}
	include('database-connection.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dasboard</title>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="icon" href="bt.ico">
	</head>
	<body>
		<?php
			$sqlGetLimit = " SELECT `limit` FROM `limit` WHERE userID = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1 ";
			$result = $conn->query($sqlGetLimit);
			$row = $result->fetch_assoc();

			if (isset($row)) {
				if($row['limit']<100 && $row['limit']>0){
					echo '<script>alert("Less than 100Rs left till limit is reached")</script>';
				}
				else if ($row['limit']<=0) {
					echo '<script>alert("Limit reached")</script>';
				}
			}


		?>


		<div class="dashboard-navbar">
			<?php
			echo "Logged in as &quot" . $_SESSION['email'] . "&quot"; ?> <br>
			<a style="float:right; color:#59e800;" href="logout.php">Logout</a>
			<h3 class="remaining-balance">Remaining Balance: <?php
				$sql = " SELECT remainingBalance from remaining_balance WHERE userID = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1 ";
				$result = $conn->query($sql);
				if ($result->num_rows > 0){
					$row = $result->fetch_assoc();
					echo $row['remainingBalance'];
				}
			?>Rs</h3>
		</div>

		<?php
			$sqlGetRemainingBalance = " SELECT remainingBalance from remaining_balance WHERE userID = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1 ";
			$result = $conn->query($sqlGetRemainingBalance);
			$row = $result->fetch_assoc();
			if ($row['remainingBalance'] == 0) {
				?>
				<div>
					<form class="" action="#" method="post">
						<p style="padding-left: 30px;">Enter Initial Amount</p>
						<input style="margin-left: 30px;" class="number-selector" type="number" name="remainingBalance">
						<input class="button" type="submit" name="" value="Submit">
					</form>
					<?php
					if (isset($_POST['remainingBalance'])) {

								$remainingBalance = $_POST['remainingBalance'];
								$sql = " INSERT INTO `remaining_balance` (`remainingBalance`, `userID`)
								VALUES ('".$remainingBalance."', '".$_SESSION['id']."')  ";

								if ($conn->query($sql) === TRUE) {
									echo "Balance Added";
									header("location:dashboard.php");
								}else {
									echo "Error: " . $sql . "<br>" . $conn->error;
								}
					}
					?>
				</div>
				<?php
			}
		?>

		<div class="sidebar">
			<a class="sidebar-item" onclick='newSrc("transactions.php")'>Transactions</a>
			<br>
			<a class="sidebar-item" onclick='newSrc("balance.php")'>Balance</a>
			<br>
			<a class="sidebar-item" onclick='newSrc("bills.php")'>Bills</a>
			<br>
			<a class="sidebar-item" onclick='newSrc("report.php")'>Report</a>
			<br>
			<a class="sidebar-item" onclick='newSrc("limit.php")'>Set Limit</a>
		</div>
		<div class="selected-item">
			<iframe width="880" height="600" name="mainScreen" frameborder="1" scrolling="auto" src="iframedefault.php" id="Frame" style="border:solid;"></iframe>
		</div>
		<script src="js/dashboardScript.js" type="text/javascript"></script>
	</body>
</html>
