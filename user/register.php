<?php
    include('../components/connect.php');
    include('../ip/ip_address.php');
?>


<!DOCTYPE html>
<html class="no-js" lang="en">

<!-- Spirits/register.html   17 Jan 2023 -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Create an Account &ndash; Spirits Stores</title>
  <meta name="description" content="description">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
  <!-- Plugins CSS -->
  <link rel="stylesheet" href="../assets/css/plugins.css">
  <!-- Bootstap CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <!-- Main Style CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/responsive.css">
</head>
<body class="page-template belle">
<div class="pageWrapper">
    <!--Header-->
      <?php
            include('header.php');
        ?>
    <!--End Header-->
    
    <!--Body Content-->
    <div id="page-content">
    	<!--Page Title-->
    	<div class="page section-header text-center">
			<div class="page-title">
        		<div class="wrapper"><h1 class="page-width">Create an Account</h1></div>
      		</div>
		</div>
        <!--End Page Title-->
        
        <div class="container">
        	<div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                	<div class="mb-4">
                       <form method="post" action="#" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">	
                          <div class="row">
                            <!-- First name -->
	                          <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="FirstName">First Name</label>
                                    <input type="text" name="fname" placeholder="" id="fname" autofocus="" required="required">
                                </div>
                            </div>

                            <!-- Last name -->
                               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="LastName">Last Name</label>
                                    <input type="text" name="lname" placeholder="" id="lname" required="required">
                                </div>
                               </div>

                            <!-- Email -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="CustomerEmail">Email</label>
                                    <input type="email" name="email" placeholder="" id="email" class="" autocorrect="off" autocapitalize="off" autofocus="" required="required">
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="Contact">Contact</label>
                                    <input type="text" name="contact" placeholder="" id="contact" required="required">
                                </div>
                               </div>

                            <!-- Address -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="Address">Address</label>
                                    <input type="text" name="address" placeholder="" id="address" required="required">
                                </div>
                               </div>

                            <!-- Password -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="CustomerPassword">Password</label>
                                    <input type="password" value="" name="password" placeholder="" id="password" class="">                        	
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="CustomerConPassword">Confirm Password</label>
                                    <input type="password" value="" name="confpassword" placeholder="" id="confpassword" class="">                        	
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" class="btn mb-3" value="Create" name="register_btn">
                            </div>
                         </div>
                     </form>
                    </div>
               	</div>
            </div>
        </div>
        
    </div>
    <!--End Body Content-->
    
    <!--Footer-->
    <?php
          include('./footer.php');
    ?>
    <!--End Footer-->
    <!--Scoll Top-->
    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
    <!--End Scoll Top-->
    
     <!-- Including Jquery -->
     <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
     <script src="assets/js/vendor/jquery.cookie.js"></script>
     <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
     <script src="assets/js/vendor/wow.min.js"></script>
     <!-- Including Javascript -->
     <script src="assets/js/bootstrap.min.js"></script>
     <script src="assets/js/plugins.js"></script>
     <script src="assets/js/popper.min.js"></script>
     <script src="assets/js/lazysizes.js"></script>
     <script src="assets/js/main.js"></script>
</div>
</body>

</html>



<!--php code-->
<?php
    if(isset($_POST['register_btn'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        $address=$_POST['address'];
        $password=$_POST['password'];
        $encrypted_password=password_hash($password,PASSWORD_DEFAULT);
        $confpassword=$_POST['confpassword'];

        $ip_address=getIP();

        //select query
        $select_query="select * from user where email='$email'";
        $result=mysqli_query($con,$select_query);
        $rows_count=mysqli_num_rows($result);

        if($rows_count>0){
            echo "<script>alert('Email already exist')</script>";
        }else if($password!=$confpassword){
            echo "<script>alert('Passwords do not match')</script>";
        }else{

            //insert_query
            $insert_query="insert into user (fname,lname,email,contact,address,password,ip_address) values 
            ('$fname','$lname','$email','$contact','$address','$encrypted_password','$ip_address')";
            $sql_execute=mysqli_query($con,$insert_query);
            if($sql_execute){
                echo "<script>alert('Data inserted successfully')</script>";
            }else{
                die(mysqli_error($con));
            }
        }

        //selecting cart items
        $cart_items="select * from cart where ip_address='$ip_address'";
        $result_cart=mysqli_query($con,$cart_items);
        $rows_count=mysqli_num_rows($result_cart);
        if($rows_count>0){
            $_SESSION['email']=$email;
            $_SESSION['fname']=$fname;

            echo "<script>alert('You have items in your cart')</script>";
            echo "<script>window.open('../cart.php','_self')</script>";
        }else{
            echo "<script>window.open('../index.php','_self')</script>";

        }

    }
?>