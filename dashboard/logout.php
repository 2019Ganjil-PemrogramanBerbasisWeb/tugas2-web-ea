<?php
session_start();
if(isset($_COOKIE["member_login"])){
    include 'db_con.php';
    if ($stmt = $con->prepare("UPDATE accounts SET lookup = NULL, validator = NULL where lookup = ?")) {
        $lookup = substr($_COOKIE['member_login'], 0, 12);
        $stmt->bind_param("s", $lookup);
        $stmt->execute();
        $stmt->close();
        setcookie("member_login", "", time()-100);
    }
}
session_destroy();

// Redirect to the login page:
header('Location: index.php');
?>