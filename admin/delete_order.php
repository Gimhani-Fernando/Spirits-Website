<?php
    include('../components/connect.php');

    if(isset($_GET['delete_order_id'])){
        $delete_id=$_GET['delete_order_id'];
        $delete_query="delete from orders where order_id=$delete_id";
        $result_delete=mysqli_query($con,$delete_query);
        if($result_delete){
            echo "<script>alert('Successfully deleted the order')</script>"; 
            echo "<script>window.open('./orders.php','_self')</script>";
        }        
    }

?>