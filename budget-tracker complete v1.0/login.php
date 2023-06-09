<?php
	session_start();
	include('database-connection.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login</title>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="icon" href="bt.ico">
	</head>
	<body>
		<form action="#" method="post" class="login-page">
			<div>
		    <h1 class="center-text">LogIn</h1>
				<div class="center-text">
			    <input class="textfield-size wide-textfield" type="text" placeholder="Enter Email" name="email">
				</div>

		    <div class="center-text">
			    <input class="textfield-size wide-textfield" type="password" placeholder="Enter Password" name="pass">
		    </div>
				<div class="center-button">
					<input type="submit" class="button wide-button" name="" value="Login">
				</div>
		  </div>
			<div>
				<p class="center-text">Dont have an account? <a href="register.php">Register</a>.</p>
			</div>
		</form>

		<?php
				if(
					isset($_POST['email']) &&
					isset($_POST['pass'])
				){
					$email = $_POST['email'];
					$password = md5(trim($_POST['pass']));
					$sql = " SELECT * FROM `user` WHERE `email` = '".$email."' and `password` = '".$password."' ";

					$result = $conn->query($sql);

					if ($result->num_rows > 0){
						$row = $result->fetch_assoc();
						$_SESSION['id'] = $row['id'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['password'] = $row['password'];
						header("location:dashboard.php");
					}
					else{
						echo "no record found";
					}
				}
			?>

	</body>
</html>
