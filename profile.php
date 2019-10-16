<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
include 'db_con.php';
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email, fullname FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $fullname);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="style.css" rel="stylesheet" type="text/css">
		<style>
		input,textarea,select {
			outline:0;
			font-family: Tahoma, Geneva, sans-serif;
		}
		.contact input[type="text"], .contact input[type="email"] {
			display: block;
			margin-top: 15px;
			padding: 15px;
			border: 1px solid #dfe0e0;
			width: 500px;
		}
		.contact input[type="text"]:focus, .contact input[type="email"]:focus {
			border: 1px solid #c6c7c7;
		}
		.contact textarea {
			resize: none;
			margin-top: 15px;
			padding: 15px;
			border: 1px solid #dfe0e0;
			width: 700px;
			height: 200px;
		}
		.contact textarea:focus {
			border: 1px solid #c6c7c7;
		}
		.contact input[type="submit"] {
			display: block;
			margin-top: 15px;
			padding: 15px;
			border: 0;
			background-color: #518acb;
			font-weight: bold;
			color: #fff;
			cursor: pointer;
			width: 150px;
		}
		.contact input[type="submit"]:hover {
			background-color: #3670b3;
		}
		</style>
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1><a href="home.php"><i class="fas fa-percentage"></i><?=strtoupper($_SESSION['name'])?></a></h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
                    <tr>
						<td>Full Name:</td>
						<td><?=$fullname?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
                    </tr>
				</table>
			</div>
		</div>
		<div class="content">
			<h2>Contact Us</h2>
			<div>
				<form class="contact" method="post" action="contact.php">
					<input type="email" name="email" placeholder="Your Email Address" required>
					<input type="text" name="name" placeholder="Your Name" required>
					<input type="text" name="subject" placeholder="Subject" required>
					<textarea name="msg" placeholder="What would you like to contact us about?" required></textarea>
					<input type="submit">
				</form>
			</div>
			<?php if ($response): ?>
			<p><?php echo $response; ?></p>
			<?php endif; ?>
		</div>
	    <footer>
		<p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |</p>
	    </footer>
	</body>
</html>