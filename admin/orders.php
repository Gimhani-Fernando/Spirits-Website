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

<!-- first child - View orders-->

<div class="view_order">
    <h1 style="text-align:center;">All Orders</h1>
    <table class="product_table" border=1px width=1350px>
        <thead>
            <tr>
                <th>Serial No.</th>
                <th>Invoice No.</th>
                <th>Bill Amount</th>
                <th>Number of products</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $get_orders="select * from orders";
            $result=mysqli_query($con,$get_orders);
            $row_count=mysqli_num_rows($result);
            if($row_count==0){
               echo "<h3 style='color:red;'>No Orders</h3>";
            }else{
                $serial=0;
                while($row=mysqli_fetch_assoc($result)){
                    $order_id=$row['order_id'];
                    $user_id=$row['user_id'];
                    $invoice=$row['invoice'];
                    $amount=$row['amount'];
                    $number_of_products=$row['number_of_products'];
                    $order_date=$row['order_date'];
                    $status=$row['order_status'];
                    $serial++;
                    ?>
                
                    
                    <tr class='text-center'>
                    <td><?php echo $serial; ?></td>
                    <td><?php echo $invoice; ?></td>
                    <td><?php echo $amount; ?></td>
                    <td><?php echo $number_of_products; ?></td>
                    <td><?php echo $order_date; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><a href='delete_order.php?delete_order_id=<?php echo $order_id?>'>Delete</a></td>
                </tr>
            <?php
                }
            }
            ?>
            
        </tbody>

    </table>
</div>


<!-- second child - View payments-->
<br><br>
<div class="view_order">
    <h1 style="text-align:center;">All Payments</h1>
    <table class="product_table" border=1px width=1350px>
        <thead>
            <tr>
                <th>Serial No.</th>
                <th>Invoice No.</th>
                <th>Bill Amount</th>
                <th>Payment mode</th>
                <th>Status</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $get_orders="select * from payments";
            $result=mysqli_query($con,$get_orders);
            $row_count=mysqli_num_rows($result);
            if($row_count==0){
               echo "<h3 style='color:red;'>No Payments made</h3>";
            }else{
                $number=0;
                while($row=mysqli_fetch_assoc($result)){
                    $order_id=$row['order_id'];
                    $payment_id=$row['payment_id'];
                    $invoice=$row['invoice_number'];
                    $amount=$row['amount'];
                    $mode=$row['payment_mode'];
                    $date=$row['date'];
                    $number++;
                    ?>
                
                    
                    <tr class='text-center'>
                    <td><?php echo $number; ?></td>
                    <td><?php echo $invoice; ?></td>
                    <td><?php echo $amount; ?></td>
                    <td><?php echo $mode; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><a href='delete_payment.php?delete_payment_id=<?php echo $order_id?>'>Delete</a></td>
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