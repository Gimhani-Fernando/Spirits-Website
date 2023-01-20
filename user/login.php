<?php
    include('../components/connect.php');
    include('../ip/ip_address.php');

    @session_start();
?>


<!DOCTYPE html>
<html class="no-js" lang="en">

<!-- spirits/login.php   17 Jan 2023  -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Account &ndash; Spirits Store</title>
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
        		<div class="wrapper"><h1 class="page-width">Login</h1></div>
      		</div>
		</div>
        <!--End Page Title-->
        
        <div class="container">
        	<div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                	<div class="mb-4">
                       <form method="post" action="#" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">	
                          <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="CustomerEmail">Email</label>
                                    <input type="email" name="email" placeholder="" id="email" class="" autocorrect="off" autocapitalize="off" autofocus="" required="required">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="CustomerPassword">Password</label>
                                    <input type="password" value="" name="password" placeholder="" id="password" class="" required="required">                        	
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" class="btn mb-3" value="Sign In" name="login_btn">
                                <p class="mb-4">
								    <a href="register.php" id="customer_register_link">Create account</a>
                                </p>
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
if(isset($_POST['login_btn'])){
    $email=$_POST['email'];
    $password=$_POST['password'];


    $select_query="select * from user where email='$email'";
    $result=mysqli_query($con,$select_query);
    $row=mysqli_fetch_assoc($result);
    $row_count=mysqli_num_rows($result);
    $ip_address=getIP();

    //cart item
    $select_query_cart="select * from cart where ip_address='$ip_address'";
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart);
    if($row_count>0){
        $_SESSION['email']=$email;
        $_SESSION['fname']=$row['fname'];
        
        if(password_verify($password,$row['password'])){
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['email']=$email;
                $_SESSION['fname']=$row['fname'];

                echo "<script>alert('Logged in successfully')</script>";
                echo "<script>window.open('../index.php','_self')</script>";
            }else{
                $_SESSION['email']=$email;
                $_SESSION['fname']=$row['fname'];

                echo "<script>alert('Logged in successfully')</script>";
                echo "<script>window.open('place_order.php','_self')</script>";
            }
        }else{
            echo "<script>alert('Invalid credentials')</script>";
        }
    }else{
        echo "<script>alert('Invalid credentials')</script>";
    }

}
?>