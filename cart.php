<!-- Connect File -->
<?php
  include('includes/connect.php');
  include('functions/common_function.php')
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Details</title>
    <!-- bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="style.css">

    <style>
    .cart_image{
    width: 80px;
    height: 80px;
    object-fit: contain;
    }
    </style>

</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        
    <!-- first child -->

        <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">

    <img src="Images/logo.png" alt="Logo" class="logo"> 
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="display_all.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Register</a>   
            </li>       
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart.php"> <i class="fa-solid fa-cart-shopping"></i> <sup> <?php cart_item(); ?>  </sup></a> 
            </li>
      </ul>

    </div>
  </div>
</nav>

<!-- calling cart function -->
<?php
  cart();
?>


<!-- second child -->

<!-- <nav class="navbar navabr-expand-lg navbar-dark bg-secondary"> 
  <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link"  href="#">Welcome Guest</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="#">Login</a>
        </li>
  </ul>
</nav> -->


<!-- third class -->

<div class="bg-light">
  <h3 class="text-center"> </h3>
  <p class="text-center">  </p>
</div>

<!-- fouth child-table -->
<div class="container">
    <div class="row">
        <form action="" method="post">
            <table class="table table-bordered text-center">

                <tbody>
                    <!-- php code to display dynamic data -->

                    <?php
                        global $con;
                        $get_ip_add = getIPAddress();
                        $total_price=0;
                        $cart_query="select * from `cart_details` where ip_address='$get_ip_add'";
                        $result=mysqli_query($con, $cart_query);
                        $result_count=mysqli_num_rows($result);
                        if($result_count>0){
                            echo "
                            <thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Remove</th>
                                    <th colspan='2'> Operations </th>
                                </tr>
                            </thead>";



                        while($row=mysqli_fetch_array($result)){
                            $product_id=$row['product_id'];
                            $select_products="Select * from `products` where product_id='$product_id'";
                            $result_products=mysqli_query($con, $select_products);
                            while($row_product_price=mysqli_fetch_array($result_products)){
                                $product_price=array($row_product_price['product_price']);
                                $price_table=$row_product_price['product_price'];
                                $product_title=$row_product_price['product_title'];
                                $product_image=$row_product_price['product_image'];
                                $product_values=array_sum($product_price);
                                $total_price+=$product_values;
                        
                        
                    ?>
                                <tr>
                                    <td> <?php echo $product_title ?> </td>
                                    <td> <img src="./product_images/<?php echo $product_image?>" alt="" class="cart_image"> </td>
                                    <td> <input type="text" name="qty" id="" class="form-input w-20"></td>
                                    <?php
                                        $get_ip_add = getIPAddress();
                                        if(isset($_POST['update_cart'])){
                                            $quantities=$_POST['qty'];
                                            $update_cart="update `cart_details` set quantity=$quantities where ip_address='$get_ip_add'";
                                            $result_products_quantity=mysqli_query($con, $update_cart);
                                            $total_price=$total_price*$quantities;
                                        }
                                    ?>
                                    <td> ৳<?php echo $price_table?>  </td>
                                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                    <td>
                                        <!-- <button class="bg-info px-3 py-2 border-0 mx-3" > Update </button> --> 
                                        <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                                        <!-- <button class="bg-info px-3 py-2 border-0 mx-3" > Remove </button> -->
                                        <input type="submit" value="Remove" class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">
                                    </td>
                                </tr>
                    <?php 
                    }   
                } 
              }else{
                echo "<h2 class='text-center text-danger'> Cart is Empty</h2>";
              } ?>
                </tbody>
            </table>
        </form>
        <!-- subtotal -->
        <?php
            $get_ip_add = getIPAddress();
            $cart_query="select * from `cart_details` where ip_address='$get_ip_add'";
            $result=mysqli_query($con, $cart_query);
            $result_count=mysqli_num_rows($result);
            if($result_count>0){
                echo " 
                    <h4 class='px-3'> Subtotal: <strong> ৳ $total_price </strong></h4>
                    <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
                    <button class='bg-info px-3 py-2 border-0 text-light'>  <a href='./users/checkout.php' class='text-light text-decotation-none'>  Checkout</button> </a>";
            } else{
                echo "<input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>";

            }
            if(isset($_POST['continue_shopping'])){
                echo "<script>window.open('index.php', '_self')</script>";
            }
        ?>




        <!-- <div class="d-flex mb-3">
            <h4 class="px-3"> Subtotal: <strong> ৳<?php //echo $total_price ?></strong></h4>
            <a href="index.php"> <button class="bg-info px-3 py-2 border-0 mx-3"> Continue Shopping</button> </a>
            <a href="#"> <button class="bg-info px-3 py-2 border-0 mx-3"> Checkout</button> </a>
        </div>  -->
    </div>
</div>

<!-- function to remove items from data -->
<?php
function remove_cart_item(){
    global $con;
    if(isset($_POST['remove_cart'])){
        foreach($_POST['removeitem'] as $remove_id){
            echo $remove_id;
            $delete_query="Delete from `cart_details` where product_id=$remove_id";
            $run_delete=mysqli_query($con, $delete_query);
            if($run_delete){
                echo "<script> window.open('cart.php', '_self')</script>";
            }
        }
    }
}

echo $remove_item=remove_cart_item();

?>


<!-- last child -->
<!-- include footer -->
<?php
include("./includes/footer.php")
?>

    <!-- bootstrap JS link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>


