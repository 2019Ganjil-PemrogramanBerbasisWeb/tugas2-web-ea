<?php // Shared Header & Footer
function template_header($title) {
echo <<<EOT
<!doctype html>
<html lang="en">
  <head>
    <title>$title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,900" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <header role="banner">
      <nav class="navbar navbar-expand-md navbar-dark bg-light">
        <div class="container">
          <a class="navbar-brand absolute" href="index.php">e-Learning Academy</a>
			    <div class="navbar">			
            <ul class="navbar-nav absolute-right">
			        <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
              </li>
              <li class="nav-item">
                <a href="dashboard/index.html" class="nav-link">Login</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
<!-- END HEADER -->
EOT;
}

function template_footer() {
echo <<<EOT
<!-- START FOOTER -->
<footer class="site-footer" style="background-image: url(images/big_image_3.svg);">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-4">
        <h3>About</h3>
        <p>EA is acronym e-Learning Academy and this is our Website for Middle Exam in Web-based programming courses.</p>
      </div>
      <div class="col-md-6 ml-auto">
        <div class="row">
          <div class="col-md-4" style="margin-left: 100px">
            <ul class="list-unstyled">
              <li><a href="about.php">About Us</a></li>
              <li><a href="contact.php">Contact Us</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
      </div>
    </div>
  </div>
</footer>
<!-- END FOOTER -->

    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    
    <script src="js/main.js"></script>
  </body>
</html>
EOT;
}
?>