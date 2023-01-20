<?php
    include('../components/connect.php');
    include('../ip/ip_address.php');

    if(isset($_GET['user_id'])){
        $user_id=$_GET['user_id'];
    }

    //getting total items and total price of all items
    $get_ip_address=getIP();
    $total_price=0;
    $cart_query_price="select * from cart where ip_address='$get_ip_address'";
    $invoice_number=mt_rand();
    $status='pending';
    $result_cart_price=mysqli_query($con,$cart_query_price);
    $count_products=mysqli_num_rows($result_cart_price);

    while($row_price=mysqli_fetch_array($result_cart_price)){
        $product_id=$row_price['product_id'];
        $select_product="select * from products where product_id=$product_id";
        $run_price=mysqli_query($con,$select_product);
        while($row_product_price=mysqli_fetch_array($run_price)){
            $product_price=array($row_product_price['product_price']);
            $product_values=array_sum($product_price);
            $total_price+=$product_values;
        }
    }

    //getting quantity from cart
    $get_cart="select * from cart";
    $run_cart=mysqli_query($con,$get_cart);
    $get_item_quantity=mysqli_fetch_array($run_cart);
    $quantity=$get_item_quantity['quantity'];
    if($quantity==0){
        $quantity=1;
    }else{
        $quantity=$quantity;
    }

    //getting total_amount
    $get_ip_address = getIP(); 
    $total_price=0; 
    $cart_query="select * from cart where ip_address='$get_ip_address'";
    $result=mysqli_query($con,$cart_query);
    $result_count=mysqli_num_rows($result);

    while($row=mysqli_fetch_array($result)){
        $product_id=$row['product_id'];
        $quantity=$row['quantity'];
        if($quantity==0){
            $quantity=1;
        }else{
            $quantity=$quantity;
        }
        
        $select_products="select * from products where product_id='$product_id'";
        $result_products=mysqli_query($con,$select_products);

        while($row_product=mysqli_fetch_array($result_products)){
            $price_table=array($row_product['product_price']);
            $product_price=$row_product['product_price'];
            $product_name=$row_product['product_name'];
            $product_image=$row_product['product_image'];

            $total_price+=$quantity*$product_price;    

        }
    }
    $insert_orders="insert into orders (user_id,invoice,amount,number_of_products,order_date,order_status)
    values ($user_id,$invoice_number,$total_price,$count_products,NOW(),'$status')";
    $result_query=mysqli_query($con,$insert_orders);
    if($result_query){
        echo "<script>alert('orders are submitted successfully')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
    }
    


    //delete items from cart
    $empty_cart="delete from cart where ip_address='$get_ip_address'";
    $result_empty_cart=mysqli_query($con,$empty_cart);




?>