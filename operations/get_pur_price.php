<?php

include "../includes/config.php";

$itemid = $_POST['itemid'];


$query = "SELECT barcode FROM tbl_items where item_id = '$itemid'";

$result = mysqli_query($conn,$query);

error_reporting(0);

if(mysqli_num_rows($result)>0)
{
     while($row = mysqli_fetch_array($result) ){
      $barcode = $row['barcode'];


   }
}
else
{
	$barcode ='';
}
 



echo($barcode);
