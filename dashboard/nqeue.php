<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = $_GET['n'];
$query = $_GET['q'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * $query";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row . "<br>";
    }
} else {
    echo $result;
}
$conn->close();
?>
