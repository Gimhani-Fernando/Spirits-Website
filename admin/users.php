<?php
    include('../components/connect.php');
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

    <style>
        .order_image{
            width:100px;
        }
        .order_table{
            padding: 10px;
            margin: 50px;
            justify-content: center;
            text-align: center;
            background: #000;
            color: white;
        }

    </style>

</head>
<body>
<!--include header-->
<?php
        include('../components/admin_header.php');
?>

<!-- first child - View users-->

<div class="view_order">
    <h1 style="text-align:center;">All Users</h1>
    <table class="product_table" border=1px width=1350px>
        <thead>
            <tr>
                <th>No.</th>
                <th>First name.</th>
                <th>Last name</th>
                <th>email</th>
                <th>contact</th>
                <th>address</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $get_users="select * from user";
            $result=mysqli_query($con,$get_users);
            $row_count=mysqli_num_rows($result);
            if($row_count==0){
               echo "<h3 style='color:red;'>No users</h3>";
            }else{
                $serial=0;
                while($row=mysqli_fetch_assoc($result)){
                    $user_id=$row['user_id'];
                    $fname=$row['fname'];
                    $lname=$row['lname'];
                    $email=$row['email'];
                    $contact=$row['contact'];
                    $address=$row['address'];
                    $serial++;
                    ?>
                
                    
                    <tr class='text-center'>
                    <td><?php echo $serial; ?></td>
                    <td><?php echo $fname; ?></td>
                    <td><?php echo $lname; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $contact; ?></td>
                    <td><?php echo $address; ?></td>
                    <td><a href='delete_user.php?delete_user_id=<?php echo $user_id?>'>Delete</a></td>
                </tr>
            <?php
                }
            }
            ?>
            
        </tbody>

    </table>
</div>

<!--include footer-->
<!--?php
        include('../components/admin_footer.php');
? -->
</body>