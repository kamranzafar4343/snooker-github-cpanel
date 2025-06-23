<?php

include "../includes/config.php";
include "../includes/session.php";

$item = $_POST['itemid'];
$qty1 = $_POST['qty'];
$po = $_POST['po'];
$location = $_POST['location'];
if($location)
{
  $created="and tbl_purchase_req_detail.parent_id='$location'";
}
else
{
  $created="";
}

$output='';
$qty=0;
$sql=mysqli_query($conn, "SELECT product, qty FROM tbl_purchase_req_detail where purchase_req_id='$po'");
                    
                        while($data = mysqli_fetch_array($sql) ){
                        $itemid=$data['product'];
                        $qty2=$data['qty'];
                    

$query4=mysqli_query($conn, "SELECT sum(qty) as qty,product FROM tbl_purchase_req_detail INNER JOIN tbl_items ON tbl_purchase_req_detail.product = tbl_items.item_id  WHERE
item_serial NOT IN (SELECT 
        tbl_sale_detail.item_serial
    FROM
        tbl_purchase_req_detail
            INNER JOIN
        tbl_sale_detail  ON tbl_purchase_req_detail.item_serial = tbl_sale_detail.item_serial)
 AND item_serial NOT IN (SELECT 
        tbl_installment.item_serial
    FROM
        tbl_purchase_req_detail
            INNER JOIN
        tbl_installment  ON tbl_purchase_req_detail.item_serial = tbl_installment.item_serial)
 AND item_serial NOT IN (SELECT 
        tbl_purchase_return_detail.item_serial
    FROM
        tbl_purchase_req_detail
            INNER JOIN
        tbl_purchase_return_detail  ON tbl_purchase_req_detail.item_serial = tbl_purchase_return_detail.item_serial)
  AND tbl_purchase_req_detail.recieved!='0' and tbl_purchase_req_detail.iemi='1' and tbl_purchase_req_detail.product='$itemid' and tbl_purchase_req_detail.transfer='0' $created");

  if(mysqli_num_rows($query4)>0){
   while($data1 = mysqli_fetch_array($query4) ){
   	 $product = $data1['product'];

   	 	$qty = $data1['qty'];

   	   $remaining=$qty2-$qty;
   //echo $qty;
}
   	if($remaining>0)
   	{
   	 	                $item_query=mysqli_query($conn, "SELECT item_name,brand_id FROM tbl_items where item_id='$itemid'");
                         while($data = mysqli_fetch_array($item_query)){
                         $item_name=$data['item_name'];
                         $brand_id=$data['brand_id'];

                         $sql6="SELECT transfer_perc,cat_name  FROM tbl_catagory where id='$brand_id'";
	                        $result5 = mysqli_query($conn,$sql6);
	                        while($data5 = mysqli_fetch_array($result5) ){
	                          
	                          $cat_name=$data5['cat_name'];
	                        
	                         }
                     	}
						$output.='
							
						  		<strong>Oops!</strong> '.$remaining.' item of '.$cat_name.' '.$item_name.' is out of stock.<br>
						    
						';
					}
   	 
   	
   }
   else
   {
  
  	$sql1=mysqli_query($conn, "SELECT * FROM tbl_purchase_req_detail where product='$itemid' and purchase_req_id='$po'");
  	while($data1 = mysqli_fetch_array($sql1) ){
   	 $product = $data1['product'];
   	 $qty = $data1['qty'];

   	
   	 	                $item_query=mysqli_query($conn, "SELECT item_name,brand_id FROM tbl_items where item_id='$product'");
                         while($data = mysqli_fetch_array($item_query)){
                         $item_name=$data['item_name'];
                         $brand_id=$data['brand_id'];

                         $sql6="SELECT transfer_perc,cat_name  FROM tbl_catagory where id='$brand_id'";
	                        $result5 = mysqli_query($conn,$sql6);
	                        while($data5 = mysqli_fetch_array($result5) ){
	                          
	                          $cat_name=$data5['cat_name'];
	                        
	                         }
                     	}
						$output.='
							
						  		<strong>Oops!</strong> '.$qty.' item of '.$cat_name.' '.$item_name.' is out of stock.
						    
						';
   	 
   	}

   }
   }

echo $output;
?>