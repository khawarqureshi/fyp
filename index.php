<?php include ( "inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($conn, "SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Online Pharmacy</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" 
		href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
		crossorigin="anonymous">
		<script src="/js/homeslideshow.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
  <div class="container">
  <a class="navbar-brand font-weight-bold" href="#">Online Pharmacy</a>
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
	  <?php
				if ($user!="") {

					echo '<a class="btn btn-primary" href="https://api.whatsapp.com/send?phone=03125544577">Watsapp</a>';
				} else {

					echo '<a href="signin.php" class="btn btn-success">Watsapp</a>';
				}
?>
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
			
<div class="jumbotron jumbotron-fluid ">
  <div class="container text-center">
	<h1 class="display-4">Welcome to <span class="text-success"> Online Pharmacy</span></h1>
	<hr class="bg-success"/>
    <p class="lead alert alert-success fit-content">Pakistan No. 1 <span class='text-primary font-weight-bold'>Pharmacy</span> Website.</p>
  </div>
</div>
		<div class="home-prodlist">
			<div>
				<h3 class="text-center font-weight-bold text-info">Products Category</h3>
				<hr/>
			</div>
			<div class="container">
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="category/Headache.php">
							<img src="./image/product/Headache/HeadImage.jpg" class="img-thumbnail">
							</a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="category/Nutritional.php">
							<img src="./image/product/Nutritional/NutritionImage.png" class="img-thumbnail">
							</a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="category/Orthopedic.php">
							<img src="./image/product/Orthopedic/OrthoImage.jpg" class="img-thumbnail"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="category/EyeInfection.php">
							<img src="./image/product/EyeInfection/EyeInfect.jpg" class="img-thumbnail"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="category/Nausea.php">
							<img src="./image/product/Nausea/NauseaImage.jpg" class="img-thumbnail"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="category/Allergy.php">
							<img src="./image/product/Allergy/AlergyImage.jpg" class="img-thumbnail"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="category/Infection.php">
							<img src="./image/product/Infection/infectImage.jpg" class="img-thumbnail"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="category/Depression.php">
							<img src="./image/product/Depression/depImage.jpg" class="img-thumbnail"></a>
						</div>
					</li>
				</ul>
			</div>			
		</div>
	</body>
</html>