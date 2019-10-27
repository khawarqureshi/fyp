<?php include ( "inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($conn, "SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$uemail_db = $get_user_email['email'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}

if (isset($_REQUEST['uid'])) {
	
	$user2 = mysqli_real_escape_string($conn, $_REQUEST['uid']);
	if($user != $user2){
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

$search_value = "";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Headache</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" 
		href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
		crossorigin="anonymous">
		<script src="/js/homeslideshow.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

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


<div class="d-flex justify-content-around  jumbotron">
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
















	<div>
		<div class="container">				
		<?php echo '<a class="btn btn-primary btn-block" href="profile.php?uid='.$user.'"  >My Orders</a>'; ?>
		<?php echo '<a class="btn btn-primary btn-block" href="settings.php?uid='.$user.'" >Settings</a>'; ?>
			
					<div>
						<div class="mt-3 container">
							<table class="table table-hover">
								<tr>
									<th>Product Name</th>
									<th>Price</th>
									<th>Total Product</th>
									<th>Order Date</th>
									<th>Delivery Date</th>
									<th>Delivery Place</th>
									<th>Delivery Status</th>
									<th>View</th>
								</tr>
								<tr>
									<?php include ( "inc/connect.inc.php");
									$query = "SELECT * FROM orders WHERE uid='$user' ORDER BY id DESC";
									$run = mysqli_query($conn, $query);
									while ($row=mysqli_fetch_assoc($run)) {
										$pid = $row['pid'];
										$quantity = $row['quantity'];
										$oplace = $row['oplace'];
										$mobile = $row['mobile'];
										$odate = $row['odate'];
										$ddate = $row['ddate'];
										$dstatus = $row['dstatus'];
										
										//get product info
										$query1 = "SELECT * FROM products WHERE id='$pid'";
										$run1 = mysqli_query($conn, $query1);
										$row1=mysqli_fetch_assoc($run1);
										$pId = $row1['id'];
										$pName = substr($row1['pName'], 0,50);
										$price = $row1['price'];
										$picture = $row1['picture'];
										$formula = $row1['formula'];
										$category = $row1['category'];
									 ?>
									<td><?php echo $pName; ?></td>
									<td><?php echo $price; ?></td>
									<td><?php echo $quantity; ?></td>
									<td><?php echo $odate; ?></td>
									<td><?php echo $ddate; ?></td>
									<td><?php echo $oplace; ?></td>
									<td><?php echo $dstatus; ?></td>
									<td><?php echo 
									'<div class="profile-img"><a href="'.$category.'/view_product.php?pid='.$pId.'">
									<img src="image/product/'.$formula.'/'.$picture.'" 
									class="img-thumbnail"
									>
													</a>
												</div>' ?>
									</td>
								</tr>
								<?php } ?>
							</table>
						</div>
					</div>
			
		</div>
	</div>

	
</body>
</html>