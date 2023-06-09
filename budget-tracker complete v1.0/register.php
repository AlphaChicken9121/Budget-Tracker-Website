<?php include('database-connection.php'); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="icon" href="bt.ico">
		<title>Register</title>
	</head>
	<body>

			<form action="#" method="post" class="register-page">
				<div>
			    <h1 class="center-text">Register</h1>
					<div class="center-text">
						<input class="textfield-size wide-textfield" type="email" placeholder="Enter Email" name="email">
					</div>
					<div class="center-text">
						<input class="textfield-size wide-textfield" type="password" placeholder="Enter Password" name="pass1">
					</div>
					<div class="center-text">
						<input class="wide-textfield textfield-size" type="password" placeholder="Repeat Password" name="pass2">
					</div>
					<div class="center-button">
				    <input type="submit" name="" value="Register" class="button wide-button">
			  </div>

			  <div>
			    <p class="center-text">Already have an account? <a href="login.php">Login</a>.</p>
			  </div>
			</form>

			<?php
				if(
					isset($_POST['email']) &&
					isset($_POST['pass2'])
				){
					$email = $_POST['email'];
					$pass2 = md5(trim($_POST['pass2']));
					$sql = "INSERT INTO `user`(`email`, `password`) VALUES ('".$email."','".$pass2."')";
					$sqlDuplicateCheck = " SELECT * FROM `user` WHERE `email` = '".$email."' ";

					$result = $conn->query($sqlDuplicateCheck);

					if($conn->query($sql) === TRUE && $result->num_rows == 0){
						$sqlGetID = " SELECT `id` FROM `user` ORDER BY id DESC LIMIT 1 ";
						$result = $conn->query($sqlGetID);
						$row = $result->fetch_assoc();

						$sqlInitializeBalance = " INSERT INTO `remaining_balance` (`remainingBalance`, `userID`)
						VALUES ('0', '".$row['id']."')  ";
						$conn->query($sqlInitializeBalance);
						echo "Registered";
						header("location:dashboard.php");
					}else if($result->num_rows > 0){
						echo "An account with that email already exists";
					}
					else{
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}
			?>

	</body>
</html>
