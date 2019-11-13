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
	            mkdir("image/prescription");
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
      $success_message = '<h3><span style="color: #169E8F;">Product added to cart. </span><a href="cart.php">Go to cart</a></h3>';
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
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-image: url(image/homebackgrndimg1.png);">
   <div class="homepageheader">
         <div class="signinButton loginButton">
            <div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
               <?php 
                  if ($user!="") {
                     echo '<a style="text-decoration: none; color: #fff;" href="logout.php">LOG OUT</a>';
                  }
                  else {
                     echo '<a style="text-decoration: none; color: #fff;" href="signin.php">SIGN UP</a>';
                  }
                ?>
               
            </div>
            <div class="uiloginbutton signinButton loginButton" style="">
               <?php 
                  if ($user!="") {
                     echo '<a style="text-decoration: none; color: #fff;" href="profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
                  }
                  else {
                     echo '<a style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>';
                  }
                ?>
            </div>
         </div>
         <div style="float: left; margin: 5px 0px 0px 23px;">
            <a href="index.php">
               <img style=" height: 75px; width: 130px;" src="image/logo.png">
            </a>
         </div>
         <div class="">
            <div id="srcheader">
               <form id="newsearch" method="get" action="search.php">
                       <input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="search" class="srcbutton" >
               </form>
            <div class="srcclear"></div>
            </div>
         </div>
      </div>
   <div class="categolis">
      <table>
         <tr>
            <th>
               <a href="category/Headache.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Headache</a>
            </th>
            <th><a href="category/Depression.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Depression</a></th>
            <th><a href="category/Infection.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Infection</a></th>
            <th><a href="category/Nutritional.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Nutritional</a></th>
            <th><a href="category/Orthopedic.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Orthopedic</a></th>
            <th><a href="category/Allergy.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Allergy</a></th>
            <th><a href="category/Nausea.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">Nausea</a></th>
            <th><a href="category/EyeInfection.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: #c7587e;border-radius: 12px;">EyeInfection</a></th>
         </tr>
      </table>
   </div>
   <div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
      <div class="container signupform_content ">
         <div>

            <h2 style="padding-bottom: 20px;">Order Form</h2>
            <div style="float: right;">
            <?php 
               if(isset($success_message)) {echo $success_message;}
               echo '
                  <div class="">
                  <div class="signupform_text"></div>
                  <div>
                     <form action="" method="POST" class="registration" enctype="multipart/form-data">
                        <div class="signup_form" style="    margin-top: 38px;">
                           <div>
                              <td>
                                 <select onchange="changeAmount()" name="quantity" required="required" id="productAmount" style=" font-size: 20px;
                              font-style: italic; margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;" class="">';

               

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

                           echo '<div>
                              <td>
                                 <input name="prescription" required="required"  placeholder="Please upload medical prescription" class="password signupbox" type="file" size="30" value="" style="height: 100% !important;">
                              </td>
                           </div>
                           <div style="color: red; width: 300px !important">To order this medicine, you must upload a medical prescription by a doctor</div>';
                        }

                           echo '<div>
                              <input name="order" class="uisignupbutton signupbutton" type="submit" value="Add To Cart">
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