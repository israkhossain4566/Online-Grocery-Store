<?php
include('../includes/connect.php');
if(isset($_POST['insert_cat'])){
    $category_title=$_POST['cat_title'];

    // select data from database
    $select_query= "Select * from `categories` where category_title='$category_title'";
    $result_select=mysqli_query($con, $select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0) {
        echo "<script> alert('This category is present inside the database') </script>";
    }else {
        $insert_query="insert into `categories` (category_title) values ('$category_title')";
        $result=mysqli_query($con, $insert_query);
        if($result) {
            echo "<script> alert('Category has been inserted successfully') </script>";
        }
    }
}
?>






<?php
$con = mysqli_connect('localhost', 'root', '', 'mystore');
if($con){
   echo "connection successful";
} else {
   die(mysqli_error($con));
} 
?>





