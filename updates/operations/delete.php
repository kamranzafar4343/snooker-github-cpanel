<?php
include "../includes/config.php";
include "../includes/session.php";
if (isset($_GET['user_id'])) {
	$user_id=mysqli_real_escape_string($conn, $_GET['user_id']);
	$sql1 = mysqli_query($conn,"SELECT * from tbl_trans Where parent_id='$user_id'");
	$sql2 = mysqli_query($conn,"SELECT * from tbl_purchase_req Where created_by='$user_id'");
		if (mysqli_num_rows($sql1)==0 && mysqli_num_rows($sql2)==0) {

						$sql=mysqli_query($conn, "DELETE FROM users WHERE user_id=$user_id");
						$sql=mysqli_query($conn, "DELETE FROM tbl_permission WHERE user_id=$user_id");
						if($sql){
							header('Location: ../users.php?delete=successful');
						}
                	}
                	else
                	{
                		header('Location: ../users.php?delete=unsuccessful');
                	}
}
if (isset($_GET['period_id'])) {
	$period_id=mysqli_real_escape_string($conn, $_GET['period_id']);
	
	$sql=mysqli_query($conn, "DELETE FROM tbl_period WHERE id=$period_id");
	if($sql){
		header('Location: ../period_list.php?delete=successful');
	}
}
if (isset($_GET['designation_id'])) {
	$designation_id=mysqli_real_escape_string($conn, $_GET['designation_id']);
	
	$sql=mysqli_query($conn, "DELETE FROM tbl_designation WHERE designation_id=$designation_id");
	if($sql){
		header('Location: ../designation_list.php?delete=successful');
	}
}
if (isset($_GET['cat_id'])) {
	$cat_id=mysqli_real_escape_string($conn, $_GET['cat_id']);
	$sql = mysqli_query($conn,"SELECT * FROM tbl_items where brand_id='$cat_id'");
	if (mysqli_num_rows($sql)==0) {
		$sql=mysqli_query($conn, "DELETE FROM tbl_catagory WHERE id=$cat_id");
		$sql=mysqli_query($conn, "DELETE FROM tbl_cat WHERE brand_id=$cat_id");
		$sql=mysqli_query($conn, "DELETE FROM tbl_sub_cat WHERE brand_id=$cat_id");
		$sql=mysqli_query($conn, "DELETE FROM tbl_items WHERE brand_id=$cat_id");
	if($sql){
		header('Location: ../brand_list.php?delete=successful');
	}
	}
	else
	{

           while($pdata = mysqli_fetch_assoc($sql))   
                { 
				   $item_id=$pdata['item_id'];
				  
				   $sql1 = mysqli_query($conn,"SELECT item_id from tbl_installment Where item_id='$item_id'");
				   $sql2 = mysqli_query($conn,"SELECT product from tbl_sale_detail Where product='$item_id'");
				   $sql3 = mysqli_query($conn,"SELECT product from tbl_purchase_detail Where product='$item_id'");
				   $sql4 = mysqli_query($conn,"SELECT product from tbl_purchase_return_detail Where product='$item_id'");
				   $sql5 = mysqli_query($conn,"SELECT product from tbl_sale_return_detail Where product='$item_id'");
				   	if (mysqli_num_rows($sql1)==0 && mysqli_num_rows($sql2)==0 && mysqli_num_rows($sql3)==0 && mysqli_num_rows($sql4)==0 && mysqli_num_rows($sql5)==0) {
				   	
						$sql=mysqli_query($conn, "DELETE FROM tbl_catagory WHERE id=$cat_id");
						$sql=mysqli_query($conn, "DELETE FROM tbl_cat WHERE brand_id=$cat_id");
						$sql=mysqli_query($conn, "DELETE FROM tbl_sub_cat WHERE brand_id=$cat_id");
						$sql=mysqli_query($conn, "DELETE FROM tbl_items WHERE brand_id=$cat_id");
						if($sql){
							header('Location: ../brand_list.php?delete=successful');
						}
                	}
                	else
                	{
                	
                		header('Location: ../brand_list.php?delete=unsuccessful');
                	}
	}

	
}
}
if (isset($_GET['branch_id'])) {
	$branch_id=mysqli_real_escape_string($conn, $_GET['branch_id']);

	$sql1 = mysqli_query($conn,"SELECT * from tbl_trans Where parent_id='$branch_id'");
	$sql2 = mysqli_query($conn,"SELECT * from tbl_purchase_req Where created_by='$branch_id'");
		if (mysqli_num_rows($sql1)==0 && mysqli_num_rows($sql2)==0) {
			$sql1 = mysqli_query($conn,"SELECT branch_id from users Where user_id='$branch_id'");
			while($pdata = mysqli_fetch_assoc($sql1))   
			{
				$branchid=$pdata['branch_id'];
			}
					
						$sql=mysqli_query($conn, "DELETE FROM users WHERE user_id=$branch_id");
						$sql=mysqli_query($conn, "DELETE FROM tbl_account_lv2 WHERE acode=$branch_id");
						if($sql){
							header('Location: ../branch_list.php?delete=successful');
						}
                	}
                	else
                	{
                		header('Location: ../branch_list.php?delete=unsuccessful');
                	}
	
	
}
if (isset($_GET['item_id'])) {
	$item_id=mysqli_real_escape_string($conn, $_GET['item_id']);

				   
				   $sql1 = mysqli_query($conn,"SELECT item_id from tbl_installment Where item_id='$item_id'");
				   $sql2 = mysqli_query($conn,"SELECT product from tbl_sale_detail Where product='$item_id'");
				   $sql3 = mysqli_query($conn,"SELECT product from tbl_purchase_detail Where product='$item_id'");
				   $sql4 = mysqli_query($conn,"SELECT product from tbl_purchase_return_detail Where product='$item_id'");
				   $sql5 = mysqli_query($conn,"SELECT product from tbl_sale_return_detail Where product='$item_id'");
				   	if (mysqli_num_rows($sql1)==0 && mysqli_num_rows($sql2)==0 && mysqli_num_rows($sql3)==0 && mysqli_num_rows($sql4)==0 && mysqli_num_rows($sql5)==0) {

						$sql=mysqli_query($conn, "DELETE FROM tbl_items WHERE item_id=$item_id");
						if($sql){
							header('Location: ../item_list.php?delete=successful');
						}
                	}
                	else
                	{
                		header('Location: ../item_list.php?delete=unsuccessful');
                	}
	

}
if (isset($_GET['purchase_return_id'])) {
	$purchase_return_id=mysqli_real_escape_string($conn, $_GET['purchase_return_id']);
	
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_return WHERE purchase_id = $purchase_return_id");
 	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_return_detail WHERE purchase_id = $purchase_return_id");
 	$invoice_no="Purchase_Return"."_".$purchase_return_id;
	 $sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
	 $sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");
	if($sql){
		header('Location: ../purchase_return_list.php?delete=successful');
	}
}
if (isset($_GET['loc_purchase_return_id'])) {
	$loc_purchase_return_id=mysqli_real_escape_string($conn, $_GET['loc_purchase_return_id']);
	$invoice_no="Local_Purchase_Return"."_".$loc_purchase_return_id;
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_return WHERE purchase_id = $loc_purchase_return_id");
 	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_return_detail WHERE purchase_id = $loc_purchase_return_id");
 	
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");
	if($sql){
		header('Location: ../loc_purchase_return_list.php?delete=successful');
	}
}
if (isset($_GET['sale_return_id'])) {
	$sale_return_id=mysqli_real_escape_string($conn, $_GET['sale_return_id']);
	$sql1 = mysqli_query($conn,"SELECT * from tbl_sale_return_detail Where sale_id='$sale_return_id'");
	while($pdata = mysqli_fetch_assoc($sql1))   
	{
		$sold=$pdata['sold'];
	}

	if($sold!='0')
	{
		header('Location: ../sale_return_list.php?delete=unsuccessful');
		exit;

	}
	$sql=mysqli_query($conn, "DELETE FROM tbl_sale_return WHERE sale_id = $sale_return_id");
 	$sql=mysqli_query($conn, "DELETE FROM tbl_sale_return_detail WHERE sale_id = $sale_return_id");
 	$invoice_no="Sale_Return"."_".$sale_return_id;
	 $sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
	 $sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");
	if($sql){
		header('Location: ../sale_return_list.php?delete=successful');
	}
}
if (isset($_GET['paymentid'])  && isset($_GET['plan_id'])) {
	$paymentid=mysqli_real_escape_string($conn, $_GET['paymentid']);
	$plan_id=mysqli_real_escape_string($conn, $_GET['plan_id']);

	$sql=mysqli_query($conn, "DELETE FROM tbl_installment_payment WHERE payment_id = '$paymentid'");

	$sql1 = mysqli_query($conn,"SELECT period,total_price  from tbl_installment Where plan_id='$plan_id'");
	$pdata = mysqli_fetch_assoc($sql1);
	$period=$pdata['period'];
	$total_price=$pdata['total_price'];

	$sql = mysqli_query($conn,"SELECT SUM(per_month_amount) as paid, SUM(installment_number) as total_installment  from tbl_installment_payment Where plan_id='$plan_id'");
	
	while($pdata = mysqli_fetch_assoc($sql))   
	{
		$total_installment=$pdata['total_installment'];
		$paid=round($pdata['paid'],2);
	}

	$per_month_amount=round((($total_price-$paid)/($period-$total_installment)),2);

	if($total_installment=='' || $total_installment=='1')
	{
		$rec_status=0;
		$mo_rec_status=0;
	}
	else
	{
		$rec_status=1;
		$mo_rec_status=1;
	}

	$sql = mysqli_query($conn,"UPDATE tbl_installment SET amount_recieved='$paid', per_month_amount='$per_month_amount', rec_status='$rec_status', mo_rec_status='$mo_rec_status' Where plan_id='$plan_id'");

 
	 $sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE payment_id = '$paymentid'");
	
	if($sql){
		header('Location: ../installment_detail_list.php?planid='.$plan_id.'');
	}
}
if (isset($_GET['voucher_id']) && isset($_GET['payment_type'])) {
	$voucher_id=mysqli_real_escape_string($conn, $_GET['voucher_id']);
	$payment_type=mysqli_real_escape_string($conn, $_GET['payment_type']);

	if($payment_type=='CP')
	{
		$invoice_no="CP_".$voucher_id;
	}
	else if($payment_type=='CR')
	{
		$invoice_no="CR_".$voucher_id;
	}
	else if($payment_type=='BP')
	{
		$invoice_no="BP_".$voucher_id;
	}
	else if($payment_type=='BR')
	{
		$invoice_no="BR_".$voucher_id;
	}
	else if($payment_type=='JV')
	{
		$invoice_no="JV_".$voucher_id;
	}
	
	$sql=mysqli_query($conn, "DELETE FROM tbl_payment WHERE id=$voucher_id");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
 	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");
	if($sql){
		header('Location: ../add_payment.php?delete=successful');
	}
}


