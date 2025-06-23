<?php
error_reporting(0);
include "../includes/config.php";

$product = $_POST['product'];



$query = "SELECT category FROM tbl_items where item_id = '$product'";

$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){ 

     while($row = mysqli_fetch_array($result) ){

      	$category = $row['category'];
      	

      	
   }

}


// $sale_rate=($rate*($sale_per/100));
echo ($category);