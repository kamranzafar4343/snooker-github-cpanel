<?php
include "../includes/config.php";
include "../includes/session.php";

	$edit=mysqli_real_escape_string($conn, $_POST['edit']);

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
	$iemi=mysqli_real_escape_string($conn, $_POST['iemi']);
	$custom_narration=mysqli_real_escape_string($conn, $_POST['narration']);
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

	if($amount_payed==$net_amount)
	{
		
		$payment_status='Completed';
		
	}
	else
	{

		$payment_status='Pending';
	}
	if($iemi=='1')
	{
		$PO='PO (IEMI)';
	}
	else
	{
		$PO='PO';
	}
	date_default_timezone_set("Asia/Karachi");
	$created_date=date("Y-m-d h:i:s");
	$created_by=$userid;


if($edit_id!='')
{
	 	$sql=mysqli_query($conn, "UPDATE tbl_purchase SET    narration='$custom_narration', amount_payed='$amount_payed', amount_remaining='$amount_remaining', payment_status='$payment_status',payment_status='$payment_status',bank_id='$bank_id',check_no='$check_no',payment_method='$payment_method', payment_date='$created_date', created_by='$created_by' where purchase_id='$edit_id'");



$tranid = $edit_id;
$invoice_no="Purchase"."_".$edit_id;
if($edit=='1')
{
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no' and bill_status='Pending'");
}
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_detail WHERE purchase_id = $edit_id");


 for ($a = 0; $a < count($_POST["qty"]); $a++)
        {

            $sql = "INSERT INTO tbl_purchase_detail (purchase_id, invoice_no, product, item_serial, pur_item_id, barcode, qty_rec, qty, rate, sale_rate, amount, created_date, created_by, parent_id, iemi) VALUES ('$tranid', '$invoice_no','" . $_POST["product"][$a] . "', '" . $_POST["item_serial"][$a] . "', '" . $_POST["pur_item_id"][$a] . "','" . $_POST["barcode"][$a] . "', '" . $_POST["qty_rec"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "', '" . $_POST["sale_rate"][$a] . "',  '" . $_POST["amount"][$a] . "', '$created_date', '$created_by','$parent_id', '$iemi')";
            mysqli_query($conn, $sql);
        }


////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////

if($payment_status='Completed')
{
	$narration="Amount Paid Against ".$PO." # ".$tranid." to Vendor , Net Amount was ".$net_amount." Amount Payed was ".$amount_payed." Payment Date was ".$created_date." GRN Date was ".$invoice_date." CUSTOM NARRATION =". $custom_narration."";
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
	$narration="Amount Paid Against ".$PO." # ".$tranid." to Vendor , Net Amount was ".$net_amount." Amount Payed was ".$amount_payed." Amount Remaining was ".$amount_remaining." Payment Date was ".$created_date." GRN Date was ".$invoice_date." CUSTOM NARRATION =". $custom_narration."";
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
	$acc_payable='200200000';
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

	$sql=mysqli_query($conn, "INSERT INTO tbl_trans(vendor_id, invoice_no, narration, total_amount, amount_payed, v_type, bill_status , payment_status, bank_id, check_no, payment_method, created_date, created_by, parent_id) VALUES ('$vendor_id', '$invoice_no', '$narration', '$net_amount', '$amount_payed',  '$v_type', 'Completed', '$payment_status', '$bank_id', '$check_no','$payment_method', '$created_date', '$userid','$parent_id')");


	$tran_id = mysqli_insert_id($conn); 
// $sql=mysqli_query($conn, "UPDATE tbl_trans SET  narration='$narration',amount_payed='$amount_payed', v_type='$v_type',payment_status='$payment_status',bank_id='$bank_id',check_no='$check_no',payment_method='$payment_method', created_date='$created_date', created_by='$created_by' where invoice_no='$invoice_no'");
// 		$sql=mysqli_query($conn, "SELECT * FROM tbl_trans where invoice_no='$invoice_no'");
// 		$data=mysqli_fetch_assoc($sql);
// 		$tran_id=$data['trans_id'];
		
$invoice_no="Purchase"."_".$edit_id;
$vendor_id=mysqli_real_escape_string($conn, $_POST['vendor']);

$narration1 =" Amount paid to Vendor against ".$PO." # ".$tranid." was ".$amount_payed." Transaction Date was ".$created_date."  Complete Stock Received on ".$invoice_date." (CUSTOM NARRATION =". $custom_narration.")";

if($amount_payed==$net_amount)
{


$narration2 =" Payment Cleared to Vendor against ".$PO." # ".$tranid." is ".$amount_payed." Transaction Date was ".$created_date." (CUSTOM NARRATION =". $custom_narration.")";

			$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by,parent_id) VALUES ('$tran_id', '$invoice_no', '$vendor_id','$net_amount', '0.00','Pending', '$narration2', '$created_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);  

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no,  acode, d_amount, c_amount, bill_status, narration, created_date, created_by,parent_id) VALUES ('$tran_id', '$invoice_no', '$acode', '0.00', '$net_amount','Pending', '$narration1', '$created_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);          

}
else
{

$narration2 =" Payment Cleared to Vendor against ".$PO." # ".$tranid." is ".$amount_payed." amount remaining is ".$amount_remaining." Transaction Date was ".$created_date." (CUSTOM NARRATION =". $custom_narration.")";

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by,parent_id) VALUES ('$tran_id', '$invoice_no', '$vendor_id', '$amount_payed', '0.00', 'Pending', '$narration1', '$created_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);


            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by,parent_id) VALUES ('$tran_id', '$invoice_no', '$acode', '0.00', '$amount_payed', 'Pending','$narration2', '$created_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);


}

            

            
      
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////            	
            

  
	if($sql){
		header('Location: ../purchase_list.php?updated=done');
	}
	 
}
    

?>