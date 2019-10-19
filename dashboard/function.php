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
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'test';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	die ('Failed to connect to database!');
    }
}
function dashboard_header($title, $session_name) {
  echo <<<EOT
    <!DOCTYPE html>
    <html>
    	<head>
    		<meta charset="utf-8">
    		<title>$title</title>
    		<link href="style.css" rel="stylesheet" type="text/css">
    		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    	</head>
    	<body class="loggedin">
    		<nav class="navtop">
    			<div>
    				<h1><a href="home.php"><i class="fas fa-percentage"></i>$session_name</a></h1>
    				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
    				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    			</div>
    		</nav>
  EOT;
}
function dashboard_footer() {
  echo <<<EOT
  <footer>
      <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |</p>
    <footer>
  </body>
</html>
EOT;
}
?>
