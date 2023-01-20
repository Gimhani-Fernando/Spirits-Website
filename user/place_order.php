<?php
    include('../components/connect.php');
    include('../ip/ip_address.php');

    @session_start();
    $email=$_SESSION['email'];
    $get_user="select * from user where email='$email'";
    $result=mysqli_query($con,$get_user);
    $row_fetch=mysqli_fetch_assoc($result);
    $user_id=$row_fetch['user_id'];

?>


<!DOCTYPE html>
<html class="no-js" lang="en">

<!-- Spirits/checkout.html   17 Jan 2023 -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Checkout &ndash; Spirits Store</title>
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
        		<div class="wrapper"><h1 class="page-width">Checkout</h1></div>
      		</div>
		</div>
        <!--End Page Title-->
        
        <div class="container">
        	<div class="row m-auto">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 m-auto">
                    <div class="customer-box customer-coupon">
                        <h3 class="font-15 xs-font-13"><i class="icon anm anm-gift-l"></i></h3>
                    </div>
                </div>
            </div>


            

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 m-auto">
                    <div class="your-order-payment">
                        <div class="your-order">
                            <h2 class="order-title mb-4">Your Order</h2>

                            <div class="table-responsive-sm order-table"> 
                                <table class="bg-white table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Product Name</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            
                                    $get_ip_address = getIP(); 
                                    $total_price=0; 
                                    $cart_query="select * from cart where ip_address='$get_ip_address'";
                                    $result=mysqli_query($con,$cart_query);
                                    $result_count=mysqli_num_rows($result);

                                    while($row=mysqli_fetch_array($result)){
                                    $product_id=$row['product_id'];
                                    $quantity=$row['quantity'];
                                    $select_products="select * from products where product_id='$product_id'";
                                    $result_products=mysqli_query($con,$select_products);

                                    while($row_product=mysqli_fetch_array($result_products)){
                                        $price_table=array($row_product['product_price']);
                                        $product_price=$row_product['product_price'];
                                        $product_name=$row_product['product_name'];
                                        $product_image=$row_product['product_image'];

                                        $total_price+=$quantity*$product_price;
                                    
                                    echo "
                                        <tr>
                                            <td class='text-left'>$product_name</td>
                                            <td>$product_price</td>
                                            <td>$quantity</td>
                                            <td>".$quantity*$product_price."</td>
                                        </tr>
                                        ";
                                    }
                                }
                                    ?>
                                    </tbody>
                                    <tfoot class="font-weight-600">
                                        <tr>
                                            <td colspan="4" class="text-right">Total</td>
                                            <td><?php echo $total_price ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        
                        <hr />

                        <div class="your-payment">
                            <div class="payment-method">
                                <div class="order-button-payment"> 
                                    <button class="btn" value="Place order" type="submit"><a href="order.php?user_id=<?php echo $user_id?>">Place order</a></button>
                                </div>
                            </div>
                        </div>
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

<!-- belle/checkout.html   11 Nov 2019 12:44:33 GMT -->
</html>