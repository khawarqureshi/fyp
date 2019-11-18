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
			$upass = $get_user_email['password'];

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

if (isset($_POST['changesettings'])) {
//declere veriable
$email = $_POST['email'];
$opass = $_POST['opass'];
$npass = $_POST['npass'];
$npass1 = $_POST['npass1'];
//triming name
	try {
		if(empty($_POST['email'])) {
			throw new Exception('Email can not be empty');
			
		}
			if(isset($opass) && isset($npass) && isset($npass1) && ($opass != "" && $npass != "" && $npass1 != "")){
				if( md5($opass) == $upass){
					if($npass == $npass1){
						$npass = md5($npass);
						mysqli_query($conn, "UPDATE user SET password='$npass' WHERE id='$user'");
						$success_message = '
						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">
							Password changed.
						</font></div>';
					}else {
					$success_message = '
						<div class="signupform_text" style=" color: red; font-size: 18px; text-align: center;">
						<font face="bookman">
							New password not matched!
						</font></div>';
					}
				}else {
				$success_message = '
					<div class="signupform_text" style=" color: red; font-size: 18px; text-align: center;">
					<font face="bookman">
						Fillup password field exactly.
					</font></div>';
				}
			}else {
				$success_message = '
					<div class="signupform_text" style=" color: red; font-size: 18px; text-align: center;">
					<font face="bookman">
						Fillup password field exactly.
					</font></div>';
				}

			if($uemail_db != $email) {
				if(mysqli_query("UPDATE user SET  email='$email' WHERE id='$user'")){
					//success message
					$success_message = '
					<div class="signupform_text" style="font-size: 18px; text-align: center;">
					<font face="bookman">
						Settings change successfull.
					</font></div>';
				}
			}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}


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

					echo '<a class="btn btn-primary" href="https://api.whatsapp.com/send?phone=03125544577">whatsapp</a>';
				} else {

					echo '<a href="signin.php" class="btn btn-success">whatsapp</a>';
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
	<div >
		
			
					<div class="container col-md-6">
					<?php echo '<a class="btn btn-primary btn-block" href="profile.php?uid='.$user.'"  >My Orders</a>'; ?>
		<?php echo '<a class="btn btn-primary btn-block" href="settings.php?uid='.$user.'" >Settings</a>'; ?>
						<form action="" method="POST" >
			<div class="form-group mt-1">
				<input 
				class="form-control" 
				type="password" 
				name="opass" 
				placeholder="Old Password">
			</div>
			<div class="form-group">
				<input 
				class="form-control" 
				type="password" 
				name="npass" 
				placeholder="New Password">
			</div>
			<div class="form-group">
				<input 
				class="form-control" 
				type="password" 
				name="npass1" 
				placeholder="Repeat Password">
			</div>
			<label for="email">Change Email</label>
			<div class="form-group">
				<?php echo '<input 
				 class="form-control"
				 required 
				 type="email" 
				 name="email" 
				 placeholder="New Email" 
				 value="'.$uemail_db.'">'; ?>
			</div>
			<input 
			class="btn btn-outline-info btn-block" 
			type="submit" 
			name="changesettings" 
			value="Update Settings">
			<div>
				<?php if (isset($success_message)) {echo $success_message;} ?>
			</div>
							
						</form>
					</div>
	</div>
</body>
</html>