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
  

    $transfer = $row['transfer'];
    $brand_id=$row['brand_id'];
    $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
    $value2 = mysqli_fetch_assoc($sql2);
    $brand_name=$value2['cat_name'];
    $item_name = $brand_name. " " .$row['item_name'];
    

    if($transfer=='1')
    {

	   
    	$sql2=mysqli_query($conn,"SELECT * from  tbl_purchase_req_detail where product='$id' and (item_serial='$item_serial' OR pur_item_id='$pur_item_id') order by tbl_purchase_req_detail.id desc");
	    $value2 = mysqli_fetch_assoc($sql2);
	    $parent_id=$value2['parent_id'];
	    $trans_parent_id = $value2['trans_parent_id'];
		$purchase_req_id = $value2['purchase_req_id'];
		$item_query=mysqli_query($conn,"SELECT * FROM tbl_purchase_req_detail INNER JOIN tbl_items ON tbl_purchase_req_detail.product = tbl_items.item_id  WHERE
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
		  AND tbl_purchase_req_detail.recieved='1' and tbl_purchase_req_detail.transfer='0'  and (tbl_purchase_req_detail.item_serial='$item_serial' OR tbl_purchase_req_detail.pur_item_id='$pur_item_id') order by tbl_purchase_req_detail.id desc"); 

			$result = mysqli_fetch_array($item_query);
		  
		  $itemfound=mysqli_num_rows($item_query);
		  $parent_id1=$result['parent_id'];
		  

		     $sql3=mysqli_query($conn,"SELECT user_name from users where user_id='$parent_id'");
		    $value3 = mysqli_fetch_assoc($sql3);
		    $to_user_name=$value3['user_name'];
		   

		    $sql7=mysqli_query($conn,"SELECT user_name from users where user_id='$trans_parent_id'");
		    $value7 = mysqli_fetch_assoc($sql7);
		    $from_user_name=$value7['user_name'];

		$sql_req=mysqli_query($conn,"SELECT stock_rec_date from  tbl_purchase_req where purchase_req_id='$purchase_req_id'");
	    $value_sql_req = mysqli_fetch_assoc($sql_req);
	    $stock_rec_date=$value_sql_req['stock_rec_date'];
		$newDate = date("d-m-Y H:i ", strtotime($stock_rec_date));   
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
		  AND tbl_purchase_detail.qty_rec!='' and tbl_purchase_detail.transfer='0' and tbl_purchase_detail.iemi='0' and (tbl_purchase_detail.item_serial='$item_serial'  OR tbl_purchase_detail.pur_item_id='$pur_item_id') and tbl_purchase_detail.parent_id='$parent_id'";
		 
		  $result = mysqli_fetch_array($item_query);
		  
		  $itemfound=mysqli_num_rows($item_query);
		  $parent_id1=$result['parent_id'];
		  $trans_parent_id = $result['trans_parent_id'];
		  $stock_rec_date = $result['created_date'];

		     $sql3=mysqli_query($conn,"SELECT user_name from users where user_id='$parent_id1'");
		    $value3 = mysqli_fetch_assoc($sql3);
		    $to_user_name=$value3['user_name'];
		   

		    $sql7=mysqli_query($conn,"SELECT user_name from users where user_id='$trans_parent_id'");
		    $value7 = mysqli_fetch_assoc($sql7);
		    $from_user_name=$value7['user_name'];

		
    }
   	
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
		  	
		  	$cash_price_sql=mysqli_query($conn,"SELECT amount, sale_id from tbl_sale_detail where parent_id='$parent_id' and (item_serial='$item_serial'  OR pur_item_id='$pur_item_id')");
		    $cash_price_sql_val = mysqli_fetch_assoc($cash_price_sql);
		    $amount=$cash_price_sql_val['amount'];
		    $sale_id=$cash_price_sql_val['sale_id'];
		    if(mysqli_num_rows($cash_price_sql)>0)
		    {
		    	$sale_type='Cash';
		    }
		    else
			    {
			    	$sale_type='';
			    }
		    $customer_sql=mysqli_query($conn,"SELECT customer_name from tbl_sale where sale_id='$sale_id'");
		    $customer_sql_val = mysqli_fetch_assoc($customer_sql);
		    $customer=$customer_sql_val['customer_name'];
		    
		    if($amount=='')
		    {
		    	$inst_price_sql=mysqli_query($conn,"SELECT total_price, customer from tbl_installment where parent_id='$parent_id' and (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
			    $inst_price_sql_val = mysqli_fetch_assoc($inst_price_sql);
			    $amount=$inst_price_sql_val['total_price'];
			    $customer=$inst_price_sql_val['customer'];
			    if(mysqli_num_rows($inst_price_sql)>0)
			    {
			    	$sale_type='Installment';
			    }
			    else
			    {
			    	$sale_type='';
			    }
			    
		    }

		    if($amount=='')
		    {
		    	$amount='';
		    }

		  if($amount=='')
		  {

		  	$stock='<span class="badge badge-success">In Stock</span>';
		  }
		  else
		  {
		  	
		  	$stock='<span class="badge badge-danger">Sold</span>';
		  
		  }

		  $customer_name_sql=mysqli_query($conn,"SELECT username,mobile_no1,client_cnic from tbl_customer where customer_id='$customer'");
		    $customer_name_sql_val = mysqli_fetch_assoc($customer_name_sql);
		    $customer_username=$customer_name_sql_val['username'];
		    $customer_mobile_no1=$customer_name_sql_val['mobile_no1'];
		    $client_cnic=$customer_name_sql_val['client_cnic'];
		 
$output.= '
<tr>
                <td>'.$id.'</td>
                <td><span>'.$item_name.'</span></td>
                <td><span class="text-info">'.$item_serial1.' '.$barcode1.' '.$pur_item_id1.'</span></td>
                <td>'.$stock.'</td>
                
                <td><span>'.$from_user_name.'</span></td>
                <td><span>'.$to_user_name.'</span></td>
                <td><span>'.$newDate.'</span></td>
                <td><span>'.$sale_type.'</span></td>
                <td>'.$customer_username.' '.$customer_mobile_no1.' '.$client_cnic.'</td>
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
     $stock_rec_date = $row['created_date'];
     $newDate = date("d-m-Y", strtotime($stock_rec_date));
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
		 
		 $result = mysqli_fetch_array($item_query);
		  
		  $itemfound=mysqli_num_rows($item_query);
		  $parent_id1=$result['parent_id'];
		  $trans_parent_id = $result['trans_parent_id'];

		     $sql3=mysqli_query($conn,"SELECT user_name from users where user_id='$parent_id1'");
		    $value3 = mysqli_fetch_assoc($sql3);
		    $to_user_name=$value3['user_name'];
		   

		    $sql7=mysqli_query($conn,"SELECT user_name from users where user_id='$trans_parent_id'");
		    $value7 = mysqli_fetch_assoc($sql7);
		    $from_user_name=$value7['user_name'];
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
		  $cash_price_sql=mysqli_query($conn,"SELECT amount,sale_id from tbl_sale_detail where parent_id='$parent_id' and (item_serial='$item_serial' OR barcode='$barcode' OR pur_item_id='$pur_item_id')");
		    $cash_price_sql_val = mysqli_fetch_assoc($cash_price_sql);
		    $amount=$cash_price_sql_val['amount'];
		    $sale_id=$cash_price_sql_val['sale_id'];
		    if(mysqli_num_rows($cash_price_sql)>0)
		    {
		    	$sale_type='Cash';
		    }
		    else
			    {
			    	$sale_type='';
			    }
		    $customer_sql=mysqli_query($conn,"SELECT customer_name from tbl_sale where sale_id='$sale_id'");
		    $customer_sql_val = mysqli_fetch_assoc($customer_sql);
		    $customer=$customer_sql_val['customer_name'];
		    if($amount=='')
		    {
		    	$inst_price_sql=mysqli_query($conn,"SELECT total_price,customer from tbl_installment where parent_id='$parent_id' and (item_serial='$item_serial' OR barcode='$barcode' OR pur_item_id='$pur_item_id')");
			    $inst_price_sql_val = mysqli_fetch_assoc($inst_price_sql);
			    $amount=$inst_price_sql_val['total_price'];
			    $customer=$inst_price_sql_val['customer'];
			    if(mysqli_num_rows($inst_price_sql)>0)
			    {
			    	$sale_type='Installment';
			    }
			    else
			    {
			    	$sale_type='';
			    }
		    }
		    if($amount=='')
		    {
		    	$amount='';
		    }
		    if($amount=='')
		  {

		  	$stock='<span class="badge badge-success">In Stock</span>';
		  }
		  else
		  {

		  	$stock='<span class="badge badge-danger">Sold</span>';
		  
		  }
		   $customer_name_sql=mysqli_query($conn,"SELECT username,mobile_no1,client_cnic from tbl_customer where customer_id='$customer'");
		    $customer_name_sql_val = mysqli_fetch_assoc($customer_name_sql);
		    $customer_username=$customer_name_sql_val['username'];
		    $customer_mobile_no1=$customer_name_sql_val['mobile_no1'];
		    $client_cnic=$customer_name_sql_val['client_cnic'];
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
                <td><span>Local Purchase</span></td>
                <td><span>'.$newDate.'</span></td>
                 <td><span>'.$sale_type.'</span></td>
                <td>'.$customer_username.' '.$customer_mobile_no1.' '.$client_cnic.'</td>
                <td>'.$amount.'</td>
                
                </tr>
';
   }
echo $output;
?>