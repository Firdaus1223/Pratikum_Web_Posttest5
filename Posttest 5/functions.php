<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'posttest5';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Pemesanan</h1>
            <a href="index.php"><i class="fas fa-home"></i>Home</a>
    		<a href="read.php"><i class="fa fa-shopping-cart"></i>Order</a>
			<a href="../Posttest 4/posttest4.php"> <i class="fa fa-list"></i>posttest4</a>
    	</div>
    </nav>
	<div class="footer-basic">
	<footer>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a class="button" href="#popup1">Services</a></li>
			<li><a href="../Posttest 4/about.php">About</a></li>
			<li><a class="button" href="#popup1">Terms</a></li>
			<li><a class="button" href="#popup1">Privacy Policy</a></li>
		</ul>
		<p class="copyright">Muhammad Firdaus © 2022</p>
	</footer>
</div>
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>