<?php
include 'db_gallery.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the poll ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM images WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$image) {
        die ('Image doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete file & delete record
            unlink($image['path']);
            $stmt = $pdo->prepare('DELETE FROM images WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            // Output msg
            $msg = 'You have deleted the image!';
        } else {
            // User clicked the "No" button, redirect them back to the home/index page
            header('Location: index.php');
            exit;
        }
    }
} else {
    die ('No ID specified!');
}
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <div class="content delete">
            <h2>Delete Image #<?=$image['id']?></h2>
            <?php if ($msg): ?>
            <p><?=$msg?></p>
            <a href="home.php">back</a>
            <?php else: ?>
            <p>Are you sure you want to delete <?=$image['title']?>?</p>
            <div class="yesno">
                <a href="delete.php?id=<?=$image['id']?>&confirm=yes">Yes</a>
                <a href="delete.php?id=<?=$image['id']?>&confirm=no">No</a>
            </div>
            <?php endif; ?>
        </div>
	    <footer>
		<p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |</p>
	    </footer>
    </body>
</html>