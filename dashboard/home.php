<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE) {
	header('Location: index.php');
	exit();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1><a href="home.php"><i class="fas fa-percentage"></i><?=strtoupper($_SESSION['name'])?></a></h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<main role="main" class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>! Let's learn something new today!</p>
			<object data="data/example.pdf" type="application/pdf" width="100%" height="600vw" typemustmatch>
  				<p>You don't have a PDF plugin, but you can <a href="data/example.pdf">download the PDF file.</a></p>
			</object>
		</main>
		<?php
		include 'db_gallery.php';
		// Connect to MySQL
		$pdo = pdo_connect_mysql();
		// MySQL query that selects all the images
		$stmt = $pdo->query('SELECT * FROM images ORDER BY uploaded_date DESC');
		$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
		?>
		<div class="content home">
			<h2>Gallery</h2>
			<p>Welcome to the gallery page, you can view the list of images below.</p>
			<a href="upload.php" class="upload-image">Upload Image</a>
			<div class="images">
				<?php foreach ($images as $image): ?>
				<a href="#">
					<img src="<?=$image['path']?>" alt="<?=$image['description']?>" data-id="<?=$image['id']?>" data-title="<?=$image['title']?>" width="300" height="200">
					<span><?=$image['description']?></span>
				</a>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="image-popup"></div>
		<script>
		// Container we'll use to show an image
		let image_popup = document.querySelector('.image-popup');
		// Loop each image so we can add the on click event
		document.querySelectorAll('.images a').forEach(img_link => {
			img_link.onclick = e => {
				e.preventDefault();
				let img_meta = img_link.querySelector('img');
				let img = new Image();
				img.onload = () => {
					// Create the pop out image
					image_popup.innerHTML = `
						<div class="con">
							<h3>${img_meta.dataset.title}</h3>
							<p>${img_meta.alt}</p>
							<img src="${img.src}" width="${img.width}" height="${img.height}">
							<a href="delete.php?id=${img_meta.dataset.id}" class="trash" title="Delete Image"><i class="fas fa-trash fa-xs"></i></a>
						</div>
					`;
					image_popup.style.display = 'flex';
				};
				img.src = img_meta.src;
			};
		});
		// Hide the image popup container if user clicks outside the image
		image_popup.onclick = e => {
			if (e.target.className == 'image-popup') {
				image_popup.style.display = "none";
			}
		};
		</script>
	    <footer>
		<p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |</p>
	    </footer>
	</body>
</html>