<?php

include "../includes/config.php";
include "../includes/session.php";

$product_search = $_POST['product_search'];
$sql="SELECT branch_id,created_by, user_privilege  FROM users where user_id='$userid'";
	                                              $result1 = mysqli_query($conn,$sql);
	                                              
	                                              while($data = mysqli_fetch_array($result1) ){
	                                                $created_by = $data['created_by'];
	                                                $branch_id = $data['branch_id'];
	                                                $user_privilege = $data['user_privilege'];
                                               		}
if($user_privilege!='branch' && $created_by=='1')
                            {
                          
                    $item_query="SELECT tbl_items.*, tbl_cat.catagory_name, tbl_purchase_detail.* FROM tbl_items INNER JOIN tbl_cat ON tbl_items.category = tbl_cat.id INNER JOIN tbl_purchase_detail ON tbl_items.item_id = tbl_purchase_detail.product WHERE tbl_purchase_detail.qty_rec!='' and tbl_purchase_detail.parent_id='$created_by' and tbl_purchase_detail.product='$product_search'"; 
                }

  else
  {
    if($user_privilege=='branch')
    {
      $created_by=$userid;
    }
    else
    {
      $created_by=$created_by;
    }
$item_query="SELECT * FROM tbl_purchase_req_detail INNER JOIN tbl_items ON tbl_purchase_req_detail.product = tbl_items.item_id  WHERE
   tbl_purchase_req_detail.recieved!='0' and tbl_purchase_req_detail.transfer='0' and tbl_purchase_req_detail.parent_id='$created_by' and tbl_purchase_req_detail.barcode='$product_search'"; 
  }
  $sale_rate=0;
  foreach ($conn->query($item_query) as $row){
    $brand_id=$row['brand_id'];
    $pur_item_id=$row['pur_item_id'];
    $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
    $value2 = mysqli_fetch_assoc($sql2);
    $brand_name=$value2['cat_name'];
    if($user_privilege!='branch'  && $created_by=='1')
    {
    	$sale_rate=$row['retail'];
    }
    else
    {
    	$sale_rate=$row['retail'];
    }
   
  if($row['barcode']!=0)
  {
    $barcode=$row['barcode'];    
  }
  else
  {
    $barcode=""; 
  }
  if($row['item_serial']!=0)
  {
    $item_serial=$row['item_serial'];    
  }
  else
  {
    $item_serial=""; 
  }
$item_id=$row['item_id'];
$item_name=$row['item_name'];
$product_arr[] = array("item_id" => $item_id, "barcode" => $barcode, "item_serial" => $item_serial, "pur_item_id" => $pur_item_id, "sale_rate" => $sale_rate, "brand_name" => $brand_name, "item_name" => $item_name);
}

echo json_encode($product_arr);
?>