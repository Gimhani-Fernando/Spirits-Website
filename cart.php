<!DOCTYPE html>
<html class="no-js" lang="en">

<!-- Spirits/cart.php   17 Jan 2023 -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Your cart &ndash; Spirits store</title>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body class="page-template belle">
<div class="pageWrapper">

<!--Header-->
    <?php
        include('./components/header.php');    
    ?>
<!--End of header-->


    <!--Body Content-->
    <div id="page-content">
    	<!--Page Title-->
    	<div class="page section-header text-center">
			<div class="page-title">
        		<div class="wrapper"><h1 class="page-width">Your cart</h1></div>
      		</div>
		</div>
        <!--End Page Title-->
        
        <div class="container">
        	<div class="row">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 main-col">
                	<form action="#" method="post" class="cart style2">
                        <!--php code to display dynamic data-->
                        <?php 
                            $get_ip_address = getIP(); 
                            $total_price=0;
                            $subtotal = 0;
                            $cart_query="select * from cart where ip_address='$get_ip_address'";
                            $result=mysqli_query($con,$cart_query);
                            $result_count=mysqli_num_rows($result);

                            if($result_count>0){
                                echo "
                                <table>
                                    <thead class='cart__row cart__header'>
                                        <tr>
                                            <th colspan='2' class='text-center'>Product</th>
                                            <th class='text-center'>Price</th>
                                            <th class='text-center'>Quantity</th>
                                            <th class='text-right'>Total</th>
                                            <th class='action'>&nbsp;</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                ";
                                while($row=mysqli_fetch_array($result)){
                                    $product_id=$row['product_id'];
                                    $product_quantity = $row['quantity'];
                                    $select_products="select * from products where product_id='$product_id'";
                                    $result_products=mysqli_query($con,$select_products);

                                

                                    while($row_product=mysqli_fetch_array($result_products)){
                                        $product_id_array = array($product_id);
                                        $price_table=array($row_product['product_price']);
                                        $product_price=$row_product['product_price'];
                                        $product_name=$row_product['product_name'];
                                        $product_image=$row_product['product_image'];

                                        $product_values=array_sum($price_table);
                                        $total_price=(int)$product_price*(int)$product_quantity;

                                        $subtotal = $subtotal + $total_price;
                                    
                                        

                                    
                                    echo "
                                        <tr class='cart__row border-bottom line1 cart-flex border-top'>
                                        <td class='cart__image-wrapper cart-flex-item'>
                                            <a href='#'><img class='cart__image' src='admin/upload_images/$product_image' alt=''></a>
                                        </td>
                                        <td class='cart__meta small--text-left cart-flex-item'>
                                            <div class='list-view-item__title'>

                                                <a href='#'>$product_name </a>
                                            </div>
                                        </td>
                                        <td class='cart__price-wrapper cart-flex-item'>
                                            <span class='money'>$$product_price</span>
                                        </td>
                                        <td class='cart__update-wrapper cart-flex-item text-right'>
                                            <div class='cart__qty text-center'>
                                                <div class='qtyField'>
                                                    <a class='qtyBtn minus' href='javascript:void(0);'><i class='icon icon-minus'></i></a>
                                                    <input class='cart__qty-input qty' type='text' name='updates[]' id='qty' pattern='[0-9]*' placeholder=$product_quantity>
                                                    <a class='qtyBtn plus' href='javascript:void(0);'><i class='icon icon-plus'></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class='text-right small--hide cart-price'>
                                            <div><span class='money'>$total_price</span></div>
                                        </td>
                                        <td class='text-center small--hide'><a href='cart.php?removeID=$product_id' class='btn btn--secondary cart__remove' title='Remove tem'><i class='icon icon anm anm-times-l'></i></a></td>
                                        ";
                                        
                                    
                                    global $con;
                                    
                                    if(isset($_GET['removeID'])){
                                        $removeID=$_GET['removeID'];
                                        $delete_query="Delete from cart where product_id=$removeID";
                                        $run_delete=mysqli_query($con,$delete_query);
                                        if($run_delete){
                                            echo "<script>window.open('cart.php','_self')</script>";
                                        }
                                    }
                                    
                            

                                    
                                    }
                                }
                            }else {
                                    echo "<h2 style='text-align:center; color:red;'>Cart is empty</h2>";
    
                            }
                            ?>  
                		
                            </tbody>
                    		<tfoot>
                                <?php
                                if($result_count>0){
                                    echo "
                                    <tr>
                                        <td colspan='3' class='text-left'><a href='index.php' class='btn--link cart-continue'><i class='icon icon-arrow-circle-left'></i> Continue shopping</a></td>
                                        <td colspan='3' class='text-right'><button type='submit' name='update_cart' class='btn--link cart-update'><i class='fa fa-refresh'></i> Update</button></td>
                                    </tr>";
                                    }else{
                                        echo "
                                        <td colspan='3' class='text-left'><a href='index.php' class='btn--link cart-continue'><i class='icon icon-arrow-circle-left'></i> Continue shopping</a></td>
                                        ";
                                    }
                                ?>
                            </tfoot>
                    </table>
                    
                    
                    </form>                   
               	</div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
                	
                    <div class="solid-border">
                      <div class="row">
                      	<span class="col-12 col-sm-6 cart__subtotal-title"><strong>Subtotal</strong></span>
                        <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money">$<?php echo"$subtotal";?></span></span>
                      </div>
                      <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
                      
                      <a href='user/checkout.php' class = 'btn'>Checkout</a>
                      <div class="paymnet-img"><img src="assets/images/payment-img.jpg" alt="Payment"></div>
                    </div>

                </div>
            </div>
        </div>
        
    </div>
    <!--End Body Content-->

    <!--function to update quantity-->
    <?php

    if (isset($_POST['update_cart'])) {
        $cart_query="select * from cart where ip_address='$get_ip_address'";
        $result=mysqli_query($con,$cart_query);
        $result_count=mysqli_num_rows($result);
        $j=0;
        while($row=mysqli_fetch_array($result)){
            $product_id=$row['product_id'];                           
        
         $quantity_array = $_POST['updates'];

        
                    $update_quantity = "update cart set quantity=$quantity_array[$j] where product_id=$product_id";
                    $run_update=mysqli_query($con,$update_quantity);
                    $j++;
                }

                echo '<meta http-equiv="refresh" content="1; URL=cart.php" />';
            
    }
    ?>






    
    <!--Footer-->
        <?php
        include('components/footer.php');
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

<!-- belle/cart.html   11 Nov 2019 12:47:01 GMT -->
</html>