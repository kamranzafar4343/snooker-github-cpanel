<?php
error_reporting(0);
include "../includes/config.php";
include "../includes/session.php";

$itemid = $_POST['itemid'];
$item=explode(',', $itemid);
$items=$item[0];
$barcode=$item[1];
$item_serial=$item[2];
$pur_item_id=$item[3];

$type = $_POST['type'];

if($type == 'local')
{

$query = "SELECT rate,barcode,item_serial,pur_item_id,parent_id FROM tbl_single_purchase_detail where product = '$items' and barcode = '$barcode' and item_serial = '$item_serial' and pur_item_id = '$pur_item_id' limit 1";

$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){ 

     while($row = mysqli_fetch_array($result) ){

      	$parent_id = $row['parent_id'];
        $query_price = mysqli_query($conn,"SELECT cash_price FROM tbl_item_price where item_id='$items' and user_id='$parent_id'");  
        $price_data = mysqli_fetch_assoc($query_price) ;
        $cash_price=$price_data['cash_price'];
       
        if($cash_price=='')
        {
           $rate = $row['rate']; 
        }
        else
        {
            $rate=$cash_price;
        }
      	$barcode = $row['barcode'];
      	$item_serial = $row['item_serial'];
        $pur_item_id = $row['pur_item_id'];
      	$users_arr[] = array("rate" => $rate,"barcode" => $barcode, "item_serial" => $item_serial, "pur_item_id" => $pur_item_id);
   }

}
}
else if($type == 'local(iemi)')
{
  $query = "SELECT rate,barcode,item_serial,parent_id FROM tbl_single_purchase_detail where product = '$items' and barcode = '$barcode' and item_serial = '$item_serial' limit 1";

$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){ 

     while($row = mysqli_fetch_array($result) ){

        $parent_id = $row['parent_id'];
        $query_price = mysqli_query($conn,"SELECT cash_price FROM tbl_item_price where item_id='$items' and user_id='$parent_id'");  
        $price_data = mysqli_fetch_assoc($query_price) ;
        $cash_price=$price_data['cash_price'];
       
        if($cash_price=='')
        {
           $rate = $row['rate']; 
        }
        else
        {
            $rate=$cash_price;
        }
        $barcode = $row['barcode'];
        $item_serial = $row['item_serial'];
        
        $users_arr[] = array("rate" => $rate,"barcode" => $barcode, "item_serial" => $item_serial);
   }

}
}
else if($type == 'iemi')
{
    $query = "SELECT cash_rate,barcode,item_serial,pur_item_id FROM tbl_purchase_req_detail where product = '$items' and barcode = '$barcode' and item_serial = '$item_serial' and pur_item_id = '$pur_item_id' limit 1";

$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){ 

     while($row = mysqli_fetch_array($result) ){
       $cash_rate = $row['cash_rate'];
        if($cash_rate=='')
        {
           $rate = ''; 
        }
        else
        {
            $rate=$cash_rate;
        }
        $barcode = $row['barcode'];
        $item_serial = $row['item_serial'];
        $pur_item_id = $row['pur_item_id'];
        $users_arr[] = array("rate" => $rate,"barcode" => $barcode, "item_serial" => $item_serial, "pur_item_id" => $pur_item_id);
   }

}
}
else{


  $query = "SELECT cash_rate,barcode,item_serial,pur_item_id FROM tbl_purchase_req_detail where product = '$items' and barcode = '$barcode' and item_serial = '$item_serial' and pur_item_id = '$pur_item_id' limit 1";



$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){ 

     while($row = mysqli_fetch_array($result) ){
        $cash_rate = $row['cash_rate'];
        if($cash_rate=='')
        {
           $rate = ''; 
        }
        else
        {
            $rate=$cash_rate;
        }
  
      	$barcode = $row['barcode'];
      	$item_serial = $row['item_serial'];
        $pur_item_id = $row['pur_item_id'];
      	$users_arr[] = array("rate" => $rate,"barcode" => $barcode, "item_serial" => $item_serial, "pur_item_id" => $pur_item_id);
   }

}
}


// $sale_rate=($rate*($sale_per/100));
echo json_encode($users_arr);

