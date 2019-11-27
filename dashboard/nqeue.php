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

$result = $conn->query($query);

if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}

if ($result->num_rows > 0) {
    // output data of each row
    while($rows = $result->fetch_assoc()) {
        foreach ($rows as $rows['id'] => $row) {
            echo $row,"<br>";
        }
    }
} else {
    echo $result;
}
$conn->close();
?>
