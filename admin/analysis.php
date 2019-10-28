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

	$result = mysqli_query($conn,
		"SELECT DISTINCT category, GROUP_CONCAT(id) AS product_ids
		FROM `products`
		GROUP BY category");
	$categories = mysqli_fetch_all($result, true);

	$result = mysqli_query($conn,
		"SELECT DISTINCT pid, SUM(quantity) AS orders FROM orders GROUP BY pid");
	$product_orders = mysqli_fetch_all($result, true);

	$p_orders = [];
	foreach ($product_orders as $order) {
		$p_orders[$order['pid']] = $order['orders'];
	}

	$orders = [];
	foreach ($categories as $cat) {

		$cat_orders = 0;
		$p_ids = explode(',', $cat['product_ids']);

		foreach($p_ids as $id) {
			if (in_array($id, array_keys($p_orders))) {
				$cat_orders += (int)$p_orders[$id];
			}
		}

		$orders[$cat['category']] = $cat_orders;
	}
}
$search_value = "";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to online pharmacy</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="/js/homeslideshow.js"></script>
		<style type="text/css">
			*, *:before, *:after {
			  -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
			 }

			body {
			  background: #999;
			}

			h2 {
			  margin: 0 0 20px 0;
			  padding: 0 0 5px 0;
			  border-bottom: 1px solid #999;
			  font-family: sans-serif;
			  font-weight: normal;
			  color: #333;
			}

			.container {
			  width: 500px;
			  margin: 20px;
			  background: #fff;
			  padding: 20px;
			  overflow: hidden;
			  float: left;
			}

			.horizontal .progress-bar {
			  float: left;
			  height: 45px;
			  width: 100%;
			  padding: 12px 0;
			}

			.horizontal .progress-track {
			  position: relative;
			  width: 100%;
			  height: 20px;
			  background: #ebebeb;
			}

			.horizontal .progress-fill {
			  position: relative;
			  background: #666;
			  height: 20px;
			  width: 50%;
			  color: #fff;
			  text-align: center;
			  font-family: "Lato","Verdana",sans-serif;
			  font-size: 12px;
			  line-height: 20px;
			}

			.rounded .progress-track,
			.rounded .progress-fill {
			  border-radius: 3px;
			  box-shadow: inset 0 0 5px rgba(0,0,0,.2);
			}



			/* Vertical */

			.vertical .progress-bar {
			  float: left;
			  height: 300px;
			  width: 40px;
			  margin-right: 25px;
			}

			.vertical .progress-track {
			  position: relative;
			  width: 40px;
			  height: 100%;
			  background: #ebebeb;
			}

			.vertical .progress-fill {
			  position: relative;
			  background: #825;
			  height: 50%;
			  width: 40px;
			  color: #fff;
			  text-align: center;
			  font-family: "Lato","Verdana",sans-serif;
			  font-size: 12px;
			  line-height: 20px;
			}

			.rounded .progress-track,
			.rounded .progress-fill {
			  box-shadow: inset 0 0 5px rgba(0,0,0,.2);
			  border-radius: 3px;
			}
		</style>
	</head>
	<body style="min-width: 980px; background-image: url(../image/homebackgrndimg4.png);">
		<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none;color: #fff;" href="logout.php">LOG OUT</a>';
						}
						else {
							echo '<a style="text-decoration: none;color: #fff;" href="signin.php">SIGN UP</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none;color: #fff;" href="login.php">Hi '.$uname_db.'</a>';
						}
						else {
							echo '<a style="text-decoration: none;color: #fff;" href="login.php">LOG IN</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 75px; width: 130px;" src="../image/logo.png">
				</a>
			</div>
			<div class="">
				<div id="srcheader">
					<form id="newsearch" method="get" action="search.php">
					        <input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>
		<div class="categolis">
			<table>
				<tr>
					<th>
						<a href="index.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: #24bfae;border-radius: 12px;">Home</a>
					</th>
					<th><a href="addproduct.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Add Product</a></th>
					<th><a href="newadmin.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">New Admin</a></th>
					<th><a href="allproducts.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">All Products</a></th>
					<th><a href="orders.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Orders</a></th>
					<th><a href="alert.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Send Alert</a></th>
					<th><a href="analysis.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Analysis</a></th>
				</tr>
			</table>
		</div>

		<div class="container vertical flat">
			<h2>Sales Analysis (Feb)</h2>

		<?php foreach ($orders as $cat => $orders) { ?>

			<div class="progress-bar">
			    <div class="progress-track">
			    	<div class="progress-fill">
			        	<span><?=$orders?></span>
			    	</div>
			    </div>
			    <div><?=$cat?></div>
			</div>

		<?php } ?>

		</div>

		<script type="text/javascript">
			$('.horizontal .progress-fill span').each(function(){
			  var percent = $(this).html();
			  $(this).parent().css('width', percent);
			});


			$('.vertical .progress-fill span').each(function(){
			  var percent = $(this).html();
			  var pTop = 100 - ( percent.slice(0, percent.length - 1) ) + "%";
			  $(this).parent().css({
			    'height' : percent,
			    'top' : pTop
			  });
			});
		</script>
	</body>
</html>