<?php
    include('../components/connect.php');

    if(isset($_GET['delete_user_id'])){
        $delete_id=$_GET['delete_user_id'];
        $delete_query="delete from user where user_id=$delete_id";
        $result_delete=mysqli_query($con,$delete_query);
        if($result_delete){
            echo "<script>alert('Successfully deleted the users')</script>"; 
            echo "<script>window.open('./users.php','_self')</script>";
        }        
    }

?>