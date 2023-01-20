<?php
    include('../components/connect.php');
    include('../ip/ip_address.php');

    @session_start();
?>

<!-- php codes for edit account -->
<?php
    $user_session_email=$_SESSION['email'];
    $select_query="select * from user where email='$user_session_email'";
    $result_query=mysqli_query($con,$select_query);
    $row_fetch=mysqli_fetch_assoc($result_query);
    $user_id=$row_fetch['user_id'];
    $fname=$row_fetch['fname'];
    $lname=$row_fetch['lname'];
    $address=$row_fetch['address'];
    $contact=$row_fetch['contact'];
    $user_email=$row_fetch['email'];


    if(isset($_POST['update_account'])){
        $update_id=$user_id;
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $address=$_POST['address'];
        $contact=$_POST['contact'];

        //update query
        $update_data="update user set fname='$fname',lname='$lname',address='$address',contact='$contact'
        where user_id=$user_id";
        $result_query_update=mysqli_query($con,$update_data);
        if($result_query_update){
            echo "<script>alert('Data updated successfully')</script>";
            $_SESSION['email']=$user_email;
        }
    }

    if(isset($_POST['delete_account'])){
        $delete_query="delete from user where email='$email'";
        $result=mysqli_query($con,$delete_query);
        if($result){
            echo "<script>alert('Account deleted successfully')</script>";
            echo "<script>window.open('logout.php','_self')</script>";

        }
    }
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<!-- Spirits/checkout.html   17 Jan 2023 -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>User Dashboard &ndash; Spirits store</title>
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
           
<div class="container">
        	<div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                    <div class="customer-box returning-customer">
                        <h3><i class="icon anm anm-user-al"></i>Edit Account</h3>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                    <div class="customer-box customer-coupon">
                        <h3 class="font-15 xs-font-13"><i class="icon anm anm-gift-l"></i> All orders</h3>
                    </div>
                </div>
            </div>


            <!----------------Editing account ------------------->

            <div class="row billing-fields">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
                    <div class="create-ac-content bg-light-gray padding-20px-all">
                        <form action="" method="post">
                            <fieldset>
                                <h2 class="login-title mb-3">Billing details</h2>
                                <div class="row">
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-firstname">First Name <span class="required-f">*</span></label>
                                        <input name="fname" id="input-firstname" type="text" required="required" value=<?php echo $fname?>>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-lastname">Last Name <span class="required-f">*</span></label>
                                        <input name="lname" id="input-lastname" type="text" required="required" value=<?php echo $lname?>>
                                    </div>
                                </div>

                                
                                <div class="row">
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-email">E-Mail</label>
                                        <p><label for="input-email"><?php echo $user_email?></label></p>
                                        </div>
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                        <label for="input-telephone">Contact <span class="required-f">*</span></label>
                                        <input name="contact" id="input-telephone" type="text" required="required" value=<?php echo $contact?>>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="row">
                                    <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                        <label for="input-company">Addess</label>
                                        <input name="address" id="input-company" type="text" required="required" value=<?php echo $address?>>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="row">
                                    <div class="form-outline mb-4 m-2">
                                        <input type="submit" value="Update Account" class="bg-info py-2 px-3 border-0" name="update_account">
                                    </div>
                                    <div class="form-outline mb-4 m-2">
                                        <input type="submit" value="Delete Account" class="bg-info py-2 px-3 border-0" name="delete_account">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <!----------------End of Editing account ------------------->



                <!--------------View all orders ---------------->

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="your-order-payment">
                        <div class="your-order">
                            <h2 class="order-title mb-4">All Orders</h2>

                            <div class="table-responsive-sm order-table"> 
                                <table class="bg-white table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Serial no</th>
                                            <th>Amount due</th>
                                            <th>Total products</th>
                                            <th>Invoice number</th>
                                            <th>Date</th>
                                            <th>Complete/Incomplete</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $get_order_details="select * from orders where user_id=$user_id";
                                        $result_orders=mysqli_query($con,$get_order_details);
                                        $number=1;

                                        while($row_orders=mysqli_fetch_assoc($result_orders)){
                                            $oid=$row_orders['order_id'];
                                            $amount=$row_orders['amount'];
                                            $number_of_products=$row_orders['number_of_products'];
                                            $invoice=$row_orders['invoice'];
                                            $order_date=$row_orders['order_date'];
                                            $order_status=$row_orders['order_status'];
                                            if($order_status=='pending'){
                                                $order_status='Incomplete';
                                            }else{
                                                $order_status='Complete';
                                            }

                                            echo "
                                            <tr>
                                                <td class='text-left'>$number</td>
                                                <td>$amount</td>
                                                <td>$number_of_products</td>
                                                <td>$invoice</td>
                                                <td>$order_date</td>
                                                <td>$order_status</td>";
                                                
                                                if($order_status=="Complete"){
                                                    echo "<td>Paid</td>
                                                    </tr>";
                                                }else{
                                                    echo "<td><a href='confirm_payment.php?order_id=$oid' class='text-light'>Confirm</a></td>
                                                    </tr>";
                                                }                                              
                                    
                                            $number++;
                                        }
                                    
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <hr />
                            </div>
                        </div>
                    </div>
                </div>
                <!--------------End of View all orders ---------------->

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


