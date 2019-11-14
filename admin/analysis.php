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

	$where = $from = $to = '';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$from = $_POST['from'];
		$to = $_POST['to'];
		$where .= "WHERE odate BETWEEN '$from' AND '$to'";
	}

	$result = mysqli_query($conn,
		"SELECT DISTINCT pid, SUM(quantity) AS orders FROM orders $where GROUP BY pid");
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
		<link rel="stylesheet" 
		href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
		crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
			  width: 97%;
			  margin: 20px;
			  background: #fff;
			  padding: 20px;
			  overflow: hidden;
			  float: left;
			  height: 435px;
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
			  margin-right: 70px;
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
	<body>
	<nav class="navbar navbar-light bg-light shadow-lg">
	<div>
	<a class="navbar-brand" href="login.php">
		Online Pharmacy
  </a>
  <!-- <form id="newsearch" class='form-inline my-2' method="get" action="search.php">
				        <?php 
				        	echo '<input type="text" class="form-control mr-sm-2" name="keywords" size="21" maxlength="120"  placeholder="Search Here..." value="'.$search_value.'"><input type="submit" value="search" class="srcbutton" >';
				         ?>
				</form> -->
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

		<div class="container vertical flat">
			<div style="float: right; margin-right: 20px">
				<form action="" method="post">
					<b>From</b>
					<input type="date" name="from" value="<?=$from?>" required>

					<b>To</b>
					<input type="date" name="to" value="<?=$to?>" required>

					<input type="submit" name="submit" value="Update">
				</form>
			</div>
			<h2>Sales Analysis</h2>

		<?php foreach ($orders as $cat => $orders) { ?>

			<div class="progress-bar">
			    <div class="progress-track">
			    	<div class="progress-fill">
			        	<span><?= $orders * 10 ?></span>
			    	</div>
			    </div>
			    <div style="margin-top: 10px"><?=$cat?></div>
			</div>

		<?php } ?>

		</div>

		<script type="text/javascript">
			$('.horizontal .progress-fill span').each(function(){
			  var percent = $(this).html();
			  $(this).parent().css('width', percent);
			});


			$('.vertical .progress-fill span').each(function(){
			  var percent = $(this).html() + '%';
			  var pTop = 100 - ( percent.slice(0, percent.length - 1) ) + "%";
			  $(this).parent().css({
			    'height' : percent,
			    'top' : pTop
			  });
			});
		</script>
	</body>
</html>