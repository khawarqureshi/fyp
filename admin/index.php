<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	header("location: login.php");
	$user = "";
}
else {
	$user = $_SESSION['admin_login'];
	$result = mysqli_query($conn, "SELECT * FROM admin WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}
$search_value = "";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to online pharmacy</title>

		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" 
		href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
		crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="/js/homeslideshow.js"></script>
	</head>
	<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
  <div class="container">
  <a class="navbar-brand font-weight-bold" href="index.php">Online Pharmacy</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <form id="newsearch" class="form-inline my-2 my-lg-0" method="get" action="search.php">
							<input type="text" class="form-control mr-sm-2" name="keywords"  maxlength="120"  placeholder="Search Here...">
							<input type="submit" value="search" class="btn btn-outline-success" >	
					</form>
    <ul class="navbar-nav ml-auto">
	<li class="ml-1">
	  <?php 
				if ($user!="") {
					echo '<a class="btn btn-success" href="profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
				}
				else {
					echo '<a class="btn btn-success" href="login.php">LOG IN</a>';
				}
				?>
	  </li>
	  <li class="ml-1">
	<!--   <?php
				if ($user!="") {

					echo '<a class="btn btn-primary" href="https://api.whatsapp.com/send?phone=03125544577">whatsapp</a>';
				} else {

					echo '<a href="signin.php" class="btn btn-success">whatsapp</a>';
				}
?> -->
	  </li>
	  <li class="nav-item ml-1">
				<?php 
				if ($user!="") {
					echo '<a class="btn btn-primary" href="logout.php">LOG OUT</a>';
				}
				else {
					echo '<a class="btn btn-outline-primary" href="signin.php">SIGN UP</a>';
				}
				?>
	  </li>
	  <li>
	</ul>
				
  </div>
  </div>
</nav>
<div class="d-flex justify-content-around  jumbotron">

<a href="index.php" class='btn btn-primary'>Home</a>

<a href="addproduct.php" class='btn btn-primary'>Add Product</a>
<a href="newadmin.php" class='btn btn-primary'>New Admin</a>
<a href="allproducts.php" class='btn btn-primary'>All Products</a>
<a href="orders.php" class='btn btn-primary'>Orders</a>
<a href="alert.php" class='btn btn-primary'>Send Alert</a>
<a href="analysis.php" class='btn btn-primary'>Analysis</a>
		</div>
		<div class="jumbotron text-center">
			
				<h1>Welcome To Admin Panel</h1>
			
		</div>
	</body>
</html>