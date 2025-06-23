<?php
include "../includes/config.php";
include "../includes/session.php";
error_reporting(0);
// echo "<script>console.log('asd');</script>";exit();
$item_identity = $_POST['item_identity'];
$output='';
$bsql=mysqli_query($conn,"SELECT * FROM tbl_purchase_detail INNER JOIN tbl_items ON tbl_purchase_detail.product = tbl_items.item_id WHERE tbl_purchase_detail.qty_rec!='' AND (tbl_purchase_detail.item_serial LIKE '%$item_identity%' OR tbl_purchase_detail.barcode LIKE '%$item_identity%' OR tbl_purchase_detail.pur_item_id  LIKE '%$item_identity%')");

	while($row = mysqli_fetch_array($bsql)){
    $id = $row['item_id'];
    $item_serial=$row['item_serial'];
    $item_serial1=$row['item_serial'];
    $barcode=$row['barcode'];
    $barcode1=$row['barcode'];
    $pur_item_id=$row['pur_item_id'];
    $pur_item_id1=$row['pur_item_id'];
    $sale_rate = $row['sale_rate'];
    $parent_id = $row['parent_id'];
    $transfer = $row['transfer'];
    $brand_id=$row['brand_id'];
    $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
    $value2 = mysqli_fetch_assoc($sql2);
    $brand_name=$value2['cat_name'];
    $item_name = $brand_name. " " .$row['item_name'];

    if($transfer=='1')
    {
    	$sql2=mysqli_query($conn,"SELECT parent_id from  tbl_purchase_req_detail where product='$id' and (item_serial='$item_serial' OR barcode='$barcode' OR pur_item_id='$pur_item_id')");
	    $value2 = mysqli_fetch_assoc($sql2);
	    $parent_id=$value2['parent_id'];

		$item_query="SELECT * FROM tbl_purchase_req_detail INNER JOIN tbl_items ON tbl_purchase_req_detail.product = tbl_items.item_id  WHERE
		pur_item_id NOT IN (SELECT 
		        tbl_sale_detail.pur_item_id
		    FROM
		        tbl_purchase_req_detail
		            INNER JOIN
		        tbl_sale_detail  ON tbl_purchase_req_detail.pur_item_id = tbl_sale_detail.pur_item_id)
		 AND pur_item_id NOT IN (SELECT 
		        tbl_installment.pur_item_id
		    FROM
		        tbl_purchase_req_detail
		            INNER JOIN
		        tbl_installment  ON tbl_purchase_req_detail.pur_item_id = tbl_installment.pur_item_id)
		   AND pur_item_id NOT IN (SELECT 
		        tbl_purchase_return_detail.pur_item_id
		    FROM
		        tbl_purchase_req_detail
		            INNER JOIN
		        tbl_purchase_return_detail  ON tbl_purchase_req_detail.pur_item_id = tbl_purchase_return_detail.pur_item_id)
		  AND tbl_purchase_req_detail.recieved='1' and tbl_purchase_req_detail.transfer='0' and (tbl_purchase_req_detail.item_serial='$item_serial' OR tbl_purchase_req_detail.barcode='$barcode' OR tbl_purchase_req_detail.pur_item_id='$pur_item_id') and tbl_purchase_req_detail.parent_id='$parent_id' "; 

		  $result = mysqli_query($conn,$item_query);
		  $itemfound=mysqli_num_rows($result);
		  
		  // $stock=0;
    }
    else
    {
    	 $item_query="SELECT * FROM tbl_purchase_detail INNER JOIN tbl_items ON tbl_purchase_detail.product = tbl_items.item_id  WHERE
		 pur_item_id NOT IN (SELECT 
		        tbl_sale_detail.pur_item_id
		    FROM
		        tbl_purchase_detail
		            INNER JOIN
		        tbl_sale_detail  ON tbl_purchase_detail.pur_item_id = tbl_sale_detail.pur_item_id)
		 AND pur_item_id NOT IN (SELECT 
		        tbl_installment.pur_item_id
		    FROM
		        tbl_purchase_detail
		            INNER JOIN
		        tbl_installment  ON tbl_purchase_detail.pur_item_id = tbl_installment.pur_item_id)
		   
		   AND pur_item_id NOT IN (SELECT 
		        tbl_purchase_return_detail.pur_item_id
		    FROM
		        tbl_purchase_detail
		            INNER JOIN
		        tbl_purchase_return_detail  ON tbl_purchase_detail.pur_item_id = tbl_purchase_return_detail.pur_item_id)
		  AND tbl_purchase_detail.qty_rec!='' and tbl_purchase_detail.transfer='0' and tbl_purchase_detail.iemi='0' and (tbl_purchase_detail.item_serial='$item_serial' OR tbl_purchase_detail.barcode='$barcode' OR tbl_purchase_detail.pur_item_id='$pur_item_id') and tbl_purchase_detail.parent_id='$parent_id'";
		 
		  $result = mysqli_query($conn,$item_query);
		  $itemfound=mysqli_num_rows($result);
		
    }
   	$sql3=mysqli_query($conn,"SELECT user_name from users where user_id='$parent_id'");
    $value3 = mysqli_fetch_assoc($sql3);
    $user_name=$value3['user_name'];
    $rate=$row['rate'];
 

		  	if($barcode=='')
		  	{
		  		$barcode=0;
		  		$barcode1='';
		  	}
		  	if($pur_item_id=='')
		  	{
		  		$pur_item_id=0;
		  		$pur_item_id1='';
		  	}
		  	if($item_serial=='')
		  	{
		  		$item_serial=0;
		  		$item_serial1='';
		  	}
		  	
		  	$cash_price_sql=mysqli_query($conn,"SELECT amount from tbl_sale_detail where parent_id='$parent_id' and (item_serial='$item_serial' OR barcode='$barcode' OR pur_item_id='$pur_item_id')");
		    $cash_price_sql_val = mysqli_fetch_assoc($cash_price_sql);
		    $amount=$cash_price_sql_val['amount'];
		    if($amount=='')
		    {
		    	$inst_price_sql=mysqli_query($conn,"SELECT total_price from tbl_installment where parent_id='$parent_id' and (item_serial='$item_serial' OR barcode='$barcode' OR pur_item_id='$pur_item_id')");
			    $inst_price_sql_val = mysqli_fetch_assoc($inst_price_sql);
			    $amount=$inst_price_sql_val['total_price'];
		    }
		    if($amount=='')
		    {
		    	$amount=0;
		    }

		  if($amount=='0')
		  {

		  	$stock='<span class="badge badge-success">In Stock</span>';
		  }
		  else
		  {

		  	$stock='<span class="badge badge-danger">Sold</span>';
		  
		  }
		  if($sale_rate!='')
		  {
		  	$amount=$sale_rate;
		  }
		  else
		  {
		  	$amount=$amount;
		  }
$output.= '
<tr>
                <td>'.$id.'</td>
                <td><span>'.$item_name.'</span></td>
                <td><span class="text-info">'.$item_serial1.' '.$barcode1.' '.$pur_item_id1.'</span></td>
                <td>'.$stock.'</td>
                <td><span>'.$user_name.'</span></td>
                <td>'.$rate.'</td>
                <td>'.$amount.'</td>
                
                </tr>
';
   }
 

