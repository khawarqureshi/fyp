<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '..\vendor\autoload.php';


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
 
$title = $msg = "";

if (isset($_POST['send'])) {

	$mail = new PHPMailer(TRUE);
	$mail->setFrom('abac@gmail.com', 'Darth Vader');

	$mail->Subject = $_POST['title'];
	$mail->Body = $_POST['msg'];

	/* SMTP parameters. */
		$mail->isSMTP();
		$mail->Host = '	smtp.mailtrap.io';
		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = 'STARTTLS ';
		$mail->Username = 'ff499716367e90';
		$mail->Password = '789ad077335cd8';
		$mail->Port = 587;
							
		/* Disable some SSL checks. */
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

	$query = "SELECT email FROM user";

	$run = mysqli_query($conn, $query);
	while ($row=mysqli_fetch_assoc($run)) {
		$mail->addAddress($row['email']);
	}

	if ($mail->send()) {
		echo '<h2 style="margin: auto !important">Alert sent successfully to all users</h2>';
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
	<body >
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
										<h2 class="alert alert-success">Create Alert!</h2>
										<div class="signup_error_msg">';
											if (isset($error_message)) {echo $error_message;}
										echo '</div>
										<div class="signupform_text"></div>
										<div>
<form action="" method="POST" class="registration" enctype="multipart/form-data">
	<div class="signup_form">
		<div class="form-group">
			
				<input name="title" id="first_name" placeholder="Alert Title"
				 required class="form-control" 
				 type="text" >
			
		</div>
		<div class="form-group">
		
				<textarea name="msg"
				placeholder="Alert Message" required="required" class="form-control" rows="5" size="50" value="" style="height: auto !important" ></textarea>
			
		</div>
		<div>
			<input name="send" class="btn btn-primary btn-block" type="submit" value="Send">
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