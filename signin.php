<?php

include ( "inc/connect.inc.php" );
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
}
else {
	header("location: index.php");
}

$u_fname = "";
$u_lname = "";
$u_email = "";
$u_mobile = "";
$u_address = "";
$u_pass = "";

if (isset($_POST['signup'])) {
//declere veriable
$u_fname = $_POST['first_name'];
$u_lname = $_POST['last_name'];
$u_email = $_POST['email'];
$u_mobile = $_POST['mobile'];
$u_address = $_POST['signupaddress'];
$u_pass = $_POST['password'];
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
		if(empty($_POST['signupaddress'])) {
			throw new Exception('Address can not be empty');
			
		}

		
		// Check if email already exists
		
		$check = 0;
		$e_check = mysqli_query($conn, "SELECT email FROM `user` WHERE email='$u_email'");
		$email_check = mysqli_num_rows($e_check);
		if (strlen($_POST['first_name']) >2 && strlen($_POST['first_name']) <16 ) {
			if ($check == 0 ) {
				if ($email_check == 0) {
					if (strlen($_POST['password']) >1 ) {
						$d = date("Y-m-d"); //Year - Month - Day
						$_POST['first_name'] = ucwords($_POST['first_name']);
						$_POST['last_name'] = ucwords($_POST['last_name']);
						$_POST['last_name'] = ucwords($_POST['last_name']);
						$_POST['email'] = mb_convert_case($u_email, MB_CASE_LOWER, "UTF-8");
						$_POST['password'] = md5($_POST['password']);
						$confirmCode   = substr( rand() * 900000 + 100000, 0, 6 );
						// send email
						$msg = "
						Assalamu Alaikum...
						
						Your activation code: ".$confirmCode."
						Signup email: ".$_POST['email']."
						
						";
				
						$mail = new PHPMailer(TRUE);
   
							$mail->setFrom('abac@gmail.com', 'Darth Vader');
							$mail->addAddress('palpatine@empire.com', 'Emperor');
							$mail->Subject = 'Activation code';
							$mail->Body = $msg;
							
						// 	/* SMTP parameters. */
							$mail->isSMTP();
							$mail->Host = '	smtp.mailtrap.io';
							$mail->SMTPAuth = TRUE;
							$mail->SMTPSecure = 'STARTTLS ';
							$mail->Username = 'ff499716367e90';
							$mail->Password = '789ad077335cd8';
							$mail->Port = 587;
							
						// 	/* Disable some SSL checks. */
							$mail->SMTPOptions = array(
							   'ssl' => array(
							   'verify_peer' => false,
							   'verify_peer_name' => false,
							   'allow_self_signed' => true
							   )
							);
							
							/* Finally send the mail. */

						if ($mail->send()) {
							


						$result = mysqli_query($conn, "INSERT INTO user (firstName,lastName,email,mobile,address,password,confirmCode) VALUES ('$_POST[first_name]','$_POST[last_name]','$_POST[email]','$_POST[mobile]','$_POST[signupaddress]','$_POST[password]','$confirmCode')");
						
						//success message
						$success_message = '
						<div class="container col-md-6">
						<h2>
						Account Created Successfully.
						</h2>
						<div>
							<h1 class="alert alert-success">
							Email: '.$u_email.'</h1>
							Activation code sent to your email.'.
							// Your activation code: '.$confirmCode.
						'</div>	
					</div>';
						}else {
							throw new Exception('Email is not valid!');
						}
						
						
					}else {
						throw new Exception('Make strong password!');
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


?>


<!doctype html>
<html>
	<head>
		<title>Online Pharmacy | SignUp</title>
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

		<button class="navbar-toggler" type="button" data-toggle="collapse"
		 data-target="#navbarSupportedContent"
		 aria-controls="navbarSupportedContent"
		 aria-expanded="false"
		 aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">

		<form id="newsearch" class="form-inline my-2 my-lg-0" method="get" action="search.php">
		<input type="text" class="form-control mr-sm-2" name="keywords"  maxlength="120"  
		placeholder="Search Here...">
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

				<div class="jumbotron">
					<h6 class="display-4 text-center">
						Signup Form
					</h6>
				
				</div>





		<?php 
			if(isset($success_message)) {echo $success_message;}
			else {
				echo '
					<div>
						<div class="container col-md-6">
						<div>';								
						if (isset($error_message)) {echo $error_message;}
							echo'
						</div>
							<div>
								<div>
											<form action="" method="POST" class="registration">
												<div class="signup_form">
													<div class="form-group">
														<div>
															<input 
															name="first_name" id="first_name" 
															placeholder="First Name" 
															required 
															class="form-control" 
															type="text"
															value="'.$u_fname.'" >
														</div>
													</div>
													<div>
														<div class="form-group">
															<input 
															name="last_name" id="last_name" placeholder="Last Name" required="required" 
															class="form-control" 
															type="text"  
															value="'.$u_lname.'" >
														</div>
													</div>
													<div>
														<div class="form-group">
															<input 
															name="email" 
															placeholder="Enter Your Email" required="required" 
															class="form-control" 
															type="email"  
															value="'.$u_email.'">
														</div
													</div>
													<div>
														<div class="form-group">
															<input 
															name="mobile" 
															placeholder="Enter Your Mobile" required="required" 
															class="form-control" 
															type="text"  
															value="'.$u_mobile.'">
														</div>
													</div>
													<div>
														<div class="form-group">
															<input 
															name="signupaddress" 
															placeholder="Write Your Full Address" required="required" 
															class="form-control" 
															type="text" 
															value="'.$u_address.'">
														</div>
													</div>
													<div>
														<div class="form-group">
															<input 
															name="password" 
															id="password-1" 
															required
															placeholder="Enter New Password" 
															class="form-control" 
															type="password"
															value="'.$u_pass.'">
														</div>
													</div>
													<div>
														<input 
														name="signup" 
														class="btn btn-outline-info btn-block" 
														type="submit" value="Sign Me Up!">
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
