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
    <title>Grocery Dokan</title>
    <!-- bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css file -->
    <link rel="stylesheet" href="style.css">
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
        <li class="nav-item">
          <a class="nav-link" href="#">Register</a>          
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        <li class="nav-item">
          <a class="nav-link" href="#"> <i class="fa-solid fa-cart-shopping"></i> <sup> <?php cart_item(); ?> </sup></a> 
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: ৳ <?php total_cart_price(); ?></a>  

      </ul>
      <form class="d-flex" role="search" action="search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search Products" name="search_data">
        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

<!-- calling cart function -->
<?php
  cart();
?>

<!-- second child -->

<nav class="navbar navabr-expand-lg navbar-dark bg-secondary"> 
  <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link"  href="#">Welcome Guest</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="./users/user_login.php">Login</a>
        </li>
  </ul>
</nav>


<!-- third class -->

<div class="bg-light">
  <h3 class="text-center"> </h3>
  <p class="text-center">  </p>
</div>

<!-- fourth child -->
<div class="row px-1">

  <div class="col-md-10">
    <!-- Product Display -->
    <div class="row"> 
    <!-- fetching products -->
      <?php 
      // calling function
      view_details();
      get_unique_categories();
      get_unique_brands();     
      ?>

<!-- row end -->
    </div>
<!-- column end -->
</div>



<!-- Side Nav -->


  <div class="col-md-2 bg-secondary p-0" >
<!-- Brands to be Displayed -->
    <ul class="navabr-nav me-auto text-center" style="list-style: none;">
      <li class="nav-item bg-info">
        <a href="#" class="nav-link text-light"> <h4>Delivery Brands</h4> </a>
      </li>
          <?php
          getbrands();
          ?>
    </ul>

    <ul class="navabr-nav me-auto text-center" style="list-style: none;">
      <li class="nav-item bg-info">
        <a href="#" class="nav-link text-light"> <h4>Categories</h4> </a>
      </li>
     
          <?php
            getcategories();
          ?>
    </ul>
  </div>
</div>





<!-- last child -->
<!-- include footer -->
<?php
include("./includes/footer.php")
?>

    <!-- bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>


