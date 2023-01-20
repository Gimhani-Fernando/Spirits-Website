<?php
    include('../components/connect.php');
    if(isset($_POST['insert_admin'])){
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $encrypted_password=password_hash($password,PASSWORD_DEFAULT);
        $confpassword=$_POST['conpassword'];
        
        //checking empty condition
        if($username=='' or $email=='' or $password=='' or $confpassword==''){
            echo "<script>alert('Please fill all the available fields')</script>";
            exit();
        }else{

        //select query
        $select_query="select * from admin where username='$username'";
        $result=mysqli_query($con,$select_query);
        $rows_count=mysqli_num_rows($result);

        if($rows_count>0){
            echo "<script>alert('Username already exist')</script>";
        }else if($password!=$confpassword){
            echo "<script>alert('Passwords do not match')</script>";
        }else{

            //insert_query
            $insert_query="insert into admin (username,email,password) values 
            ('$username','$email','$encrypted_password')";
            $sql_execute=mysqli_query($con,$insert_query);
            if($sql_execute){
                echo "<script>alert('Data inserted successfully')</script>";
                echo "<script>window.open('product.php','_self')</script>";

            }else{
                die(mysqli_error($con));
            }
        }
        }       
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Panel</title>

	<!-- custom css file link  -->
	<link rel="stylesheet" href="admin_style.css">
	
    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<!-- Start of header section-->
<header class="header">
		<div class="logo">
			<img src="../assets/images/logo.png" width="150px"> 
		</div>
</header>
<!--end of header section-->

<!-- first child - signup admin-->
<div class="insert_product">
    <h1 style="text-align:center;">Admin Registration</h1>
    <!--form-->
        <form action="" method="post" class="insert_product_form">
            <!--Username-->
            <div class="form-container">
                <label for="username" class="form-label">Username:</label><br>
                <input type="text" name="username" id="username" placeholder="Enter username" autocomplete="off"
                required="required">
            </div>
            <br>
            <!--email-->
            <div class="form-container">
                <label for="email" class="form-label">Email:</label><br>
                <input type="email" name="email" id="email" placeholder="Enter email" autocomplete="off"
                required="required">
            </div>
            <br>
            <!--password-->
            <div class="form-container">
                <label for="password" class="form-label">Password:</label><br>
                <input type="password" name="password" id="password" placeholder="Enter password" autocomplete="off"
                required="required">
            </div>
            <br>
            <!--Confirm password-->
            <div class="form-container">
                <label for="conpassword" class="form-label">Confirm password:</label><br>
                <input type="password" name="conpassword" id="conpassword" placeholder="Confirm password" autocomplete="off"
                required="required">
            </div>
            <br>
            <!--Submit-->
            <div class="form-container">
                <input type="submit" name="insert_admin" value="Register">
            </div>
        </form>
    </div>
</div>

<p style="text-align:center;">Already have an admin account? <a href="admin_login.php">login</a></p>