$bsql1=mysqli_query($conn,"SELECT * FROM tbl_single_purchase_detail INNER JOIN tbl_items ON tbl_single_purchase_detail.product = tbl_items.item_id WHERE tbl_single_purchase_detail.qty_rec='1'AND (tbl_single_purchase_detail.item_serial LIKE '%$item_identity%' OR tbl_single_purchase_detail.barcode LIKE '%$item_identity%' OR tbl_single_purchase_detail.pur_item_id  LIKE '%$item_identity%')");

	while($row = mysqli_fetch_array($bsql1)){
    $id = $row['item_id'];
   $item_serial=$row['item_serial'];
    $item_serial1=$row['item_serial'];
    $barcode=$row['barcode'];
    $barcode1=$row['barcode'];
    $pur_item_id=$row['pur_item_id'];
    $pur_item_id1=$row['pur_item_id'];
    
    $parent_id = $row['parent_id'];
    $transfer = $row['transfer'];
    $brand_id=$row['brand_id'];
    $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
    $value2 = mysqli_fetch_assoc($sql2);
    $brand_name=$value2['cat_name'];
    $item_name = $brand_name. " " .$row['item_name'];

     $item_query="SELECT * FROM tbl_single_purchase_detail INNER JOIN tbl_items ON tbl_single_purchase_detail.product = tbl_items.item_id  
                    WHERE
pur_item_id NOT IN (SELECT 
        tbl_sale_detail.pur_item_id
    FROM
        tbl_single_purchase_detail
            INNER JOIN
        tbl_sale_detail  ON tbl_single_purchase_detail.pur_item_id = tbl_sale_detail.pur_item_id where tbl_sale_detail.local='1')
 AND pur_item_id NOT IN (SELECT  
        tbl_installment.pur_item_id
    FROM
        tbl_single_purchase_detail
            INNER JOIN
        tbl_installment  ON tbl_single_purchase_detail.pur_item_id = tbl_installment.pur_item_id where tbl_installment.local='1')
   
   AND pur_item_id NOT IN (SELECT 
        tbl_purchase_return_detail.pur_item_id
    FROM
        tbl_single_purchase_detail
            INNER JOIN
        tbl_purchase_return_detail  ON tbl_single_purchase_detail.pur_item_id = tbl_purchase_return_detail.pur_item_id)
  AND tbl_single_purchase_detail.qty_rec!='' and (tbl_single_purchase_detail.item_serial='$item_serial' OR tbl_single_purchase_detail.barcode='$barcode' OR tbl_single_purchase_detail.pur_item_id='$pur_item_id') and tbl_single_purchase_detail.parent_id='$parent_id'";
		 
		  $result = mysqli_query($conn,$item_query);
		  $itemfound=mysqli_num_rows($result);
		if($barcode=='')
		  	{
		  		$barcode=0;
		  		$barcode1='';
		  	}
		  	if($pur_item_id=='')
		  	{
		  		$pur_item_id=0;
		  		$pur_item_id1='';
		  	}
		  	if($item_serial=='')
		  	{
		  		$item_serial=0;
		  		$item_serial1='';
		  	}
		  $cash_price_sql=mysqli_query($conn,"SELECT amount from tbl_sale_detail where parent_id='$parent_id' and (item_serial='$item_serial' OR barcode='$barcode' OR pur_item_id='$pur_item_id')");
		    $cash_price_sql_val = mysqli_fetch_assoc($cash_price_sql);
		    $amount=$cash_price_sql_val['amount'];
		    if($amount=='')
		    {
		    	$inst_price_sql=mysqli_query($conn,"SELECT total_price from tbl_installment where parent_id='$parent_id' and (item_serial='$item_serial' OR barcode='$barcode' OR pur_item_id='$pur_item_id')");
			    $inst_price_sql_val = mysqli_fetch_assoc($inst_price_sql);
			    $amount=$inst_price_sql_val['total_price'];
		    }
		    if($amount=='')
		    {
		    	$amount=0;
		    }
		    if($amount=='0')
		  {

		  	$stock='<span class="badge badge-success">In Stock</span>';
		  }
		  else
		  {

		  	$stock='<span class="badge badge-danger">Sold</span>';
		  
		  }
		    $sql3=mysqli_query($conn,"SELECT user_name from users where user_id='$parent_id'");
    $value3 = mysqli_fetch_assoc($sql3);
    $user_name=$value3['user_name'];
    $rate=$row['rate'];
$output.= '
<tr>
                <td>'.$id.'</td>
                <td><span>'.$item_name.'</span></td>
                <td><span class="text-info">'.$item_serial1.' '.$barcode1.' '.$pur_item_id1.'</span></td>
                <td>'.$stock.'</td>
                <td><span>'.$user_name.'</span></td>
                <td>'.$rate.'</td>
                <td>'.$amount.'</td>
                
                </tr>
';
   }
echo $output;
?>