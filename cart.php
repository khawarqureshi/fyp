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
            <br>
            <h2 style="padding-bottom: 20px;">Shopping Cart</h2>

            <div style="float: left; font-size: 23px;">
                <?php
                    if (isset($_SESSION['cart'])) {
                        echo '
                        <br><br>
                                    <table style="float: left; background-color: white">
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                        </tr>';

                                    $total = 0;
                                    foreach ($_SESSION['cart'] as $item) {

                                        $amount = $item["quan"] * $item["price"];
                                        echo '<tr>
                                                <td><img src="image/product/'.$item['formula'].'/'.$item['picture'].'" alt=""></td>
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
                                            <td></td>
                                            <td><b>Total:</b></td>
                                            <td><b>$total</b></td>
                                        </tr>
                                    </table>
                                ";
                    }
                ?>
            </div>
            <div style="float: right;">
                <?php
                if(isset($success_message)) {echo $success_message;}
                elseif (isset($_POST['proceed'])) {

                    echo '
                  <div class="">
                  <div class="signupform_text"></div>
                  <div>
                     <form action="" method="POST" class="registration" enctype="multipart/form-data">
                        <div class="signup_form" style=" margin-top: 38px; color: #169e8f">
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
                           <div>
                              <td>
                                 <input name="transaction_id" placeholder="Transaction Id" class="email signupbox" type="text" size="30" value="">
                              </td>
                           </div>
                        <div>
                        <div>
                              <input name="confirm" class="uisignupbutton signupbutton" type="submit" value="Confirm Order">
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
                        <div class="signup_form" style="    margin-top: 38px;">
                           <div>
                              <td>
                                 <input name="mobile" placeholder="Your mobile number" required="required" class="email signupbox" type="text" size="30" value="'.$umob_db.'">
                              </td>
                           </div>
                           <div>
                              <td>
                                 <input name="address" id="password-1" required="required"  placeholder="Write your full address" class="password signupbox " type="text" size="30" value="'.$uadd_db.'">
                              </td>
                           </div>
                           <div>
                              <td>';

                    echo '<div>
                              <input name="proceed" class="uisignupbutton signupbutton" type="submit" value="Proceed to Payment">
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