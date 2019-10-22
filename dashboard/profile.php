<?php
if(isset($_POST['submit'])){
	$response = '';
	if (isset($_POST['email'], $_POST['subject'], $_POST['name'], $_POST['msg'])) {
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$response = 'Email is not valid!';
		} else if (empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['name']) || empty($_POST['msg'])) {
			$response = 'Please complete all fields!';
		} else {
			$to      = 'ea-contact@localhost';
			$from    = $_POST['email'];
			$subject = $_POST['subject'];
			$message = $_POST['msg'];
			$headers = 'From: ' . $_POST['email'] . "\r\n" . 'Reply-To: ' . $_POST['email'] . "\r\n" . 'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers); //Nunggu mail server online
			$response = 'Message sent!';
		}
	}
}

// We need to use sessions, so you should always start sessions using the below code.
session_start();
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != TRUE) {
	header('Location: index.php');
	exit();
}
include 'db_con.php';
include 'function.php';
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email, fullname FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $fullname);
$stmt->fetch();
$stmt->close();
dashboard_header(Profile Page);
?>
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
			<?php
			if (isset($response) && $response=='Message sent!') {
				echo "<p style=\"background: #38b673; color: white;\">$response</p>";
			} elseif(isset($response) && !empty($response)) {
				echo "<p style=\"background: red; color: white;\">$response</p>";
			} ?>
			<div>
				<form class="contact" method="post" action="profile.php">
					<input type="email" name="email" placeholder="Your Email Address" required>
					<input type="text" name="name" placeholder="Your Name" required>
					<input type="text" name="subject" placeholder="Subject" required>
					<textarea name="msg" placeholder="What would you like to contact us about?" required></textarea>
					<input type="submit" name="submit" value="submit">
				</form>
			</div>
		</div>
<?=dashboard_footer()?>
