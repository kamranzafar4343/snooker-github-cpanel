<?php

include "../includes/config.php";
if($_POST['Installment_id'])
{
	$Installment_id = $_POST['Installment_id'];


$query = "SELECT * FROM tbl_installment where customer = '$Installment_id' and installment_status='Pending'";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      $item_id = $row['item_id'];
      $item_serial = $row['item_serial'];
      $barcode = $row['barcode'];
      $plan_id = $row['plan_id'];
      
      $query1 = mysqli_query($conn,"SELECT * FROM tbl_items where item_id='$item_id'");

		$data=mysqli_fetch_assoc($query1);
	   $item_name = $data['item_name'];
        $brand_id=$data['brand_id'];
                          $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
                          $value2 = mysqli_fetch_assoc($sql2);
                          $brand_name=$value2['cat_name'];
		
    
      

      $users_arr[] = array("item_id" => $item_id, "item_name" => $item_name, "plan_id" => $plan_id, "item_serial" => $item_serial, "barcode" => $barcode, "brand_name" => $brand_name);
   }
 



echo json_encode($users_arr);
}

