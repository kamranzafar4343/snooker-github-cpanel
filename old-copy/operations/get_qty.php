<?php

include "../includes/config.php";

if($_POST['itemid'])
{
$item = $_POST['itemid'];
$sep=explode(',', $item);
$itemid=$sep[0];
$pur_req_id=$sep[1];

$query = "SELECT qty_allowed, qty_purchased FROM tbl_local_purchase where product='$itemid' and pur_req_id='$pur_req_id'";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      
                         
                        $qty_allowed = $row['qty_allowed'];
                        $qty_purchased = $row['qty_purchased'];
                        $qty=$qty_allowed-$qty_purchased;

}
$users_arr[] = array("qty" => $qty, "pur_req_id" => $pur_req_id);
echo json_encode($users_arr);
}