<?php include ( "inc/connect.inc.php" ); ?>
<?php session_start(); ?>
<?php
ob_start();
if (!isset($_SESSION['user_login'])) {
}
else {
	header("location: index.php");
}
$emails = "";
$passs = "";
if (isset($_POST['login'])) {
	if (isset($_POST['email']) && isset($_POST['password'])) {
		$user_login = mysqli_real_escape_string($conn, $_POST['email']);
		$user_login = mb_convert_case($user_login, MB_CASE_LOWER, "UTF-8");	
		$password_login = mysqli_real_escape_string($conn, $_POST['password']);		
		$num = 0;
		$password_login_md5 = md5($password_login);
		$result = mysqli_query($conn, "SELECT * FROM user WHERE (email='$user_login') AND password='$password_login_md5' AND activation='yes'");
		$num = mysqli_num_rows($result);
		$get_user_email = mysqli_fetch_assoc($result);
			$get_user_uname_db = $get_user_email['id'];
		if ($num>0) {
			$_SESSION['user_login'] = $get_user_uname_db;
			setcookie('user_login', $user_login, time() + (365 * 24 * 60 * 60), "/");
			
			if (isset($_REQUEST['ono'])) {
				$ono = mysqli_real_escape_string($conn, $_REQUEST['ono']);
				header("location: orderform.php?poid=".$ono."");
			}else {
				header('location: index.php');
			}
			exit();
		}
		else {
			$result1 = mysqli_query($conn, "SELECT * FROM user WHERE (email='$user_login') AND password='$password_login_md5' AND activation='no'");
		$num1 = mysqli_num_rows($result1);
		$get_user_email1 = mysqli_fetch_assoc($result1);
			$get_user_uname_db1 = $get_user_email1['id'];
		if ($num1>0) {
			$emails = $user_login;
			$activacc ='';
		}else {
			$emails = $user_login;
			$passs = $password_login;
			$error_message = '<br><br>
				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
				<font face="bookman">Email or Password incorrect.<br>
				</font></div>';
		}
			
		}
	}

}
$acemails = "";
$acccode = "";
if(isset($_POST['activate'])){
	if(isset($_POST['actcode'])){
		$user_login = mysqli_real_escape_string($conn, $_POST['acemail']);
		$user_login = mb_convert_case($user_login, MB_CASE_LOWER, "UTF-8");	
		$user_acccode = mysqli_real_escape_string($conn, $_POST['actcode']);
		$result2 = mysqli_query($conn, "SELECT * FROM user WHERE ((email='$user_login') AND confirmCode='$user_acccode')");
		$num3 = mysqli_num_rows($result2);
		echo $user_login;
		if ($num3>0) {
			$get_user_email = mysqli_fetch_assoc($result2);
			$get_user_uname_db = $get_user_email['id'];
			$_SESSION['user_login'] = $get_user_uname_db;
			setcookie('user_login', $user_login, time() + (365 * 24 * 60 * 60), "/");
			mysqli_query("UPDATE user SET confirmCode='0', activation='yes' WHERE email='$user_login'");
			if (isset($_REQUEST['ono'])) {
				$ono = mysqli_real_escape_string($conn, $_REQUEST['ono']);
				header("location: orderform.php?poid=".$ono."");
			}else {
				header('location: index.php');
			}
			exit();
		}else {
			$emails = $user_login;
			$error_message = '<br><br>
				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
				<font face="bookman">Code not matched!<br>
				</font></div>';
		}
	}else {
		$error_message = '<br><br>
				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
				<font face="bookman">Activation code not matched!<br>
				</font></div>';
	}

}

?>

<!doctype html>
<html>
	<head>
		<title>Online Pharmacy | Login</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
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
					<a class="btn btn-primary" href="signin.php">SIGN UP</a>
				<li>
			<li class="ml-1">
					<a class="btn btn-success" href="login.php">LOG IN</a>
			<li>
			</ul>
		</div>
		</div>
		</nav>
			
		 <div class="jumbotron text-center">
							<?php
							 	if (isset($activacc)){
							 		echo '<h2>Activation Form</h2>';
							 	}else {
							 		echo '<h2>Login Form</h2>';
							 	}
							?>
		 </div> 
			
		
		<form action="" class="container col-md-6 m-auto" method="POST" class="registration">
						<?php
				if (isset($activacc)) {
				echo '
				<div class="signup_error_msg">
				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
				<font face="bookman">Check your email!<br>
				</font></div>
				</div>
				<div class="form-group">
				<div>
						<input 
						name="acemail" 
						placeholder="Enter Your Email"
						required
						class="form-control" 
						type="email"  value="'.$emails.'">
				</div>
				</div>
				<div>
				<div class="form-group">
						<input 
						name="actcode"
						placeholder="Activation Code"
						required
						class="form-control"
						type="text"
						value="'.$acccode.'">
				</div>
				</div>
				<div>
				<input 
				name="activate" 
				class="btn btn-outline-info btn-block"
				type="submit"
				value="Active Account">
				</div>
				';
				}else{
				echo '
				<div>
				<div class="form-group">
						<input name="email" 
						placeholder="Enter Your Email" 
						required
						class="form-control"
						type="email"
						value="'.$emails.'">
				</div>
				</div>
				<div>
				<div class="form-group">
				<input 
				name="password"
				id="password-1"
				required="required"
				placeholder="Enter Password"
				class="form-control"
				type="password"
				value="'.$passs.'">
				</div>
				</div>
				<div>
				<input 
				name="login"
				class="btn btn-outline-info btn-block"
				type="submit"
				value="Log In">
				</div>
				';
				}
				?>
			<div class="text-center text-dark">
		<a class="forgetpass" href="forgetpass.php">
		<span>forget your password???</span>
		</a>
			<div class="signup_error_msg">
			<?php 
			if (isset($error_message)) {echo $error_message;}
			?>
			</div>
</form>
	</body>
</html>
