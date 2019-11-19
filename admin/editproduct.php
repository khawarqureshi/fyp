<?php include ( "../inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	$user = "";
	header("location: login.php?ono=".$epid."");
}
else {
	if (isset($_REQUEST['epid'])) {
	
		$epid = mysqli_real_escape_string($conn, $_REQUEST['epid']);
	
	}
	else {
		header('location: index.php');
	}
	$user = $_SESSION['admin_login'];
	$result = mysqli_query($conn, "SELECT * FROM admin WHERE id='$user'");
	$get_user_email = mysqli_fetch_assoc($result);
		$uname_db = $get_user_email['firstName'];

}
$getposts = mysqli_query($conn, "SELECT * FROM products WHERE id ='$epid'") or die(mysqli_error($conn));
	if (mysqli_num_rows($getposts)) {
		$row = mysqli_fetch_assoc($getposts);
		$id = $row['id'];
		$pName = $row['pName'];
		$price = $row['price'];
		$description = $row['description'];
		$picture = $row['picture'];
		$formula = $row['formula'];
		$itemu = ucwords($row['formula']);
		$type = $row['type'];
		$typeu = ucwords($row['type']);
		$category = $row['category'];
		$categoryu = ucwords($row['category']);
		$code = $row['pCode'];
		$available =$row['available'];
	}	

//update product
$pname = $price = $availble = $category = $type = $formula = $pcode = "";

if (isset($_POST['updatepro'])) {
	$pname = $_POST['pname'];
	$price = $_POST['price'];
	$available = $_POST['available'];
	$category = $_POST['category'];
	$type = $_POST['type'];
	$formula = $_POST['formula'];
	$pCode = $_POST['code'];
	//triming name
	$_POST['pname'] = trim($_POST['pname']);

	if($result = mysqli_query($conn, "UPDATE products SET pName='$_POST[pname]',price='$_POST[price]',description='$_POST[descri]',available='$_POST[available]',category='$_POST[category]',type='$_POST[type]',formula='$_POST[formula]',pCode='$_POST[code]' WHERE id='$epid'")){
		header("Location: editproduct.php?epid=".$epid."");

	}else {
		echo "no changed";
	}
}
if (isset($_POST['updatepic'])) {

if($_FILES['profilepic'] == ""){
	
		echo "not changed";
}else {
	//finding file extention
$profile_pic_name = @$_FILES['profilepic']['name'];
$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

if (((@$_FILES['profilepic']['type']=='image/jpeg') || (@$_FILES['profilepic']['type']=='image/png') || (@$_FILES['profilepic']['type']=='image/jpg') || (@$_FILES['profilepic']['type']=='image/gif')) && (@$_FILES['profilepic']['size'] < 1000000)) {

	$category = $category;
	if (file_exists("../image/product/$category")) {
		//nothing
	}else {
		mkdir("../image/product/$category");
	}
	
	
	$filename = strtotime(date('Y-m-d H:i:s')).$file_ext;

	if (file_exists("../image/product/$category/".$filename)) {
		echo @$_FILES["profilepic"]["name"]."Already exists";
	}else {
		if(move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "../image/product/$category/".$filename)){
			$photos = $filename;
			if($result = mysqli_query($conn, "UPDATE products SET picture='$photos' WHERE id='$epid'")){

				$delete_file = unlink("../image/product/$category/".$picture);
				header("Location: editproduct.php?epid=".$epid."");
			}else {
				echo "Wrong!";
			}
		}else {
			echo "Something Worng on upload!!!";
		}
		//echo "Uploaded and stored in: userdata/profile_pics/$item/".@$_FILES["profilepic"]["name"];
		
		
	}
	}
	else {
		$error_message = "Choose a picture!";
	}

}
}



if (isset($_POST['delprod'])) {
//triming name
	$getposts1 = mysqli_query($conn, "SELECT pid FROM orders WHERE pid='$epid'") or die(mysqli_error());
					if ($ttl = mysqli_num_rows($getposts1)) {
						$error_message = "You can not delete this product.<br>Someone ordered this.";
					}
					else {
						if(mysqli_query($conn, "DELETE FROM products WHERE id='$epid'")){
						header('location: orders.php');
						}
					}
	}

