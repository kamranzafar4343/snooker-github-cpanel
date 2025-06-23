<?php
include "../includes/config.php";
include "../includes/session.php";






	$edit_id=mysqli_real_escape_string($conn, $_POST['po']);
	$invoice_no=mysqli_real_escape_string($conn, $_POST['invoice_no']);
	$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
	$net_amount=mysqli_real_escape_string($conn, $_POST['net_amount']);
	$vendor_id=mysqli_real_escape_string($conn, $_POST['vendor']);
	$item_total=mysqli_real_escape_string($conn, $_POST['item_total']);
	$item_recieved=mysqli_real_escape_string($conn, $_POST['item_recieved']);
	$amount_payed=mysqli_real_escape_string($conn, $_POST['amount_payed']);
	$amount_remaining=mysqli_real_escape_string($conn, $_POST['amount_remaining']);
	$bank_id=mysqli_real_escape_string($conn, $_POST['bank_id']);
	$check_no=mysqli_real_escape_string($conn, $_POST['check_no']);
	$payment_method=mysqli_real_escape_string($conn, $_POST['payment_method']);


	if($amount_payed==$net_amount)
	{
		
		$payment_status='Completed';
		
	}
	else
	{

		$payment_status='Pending';
	}
	
	
	$created_date=date('Y-m-d');
	$created_by=$userid;


if($edit_id!='')
{
	 	$sql=mysqli_query($conn, "UPDATE tbl_single_purchase SET   amount_payed='$amount_payed', amount_remaining='$amount_remaining', payment_status='$payment_status',payment_status='$payment_status',bank_id='$bank_id',check_no='$check_no',payment_method='$payment_method', payment_date='$created_date', created_by='$created_by' where purchase_id='$edit_id'");



$tranid = $edit_id;
$invoice_no="Local_Purchase"."_".$edit_id;
		
	$sql=mysqli_query($conn, "DELETE FROM tbl_single_purchase_detail WHERE purchase_id = $edit_id");

	


 for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
           $sql = "INSERT INTO tbl_single_purchase_detail (purchase_id, invoice_no, product, item_serial, barcode, qty_rec, qty, rate, amount, created_date, created_by) VALUES ('$tranid', '$invoice_no','" . $_POST["product"][$a] . "', '" . $_POST["item_serial"][$a] . "', '" . $_POST["barcode"][$a] . "', '" . $_POST["qty_rec"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "', '$created_date', '$created_by')";
            mysqli_query($conn, $sql);
        }


////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////

if($payment_status='Completed')
{
	$narration="Amount Paid Against Local Purchase # ".$tranid." to Vendor , Net Amount was ".$net_amount." Amount Payed was ".$amount_payed." Payment Date was ".$created_date." Order Date was ".$invoice_date."";
	if($payment_method=='Bank Payment')
	{
		$v_type='BP';
		$acode=mysqli_real_escape_string($conn, $_POST['bank_id']);
	}
	if($payment_method=='Cash Payment')
	{
		$v_type='CP';
		$acode='100100000';
	}
}	
else
{
	$narration="Amount Paid Against Local Purchase # ".$tranid." to Vendor , Net Amount was ".$net_amount." Amount Payed was ".$amount_payed." Amount Remaining was ".$amount_remaining." Payment Date was ".$created_date." Order Date was ".$invoice_date."";
	if($payment_method=='Bank Payment')
	{
		$v_type='BP';
		$acode=mysqli_real_escape_string($conn, $_POST['bank_id']);
	}
	if($payment_method=='Cash Payment')
	{
		$v_type='CP';
		$acode='100100000';
	}
}

	$bank_id=mysqli_real_escape_string($conn, $_POST['bank_id']);
	$check_no=mysqli_real_escape_string($conn, $_POST['check_no']);
	$payment_method=mysqli_real_escape_string($conn, $_POST['payment_method']);
	if($amount_payed==$net_amount)
	{
		
		$payment_status='Completed';
	}
	else
	{

		$payment_status='Pending';
	}

$sql=mysqli_query($conn, "UPDATE tbl_trans SET  narration='$narration',amount_payed='$amount_payed', v_type='$v_type',payment_status='$payment_status',bank_id='$bank_id',check_no='$check_no',payment_method='$payment_method', created_date='$created_date', created_by='$created_by' where invoice_no='$invoice_no'");

$vendor_id=mysqli_real_escape_string($conn, $_POST['vendor']);



if($amount_payed==$net_amount)
{

$narration1 =" Amount paid to Vendor against Local Purchase # ".$tranid." was ".$amount_payed." Transaction Date was ".$created_date."  Complete Stock Received on ".$invoice_date."";
$narration2 =" Payment Cleared to Vendor against Local Purchase # ".$tranid." is ".$amount_payed." Transaction Date was ".$created_date."";

			$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by) VALUES ('$tran_id', '$invoice_no', '$vendor_id','$net_amount', '0.00','$payment_status', '$narration2', '$created_date', '$created_by')";
            mysqli_query($conn, $sql);  

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no,  acode, d_amount, c_amount, bill_status, narration, created_date, created_by) VALUES ('$tran_id', '$invoice_no', '$acode', '0.00', '$net_amount','$payment_status', '$narration1', '$created_date', '$created_by')";
            mysqli_query($conn, $sql);          

}
else
{



$narration1 =" Amount paid to Vendor against Local Purchase # ".$tranid." was ".$amount_payed." Amount Remaining is ".$amount_remaining." Transaction Date was ".$created_date."  Complete Stock Received on ".$invoice_date."";
$narration2 =" Payment Cleared to Vendor against Local Purchase # ".$tranid." is ".$amount_payed." Amount Remaining is ".$amount_remaining." Transaction Date was ".$created_date."";

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by) VALUES ('$tran_id', '$invoice_no', '$vendor_id', '$amount_payed', '0.00', '$payment_status', '$narration1', '$created_date', '$created_by')";
            mysqli_query($conn, $sql);


            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by) VALUES ('$tran_id', '$invoice_no', '$acode', '0.00', '$amount_payed', '$payment_status','$narration2', '$created_date', '$created_by')";
            mysqli_query($conn, $sql);


}

            

            
      
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////            	
            

  
	if($sql){
		header('Location: ../single_purchase.php?updated=done');
	}
	 
}
    

?>