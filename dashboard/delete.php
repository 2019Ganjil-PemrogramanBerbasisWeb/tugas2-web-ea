<?php
session_start();
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != TRUE) {
	header('Location: index.php');
	exit();
}
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the poll ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM images WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$image) {
				$msg = 'Image doesn\'t exist with that ID!';
        redirect('', 'home.php');
    }
    // Make sure the user confirms before deletion
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
            header('Location: home.php');
            exit;
        }
    }
} else {
    die ();
		redirect('No ID specified!', 'home.php');
}
dashboard_header("Delete Image", strtoupper($_SESSION['name']));
?>
  <div class="content delete">
    <h2>Delete Image #<?=$image['id']?></h2>
		<?php	if ($msg=='You have deleted the image!'): ?>
			<p style="background: #38b673; color: white;"><?=$msg?></p>
			<?php redirect(NULL, 'home.php')?>
		<?php elseif(!empty($msg)): ?>
			<p style=\"background: red; color: white;\"><?=$msg?></p>
		<?php else:?>
			<p>Are you sure you want to delete <?=$image['title']?>?</p>
      <div class="yesno">
      	<a href="delete.php?id=<?=$image['id']?>&confirm=yes">Yes</a>
      	<a href="delete.php?id=<?=$image['id']?>&confirm=no">No</a>
      </div>
		<?php endif; ?>
  </div>
<?=dashboard_footer()?>
