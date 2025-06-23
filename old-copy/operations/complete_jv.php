<?php
include "../includes/config.php";
include "../includes/session.php";

	$created_by=$userid;


		$payment_date=mysqli_real_escape_string($conn, $_POST['payment_date']);
		$voucher_type=mysqli_real_escape_string($conn, $_POST['voucher_type']);


		$location=mysqli_real_escape_string($conn, $_POST['location']);
		$total=mysqli_real_escape_string($conn, $_POST['total']);
		$remarks=mysqli_real_escape_string($conn, $_POST['remarks']);
		$amount=mysqli_real_escape_string($conn, $_POST['amount']);
		$jv_id=mysqli_real_escape_string($conn, $_POST['jv_id']);
		date_default_timezone_set("Asia/Karachi");
   		$created_date=date("".$payment_date." h:i:s");
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
for ($a = 1; $a < count($_POST["debit"]); $a++)
        {
        	$acc2_id=$_POST["account"][$a];
        	$narration2=$_POST["narration"][$a];

        	$sql=mysqli_query($conn, "UPDATE  tbl_jv SET vou_status='Completed', 	accid_2='$acc2_id', narration2='$narration2',	credit='$amount' WHERE jv_id='$jv_id'");
        }
        

$sql=mysqli_query($conn, "INSERT INTO tbl_payment( location, remarks, total, payment_type,  payment_date, created_date, created_by, parent_id) VALUES ('$location', '$remarks', '$amount', '$voucher_type', '$payment_date', '$created_date', '$created_by', '$parent_id')");
			 
			 $voucher = mysqli_insert_id($conn);
			 $v_type=$voucher_type; 
/////////////////////////////////////// JV //////////////////////////////////////////////
if($voucher_type=='JV')
{


      $invoice_no="JV_".$voucher;      
      
     for ($a = 0; $a < count($_POST["debit"]); $a++)
        {
          $sql=mysqli_query($conn, "INSERT INTO tbl_trans(account_id, invoice_no, narration, total_amount, v_type, bill_status ,payment_method ,created_date, created_by, parent_id) VALUES ('" . $_POST["account"][$a] . "', '$invoice_no',  '" . $_POST["narration"][$a] . "', '$amount',  '$v_type', 'Completed', 'Cash', '$payment_date', '$created_by', '$parent_id')");

          $tranid = mysqli_insert_id($conn); 

          $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '" . $_POST["account"][$a] . "' ,'" . $_POST["debit"][$a] . "', '" . $_POST["credit"][$a] . "' , '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);

    }
}
if($sql){
		header('Location: ../add_payment.php?added=done');
	}  
?>