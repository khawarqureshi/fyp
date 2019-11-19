


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

if (isset($_POST['signup'])) {
//declere veriable
$u_fname = $_POST['first_name'];
$u_lname = $_POST['last_name'];
$u_email = $_POST['email'];
$u_mobile = $_POST['mobile'];
$u_address = $_POST['signupaddress'];
//triming name
$_POST['first_name'] = trim($_POST['first_name']);
$_POST['last_name'] = trim($_POST['last_name']);
	try {
		if(empty($_POST['first_name'])) {
			throw new Exception('Fullname can not be empty');
			
		}
		if (is_numeric($_POST['first_name'][0])) {
			throw new Exception('Please write your correct name!');

		}
		if(empty($_POST['last_name'])) {
			throw new Exception('Lastname can not be empty');
			
		}
		if (is_numeric($_POST['last_name'][0])) {
			throw new Exception('lastname first character must be a letter!');

		}
		if(empty($_POST['email'])) {
			throw new Exception('Email can not be empty');
			
		}
		if(empty($_POST['mobile'])) {
			throw new Exception('Mobile can not be empty');
			
		}
		if(empty($_POST['password'])) {
			throw new Exception('Password can not be empty');
			
		}
		if(empty($_POST['admintype'])) {
			throw new Exception('Admin Type can not be empty');
			
		}
		if(empty($_POST['signupaddress'])) {
			throw new Exception('Address can not be empty');
			
		}

		
		// Check if email already exists
		
		$check = 0;
		$e_check = mysqli_query($conn, "SELECT email FROM `admin` WHERE email='$u_email'");
		$email_check = mysqli_num_rows($e_check);
		if (strlen($_POST['first_name']) >2 && strlen($_POST['first_name']) <16 ) {
			if ($check == 0 ) {
				if ($email_check == 0) {
					if (strlen($_POST['password']) >4 ) {
						$d = date("Y-m-d"); //Year - Month - Day
						$_POST['first_name'] = ucwords($_POST['first_name']);
						$_POST['last_name'] = ucwords($_POST['last_name']);
						$_POST['password'] = md5($_POST['password']);
						$confirmCode   = substr( rand() * 900000 + 100000, 0, 6 );
						// send email
						$msg = "
						Assalamu Alaikum...
						
						Your activation code: ".$confirmCode."
						Signup email: ".$_POST['email']."
						
						";
						//if (@mail($_POST['email'],"eBuyBD Activation Code",$msg, "From:eBuyBD <no-reply@ebuybd.xyz>")) {
							
						$result = mysqli_query("INSERT INTO admin (firstName,lastName,email,mobile,address,password,type,confirmCode) VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[email]','$_POST[mobile]','$_POST[signupaddress]','$_POST[password]','$_POST[admintype]','$confirmCode')");
						
						//success message
						$success_message = '
						<div class="signupform_content"><h2><font face="bookman">Admin Registration Successfull!</font></h2>
						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">
							Email: '.$u_email.'<br>
							Account Successfully Created. <br>
						</font></div></div>';
						//}else {
						//	throw new Exception('Email is not valid!');
						//}
						
						
					}else {
						throw new Exception('Password must be 5 or more then 5 characters!');
					}
				}else {
					throw new Exception('Email already taken!');
				}
			}else {
				throw new Exception('Username already taken!');
			}
		}else {
			throw new Exception('Firstname must be 2-15 characters!');
		}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}

$search_value = "";
?>


<!doctype html>
<html>
	<head>
		<title>Welcome to online pharmacy</title>
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
		<?php 
			if(isset($success_message)) {echo $success_message;}
			else {
				echo '
					<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 20px;">
						<div class="container">
							<div>
								<div>
									<div class="signupform_content">
										<h2 class="text-center alert alert-success">New Admin Form!</h2>
										<div class="signupform_text"></div>
										<div>
<form action="" method="POST" class="registration">
	<div class="signup_form">
		<div class="form-control">
			
				<input name="first_name" id="first_name" placeholder="First Name" required="required" class="first_name form-control" type="text" size="30" value="" >
		
		</div>
		<div  class="form-control">
		
				<input name="last_name" id="last_name" placeholder="Last Name" required="required" class="last_name form-control" type="text" size="30" value="" >
		
		</div>
		<div  class="form-control">
			
				<input name="email" placeholder="Enter Your Email" required="required" class="email form-control" type="email" size="30" value="">

										</div>
		<div  class="form-control">
			
				<input name="mobile" placeholder="Enter Your Mobile" required="required" class="email form-control" type="text" size="30" value="">
			
		</div>
		<div  class="form-control">
		
				<input name="signupaddress" placeholder="Write Your Full Address" required="required" class="email form-control" type="text" size="30" value="">
			
		</div>
		<div  class="form-control">
		
				<input name="password" id="password-1" required="required"  placeholder="Enter New Password" class="password form-control " type="password" size="30" value="">
		
		</div>
		<div class="form-control">
			
				<select name="admintype" class="form-control" required="required">
					<option selected value="manager">Manager</option>
					<option value="seller">Seller</option>
					<option value="other">Other</option>
				</select>
			
		</div>
		<div >
			<input name="signup" class="btn btn-primary btn-block" type="submit" value="Add Admin!">
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
								</div>
							</div>
						</div>
					</div>
				';
			}

		 ?>
	</body>
</html>
