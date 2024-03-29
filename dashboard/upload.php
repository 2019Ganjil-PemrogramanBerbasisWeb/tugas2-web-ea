<?php
session_start();
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != TRUE) {
	header('Location: index.php');
	exit();
}
include 'function.php';
// The output message
$msg = '';
// Check if user has uploaded new image
if (isset($_FILES['image'], $_POST['title'], $_POST['description'])) {
	// The folder where the images will be stored
	$target_dir = 'images/';
	// The path of the new uploaded image
	$image_path = $target_dir . basename($_FILES['image']['name']);
	// Check to make sure the image is valid
	if (!empty($_FILES['image']['tmp_name']) && getimagesize($_FILES['image']['tmp_name'])) {
		if (file_exists($image_path)) {
			$msg = 'Image already exists, please choose another or rename that image.';
		} else if ($_FILES['image']['size'] > 500000) {
			$msg = 'Image file size too large, please choose an image less than 500kb.';
		} else {
			// Everything checks out now we can move the uploaded image
			move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
			// Connect to MySQL
			$pdo = pdo_connect_mysql();
			// Insert image info into the database (title, description, image path, and date added)
			$stmt = $pdo->prepare('INSERT INTO images VALUES (NULL, ?, ?, ?, CURRENT_TIMESTAMP)');
	        $stmt->execute([$_POST['title'], $_POST['description'], $image_path]);
			$msg = 'Image uploaded successfully!';
		}
	} else {
		$msg = 'Please upload an image!';
	}
}
dashboard_header("Upload Image", strtoupper($_SESSION['name']));
?>
		<div class="content upload">
			<h2>Upload Image</h2>
			<?php
			if ($msg=='Image uploaded successfully!') {
				echo "<p style=\"background: #38b673; color: white;\">$msg</p>";
			} elseif(!empty($msg)) {
				echo "<p style=\"background: red; color: white;\">$msg</p>";
			} ?>
			<form action="upload.php" method="post" enctype="multipart/form-data">
				<label for="image">Choose Image</label>
				<input type="file" name="image" accept="image/*" id="image">
				<label for="title">Title</label>
				<input type="text" name="title" id="title">
				<label for="description">Description</label>
				<textarea name="description" id="description"></textarea>
				<input type="submit" value="Upload Image" name="submit">
			</form>
		</div>
<?=dashboard_footer()?>
