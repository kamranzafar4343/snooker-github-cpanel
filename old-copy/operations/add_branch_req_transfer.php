<?php
include "../includes/config.php";
include "../includes/session.php";





	$edit=mysqli_real_escape_string($conn, $_POST['edit_id']);
	$edit_id=mysqli_real_escape_string($conn, $_POST['po']);
	$invoice_no=mysqli_real_escape_string($conn, $_POST['invoice_no']);
	$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
	$net_amount=mysqli_real_escape_string($conn, $_POST['net_amount']);
	$item_total=mysqli_real_escape_string($conn, $_POST['item_total']);
	$item_transfer=mysqli_real_escape_string($conn, $_POST['item_recieved']);
	$location=mysqli_real_escape_string($conn, $_POST['location']);
	$po_remarks=mysqli_real_escape_string($conn, $_POST['po_remarks']);
	// $branch_stock='100900000';
	// $ho_stock='100300000';
	$sql=mysqli_query($conn, "SELECT branch_id, created_by  FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $branch_id=$data['branch_id'];
                                $created=$data['created_by'];
                                if($branch_id=='')
                                {
                                  $parent_id=$created;
                                }
                                else
                                {
                                  $parent_id=$userid;
                                }
	if($item_total==$item_transfer){
	$stock_status='Completed';
}
else{
	$stock_status='Pending';
}
	
	$created_date=date('Y-m-d');
	$created_by=$userid;


if($edit_id!='' || $edit!='')
{
	
	 	$sql=mysqli_query($conn, "UPDATE tbl_purchase_req  SET  from_location='$location', po_remarks='$po_remarks', gross_amount='$net_amount', net_amount='$net_amount', item_total='$item_total', item_transfer='$item_transfer', stock_status='$stock_status', stock_tranfer_date='$created_date' where purchase_req_id='$edit_id'");



		$tranid = $edit_id; 
		$invoice_no="Purchase_req_".$edit_id;
		$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req_detail WHERE purchase_req_id = $edit_id");
	


		  for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
    
            $sql = mysqli_query($conn,"INSERT INTO tbl_purchase_req_detail (purchase_req_id, invoice_no, product, item_serial, pur_item_id, barcode, qty_rec, qty, rate, amount, created_date, created_by, parent_id, trans_id, trans_parent_id) VALUES ('$tranid', '$invoice_no','" . $_POST["product"][$a] . "', '" . $_POST["item_serial"][$a] . "','" . $_POST["pur_item_id"][$a] . "', '" . $_POST["barcode"][$a] . "', '" . $_POST["qty_rec"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "', '$created_date', '" . $_POST["created_by"][$a] . "','" . $_POST["parent_id"][$a] . "', '$location', '$location')");

            $sql=mysqli_query($conn, "UPDATE tbl_purchase_req_detail SET transfer='1' where item_serial='" . $_POST["item_serial"][$a] . "' and barcode='" . $_POST["barcode"][$a] . "' and pur_item_id='" . $_POST["pur_item_id"][$a] . "'  and product='" . $_POST["product"][$a] . "' and purchase_req_id!='$edit_id'");
        }



    
////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////////////      


// 	$narration=" PR # ".$tranid." PR Date was ".$invoice_date." Stock Qty Transfered on ".$created_date." was ".$item_transfer." and Total Qty was ".$item_total."";
// 	$v_type='ST';


// 	$sql=mysqli_query($conn, "INSERT INTO tbl_trans(account_id, invoice_no, narration, total_amount, v_type, bill_status ,created_date, created_by) VALUES ('$branch_stock', '$invoice_no', '$narration', '$net_amount',  '$v_type', '', '$created_date', '$created_by')");


// $tran_id = mysqli_insert_id($conn); 

// $stock_acode='100300000';

// $narration1 ="PR # ".$tranid." Net Amount was ".$net_amount." Requested Date was ".$invoice_date." Branch Stock Transfered on ".$created_date."";
// $narration2 ="PR # ".$tranid." Net Amount was ".$net_amount." Requested Date was ".$invoice_date." HO Stock Effected on ".$created_date."";
// $bill_status='Transfered';

//             $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by) VALUES ('$tran_id', '$invoice_no', '$branch_stock','$net_amount', '0.00','$bill_status', '$narration1', '$created_date', '$created_by')";
//             mysqli_query($conn, $sql);

//             $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by) VALUES ('$tran_id', '$invoice_no', '$stock_acode', '0.00', '$net_amount', '$bill_status', '$narration2', '$created_date', '$created_by')";
//             mysqli_query($conn, $sql);
            

  
	if($sql){
		header('Location: ../main_purchase_req_list.php?stock=done');
	}
	 
}
    

?>