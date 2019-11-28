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

    $umob_db = $get_user_email['mobile'];
    $uadd_db = $get_user_email['address'];
}


if (isset($_POST['proceed'])) {
//declere veriable
    $_SESSION['mbl'] = $_POST['mobile'];
    $_SESSION['addr'] = $_POST['address'];
//triming name
    try {
        if(empty($_POST['mobile'])) {
            throw new Exception('Mobile can not be empty');

        }
        if(empty($_POST['address'])) {
            throw new Exception('Address can not be empty');

        }
    } catch(Exception $e) {
        $error_message = $e->getMessage();
    }

} elseif (isset($_POST['confirm'])) {

    try {

        if ($_POST['payment_method'] != 'cash' && !$_POST['transaction_id']) {
            throw Exception('Transaction Id is required');
        }

        $mbl = $_SESSION['mbl'];
        $addr = $_SESSION['addr'];

        $d = date("Y-m-d"); //Year - Month - Day
        $timestamp = time();
        $date = strtotime("+7 day", $timestamp);
        $date = date('Y-m-d', $date);

        // send email
        $msg = "
                  Assalamu Alaikum...
                  Your Order successfull. Very soon we will send you a verification call.
                  
                  ";
        //if (@mail($uemail_db,"eBuyBD Product Order",$msg, "From:eBuyBD <no-reply@ebuybd.xyz>")) {

    $success = false;
    foreach ($_SESSION['cart'] as $poid => $product) {
        
        $prescription = $product['picture'] ?: '';
        $success = mysqli_query($conn, "INSERT INTO orders (uid,pid,quantity,prescription,oplace,mobile,odate,ddate,payment_method,transaction_id) VALUES ('$user','$poid',$product[quan],'$prescription','$addr','$mbl', '$d','$date', '$_POST[payment_method]', '$_POST[transaction_id]')");
    }

        if ($success){

            //success message
            $success_message = '
                  <div class="signupform_content"><h2><font face="bookman">Your order successfull!</font></h2>
                  <div class="signupform_text" style="font-size: 18px; text-align: center;">
                  <font face="bookman">
                     We send you a verification <br> call very soon.
                  </font></div></div>';
            unset($_SESSION['cart']);
            unset($_SESSION['mbl']);
            unset($_SESSION['addr']);
        } else {
            $error_message = 'Something goes wrong!';
        }
        //}

    }
    catch(Exception $e) {
        $error_message = $e->getMessage();
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
   
    <link rel="stylesheet" 
		href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
		crossorigin="anonymous">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   
   
   
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
<div class="holecontainer" >
    <div class="container signupform_content ">
        <br>
        <h2 class="alert alert-success text-center">Shopping Cart</h2>

        <div class="row">
           
                <?php
                    if (isset($_SESSION['cart'])) {
                        echo '
                            <table class="table table-bordered">
                                <tr>
                                
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>';

                        $total = 0;
                        foreach ($_SESSION['cart'] as $item) {

                            $amount = $item["quan"] * $item["price"];
                            echo '<tr>
                                    
                                    <td>'.$item["pName"].'</td>
                                    <td>'.$item["price"].'</td>
                                    <td>'.$item["quan"].'</td>
                                    <td>'.$amount.'</td>
                                </tr>';

                            $total += $amount;
                        }

                        echo "
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total:</b></td>
                                    <td><b>$total</b></td>
                                </tr>
                            </table>
                        ";
                    }
                ?>
            </div>
            <div class="col-md-6">
                <?php
                if(isset($success_message)) {echo $success_message;}
                elseif (isset($_POST['proceed'])) {

                    echo '
                  <div class="">
                  
                  <div class="signupform_text"></div>
                  <div>
                     <form action="" method="POST" class="registration" enctype="multipart/form-data">
                        <div class="signup_form">
                            <h3>Payment Method</h3>
                            <p>Select a payment method and pay bill accurately on the given numbers. And provide transaction id in the field below. (Leave empty in case of cash on delivery)
                            <br>
                            <br>
                           <div>
                              <td>
                              <label>
                                 <input name="payment_method" type="radio" checked value="cash" > Cash On Delivery
                                </label>
                              </td>
                           </div>
                           <br>
                           <div>
                              <td>
                              <label>
                                 <input name="payment_method" type="radio" value="jazz"> Jazz Cash (03001234567)
                                 </label>
                              </td>
                           </div>
                           <br>
                           <div>
                              <td>
                              <label>
                                 <input name="payment_method" type="radio" value="easypaisa" > Easypaisa (03412345678)
                                </label>
                              </td>
                           </div>
                           <br>
                           <div>
                              <td>
                                <label>
                                 <input name="payment_method" type="radio" value="credit"> Jazz Cash (0432948438484324)
                                </label>
                              </td>
                           </div>
                           <br>
                           <div class="form-group">
                              <td>
                                 <input name="transaction_id" placeholder="Transaction Id" class="email form-control" type="text" size="30" value="">
                              </td>
                           </div>
                        <div>
                        <div>
                              <input name="confirm" class="btn btn-info mb-3 btn-block" type="submit" value="Confirm Order">
                           </div>
                           </div>
                        </div>
                     </form>

                  </div>
               </div>';
                } elseif (isset($_SESSION['cart'])) {
                    echo '
                  <div class="">
                  <div class="signupform_text"></div>
                  <div>
                     <form action="" method="POST" class="registration" enctype="multipart/form-data">
                        <div class="signup_form">
                           <div class="form-group">
                              <td>
                                 <input name="mobile" placeholder="Your mobile number" required="required" class="email form-control" type="text" size="30" value="'.$umob_db.'">
                              </td>
                           </div>
                           <div class="form-group">
                              <td>
                                 <input name="address" id="password-1" required="required"  placeholder="Write your full address" class="password form-control " type="text" size="30" value="'.$uadd_db.'">
                              </td>
                           </div>
                           <div>
                              <td>';

                    echo '<div>
                              <input name="proceed" class="btn btn-outline-info btn-block mt-2 mb-2" type="submit" value="Proceed to Payment">
                           </div>
                           <div class="signup_error_msg"> '; ?>
                    <?php
                    if (isset($error_message)) {echo $error_message;}

                    ?>
                    <?php echo '</div>
                        </div>
                     </form>
                     
                  </div>
               </div>

               ';

                } else {
                    echo '<h2>Cart is empty</h2>';
                }

                ?>

            </div>
        </div>
    </div>
</div>
</body>
</html>