if (isset($_GET['subchild_id'])) {
	$subchild_id=mysqli_real_escape_string($conn, $_GET['subchild_id']);
	$sql = mysqli_query($conn,"SELECT LEFT(acode, 6) as acode from tbl_account_lv2 Where id='$subchild_id'");
	
	while($pdata = mysqli_fetch_assoc($sql))   
	{
		$acode=$pdata['acode'];
	
		$sql1 = mysqli_query($conn,"SELECT acode from tbl_trans_detail Where Left(acode, 6)='$acode'");
		if (mysqli_num_rows($sql1)==0) {
			$sql=mysqli_query($conn, "DELETE FROM tbl_account_lv2 WHERE id=$subchild_id");
			if($sql){
				header('Location: ../chart_of_account.php?delete=successful');
			}
		}
		else
		{
			header('Location: ../chart_of_account.php?delete=unsuccessful');
		}
	}

}



if (isset($_GET['subhead_id'])) {
	$subhead_id=mysqli_real_escape_string($conn, $_GET['subhead_id']);
	$sql = mysqli_query($conn,"SELECT LEFT(acode, 6) as acode from tbl_account Where id='$subhead_id'");
	while($pdata = mysqli_fetch_assoc($sql))   
	{
		$acode=$pdata['acode'];
	 	$sql1 = mysqli_query($conn,"SELECT acode from tbl_trans_detail Where Left(acode, 6)='$acode'");
	 	if (mysqli_num_rows($sql1)==0) {
			$sql=mysqli_query($conn, "DELETE FROM tbl_account WHERE id=$subhead_id");
			if($sql){
				header('Location: ../chart_of_account.php?delete=successful');
			}
		}
		else
		{
			header('Location: ../chart_of_account.php?delete=unsuccessful');
		}
}
}
if (isset($_GET['salary_id'])) {
	$salary_id=mysqli_real_escape_string($conn, $_GET['salary_id']);

	$sql=mysqli_query($conn, "DELETE FROM tbl_salary WHERE id = $salary_id");

 	$invoice_no="Salary_".$salary_id;
	 $sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
	 $sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");
	if($sql){
		header('Location: ../salary_paid.php?delete=successful');
	}
}

