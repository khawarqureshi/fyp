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
?>

<!DOCTYPE html>
<html>
<head>
	<title>EyeInfection</title>
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
	<div class="container col-md-10">
		
		<?php 
			$getposts = mysqli_query($conn, "SELECT * FROM products WHERE available >='1' AND category ='EyeInfection'  ORDER BY id DESC LIMIT 10") or die(mysqli_error($conn));
					if (mysqli_num_rows($getposts)) {
					echo '<ul id="recs">';
					while ($row = mysqli_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						
						echo '
							
		<li style="float: left; class="list-group-item mb-1">
			<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'">
				<img src="../image/product/EyeInfection/'.$picture.'" 
				class="img-thumbnail">
				</a>
			
			</div>
			<div style="text-align: center; padding: 0 0 6px 0;"> 	
			<span style="font-size: 15px;">'.$pName.'</span>
			<br> Price: '.$price.' PKR</div>
		</li>
						
						';

						}
				}
		?>
			
	</div>
</body>
</html>