$search_value = "";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Medicine</title>
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
	<div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
		<div class="container signupform_content ">
			<div>

				<h2 class="text-center alert alert-success">Edit Product Info</h2>
				<div style="float: right;">
				<?php 
					echo '
						<div class="">
						<div class="signupform_text"></div>
						<div>
<form action="" method="POST" class="registration">
<div class="signup_form">
<div class="form-group">
<input name="pname" id="first_name" placeholder="Product Name" required="required" class="first_name form-control" type="text" size="30" value="'.$pName.'" >
</div>

<div class="form-group">
<input name="price" id="last_name" placeholder="Price" required="required" class="last_name form-control" type="text" size="30" value="'.$price.'" >
</div>

<div class="form-group">
<input name="formula" placeholder="formula" required="required" class="last_name form-control" type="text" size="30" value="'.$itemu.'" >
</div>
	

<div class="form-group">
<input name="available" placeholder="Available Quantity" required="required" class="email form-control" type="text" size="30" value="'.$available.'">
</div>
<div class="form-group">

<input name="descri" id="first_name" placeholder="Description" required="required" class="first_name form-control" type="text" size="30" value="'.$description.'" >
</div>
	<div class="form-group">
<select name="category" class="form-control" required="required" >
<option selected value="'.$category.'">'.$categoryu.'</option>
                <!-- <option value="category">category</option> -->
                <option value="Headache">Headache</option>
				<option value="Depression">Depression</option>
				<option value="Infection">Infection</option>
				<option value="Allergy">Allergy</option>
				<option value="Orthopedic">Orthopedic</option>
				<option value="Nutritional">Nutritional</option>
				<option value="Nausea">Nausea</option>
				<option value="EyeInfection">EyeInfection</option>
				<!-- <option value="Other">Other</option> -->
			</select>
		</div>
	<div class="form-group">
		<select name="type" required="required"  class="form-control">
			<option selected value="'.$type.'">'.$typeu.'</option>
				
				
				<option value="Tablet">Tablet</option>
				<option value="Syrup">Syrup</option>
				<option value="Drops">Drops</option>
				<option value="Injection">Injection</option>

			
			</select>
	</div>



	<!-- <div>
			    <select name="formula" class="form-control" required>
				<option selected value="'.$formula.'">'.$itemu.'</option>
			
			</select>
		</div> -->


	            <div>
				<input name="code" id="password-1" required="required"  placeholder="Code" class="password form-control " type="text" size="30" value="'.$code.'">
				</div>
	<div>
		<input name="updatepro" class="btn btn-success btn-block mb-2 mt-2" type="submit" value="Update Product">
	</div>
	<div>
		<input name="delprod" class="btn btn-danger btn-block" type="submit" value="Delete This Product">
	</div>
	<div class="signup_error_msg">
		<?php 
			if (isset($error_message)) {echo $error_message;}
			
		?>
	</div>
</div>
</form>
						</div>
					</div>

					';
					if(isset($success_message)) {echo $success_message;}

				 ?>
					
				</div>
			</div>
		</div>
		<div style="float: left;">
			<div>
				<?php
					echo '
						<ul style="float: left;">
							<li style="float: left; padding: 0px 25px 25px 25px;list-style:none;">
								<div class="home-prodlist-img prodlist-img">';
								if (file_exists('../image/product/'.$category.'/'.$picture.'')){
									echo '<img src="../image/product/'.$category.'/'.$picture.'" class="home-prodlist-imgi">';
								}else {
									echo '
									<div class="alert alert-warning mt-2 btn-block">No Image Found!</div>';
								} echo '
									
								</div>
							</li>
							<li style="list-style:none">
								<form action="" method="POST" class="registration" enctype="multipart/form-data">
										<div class="signup_form">
<div class="form-group">
<input name="profilepic"  class="form-control" type="file" value="Add Picture">
</div>
<div>
<input name="updatepic" style="width: 144px;" class="btn btn-outline-info" type="submit" value="Change Picture">
</div>
											<div class="signup_error_msg">';
											if(isset($error_message)) {echo $error_message;}
											' </div>
										</div>
									</form>
							</li>
						</ul>
					';
				?>
			</div>

		</div>
	</div>
</body>
</html>