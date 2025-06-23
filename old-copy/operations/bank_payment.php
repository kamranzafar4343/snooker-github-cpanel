<?php
include "../includes/config.php";
include "../includes/session.php";




	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	
	$created_by=$userid;


		$payment_date=mysqli_real_escape_string($conn, $_POST['payment_date']);
		$location=mysqli_real_escape_string($conn, $_POST['location']);
		$total=mysqli_real_escape_string($conn, $_POST['total']);
		$remarks=mysqli_real_escape_string($conn, $_POST['remarks']);
		$bank_id=mysqli_real_escape_string($conn, $_POST['bank_id']);
		$check_no=mysqli_real_escape_string($conn, $_POST['check_no']);
	
$created_date=date('Y-m-d');
	
if($edit_id!='')
{

$invoice_no="Bank_Payment_".$edit_id;

 $sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
 $sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");


 		$sql=mysqli_query($conn, "UPDATE tbl_payment SET location='$location', remarks='$remarks', total='$total', payment_date='$payment_date', created_date='$created_date', created_by='$created_by' where id='$edit_id'");


    

			$bank_payment = mysqli_insert_id($conn); 
			$invoice_no="Bank_Payment"."_".$edit_id;
			$v_type='BP';

     for ($a = 0; $a < count($_POST["debit"]); $a++)
        {
        	$sql=mysqli_query($conn, "INSERT INTO tbl_trans(account_id, invoice_no, narration, bank_id, check_no ,total_amount, v_type, bill_status ,payment_method ,created_date, created_by) VALUES ('" . $_POST["account"][$a] . "', '$invoice_no',  '" . $_POST["narration"][$a] . "', '$bank_id', '$check_no', '" . $_POST["debit"][$a] . "',  '$v_type', 'Completed', 'Bank Payment', '$payment_date', '$created_by')");

        	$tranid = mysqli_insert_id($conn); 

        	$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by) VALUES ('$tranid', '$invoice_no', '" . $_POST["account"][$a] . "' ,'" . $_POST["debit"][$a] . "', '0.00' , '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by')";
            mysqli_query($conn, $sql);

            	$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by) VALUES ('$tranid', '$invoice_no', '$bank_id', '0.00', '" . $_POST["debit"][$a] . "' , '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by')";
            mysqli_query($conn, $sql);
        }



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
	if($sql){
		header('Location: ../bank_payment_list.php?updated=done');
	}
	 
}
//////////////////////////////////////////////
else
{

			$sql=mysqli_query($conn, "INSERT INTO tbl_payment( location, remarks, total, payment_type,  payment_date, created_date, created_by) VALUES ('$location', '$remarks', '$total', 'Bank', '$payment_date', '$created_date', '$created_by')");

			$bank_payment = mysqli_insert_id($conn); 
			$invoice_no="Bank_Payment"."_".$bank_payment;
			$v_type='BP';

			

     for ($a = 0; $a < count($_POST["debit"]); $a++)
        {
        	$sql=mysqli_query($conn, "INSERT INTO tbl_trans(account_id, invoice_no, narration, bank_id, check_no ,total_amount, v_type, bill_status ,payment_method ,created_date, created_by) VALUES ('" . $_POST["account"][$a] . "', '$invoice_no',  '" . $_POST["narration"][$a] . "', '$bank_id', '$check_no', '" . $_POST["debit"][$a] . "',  '$v_type', 'Completed', 'Bank Payment', '$payment_date', '$created_by')");

        	$tranid = mysqli_insert_id($conn); 

        	$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by) VALUES ('$tranid', '$invoice_no', '" . $_POST["account"][$a] . "' ,'" . $_POST["debit"][$a] . "', '0.00' , '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by')";
            mysqli_query($conn, $sql);

            	$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by) VALUES ('$tranid', '$invoice_no', '$bank_id', '0.00', '" . $_POST["debit"][$a] . "' , '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by')";
            mysqli_query($conn, $sql);
        }


  
	if($sql){
		header('Location: ../bank_payment_list.php?added=done');
	}

}

?>