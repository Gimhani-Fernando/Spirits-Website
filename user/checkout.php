<?php
    @session_start();
    if(!isset($_SESSION['email'])){
        include('login.php');
     }else{
        include('place_order.php');
    }
?>