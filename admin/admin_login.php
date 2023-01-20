<?php
    include('../components/connect.php');
    if(isset($_POST['login_admin'])){
        $username=$_POST['username'];
        $password=$_POST['password'];

        $select_query="select * from admin where username='$username'";
        $result=mysqli_query($con,$select_query);
        $row=mysqli_fetch_assoc($result);
        $row_count=mysqli_num_rows($result);

        if($row_count>0){
            $_SESSION['email']=$email;
            
            if(password_verify($password,$row['password'])){
                    $_SESSION['username']=$username;

                    echo "<script>alert('Logged in successfully')</script>";
                    echo "<script>window.open('product.php','_self')</script>";
            }else{
                echo "<script>alert('Invalid credentials')</script>";
            }
        }else{
            echo "<script>alert('Invalid credentials')</script>";
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
<!-- first child - login admin-->
<div class="insert_product">
    <h1 style="text-align:center;">Admin Login</h1>
    <!--form-->
        <form action="" method="post" class="insert_product_form">
            <!--Username-->
            <div class="form-container">
                <label for="username" class="form-label">Username:</label><br>
                <input type="text" name="username" id="username" placeholder="Enter username" autocomplete="off"
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
            
            <!--Submit-->
            <div class="form-container">
                <input type="submit" name="login_admin" value="Login">
            </div>
        </form>
    </div>
</div>

<p style="text-align:center;"><a href="admin_register.php">Create an admin account</a></p>