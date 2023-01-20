<?php
    include('../components/connect.php');

    if(isset($_GET['update_product_id'])){
        $update_id=$_GET['update_product_id'];
        $get_products="select * from products where product_id=$update_id";
        $result_products=mysqli_query($con,$get_products);
        $row=mysqli_fetch_assoc($result_products);
        $product_name=$row['product_name'];
        $product_price=$row['product_price'];
        $product_category=$row['product_category'];
        $product_details=$row['product_details'];
        $product_keywords=$row['product_keywords'];
        $product_image=$row['product_image'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Panel - update products</title>

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
    <h1>Update Products</h1>
    <!--form-->
        <form action="" method="post" enctype="multipart/form-data" class="insert_product_form">
            <!--title-->
            <div class="form-container">
                <label for="product_name" class="form-label">Product Name:</label><br>
                <input type="text" name="product_name" value="<?php echo $product_name?>" id="product_name" autocomplete="off"
                required="required">
            </div>
            
            <!--price-->
            <div class="form-container">
                <label for="product_price" class="form-label">Price:</label><br>
                <input type="text" name="product_price" id="product_price" value="<?php echo $product_price?>" autocomplete="off"
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
                <input type="text" name="product_details" id="product_details" value="<?php echo $product_details?>" autocomplete="off"
                required="required">
            </div>

            <!--keywords-->
            <div class="form-container">
                <label for="product_keywords" class="form-label">Keywords:</label><br>
                <input type="text" name="product_keywords" id="product_keywords" value="<?php echo $product_keywords?>" autocomplete="off"
                required="required">
            </div>


            <!--image -->
            <div class="form-container">
                <label for="product_image" class="form-label">Product image:</label><br>
                <input type="file" name="product_image" id="product_image" required="required">
                <img src="./upload_images/<?php echo $product_image?>" alt="" width=50px>
            </div><br>

            <!--Submit-->
            <div class="form-container">
                <input type="submit" name="update_product" value="Update Products">
            </div>
        </form>
    </div>
</div>


<!-- updating products -->
<?php
if(isset($_POST['update_product'])){
    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_category=$_POST['product_category'];
    $product_details=$_POST['product_details'];
    $product_keywords=$_POST['product_keywords'];

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

        //update query
        $update_products="update products set product_name='$product_name',product_price='$product_price',
        product_category='$product_category',product_details='$product_details',product_keywords='$product_keywords'
        ,product_image='$product_image',date=NOW() where product_id=$update_id";
        $result_query=mysqli_query($con,$update_products);
        if($result_query){
            echo "<script>alert('Successfully updateded the product')</script>"; 
            echo "<script>window.open('./product.php','_self')</script>";
        }
    }       
}
?>