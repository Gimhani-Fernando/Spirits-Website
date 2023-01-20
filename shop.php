<?php
//connect file
include('components/connect.php');
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<!-- Spirits/shop.php   17 Jan 2023 -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shop &ndash; Spirits Store</title>
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
<body class="template-collection belle">
<div class="pageWrapper">
	
    <!--Header-->
    <?php
        include('./components/header.php');    
    ?>
    

<!--Body Content-->
<div id="page-content">
    	<!--Collection Banner-->
    	<div class="collection-header">
			<div class="collection-hero">
        		<div class="collection-hero__image"><img class="blur-up lazyload" data-src="./assets/images/categories/1.png" src="./assets/images/categories/1.png" alt="Women" title="Women" /></div>
        		<div class="collection-hero__title-wrapper"><h1 class="collection-hero__title page-width"></h1></div>
      		</div>
		</div>
        <!--End Collection Banner-->
        
        <div class="container">
        	<div class="row">
            	<!--Sidebar-->
            	<div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
                	<div class="closeFilter d-block d-md-none d-lg-none"><i class="icon icon anm anm-times-l"></i></div>
                	<div class="sidebar_tags">
                    	<!--Categories-->
                    	<div class="sidebar_widget categories filter-widget">
                            <div class="widget-title"><h2>Categories</h2></div>
                            <div class="widget-content">
                                <ul class="sidebar_categories">
                                    <li class="level1 sub-level"><a href="./shop.php?category='liquor'" class="site-nav">Liquors</a>
                                    	
                                    </li>

                                    <li class="level1 sub-level"><a href="./shop.php?category='wine'" class="site-nav">Wines</a>
                                    	
                                    </li>
                                    <li class="lvl-1"><a href="./shop.php?category='beer'" class="site-nav">Beers</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                        <!--Categories-->
                        
                    </div>
                </div>
                <!--End Sidebar-->

                <!--Main Content-->
                <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                <div class="productList">
                <div class="grid-products grid--view-items">
                    <div class="row">
                
                    <hr>
                            <?php
                                //get all products
                                if(!isset($_GET['category']) && !isset($_GET['search_data_product'])){

                                    echo "<h2 class='title'>All products</h2>
                                    <div class='row'>";
                                    
                                    $select_query="Select * from products";
                                    $result_query=mysqli_query($con,$select_query);
                                    while($row=mysqli_fetch_assoc($result_query)){
                                        $product_id=$row['product_id'];
                                        $product_name=$row['product_name'];
                                        $product_details=$row['product_details'];
                                        $product_keywords=$row['product_keywords'];
                                        $product_image=$row['product_image'];
                                        $category=$row['product_category'];
                                        $product_price=$row['product_price'];

                                        echo "
                                        
                                                    <div class='col-6 col-sm-6 col-md-4 col-lg-4 item'>
                                                        <div class='product-image'>
                                                            <a href='#'>
                                                                <img class='primary blur-up lazyload' data-src='admin/upload_images/$product_image' src='admin/upload_images/$product_image' alt=''>
                                                                <img class='hover blur-up lazyload' data-src='admin/upload_images/$product_image' src='admin/upload_images/$product_image' alt=''>
                                                            </a>
                                                            <form class='variants add' action='#' onclick='window.location.href='cart.html''method='post'>
                                                            <button class='btn btn-addto-cart' type='button'><a href='shop.php?add_to_cart=$product_id'>Add to cart</a></button>
                                                            </form>
                                                        </div>
                                                        <div class='product-details text-center'>
                                                        <div class='product-name'>
                                                                <a href='#'>$product_name</a>
                                                            </div><br>
                                                        <div class='product-name'>
                                                                <a href='#'>$product_details</a>
                                                            </div><br>
                                                            
                                                            <div class='product-price'>
                                                                <span class='price'>$product_price</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                          
                                        ";
                                    }
                                }


                                //get category products
                                if(isset($_GET['category'])){
                                    $category=$_GET['category'];
                                    echo "<h2 class='title'>$category products</h2>
                                    <div class='row'>";
                                
                                    $select_query="Select * from products where product_category=$category";
                                    $result_query=mysqli_query($con,$select_query);
                                    $num_of_rows=mysqli_num_rows($result_query);
                                    if($num_of_rows==0){
                                        echo "<h2 class='text-center text-danger'><br><br>No Stock for this category</h2>";
                                    }
                                            
                                    while($row=mysqli_fetch_assoc($result_query)){
                                        $product_id=$row['product_id'];
                                        $product_name=$row['product_name'];
                                        $product_details=$row['product_details'];
                                        $product_keywords=$row['product_keywords'];
                                        $product_image=$row['product_image'];
                                        $product_price=$row['product_price'];
                                        echo "
                                        <div class='col-6 col-sm-6 col-md-4 col-lg-4 item'>
                                            <div class='product-image'>
                                                <a href='#'>
                                                    <img class='primary blur-up lazyload' data-src='admin/upload_images/$product_image' src='admin/upload_images/$product_image' alt=''>
                                                    <img class='hover blur-up lazyload' data-src='admin/upload_images/$product_image' src='admin/upload_images/$product_image' alt=''>
                                                </a>
                                                <form class='variants add' action='#' onclick='window.location.href='cart.html''method='post'>
                                                <button class='btn btn-addto-cart' type='button'><a href='shop.php?add_to_cart=$product_id'>Add to cart</a></button>
                                                </form>
                                            </div>
                                            <div class='product-details text-center'>
                                                <div class='product-name'>
                                                    <a href='#'>$product_name</a>
                                                </div><br>
                                                <div class='product-name'>
                                                        <a href='#'>$product_details</a>
                                                    </div><br>
                                                    
                                                <div class='product-price'>
                                                    <span class='price'>$product_price</span>
                                                </div>
                                            </div>
                                        </div>
                                        ";
                                    }
                                }


                                //get search products
                                if(isset($_GET['search_data_product'])){
                                    echo "<h2 class='title'>Searched products</h2>
                                        <div class='row'>";
                                    $search_data_value=$_GET['search_data'];
                                    $search_query="Select * from products where product_keywords LIKE '%$search_data_value%'";
                                        $result_query=mysqli_query($con,$search_query);
                                        $num_of_rows=mysqli_num_rows($result_query);
                                        if($num_of_rows==0){
                                            echo "<h2 style = 'color:red''>
                                            <br><br><br>No results match</h2>";
                                        }
                                        while($row=mysqli_fetch_assoc($result_query)){
                                            $product_id=$row['product_id'];
                                            $product_name=$row['product_name'];
                                            $product_details=$row['product_details'];
                                            $product_keywords=$row['product_keywords'];
                                            $product_image=$row['product_image'];
                                            $product_price=$row['product_price'];
                                            echo "
                                            <div class='col-6 col-sm-6 col-md-4 col-lg-4 item'>
                                            <div class='product-image'>
                                                <a href='#'>
                                                    <img class='primary blur-up lazyload' data-src='admin/upload_images/$product_image' src='admin/upload_images/$product_image' alt=''>
                                                    <img class='hover blur-up lazyload' data-src='admin/upload_images/$product_image' src='admin/upload_images/$product_image' alt=''>
                                                </a>
                                                <form class='variants add' action='#' onclick='window.location.href='cart.html''method='post'>
                                                    <button class='btn btn-addto-cart' type='button'><a href='shop.php?add_to_cart=$product_id'>Add to cart</a></button>
                                                </form>
                                            </div>
                                            <div class='product-details text-center'>
                                                <div class='product-name'>
                                                    <a href='#'>$product_name</a>
                                                </div><br>
                                                <div class='product-name'>
                                                        <a href='#'>$product_details</a>
                                                    </div><br>
                                                    
                                                <div class='product-price'>
                                                    <span class='price'>$product_price</span>
                                                </div>
                                            </div>
                                        </div>
                                        ";
                                    }
                                }
                                
                            ?>
                        </div>  
                    </div>
                </div>    
                </div>    
                </div>
                <!--End Main Content-->
            </div>
        </div>
        
    </div>
    <!--End Body Content-->
          
    
    <!-- Add to cart function-->
    <?php
        if(isset($_GET['add_to_cart'])){
            $get_ip_address = getIP();  
            $get_product_id=$_GET['add_to_cart'];
            $select_query="select * from cart where ip_address='$get_ip_address' and product_id=$get_product_id";
            $result_query=mysqli_query($con,$select_query);
            $num_of_rows=mysqli_num_rows($result_query);
            if($num_of_rows>0){
                echo "<script>alert('This item is already present inside the cart')</script>";
                echo "<script>window.open('shop.php','_self')</script>";
            }else{
                $insert_query="insert into cart (product_id,ip_address,quantity) values 
                ($get_product_id,'$get_ip_address',1)";
                $result_query=mysqli_query($con,$insert_query);
                echo "<script>alert('Item is added to the cart')</script>";
                echo "<script>window.open('shop.php','_self')</script>";


            }
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

</html>

