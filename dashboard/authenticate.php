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
session_start();
include 'db_con.php';
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	redirect('Please fill both the username and password field!', 'index.php');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
}
if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) {
		// Verification success! User has loggedin!
		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		if (!empty($_POST['remember'])) {
			$lookup = base64_encode(random_bytes(9));
			$validator = base64_encode(random_bytes(18));
			if ($stmt2 = $con->prepare('UPDATE accounts SET lookup = ?, validator = ? WHERE username = ?')) {
				$stmt2->bind_param('sss', $lookup, hash("sha256", $validator), $_POST['username']);
				$stmt2->execute();
				$stmt2->close();
				$cook = $lookup.$validator;
				setcookie("member_login", $cook, time()+60*60*25*180);
			}
		}	
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
        $_SESSION['id'] = $id;
        header('Location: home.php');
	} else {
		redirect('Incorrect password!', 'index.php');
	}
} else {
	redirect('Incorrect username!', 'index.php');
}
$stmt->close();
// if(!empty($_POST['remember'])){
// 	setcookie("member_login", hash("sha256", $_POST['username']), time()+60*60*24*180);
// 	$newhash = hash("sha256", $_POST['username']);
// 	$querynew = "UPDATE accounts SET user_hash= ? where username = ?";
// 	$stmt = $con->prepare($querynew);
// 	$stmt->bind_param('ss', $newhash, $_POST['username']);
// 	$stmt->execute();
// } else {
// 	if(isset($_COOKIE["member_login"])){
// 		setcookie("member_login", "");
// 	}
// }
?>
