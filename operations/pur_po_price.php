<?php

include "../includes/config.php";

$itemid = $_POST['itemid'];


$query = "SELECT barcode, item_id, purchase, retail FROM tbl_items where item_id = '$itemid'";

$result = mysqli_query($conn,$query);

error_reporting(0);

if(mysqli_num_rows($result)>0)
{
     while($row = mysqli_fetch_array($result) ){
      $barcode = $row['barcode'];
      $item_id = $row['item_id'];
      $rate = $row['purchase'];
      $sale_rate = $row['retail'];

   }
}
else
{
	$barcode ='';
	$rate ='';
	$sale_rate ='';
}
 
$users_arr[] = array("barcode" => $barcode, "rate" => $rate, "sale_rate" => $sale_rate);

echo json_encode($users_arr);
