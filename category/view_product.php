<?php include ( "../inc/connect.inc.php" ); ?>
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
if (isset($_REQUEST['pid'])) {
	
	$pid = mysqli_real_escape_string($conn, $_REQUEST['pid']);
}else {
	header('location: index.php');
}

$formula = $price = $picture = $pName = $description = $category = '';

$getposts = mysqli_query($conn, "SELECT * FROM products WHERE id ='$pid'") or die(mysqli_error($conn));
					if (mysqli_num_rows($getposts)) {
						$row = mysqli_fetch_assoc($getposts);
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$formula = $row['formula'];

						$category =$row['category'];
					}	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include ( "../inc/mainheader.inc.php" ); ?>

	<div class="d-flex justify-content-around  jumbotron">
				<a 
				role="button"
				class="btn btn-primary"
				href="Headache.php">Headache
				</a>
				<a 
				role="button" 
				class="btn btn-primary"
				href="Depression.php">Depression
				</a>
				<a 
				role="button" 
				class="btn btn-primary"
				href="Infection.php">Infection
				</a>

				<a 
				role="button" 
				class="btn btn-primary"
				href="Nutritional.php">Nutritional
				</a>
				<a 
				role="button" 
				class="btn btn-primary" 
				href="Orthopedic.php">Orthopedic
				</a>
				<a 
				role="button" 
				class="btn btn-primary" 
				href="Allergy.php">Allergy
				</a>
				<a 
				role="button" 
				class="btn btn-primary" 
				href="Nausea.php">Nausea
				</a>
				<a 
				role="button" 
				class="btn btn-primary" 
				href="EyeInfection.php">EyeInfection
				</a>
	</div>					



	<div>

		<?php 
			echo '
				<div class="d-flex">
				<div class="home-prodlist-img col-md-4">
					<img class="img-thumbnail" 
					src="../image/product/'.$category.'/'.$picture.'">
				</div>
				<div class="card col-md-8">
						<h3 class="card-header" >'.$pName.'</h3>
						<hr>
						<h5 >Prize: '.$price.' PKR</h5>
						<hr/>
						<h3>Description:</h3>
						<p>
							'.$description.'
						</p>
						<hr/>
						<div>
							<h3>Want to buy this product? </h3>
							<div id="srcheader">
								<form id=""
								method="post" 
								action="../orderform.php?poid='.$pid.'">
							<input 
							type="submit" 
							value="Order Now" class="btn btn-outline-info btn-block mb-1" >
								</form>
								
							</div>
						</div>

					
				</div>
				</div>
			';
		?>

	</div>
	<div class="container">
		<h3>Recommand Product For You:</h3>
		<div>
		<?php 
			$getposts = mysqli_query($conn, "SELECT * FROM products WHERE available >='1' AND id != '".$pid."' AND formula ='".$formula."'  ORDER BY RAND() LIMIT 3") or die(mysqli_error($conn));
					if (mysqli_num_rows($getposts)) {
					echo '<ul id="recs">';
					while ($row = mysqli_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						
						echo '
							<ul style="float: left;">
								<li class="list-group-item">
									<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'">
										<img 
										src="../image/product/'.$category.'/'.$picture.'" 
										class="img-thumbnail">
										</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' PKR</div>
									</div>
									
								</li>
							</ul>
						';

						}
				}
		?>
			
		</div>
	</div>
</body>
</html>
