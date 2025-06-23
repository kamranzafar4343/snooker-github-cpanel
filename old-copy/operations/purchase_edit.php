<?php
include "../includes/config.php";
include "../includes/session.php";






	$edit_id=mysqli_real_escape_string($conn, $_POST['po']);
	$trans_id=mysqli_real_escape_string($conn, $_POST['trans_id']);
	$amount_old=mysqli_real_escape_string($conn, $_POST['amount_old']);
	$amount_payed=mysqli_real_escape_string($conn, $_POST['amount']);
	
	$sql=mysqli_query($conn, "SELECT * FROM tbl_purchase where purchase_id='$edit_id'");
                                $data = mysqli_fetch_assoc($sql);
                                $amount_payed_old=$data['amount_payed'];
                                $net_amount=$data['net_amount'];
                                $invoice_date=$data['invoice_date'];
                                $vendor_id=$data['vendor_id'];
                                $amount_edit=$amount_payed_old-$amount_old;
                                $new_amount=$amount_payed+$amount_edit;
               
                  if($new_amount>$net_amount)     
                  {
                  	header('Location: ../purchase_list.php?updated=wrong');
                  	exit();
                  }
	$total_amt=$amount_edit+$amount;

	if($new_amount==$net_amount)
	{
		
		$payment_status='Completed';
		
	}
	else
	{

		$payment_status='Pending';
	
	}
	
	date_default_timezone_set("Asia/Karachi");
	$created_date=date("Y-m-d h:i:s");
	$created_by=$userid;
	$amount_remaining=round($net_amount-$new_amount);

$sql6=mysqli_query($conn, "SELECT acode FROM tbl_trans_detail where trans_id='$trans_id' and acode!='$vendor_id'");
                                $data = mysqli_fetch_assoc($sql6);
                               	$acode=$data['acode'];
if($edit_id!='')
{

	 	$sql=mysqli_query($conn, "UPDATE tbl_purchase SET   amount_payed='$new_amount', amount_remaining='$amount_remaining', payment_status='$payment_status', payment_date='$created_date', created_by='$created_by' where purchase_id='$edit_id'");



$tranid = $edit_id;
$invoice_no="Purchase"."_".$edit_id;
		
	


/////////////////////////////////////////////////////////////////////////////////// Accounts /////////////////////////////////////////////////////////////////////////////////////////////////

if($payment_status='Completed')
{
	$narration="Amount Paid Against ".$PO." # ".$tranid." Net Amount was ".$net_amount." Amount Payed was ".$total_amt." Payment Date was ".$created_date." GRN Date was ".$invoice_date."";
	
}	
else
{
	$narration="Amount Paid Against ".$PO." # ".$tranid." Net Amount was ".$net_amount." Amount Payed was ".$total_amt." Amount Remaining was ".$amount_remaining." Payment Date was ".$created_date." GRN Date was ".$invoice_date."";
}

	
$sql=mysqli_query($conn, "UPDATE tbl_trans SET  narration='$narration', amount_payed='$amount_payed', payment_status='$payment_status', created_date='$created_date', created_by='$created_by' where trans_id = '$trans_id'");
	
		
$invoice_no="Purchase"."_".$edit_id;

	$narration1 =" Amount paid to Vendor against ".$PO." # ".$tranid." was ".$amount_payed." Transaction Date was ".$created_date."  Complete Stock Received on ".$invoice_date."";
			$narration2 =" Payment Cleared to Vendor against ".$PO." # ".$tranid." is ".$amount_payed." Transaction Date was ".$created_date."";

$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE trans_id = $trans_id");

			$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration,  created_date, created_by,parent_id) VALUES ('$trans_id', '$invoice_no', '$vendor_id','$amount_payed', '0.00','Pending', '$narration2', '$created_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);  

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no,  acode, d_amount, c_amount, bill_status, narration,  created_date, created_by,parent_id) VALUES ('$trans_id', '$invoice_no', '$acode', '0.00', '$amount_payed','Pending','$narration1', '$created_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);          



            
      
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////            	
            

  
	if($sql){
		header('Location: ../purchase_list.php?updated=done');
	}
	 
}
    

?>