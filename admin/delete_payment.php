<?php
    include('../components/connect.php');

    if(isset($_GET['delete_payment_id'])){
        $delete_id=$_GET['delete_payment_id'];
        $delete_query="delete from payments where payment_id=$delete_id";
        $result_delete=mysqli_query($con,$delete_query);
        if($result_delete){
            echo "<script>alert('Successfully deleted the payment')</script>"; 
            echo "<script>window.open('./orders.php','_self')</script>";
        }        
    }

?>