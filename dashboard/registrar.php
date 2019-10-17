<?php
function redirect($err_message, $url) {
	echo <<<EOT
	<p>$err_message</p>
	<p>You will be redirected<p>
	<script>
	setTimeout(function(){
	   window.location.href = '$url';
	}, 3000);
	</script>
	EOT;
}
include 'db_con.php';
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	// Could not get the data that should have been sent.
	redirect('Please complete the registration form!', "index.php");
}
// Make sure the submitted registration values are not empty.
elseif (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	// One or more values are empty.
	redirect('Please complete the registration form', "index.php");
}
elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	redirect('Email is not valid!', "index.php");
}
elseif (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
	redirect('Username is not valid!', "index.php");
}
elseif (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	redirect('Password must be between 5 and 20 characters long!', "index.php");
}

// We need to check if the account with that username exists.
else {
	if ($stmt = $con->prepare('SELECT id, password, fullname FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		redirect('Username exists, please choose another!', "index.php");
	} else {
		// Username doesnt exists, insert new account
		// Email Activation
		/*
		if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, fullname, activation_code) VALUES (?, ?, ?, ?, ?)')) {
		// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$uniqid = uniqid();
		$stmt->bind_param('sssss', $_POST['username'], $password, $_POST['email'], $_POST['fullname'], $uniqid);
		$stmt->execute();
		// Email Setup
		$from    = 'noreply@localhost';
		$subject = 'Account Activation Required';
		$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
		$activate_link = 'http://localhost/ea/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
		$message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
		mail($_POST['email'], $subject, $message, $headers);
		echo 'Please check your email to activate your account!';
		*/
		// No Activation
		if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, fullname) VALUES (?, ?, ?, ?)')) {
		// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$stmt->bind_param('ssss', $_POST['username'], $password, $_POST['email'], $_POST['fullname']);
		$stmt->execute();
		echo '<p>You have successfully registered, you can now login!</p>';
		echo '<p><b><a href="home.php">click here</a></b></p>';
		redirect("","home.php");
        } else {
		// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
		redirect('Could not prepare statement!', "index.php");
        }
    }
    $stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	redirect('Could not prepare statement!', "index.php");
}
}
$con->close();
?>
