<?php
include "../includes/config.php";
include "../includes/session.php";

	$created_by=$userid;


		$payment_date=mysqli_real_escape_string($conn, $_POST['payment_date']);
		$voucher_type=mysqli_real_escape_string($conn, $_POST['voucher_type']);


		$location=mysqli_real_escape_string($conn, $_POST['location']);
		$total=mysqli_real_escape_string($conn, $_POST['total']);
		$remarks=mysqli_real_escape_string($conn, $_POST['remarks']);
	
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
      
	    for ($a = 0; $a < count($_POST["debit"]); $a++)
	        {

	          $sql=mysqli_query($conn, "INSERT INTO tbl_jv(location, remarks,  acc_id, narration, debit, credit, voc_type, vou_status ,created_date, created_by, parent_id) VALUES ('$location', '$remarks', '" . $_POST["account"][$a] . "',  '" . $_POST["narration"][$a] . "', '" . $_POST["debit"][$a] . "', '" . $_POST["credit"][$a] . "',  'JV', 'Invalid',  '$created_date', '$created_by', '$parent_id')");

	    	}
if($sql){
		header('Location: ../add_jv_payment.php?added=done');
	}      
?>