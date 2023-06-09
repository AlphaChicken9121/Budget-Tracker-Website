<?php
	session_start();
	include('database-connection.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Categories</title>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="icon" href="bt.ico">
	</head>
	<body class="body-padded">
		<input class="textfield-size" type="text" name="" value="">
		<a class="button" href="#">+Category</a>
		<table>
			<tr>
				<th>#</th>
				<th>Category Name</th>
				<th>Options</th>
			</tr>
			<tr>
				<td>1.</td>
				<td>Food</td>
				<td>
					<a class="button small-button" href="#">Delete</a>
					<a class="button small-button" href="#">Edit</a>
				</td>
			</tr>
			<tr>
				<td>2.</td>
				<td>Bill</td>
				<td>
					<a class="button small-button" href="#">Delete</a>
					<a class="button small-button" href="#">Edit</a>
				</td>
			</tr>
			<tr>
				<td>3.</td>
				<td>Games</td>
				<td>
					<a class="button small-button" href="#">Delete</a>
					<a class="button small-button" href="#">Edit</a>
				</td>
			</tr>
		</table>
	</body>
</html>
