<?php
include "../includes/config.php";
include "../includes/session.php";






	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);

	$net_amount=mysqli_real_escape_string($conn, $_POST['net_amount']);
	$gross_amount=mysqli_real_escape_string($conn, $_POST['gross_amount']);
	$discount=mysqli_real_escape_string($conn, $_POST['discount']);

	$location=mysqli_real_escape_string($conn, $_POST['location']);
	$invoice_no=mysqli_real_escape_string($conn, $_POST['invoice_no']);
	$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
	$po_remarks=mysqli_real_escape_string($conn, $_POST['po_remarks']);
	$iemi=mysqli_real_escape_string($conn, $_POST['iemi']);
	$stock_status='Pending';
	date_default_timezone_set("Asia/Karachi");
	$created_date=date("Y-m-d h:i:s");
	$created_by=$userid;

if($edit_id!='')
{
	 	$sql=mysqli_query($conn, "UPDATE tbl_purchase_req SET  location='$location', iemi='$iemi', invoice_no='$invoice_no', invoice_date='$invoice_date',po_remarks='$po_remarks', net_amount='$net_amount', gross_amount='$gross_amount', bill_status='Pending',payment_status='Pending', discount='$discount', created_date='$created_date', created_by='$location' where purchase_id='$edit_id'");

	 	$invoice_no="Purchase"."_".$edit_id;
  	
  	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_detail WHERE purchase_id = $edit_id");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");

     for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
            $sql = "INSERT INTO tbl_purchase_detail (purchase_id, invoice_no, product, qty, cash_rate, inst_rate, created_date, created_by) VALUES ('$edit_id', '$invoice_no','" . $_POST["product"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "', '$created_date', '$location')";
            mysqli_query($conn, $sql);
        }        

  
	if($sql){
		header('Location: ../purchase_list.php?updated=done');
	}
	 
}
//////////////////////////////////////////////
else
{

 	$sql=mysqli_query($conn, "INSERT INTO tbl_purchase_req(location, transfer_type, iemi, invoice_no, invoice_date, po_remarks, net_amount, gross_amount, discount, stock_status, stock_rec_date, created_date, created_by, parent_id) VALUES ('$location', '1','$iemi', '$invoice_no', '$invoice_date', '$po_remarks', '$net_amount', '$gross_amount', '$discount', '$stock_status', '','$created_date', '$location', '$location')");

 	$purchase_req_id = mysqli_insert_id($conn); 
	$invoice_no="Purchase_req_".$purchase_req_id;

	  for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
            $sql = "INSERT INTO tbl_purchase_req_detail (purchase_req_id, invoice_no, product, qty, cash_rate, inst_rate, created_date, created_by, parent_id) VALUES ('$purchase_req_id', '$invoice_no','" . $_POST["product"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "', '$created_date', '$location', '$location')";



            mysqli_query($conn, $sql);
        }

   

	if($sql){
		header('Location: ../direct_transfer_branch.php?added=done');
	}

}

?>