<?php include ( "inc/connect.inc.php" ); ?>
<?php 

if (isset($_REQUEST['poid'])) {
   
   $poid = mysqli_real_escape_string($conn, $_REQUEST['poid']);
}else {
   header('location: index.php');
}
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
   $user = "";
   header("location: login.php?ono=".$poid."");
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


$getposts = mysqli_query($conn, "SELECT * FROM products WHERE id ='$poid'") or die(mysqli_error($conn));
               if (mysqli_num_rows($getposts)) {
                  $row = mysqli_fetch_assoc($getposts);
                  $id = $row['id'];
                  $pName = $row['pName'];
                  $price = $row['price'];
                  $description = $row['description'];
                  $picture = $row['picture'];
                  $formula = $row['formula'];
                  $category = $row['category'];
                  $available =$row['available'];
                  $need_prescription = $row['need_prescription'];
               }  

//order

if (isset($_POST['order'])) {
//declere veriable
$quan = $_POST['quantity'];
//triming name
   try {
      if(empty($_POST['quantity'])) {
         throw new Exception('Address can not be empty');
         
      }

      if ($need_prescription) {
      	$prescription = @$_FILES['prescription']['name'];
	      $file_basename = substr($prescription, 0, strripos($prescription, '.'));
	      $file_ext = substr($prescription, strripos($prescription, '.'));

	      if (((@$_FILES['prescription']['type']=='image/jpeg') || (@$_FILES['prescription']['type']=='image/png') || (@$_FILES['prescription']['type']=='image/gif')) && (@$_FILES['prescription']['size'] < 1000000)) {

	         if (file_exists("image/prescription")) {
	            //nothing
	         }else {
	            mkdir("image/prescription", 777);
	         }

	         
	         $filename = strtotime(date('Y-m-d H:i:s')).$file_ext;

	         if (file_exists("image/prescription".$filename)) {
	            echo @$_FILES["prescription"]["name"]."Already exists";
	         }else {
	            if(!move_uploaded_file(@$_FILES["prescription"]["tmp_name"], "image/prescription/".$filename))
	            {
	               echo "Something Worng on upload!!!";
	            }

	            //echo "Uploaded and stored in: userdata/profile_pics/$item/".@$_FILES["profilepic"]["name"];
	             // item replace to formula
	            
	         }
	      } else {
	         $error_message = 'Add picture!';
	      }
      }

      $_SESSION['cart'][$poid] = compact('poid', 'pName', 'price', 'quan', 'picture', 'formula', 'category', 'filename');
      $success_message = '<h3><kbd>Product added to cart. <kbd><a href="cart.php" class="text-white">Go to carts</a></h3>';
   }
   catch(Exception $e) {
      $error_message = $e->getMessage();
   }
}


?>

<!DOCTYPE html>
<html>
<head>
   <title>Order</title>
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
   <div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
      <div class="container signupform_content ">
         <div>
            <?php 
               if(isset($success_message)) {echo $success_message;}
               echo '
               <h2 class="alert alert-success text-center">Order Form</h2>
               <div>
                  <div class="">
                  <div class="signupform_text"></div>
                  <div>
                     <form action="" method="POST" class="registration" enctype="multipart/form-data">
                        <div class="signup_form" style="    margin-top: 38px;">
                           <div class="form-group">
                              <td>
                                 <select class="form-control" onchange="changeAmount()" name="quantity" required="required" id="productAmount" >';

               

             ?><?php
                                    for ($i=1; $i<=$available; $i++) { 
                                       echo '<option  value="'.$i.'">Quantity: '.$i.'</option>';
                                    }
                                 ?>
                                 <?php echo '
                                 </select>
                              </td>
                           </div>'?>

                     <?php

                        if ($need_prescription) {

                           echo '<div class="form-group">
                              <td>
                                 <input name="prescription" required="required"  placeholder="Please upload medical prescription" class="password form-control" type="file" size="30" value="" style="height: 100% !important;">
                              </td>
                           </div>
                           <div style="color: red; width: 300px !important">To order this medicine, you must upload a medical prescription by a doctor</div>';
                        }

                           echo '<div class="form-group">
                              <input name="order" class="btn btn-primary btn-block" type="submit" value="Add To Cart">
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

             ?>
               
            </div>
         </div>
      </div>
      <div style="float: left; font-size: 23px;">
         <div>
            <?php
               echo '
                  <ul style="float: left;">
                     <li style="float: left; padding: 0px 25px 25px 25px;">
                        <div class="home-prodlist-img"><a href="'.$category.'/view_product.php?pid='.$id.'">
                           <img src="image/product/'.$formula.'/'.$picture.'" class="home-prodlist-imgi">
                           </a>
                           <div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: <span id="amountText">'.$price.'</span> PKR <span id="aHiddenText" style="display:none">'.$price.'</span></div>
                        </div>
                        
                     </li>
                  </ul>
               ';
            ?>
         </div>

      </div>
   </div>
   <script type="text/javascript">
   function changeAmount() {
       var v = document.getElementById("aHiddenText").innerHTML;
       document.getElementById("amountText").innerHTML = v;
       var sBox = document.getElementById("productAmount");
       var y = sBox.value;
       var x = document.getElementById("amountText").innerHTML;
       var y = parseInt(y);
       var x = parseInt(x);
       document.getElementById("amountText").innerHTML = x+"x"+y+ " = " + x*y;
   }
   </script>
</body>
</html>