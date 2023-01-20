<?php
    include('../components/connect.php');

    if(isset($_GET['delete_product_id'])){
        $delete_id=$_GET['delete_product_id'];
        $delete_query="delete from products where product_id=$delete_id";
        $result_delete=mysqli_query($con,$delete_query);
        if($result_delete){
            echo "<script>alert('Successfully deleted the product')</script>"; 
            echo "<script>window.open('./product.php','_self')</script>";
        }        
    }

?>