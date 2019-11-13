<!DOCTYPE html>
<html>
<head>
	<title>Online Pharmacy | Forget Password</title>
	<link rel="icon" href="image/title.png" type="image/x-icon">
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
			<h2 class="display-4">Forget Password</h2>
		 </div> 

		<div class="container">
							<form action="" method="POST" class="registration">
								<div class="signup_form">
									<div class="form-group">
										<input 
										 type="text"
										 name="username"
										 class="form-control" 
										 placeholder="Write eBuyBD Email..."
										 required autofocus>
									</div>
									<div>
										<input
										 class="btn btn-outline-info btn-block"
										 type="submit"
										 name="searchId"
										 id="senddata"
										 value="Search">
									</div>
									<div class="signup_error_msg">
									</div>
								</div>
							</form>
					</div>
		</div>
</body>
</html>