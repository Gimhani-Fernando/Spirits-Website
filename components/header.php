<?php
//connect file
include('components/connect.php');
include('ip/ip_address.php');


@session_start();
?>

<!--Search Form Drawer-->
	<div class="search">
        <div class="search__form">
            <form action="shop.php" method="get" class="search-bar__form">
                <button class="go-btn search__button" type="submit" name="search_data_product"><i class="icon anm anm-search-l"></i></button>
                <input class="search__input" type="search" value="" placeholder="Search entire store..." name="search_data" autocomplete="off">
            </form>
            <button type="button" class="search-trigger close-btn"><i class="icon anm anm-times-l"></i></button>
        </div>
    </div>
    <!--End Search Form Drawer-->
    
    <!--Top Header-->
    <div class="top-header">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-10 col-sm-8 col-md-5 col-lg-4">
                    <p class="phone-no"><i class="anm anm-phone-s"></i> +440 0(111) 044 833</p>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
                	<div class="text-center"><p class="top-header_middle-text"> Worldwide Express Shipping</p></div>
                </div>
                <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                	<span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
                    <ul class="customer-links list-inline">
                        <?php
                            if(!isset($_SESSION['email'])){
                                echo "<li><a href='./user/login.php'>Login</a></li>";
                            }else{
                                echo "<li><a href='./user/logout.php'>Logout</a></li>";
                            }
                        ?>   
                        <?php
                            if(!isset($_SESSION['email'])){
                                echo "<li><a href='./user/register.php'>Create Account</a></li>";
                            }else{
                                echo "<li><a href='./user/profile.php'>".$_SESSION['fname']."_Account</a></li>";
                            }
                        ?>                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--End Top Header-->
<div class="header-wrap animated d-flex">
    	<div class="container-fluid">        
            <div class="row align-items-center">
            	<!--Desktop Logo-->
                <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                    <a href="index.php">
                    	<img src="assets/images/logo.svg" alt="" />
                    </a>
                </div>
                <!--End Desktop Logo-->
                <div class="col-2 col-sm-3 col-md-3 col-lg-8">
                	<div class="d-block d-lg-none">
                        <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                        	<i class="icon anm anm-times-l"></i>
                            <i class="anm anm-bars-r"></i>
                        </button>
                    </div>
                	<!--Desktop Menu-->
                	<nav class="grid__item" id="AccessibleNav"><!-- for mobile -->
                        <ul id="siteNav" class="site-nav medium center hidearrow">
                            <li class="lvl1 parent megamenu"><a href="./index.php">Home <i class="anm anm-angle-down-l"></i></a></li>
                            <li class="lvl1 parent megamenu"><a href="./shop.php">Shop <i class="anm anm-angle-down-l"></i></a></li>
                            <li class="lvl1 parent dropdown"><a href="./contact-us.php">Contact us <i class="anm anm-angle-down-l"></i></a>
                        </ul>
                    </nav>
                    <!--End Desktop Menu-->
                </div>
                
                <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                	<div class="site-cart">
                    	<a href="./cart.html" class="site-header__cart" title="Cart">
                        	<i class="icon anm anm-bag-l"></i>
                            <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count">
                            <?php
                            if(isset($_GET['add_to_cart'])){
                                global $con;//because we are having it inside file
                                $get_ip_address = getIP();  
                                $select_query="select * from cart where ip_address='$get_ip_address'";
                                $result_query=mysqli_query($con,$select_query);
                                $count_cart_items=mysqli_num_rows($result_query);
                                }else{
                                global $con;//because we are having it inside file
                                $get_ip_address = getIP();  
                                $select_query="select * from cart where ip_address='$get_ip_address'";
                                $result_query=mysqli_query($con,$select_query);
                                $count_cart_items=mysqli_num_rows($result_query);
                                }
                                echo $count_cart_items;
                            ?>
                            </span>
                        </a>
                        <!--Minicart Popup-->
                        <div id="header-cart" class="block block-cart">
                        	
                            <div class="total">
                            	<div class="total-in">
                                	<span class="label">Cart Subtotal:</span><span class="product-price"><span class="money">
                                    <?php
                                        $get_ip_address = getIP(); 
                                        $subtotal = 0;
                                        $cart_query="select * from cart where ip_address='$get_ip_address'";
                                        $result=mysqli_query($con,$cart_query);
                                        $result_count=mysqli_num_rows($result);
            
                                        if($result_count>0){
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
                                                    $subtotal+=(int)$product_price*(int)$product_quantity;
                                                }
                                            }
                                        }
                                        echo $subtotal;
            
                                        ?>
                                    </span></span>
                                </div>
                                 <div class="buttonSet text-center">
                                    <a href="cart.php" class="btn btn-secondary btn--small">View Cart</a>
                                </div>
                            </div>
                        </div>
                        <!--End Minicart Popup-->
                    </div>
                    <div class="site-header__search">
                    	<button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button>
                    </div>
                </div>
        	</div>
        </div>
    </div>
    