if (isset($_GET['sale_id']) && isset($_GET['sale_type'])) {
	$sale_id=mysqli_real_escape_string($conn, $_GET['sale_id']);
	$sale_type=mysqli_real_escape_string($conn, $_GET['sale_type']);

	$sql=mysqli_query($conn, "SELECT sale_id FROM tbl_sale_return where sale_id='$sale_id'");
    if(mysqli_num_rows($sql)>0){
        header('Location: ../sale_list.php?updated=fail');
        exit();
    }
    if($sale_type=='Cash Sale')
    {
    	$invoice_no="Sale"."_".$sale_id;
    }
    else if($sale_type=='Cash Sale (IEMI)')
    {
    	$invoice_no="Sale"."_".$sale_id;
    }
    else if($sale_type=='Local Cash Sale')
    {
    	$invoice_no="Local_Sale"."_".$sale_id;
    }
	else if($sale_type=='Local Cash Sale (IEMI)')
    {
    	$invoice_no="Local_Sale"."_".$sale_id;
    }
	
	
	$sql=mysqli_query($conn, "DELETE FROM tbl_sale WHERE sale_id=$sale_id");
	$sql=mysqli_query($conn, "DELETE FROM tbl_sale_detail WHERE sale_id=$sale_id");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
 	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");
	if($sql){
		header('Location: ../sale_list.php?delete=done');
	}
}

