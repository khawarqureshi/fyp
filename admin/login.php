<?php include ( "../inc/connect.inc.php" ); ?>

<?php
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
}
else {
	header("location: index.php");
}

if (isset($_POST['login'])) {
	if (isset($_POST['email']) && isset($_POST['password'])) {
		$user_login = mysqli_real_escape_string($conn, $_POST['email']);
		$user_login = mb_convert_case($user_login, MB_CASE_LOWER, "UTF-8");	
		$password_login = mysqli_real_escape_string($conn, $_POST['password']);		
		$num = 0;
		$password_login_md5 = md5($password_login);
		$result = mysqli_query($conn, "SELECT * FROM admin WHERE (email='$user_login') AND password='$password_login_md5'");
		$num = mysqli_num_rows($result);
		$get_user_email = mysqli_fetch_assoc($result);
			$get_user_uname_db = $get_user_email['id'];
		if ($num>0) {
			$_SESSION['admin_login'] = $get_user_uname_db;
			setcookie('admin_login', $user_login, time() + (365 * 24 * 60 * 60), "/");
			header('location: index.php');
			exit();
		}
		else {
			$error_message = '<br><br>
				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
				<div class="alert alert-danger">Username or Password incorrect.</div>
				</font></div>';
			
		}
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
		
	<nav class="navbar navbar-light bg-light shadow-lg">
	<div class="container">
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
		

		
			
		

			<div class="container mt-4">

				<div>
		<form action="" class='container col-md-6 mt-6 ' method="POST" class="registration">
		<div class="signup_error_msg">
					<?php 
						if (isset($error_message)) {echo $error_message;}
						
					?>
				</div>
		<h2 class='text-center'>Admin Login</h2>
			<div class="signup_form m-auto">
				<div class='form-group'>
				
						<input name="email" class='form-control' placeholder="Enter Your Email" required="required" class="email signupbox" type="email" size="30" value="">
					
				</div>
				<div class='form-group'>
				
						<input 
						name="password" 
						class='form-control' 
						id="password-1" required 
						placeholder="Enter Password" 
						type="password" >
					
				</div>
				<div>
					<input 
					name="login" 
					class='btn btn-outline-success btn-block' 
					type="submit" 
					value="Log In">
				</div>
			
			</div>
		</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>

	</body>
</html>