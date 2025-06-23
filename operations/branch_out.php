<?php
include "../includes/config.php";
include "../includes/session.php";






	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);

	$net_amount=mysqli_real_escape_string($conn, $_POST['net_amount']);
	$gross_amount=mysqli_real_escape_string($conn, $_POST['gross_amount']);

	$location=mysqli_real_escape_string($conn, $_POST['location']);
	$invoice_no=mysqli_real_escape_string($conn, $_POST['invoice_no']);
	$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
	$po_remarks=mysqli_real_escape_string($conn, $_POST['po_remarks']);
	$iemi=mysqli_real_escape_string($conn, $_POST['iemi']);
	$stock_status='Completed';
	date_default_timezone_set("Asia/Karachi");
	$created_date=date("Y-m-d h:i:s");
	$created_by=$userid;

	$sql=mysqli_query($conn, "SELECT branch_id, created_by, user_name  FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $branch_id=$data['branch_id'];
                                $created=$data['created_by'];
                                $user_name=$data['user_name'];
                                if($branch_id=='')
                                {
                                  $parent_id=$created;
                                }
                                else
                                {
                                  $parent_id=$userid;
                                }
    $remarks_from="[ ".$user_name." ] ".$po_remarks;
    
if($edit_id!='')
{
		$invoice_no="Purchase_req_".$edit_id;
	 	$sql=mysqli_query($conn, "UPDATE tbl_purchase_req SET  location='$location', iemi='$iemi', invoice_no='$invoice_no', invoice_date='$invoice_date',po_remarks='$remarks_from', net_amount='$net_amount', gross_amount='$gross_amount', bill_status='Pending',payment_status='Pending', discount='$discount', created_date='$created_date', created_by='$created_by' where purchase_req_id='$edit_id'");

	 	
  	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req_detail WHERE purchase_req_id = $edit_id");

     for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
            $sql = "INSERT INTO tbl_purchase_req_detail (purchase_req_id, invoice_no, product, qty, cash_rate, inst_rate, created_date, created_by) VALUES ('$edit_id', '$invoice_no','" . $_POST["product"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "', '$created_date', '$created_by')";
            mysqli_query($conn, $sql);
        }        

  
	if($sql){
		header('Location: ../purchase_req_list.php?updated=done');
	}
	 
}
//////////////////////////////////////////////
else
{


 	$sql=mysqli_query($conn, "INSERT INTO tbl_purchase_req(transfer_type, location, from_location, iemi, invoice_no, invoice_date, po_remarks, net_amount, gross_amount, discount, stock_status, stock_rec_date, created_date, created_by, parent_id, branch_read, admin_read) VALUES ('2', '$location', '$userid', '$iemi', '$invoice_no', '$invoice_date', '$remarks_from', '$net_amount', '$gross_amount', '$discount', '$stock_status', '','$created_date', '$location', '$location', '0', '1')");

 	$purchase_req_id = mysqli_insert_id($conn); 


	  for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
        	$product=explode(',', $_POST["product"][$a]);
        	$item_id=$product[0];
        	$total_items+=$_POST["qty"][$a];
        	$sql=mysqli_query($conn, "Update tbl_purchase_req_detail set transfer='1' WHERE product='$item_id' and  item_serial='" . $_POST["item_serial"][$a] . "' and  pur_item_id='" . $_POST["pur_item_id"][$a] . "'");

            $sql = "INSERT INTO tbl_purchase_req_detail (purchase_req_id, invoice_no, product, item_serial, pur_item_id, barcode,  qty, qty_rec,  cash_rate, inst_rate, created_date, created_by, parent_id,trans_id,trans_parent_id,iemi, recieved) VALUES ('$purchase_req_id', '$invoice_no','$item_id', '" . $_POST["item_serial"][$a] . "', '" . $_POST["pur_item_id"][$a] . "', '" . $_POST["barcode"][$a] . "', '" . $_POST["qty"][$a] . "', '0', '" . $_POST["cash_rate"][$a] . "',  '" . $_POST["inst_rate"][$a] . "', '$created_date', '$location', '$location','$userid','$userid', '$iemi', '0')";
            mysqli_query($conn, $sql);

            $sql=mysqli_query($conn, "UPDATE tbl_purchase_req SET item_total='$total_items', item_transfer='$total_items'  WHERE purchase_req_id='$purchase_req_id'");
            
        }

   

	if($sql){
		header('Location: ../branch_stock_out_list.php?added=done');
	}

}

?>