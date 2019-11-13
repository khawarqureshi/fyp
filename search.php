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

if (isset($_REQUEST['keywords'])) {

	$epid = mysqli_real_escape_string($conn, $_REQUEST['keywords']);
	if($epid != "" && ctype_alnum($epid)){
		
	}else {
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

$search_value = "";
$search_value = trim($_GET['keywords']);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Headache</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" 
		href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
		crossorigin="anonymous">
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
	<div class="d-flex justify-content-around jumbotron">
				<a 
				role="button"
				class="btn btn-primary"
				href="category/Headache.php">Headache
				</a>
				<a 
				role="button" 
				class="btn btn-primary"
				href="category/Depression.php">Depression
				</a>
				<a 
				role="button" 
				class="btn btn-primary"
				href="category/Infection.php">Infection
				</a>

				<a 
				role="button" 
				class="btn btn-primary"
				href="category/Nutritional.php">Nutritional
				</a>
				<a 
				role="button" 
				class="btn btn-primary" 
				href="category/Orthopedic.php">Orthopedic
				</a>
				<a 
				role="button" 
				class="btn btn-primary" 
				href="category/Allergy.php">Allergy
				</a>
				<a 
				role="button" 
				class="btn btn-primary" 
				href="category/Nausea.php">Nausea
				</a>
				<a 
				role="button" 
				class="btn btn-primary" 
				href="category/EyeInfection.php">EyeInfection
				</a>
	
		
	</div>
	<div class="container mt-3">
		<div>
		<?php 
			if (isset($_GET['keywords']) && $_GET['keywords'] != ""){
				$search_value = trim($_GET['keywords']);
				$getposts = mysqli_query($conn, "SELECT * FROM products WHERE pName like '%$search_value%' OR formula like '%$search_value%'  ORDER BY id DESC") or die(mysqli_error($conn));
					if ( $total = mysqli_num_rows($getposts)) {
					echo '<div class="text-center alert alert-secondary"> 
					'.$total.' Products Found... </div>';
					while ($row = mysqli_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$formula = $row['formula'];
						$category = $row['category'];
						
						
						echo '
							<ul>
								<li class="list-group-item">
									<div class="home-prodlist-img">
									<a href="category/view_product.php?pid='.$id.'">
										<img src="image/product/'.$category.'/'.$picture.'" class="img-thumbnail">
									</a>
									</div>
									<div> 
										<span style="font-size: 15px;">'.$pName.'</span>
										<br> 
										<h1>Price: '.$price.' PKR</h1>
										</div>
								</li>
							</ul>
						';

						}
				}else {
				echo "<div class='alert alert-danger'>Nothing Found!</div>";
			}
			}else {
				echo "Input Something...";
			}
			
		?>
			
		</div>
	</div>
</body>
</html>