if (isset($_GET['purchase_id'])) {
	$purchase_id=mysqli_real_escape_string($conn, $_GET['purchase_id']);
	$invoice_no="Purchase"."_".$purchase_id;

	   $query = mysqli_query($conn,"SELECT product, item_serial, pur_item_id from tbl_purchase_detail Where purchase_id='$purchase_id'");
	
	   while($data = mysqli_fetch_assoc($query))
	   {

	   	$product=$data['product'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];
	   	if($item_serial=='')
	   	{
	   		$item_serial=0;
	   	}
	   	if($pur_item_id=='')
	   	{
	   		$pur_item_id=0;
	   	}

	   	$sql2 = mysqli_query($conn,"SELECT product from tbl_sale_detail Where product='$product' AND (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		$sql3 = mysqli_query($conn,"SELECT item_id from tbl_installment Where item_id='$product' AND  (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		$sql4 = mysqli_query($conn,"SELECT product from tbl_purchase_req_detail Where product='$product' AND (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		if (mysqli_num_rows($sql2)!=0 || mysqli_num_rows($sql3)!=0  || mysqli_num_rows($sql4)!=0) {
				
				header('Location: ../purchase_list.php?delete=unsuccessful');
				exit;
			} 
		
	  }
			
		 
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase WHERE purchase_id=$purchase_id");
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_detail WHERE purchase_id=$purchase_id");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no='$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no='$invoice_no'");
	if($sql){
		header('Location: ../purchase_list.php?delete=done');
	}

}

if (isset($_GET['purchase_req_id'])) {
	$purchase_req_id=mysqli_real_escape_string($conn, $_GET['purchase_req_id']);
	$invoice_no="Purchase_req_".$purchase_req_id;

	$sql=mysqli_query($conn, "UPDATE tbl_purchase_req  SET item_transfer='', stock_status='Pending' where purchase_req_id='$purchase_req_id'");

	$sql=mysqli_query($conn, "UPDATE tbl_purchase_req_detail  SET  item_serial='', barcode='', qty_rec='' where purchase_req_id='$purchase_req_id'");

	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no='$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no='$invoice_no'");
	if($sql){
		header('Location: ../main_purchase_req_list.php?delete=done');
	}
}

if (isset($_GET['purchase_req_branch_id'])) {
	$purchase_req_branch_id=mysqli_real_escape_string($conn, $_GET['purchase_req_branch_id']);
	$invoice_no="Purchase_req_".$purchase_req_branch_id;


	   $sql1 = mysqli_query($conn,"SELECT product,barcode, item_serial, pur_item_id, transfer from tbl_purchase_req_detail Where purchase_req_id='$purchase_req_branch_id'");
	   while($data = mysqli_fetch_assoc($sql1))
	   {

	   	$product=$data['product'];
	   	$barcode=$data['barcode'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];
	   	$transfer=$data['transfer'];
	   	if($item_serial=='')
	   	{
	   		$item_serial=0;
	   	}
	   	if($pur_item_id=='')
	   	{
	   		$pur_item_id=0;
	   	}

	   	$sql2 = mysqli_query($conn,"SELECT product from tbl_sale_detail Where product='$product' AND (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		$sql3 = mysqli_query($conn,"SELECT item_id from tbl_installment Where item_id='$product' AND  (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		
		
	
			if (mysqli_num_rows($sql2)!=0 || mysqli_num_rows($sql3)!=0 || $transfer=='1') {
				
				header('Location: ../purchase_req_list.php?delete=unsuccessful');
				exit;
			}

	  }

$sql7 = mysqli_query($conn,"SELECT *  from tbl_purchase_req_detail Where purchase_req_id='$purchase_req_branch_id'");
	while($data = mysqli_fetch_assoc($sql7)){
    	$product=$data['product'];
	   	$barcode=$data['barcode'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];
	   	$iemi=$data['iemi'];
	   	if($iemi=='1')
	   	{
	   		$sql=mysqli_query($conn, "UPDATE tbl_purchase_detail SET transfer='0' where item_serial='$item_serial' and product='$product'");
	   	}
	   	else
	   	{
	   		$sql=mysqli_query($conn, "UPDATE tbl_purchase_detail SET transfer='0' where  product='$product' and pur_item_id='$pur_item_id'");
	   	}
    	
		}

	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req WHERE purchase_req_id='$purchase_req_branch_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req_detail WHERE purchase_req_id='$purchase_req_branch_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no='$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no='$invoice_no'");
	if($sql){
		header('Location: ../purchase_req_list.php?delete=done');
	}
}
if (isset($_GET['direct_branch_id'])) {
	$purchase_req_branch_id=mysqli_real_escape_string($conn, $_GET['direct_branch_id']);
	$invoice_no="Purchase_req_".$purchase_req_branch_id;


	   $sql1 = mysqli_query($conn,"SELECT product,pur_item_id, item_serial, transfer from tbl_purchase_req_detail Where purchase_req_id='$purchase_req_branch_id'");
	   while($data = mysqli_fetch_assoc($sql1))
	   {

	   	$product=$data['product'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];
	   	$transfer=$data['transfer'];
	   	if($item_serial=='')
	   	{
	   		$item_serial=0;
	   	}
	   	if($pur_item_id=='')
	   	{
	   		$pur_item_id=0;
	   	}

	   	$sql2 = mysqli_query($conn,"SELECT product from tbl_sale_detail Where product='$product' AND (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		$sql3 = mysqli_query($conn,"SELECT item_id from tbl_installment Where item_id='$product' AND  (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		
	
			if (mysqli_num_rows($sql2)!=0 || mysqli_num_rows($sql3)!=0 || $transfer=='1') {
				
				header('Location: ../transfer_list.php?delete=unsuccessful');
				exit;
			}

	  }

$sql7 = mysqli_query($conn,"SELECT *  from tbl_purchase_req_detail Where purchase_req_id='$purchase_req_branch_id'");
	while($data = mysqli_fetch_assoc($sql7)){
    	$product=$data['product'];
	   	$barcode=$data['barcode'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];

    $sql=mysqli_query($conn, "UPDATE tbl_purchase_detail SET transfer='0' where item_serial='$item_serial' and product='$product' and barcode='$barcode' and pur_item_id='$pur_item_id'");
		}

	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req WHERE purchase_req_id='$purchase_req_branch_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req_detail WHERE purchase_req_id='$purchase_req_branch_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no='$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no='$invoice_no'");
	if($sql){
		header('Location: ../transfer_list.php?delete=done');
	}
}
if (isset($_GET['purchase_req_head_id'])) {
	$purchase_req_branch_id=mysqli_real_escape_string($conn, $_GET['purchase_req_head_id']);
	$invoice_no="Purchase_req_".$purchase_req_branch_id;


	   $sql1 = mysqli_query($conn,"SELECT product,barcode, item_serial, pur_item_id, transfer from tbl_purchase_req_detail Where purchase_req_id='$purchase_req_branch_id'");
	   while($data = mysqli_fetch_assoc($sql1))
	   {

	   	$product=$data['product'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];
	   	$transfer=$data['transfer'];
	   	if($item_serial=='')
	   	{
	   		$item_serial=0;
	   	}
	   	if($pur_item_id=='')
	   	{
	   		$pur_item_id=0;
	   	}

	   	$sql2 = mysqli_query($conn,"SELECT product from tbl_sale_detail Where product='$product' AND (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		$sql3 = mysqli_query($conn,"SELECT item_id from tbl_installment Where item_id='$product' AND  (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");	
			if (mysqli_num_rows($sql2)!=0 || mysqli_num_rows($sql3)!=0  || $transfer=='1') {
				
				header('Location: ../main_purchase_req_list.php?delete=unsuccessful');
				exit;
			}

	  }
$sql10 = mysqli_query($conn,"SELECT iemi from tbl_purchase_req Where purchase_req_id='$purchase_req_branch_id'");
	while($data = mysqli_fetch_assoc($sql10)){
			$iemi=$data['iemi'];
	}

$sql7 = mysqli_query($conn,"SELECT *  from tbl_purchase_req_detail Where purchase_req_id='$purchase_req_branch_id'");
	while($data = mysqli_fetch_assoc($sql7)){
    	$product=$data['product'];
	   	$barcode=$data['barcode'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];
	   
	   	if($iemi=='1')
	   	{
	   		$sql=mysqli_query($conn, "UPDATE tbl_purchase_req_detail SET transfer='0' where product='$product' and item_serial='$item_serial'");
	   	}
	   	else
	   	{
	   		$sql=mysqli_query($conn, "UPDATE tbl_purchase_req_detail SET transfer='0' where product='$product' and pur_item_id='$pur_item_id'");
	   	}
    
		}

	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req WHERE purchase_req_id='$purchase_req_branch_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req_detail WHERE purchase_req_id='$purchase_req_branch_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no='$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no='$invoice_no'");
	if($sql){
		header('Location: ../main_purchase_req_list.php?delete=done');
	}
}
if (isset($_GET['direct_transfer_id'])) {
	$purchase_req_branch_id=mysqli_real_escape_string($conn, $_GET['direct_transfer_id']);
	$invoice_no="Purchase_req_".$purchase_req_branch_id;


	   $sql1 = mysqli_query($conn,"SELECT product,pur_item_id, item_serial from tbl_purchase_req_detail Where purchase_req_id='$purchase_req_branch_id'");
	   while($data = mysqli_fetch_assoc($sql1))
	   {

	   	$product=$data['product'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];
	   	if($item_serial=='')
	   	{
	   		$item_serial=0;
	   	}
	   	if($pur_item_id=='')
	   	{
	   		$pur_item_id=0;
	   	}

	   	$sql2 = mysqli_query($conn,"SELECT product from tbl_sale_detail Where product='$product' AND (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		$sql3 = mysqli_query($conn,"SELECT item_id from tbl_installment Where item_id='$product' AND  (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		
	
			if (mysqli_num_rows($sql2)!=0 || mysqli_num_rows($sql3)!=0  || mysqli_num_rows($sql4)!=0) {
				
				header('Location: ../direct_transfer_branch.php?delete=unsuccessful');
				exit;
			}

	  }
	  
$sql7 = mysqli_query($conn,"SELECT *  from tbl_purchase_req_detail Where purchase_req_id='$purchase_req_branch_id'");
	while($data = mysqli_fetch_assoc($sql7)){
    	$product=$data['product'];
	   	$barcode=$data['barcode'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];

    $sql=mysqli_query($conn, "UPDATE tbl_purchase_req_detail SET transfer='0' where item_serial='$item_serial' and product='$product' and barcode='$barcode' and pur_item_id='$pur_item_id'");
		}

	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req WHERE purchase_req_id='$purchase_req_branch_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req_detail WHERE purchase_req_id='$purchase_req_branch_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no='$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no='$invoice_no'");
	if($sql){
		header('Location: ../direct_transfer_branch.php?delete=done');
	}
}
if (isset($_GET['single_purchase_id'])) {
	$single_purchase_id=mysqli_real_escape_string($conn, $_GET['single_purchase_id']);
	$invoice_no="Local_Purchase_".$single_purchase_id;

	$sql1 = mysqli_query($conn,"SELECT product,barcode, item_serial from tbl_single_purchase_detail Where purchase_id='$single_purchase_id'");
	   while($data = mysqli_fetch_assoc($sql1))
	   {

	   	$product=$data['product'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];
	   	if($item_serial=='')
	   	{
	   		$item_serial=0;
	   	}
	   	if($pur_item_id=='')
	   	{
	   		$pur_item_id=0;
	   	}

	   	$sql2 = mysqli_query($conn,"SELECT product from tbl_sale_detail Where product='$product' AND (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		$sql3 = mysqli_query($conn,"SELECT item_id from tbl_installment Where item_id='$product' AND  (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		
	
			if (mysqli_num_rows($sql2)!=0 || mysqli_num_rows($sql3)!=0) {
				
				header('Location: ../single_purchase.php?delete=unsuccessful');
				exit;
			}
	  }
	$sql=mysqli_query($conn, "DELETE FROM tbl_single_purchase WHERE purchase_id='$single_purchase_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_single_purchase_detail WHERE purchase_id='$single_purchase_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no='$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no='$invoice_no'");
	if($sql){
		header('Location: ../single_purchase.php?delete=done');
	}
}
if (isset($_GET['planid']) && isset($_GET['type'])) {
	$planid=mysqli_real_escape_string($conn, $_GET['planid']);
	$type=mysqli_real_escape_string($conn, $_GET['type']);
	$invoice_no=$type."_".$planid;
	$invoice_no1="Installment_".$planid;

	$sql2 = mysqli_query($conn,"SELECT *  from tbl_installment Where plan_id='$planid'");
	$row1 = mysqli_fetch_array($sql2);
    $item_serial = $row1['item_serial'];
    $item_id = $row1['item_id'];

    $sql8 = mysqli_query($conn,"SELECT * from tbl_installment_payment Where plan_id='$planid'");
    if (mysqli_num_rows($sql8)!=0) {
				
				header('Location: ../installment_customer.php?delete=unsuccessful');
				exit;
			}
    $sql2=mysqli_query($conn, "UPDATE tbl_sale_return_detail SET sold='0' where item_serial='$item_serial' and product='$item_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_installment WHERE plan_id='$planid'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_installment_payment WHERE plan_id='$planid'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no='$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no='$invoice_no1'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no='$invoice_no'");
	if($sql){
		header('Location: ../installment_customer.php?delete=done');
	}
}
if (isset($_GET['zone_id'])) {
	$zone_id=mysqli_real_escape_string($conn, $_GET['zone_id']);

	$sql=mysqli_query($conn, "SELECT * FROM tbl_zone where parent_zone_id='$zone_id'");
	
	
    if(mysqli_num_rows($sql)>0){
        header('Location: ../zone_list.php?delete=unsuccessful');
        exit();
    }
	$sql=mysqli_query($conn, "DELETE FROM tbl_zone WHERE zone_id='$zone_id'");

	
	if($sql){
		header('Location: ../zone_list.php?delete=done');
	}
}
if (isset($_GET['sub_zone_id'])) {
	$zone_id=mysqli_real_escape_string($conn, $_GET['sub_zone_id']);

	$sql=mysqli_query($conn, "SELECT * FROM tbl_customer where sub_zone='$zone_id'");
	
    if(mysqli_num_rows($sql)>0){
        header('Location: ../sub_zone_list.php?delete=unsuccessful');
        exit();
    }
	$sql=mysqli_query($conn, "DELETE FROM tbl_zone WHERE zone_id='$zone_id'");

	
	if($sql){
		header('Location: ../sub_zone_list.php?delete=done');
	}
}
if (isset($_GET['branch_out_id'])) {
	$purchase_req_branch_id=mysqli_real_escape_string($conn, $_GET['branch_out_id']);
	$invoice_no="Purchase_req_".$purchase_req_branch_id;


	   $sql1 = mysqli_query($conn,"SELECT product,barcode, item_serial, pur_item_id from tbl_purchase_req_detail Where purchase_req_id='$purchase_req_branch_id'");
	   while($data = mysqli_fetch_assoc($sql1))
	   {

	   	$product=$data['product'];
	   	$barcode=$data['barcode'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];
	   	
	   	if($item_serial=='')
	   	{
	   		$item_serial=0;
	   	}
	   	if($pur_item_id=='')
	   	{
	   		$pur_item_id=0;
	   	}
	   	$sql4 = mysqli_query($conn,"SELECT recieved from tbl_purchase_req_detail Where product='$product' and parent_id!='$userid' AND (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
	   	$data = mysqli_fetch_assoc($sql4);
	   	$recieved=$data['recieved'];

	   	$sql2 = mysqli_query($conn,"SELECT product from tbl_sale_detail Where product='$product' AND (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		$sql3 = mysqli_query($conn,"SELECT item_id from tbl_installment Where item_id='$product' AND  (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		
		
	
			if (mysqli_num_rows($sql2)!=0 || mysqli_num_rows($sql3)!=0 || $recieved=='1') {
				
				header('Location: ../branch_stock_out_list.php?delete=unsuccessful');
				exit;
			}

	  }

$sql7 = mysqli_query($conn,"SELECT *  from tbl_purchase_req_detail Where purchase_req_id='$purchase_req_branch_id'");
	while($data = mysqli_fetch_assoc($sql7)){
    	$product=$data['product'];
	   	$barcode=$data['barcode'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];
	   	$iemi=$data['iemi'];
	   	$trans_parent_id=$data['trans_parent_id'];
	   	if($iemi=='1')
	   	{
	   		$sql=mysqli_query($conn, "UPDATE tbl_purchase_req_detail SET transfer='0' where item_serial='$item_serial' and product='$product' and parent_id='$trans_parent_id'");
	   	}
	   	else
	   	{
	   		$sql=mysqli_query($conn, "UPDATE tbl_purchase_req_detail SET transfer='0' where  product='$product' and pur_item_id='$pur_item_id' and parent_id='$trans_parent_id'");
	   	}
    	
		}

	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req WHERE purchase_req_id='$purchase_req_branch_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req_detail WHERE purchase_req_id='$purchase_req_branch_id'");

	if($sql){
		header('Location: ../branch_stock_out_list.php?delete=done');
	}
}
if (isset($_GET['branch_in_id'])) {
	$purchase_req_branch_id=mysqli_real_escape_string($conn, $_GET['branch_in_id']);


	   $sql1 = mysqli_query($conn,"SELECT product,barcode, item_serial, pur_item_id,transfer from tbl_purchase_req_detail Where purchase_req_id='$purchase_req_branch_id'");
	   while($data = mysqli_fetch_assoc($sql1))
	   {

	   	$product=$data['product'];
	   	$barcode=$data['barcode'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];
	   	$transfer=$data['transfer'];
	   	if($item_serial=='')
	   	{
	   		$item_serial=0;
	   	}
	   	if($pur_item_id=='')
	   	{
	   		$pur_item_id=0;
	   	}

	   	$sql2 = mysqli_query($conn,"SELECT product from tbl_sale_detail Where product='$product' AND (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		$sql3 = mysqli_query($conn,"SELECT item_id from tbl_installment Where item_id='$product' AND  (item_serial='$item_serial' OR pur_item_id='$pur_item_id')");
		
		
	
			if (mysqli_num_rows($sql2)!=0 || mysqli_num_rows($sql3)!=0 || $transfer=='1') {
				
				header('Location: ../branch_stock_in_list.php?delete=unsuccessful');
				exit;
			}

	  }

$sql7 = mysqli_query($conn,"SELECT *  from tbl_purchase_req_detail Where purchase_req_id='$purchase_req_branch_id'");
	while($data = mysqli_fetch_assoc($sql7)){
    	$product=$data['product'];
	   	$barcode=$data['barcode'];
	   	$item_serial=$data['item_serial'];
	   	$pur_item_id=$data['pur_item_id'];
	   	$iemi=$data['iemi'];
	   	$trans_parent_id=$data['trans_parent_id'];
	   	if($iemi=='1')
	   	{
	   		
	   		$sql=mysqli_query($conn, "UPDATE tbl_purchase_req_detail SET transfer='0' where item_serial='$item_serial' and product='$product' and parent_id='$trans_parent_id'");
	   	}
	   	else
	   	{
	   		$sql=mysqli_query($conn, "UPDATE tbl_purchase_req_detail SET transfer='0' where  product='$product' and pur_item_id='$pur_item_id' and parent_id='$trans_parent_id'");
	   	}
    	
		}

	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req WHERE purchase_req_id='$purchase_req_branch_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req_detail WHERE purchase_req_id='$purchase_req_branch_id'");

	if($sql){
		header('Location: ../branch_stock_in_list.php?delete=done');
	}
}
if (isset($_GET['local_purchase_head_id'])) {
	$purchase_req_branch_id=mysqli_real_escape_string($conn, $_GET['local_purchase_head_id']);


	   $sql1 = mysqli_query($conn,"SELECT qty_purchased from tbl_local_purchase Where pur_req_id='$purchase_req_branch_id'");
	   while($data = mysqli_fetch_assoc($sql1))
	   {

	   	$qty_purchased=$data['qty_purchased'];

			if ($qty_purchased!='0') {
				
				header('Location: ../main_purchase_req_list.php?delete=unsuccessful');
				exit;
			}

	  }

	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req WHERE purchase_req_id='$purchase_req_branch_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req_detail WHERE purchase_req_id='$purchase_req_branch_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_local_purchase WHERE pur_req_id='$purchase_req_branch_id'");
	if($sql){
		header('Location: ../main_purchase_req_list.php?delete=done');
	}
}
if (isset($_GET['pos_sale_id']) && isset($_GET['ref_id'])) {
	$pos_sale_id=mysqli_real_escape_string($conn, $_GET['pos_sale_id']);
	$invoice_no=mysqli_real_escape_string($conn, $_GET['ref_id']);

	$sql=mysqli_query($conn, "DELETE FROM tbl_sale WHERE sale_id='$pos_sale_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_sale_detail WHERE sale_id='$pos_sale_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no='$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no='$invoice_no'");
	if($sql){
		header('Location: ../pos_sale_list.php?delete=done');
	}
}
?>