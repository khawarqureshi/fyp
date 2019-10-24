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
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-image: url(image/homebackgrndimg1.png);">
	<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="logout.php">LOG OUT</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="signin.php">SIGN UP</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 75px; width: 130px;" src="image/logo.png">
				</a>
			</div>
			<div id="srcheader">
				<form id="newsearch" method="get" action="search.php">
				        <?php 
				        	echo '<input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..." value="'.$search_value.'"><input type="submit" value="search" class="srcbutton" >';
				         ?>
				</form>
			<div class="srcclear"></div>
			</div>
		</div>
	<div class="categolis">
		<table>
			<tr>
				<th>
					<a href="category/Headache.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Headache</a>
				</th>
				<th><a href="category/Depression.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Depression</a></th>
				<th><a href="category/Infection.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Infection</a></th>
				<th><a href="category/Nutritional.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Nutritional</a></th>
				<th><a href="category/Orthopedic.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Orthopedic</a></th>
				<th><a href="category/Allergy.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Allergy</a></th>
				<th><a href="category/Nausea.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Nausea</a></th>
				<th><a href="category/EyeInfection.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">EyeInfection</a></th>
			</tr>
		</table>
	</div>
	<div style="margin-top: 20px;">
		<div style="width: 900px; margin: 0 auto;">
		
			<ul>
				<li style="float: left;">
					<div class="settingsleftcontent">
						<ul>
							<ul>
							<li><?php echo '<a href="profile.php?uid='.$user.'" style=" background-color: #169e8f; border-radius: 4px; color: #fff;" >My Orders</a>'; ?></li>
							<li><?php echo '<a href="settings.php?uid='.$user.'" >Settings</a>'; ?></li>
						</ul>
						</ul>
					</div>
				</li>
				<li style="float: right; background-color: #fff;">
					<div>
						<div>
							<table class="rightsidemenu">
								<tr style="font-weight: bold;" colspan="10" bgcolor="#3A5487">
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
									<th><?php echo $pName; ?></th>
									<th><?php echo $price; ?></th>
									<th><?php echo $quantity; ?></th>
									<th><?php echo $odate; ?></th>
									<th><?php echo $ddate; ?></th>
									<th><?php echo $oplace; ?></th>
									<th><?php echo $dstatus; ?></th>
									<th><?php echo '<div class="home-prodlist-img"><a href="'.$category.'/view_product.php?pid='.$pId.'">
													<img src="image/product/'.$formula.'/'.$picture.'" class="home-prodlist-imgi" style="height: 75px; width: 75px;">
													</a>
												</div>' ?></th>
								</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>

	
</body>
</html>