<?php
    include('../components/connect.php');
    if(isset($_POST['insert_product'])){
        $product_name=$_POST['product_name'];
        $product_price=$_POST['product_price'];
        $product_category=$_POST['product_category'];
        $product_details=$_POST['product_details'];
        $product_keywords=$_POST['product_keywords'];
        $product_status='true';

        //accessing images
        $product_image=$_FILES['product_image']['name'];

        //accessing image temp name
        $temp_image=$_FILES['product_image']['tmp_name'];

        //checking empty condition
        if($product_name=='' or $product_price=='' or $product_category=='' or $product_details=='' or $product_keywords=='' or $product_image==''){
            echo "<script>alert('Please fill all the available fields')</script>";
            exit();
        }else{
            move_uploaded_file($temp_image,"./upload_images/$product_image");

            //insert query
            $insert_products="insert into products (product_name,product_price,product_category,product_details,product_keywords,product_image,product_status) 
            values ('$product_name','$product_price','$product_category','$product_details','$product_keywords','$product_image','$product_status')";
            $result_query=mysqli_query($con,$insert_products);
            if($result_query){
                echo "<script>alert('Successfully inserted the product')</script>"; 
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

    <style>
        .product_image{
            width:100px;
        }
        .product_table{
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

<!-- first child - Insert products-->
<div class="insert_product">
    <h1 style="text-align:center;">Insert Products</h1>
    <!--form-->
        <form action="" method="post" enctype="multipart/form-data" class="insert_product_form">
            <!--title-->
            <div class="form-container">
                <label for="product_name" class="form-label">Product Name:</label><br>
                <input type="text" name="product_name" id="product_name" placeholder="Enter product name" autocomplete="off"
                required="required">
            </div>
            
            <!--price-->
            <div class="form-container">
                <label for="product_price" class="form-label">Price:</label><br>
                <input type="text" name="product_price" id="product_price" placeholder="Enter price" autocomplete="off"
                required="required">
            </div>

            <!--categories-->
            <div class="form-container">
            <label for="product_category" class="form-label">Category:</label><br>
                <select name="product_category" id="">
                    <option value="">Select a Category</option>
                    <option value='liquor'>Liquor</option>
                    <option value='wine'>Wine</option>
                    <option value='beer'>Beer</option>
                </select>
            </div>

            <!--description-->
            <div class="form-container">
                <label for="product_details" class="form-label">Details:</label><br>
                <input type="text" name="product_details" id="product_details" placeholder="Enter product details" autocomplete="off"
                required="required">
            </div>

            <!--keywords-->
            <div class="form-container">
                <label for="product_keywords" class="form-label">Keywords:</label><br>
                <input type="text" name="product_keywords" id="product_keywords" placeholder="Enter product keywords" autocomplete="off"
                required="required">
            </div>


            <!--image -->
            <div class="form-container">
                <label for="product_image" class="form-label">Product image:</label><br>
                <input type="file" name="product_image" id="product_image" required="required">
            </div><br>

            <!--Submit-->
            <div class="form-container">
                <input type="submit" name="insert_product" value="Insert Products">
            </div>
        </form>
    </div>
</div>


<!-- second child - View products-->

<div class="view_product">
    <h1 style="text-align:center;">Added Products</h1>
    <table class="product_table" border=1px width=1350px>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product image</th>
                <th>Product Price</th>
                <th>Update</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $get_products="select * from products";
            $result=mysqli_query($con,$get_products);
            $number=0;
            while($row=mysqli_fetch_assoc($result)){
                $product_id=$row['product_id'];
                $product_name=$row['product_name'];
                $product_image=$row['product_image'];
                $product_price=$row['product_price'];
                $number++;
                ?>

                
                <tr class='text-center'>
                <td><?php echo $number; ?></td>
                <td><?php echo $product_name; ?></td>
                <td><img src='./upload_images/<?php echo $product_image; ?>' alt='' class='product_image'></td>
                <td><?php echo $product_price; ?></td>
                <td><a href='update_product.php?update_product_id=<?php echo $product_id?>'><u>Update</u></a></td>
                <td><a href='delete_product.php?delete_product_id=<?php echo $product_id?>'><u>Delete</u></a></td>
            </tr>
            <?php
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