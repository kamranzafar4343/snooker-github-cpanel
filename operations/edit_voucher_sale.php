<?php
include "../includes/config.php";
include "../includes/session.php";




	$edit_id=mysqli_real_escape_string($conn, $_POST['edit']);
	
	$created_by=$userid;
    $trans_id=mysqli_real_escape_string($conn, $_POST['trans_id']);
    $amount_old=mysqli_real_escape_string($conn, $_POST['amount_old']);
    $amount=mysqli_real_escape_string($conn, $_POST['amount']);
      
    $new_narration=mysqli_real_escape_string($conn, $_POST['narration']);
	$sale_type=mysqli_real_escape_string($conn, $_POST['type']);


$cash_sale='300100100';
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
    date_default_timezone_set("Asia/Karachi");
    $invoice_date=date("Y-m-d h:i:s");
    $time = new DateTime($invoice_date);
                        $date = $time->format('Y-m-d');
                        $time = $time->format('h:i');

$invoice_no="Sale"."_".$edit_id;
    $sql=mysqli_query($conn, "SELECT narration  FROM tbl_trans where invoice_no='$invoice_no'");
                                $data = mysqli_fetch_assoc($sql);
                                $narration=$data['narration']."( EDITED NARRATION = ".$new_narration." )";


                                $sql=mysqli_query($conn, "SELECT net_amount  FROM tbl_sale where sale_id='$edit_id'");
                                $data = mysqli_fetch_assoc($sql);
                                $net_amount=$data['net_amount'];

                                if($amount<$net_amount)
                                {
                                    header('Location: ../edit_ledger.php?updated=fail&invoice_no='.$invoice_no.'&acode='.$cash_sale.'&created_at='.$date.'');

                                        exit();
                                }
                   
$sql=mysqli_query($conn, "SELECT sale_id FROM tbl_sale_return where sale_id='$edit_id'");
    if(mysqli_num_rows($sql)>0){
        header('Location: ../edit_ledger.php?updated=fail&invoice_no='.$invoice_no.'&acode='.$cash_sale.'&created_at='.$date.'');

        exit();
    }
$saleid = $edit_id; 
 
	 	$sql=mysqli_query($conn, "UPDATE tbl_sale SET remarks='$new_narration', amount_recieved='$amount', created_date='$invoice_date', created_by='$created_by', parent_id='$parent_id' where sale_id='$edit_id'");
 
        $sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");

     

////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////




$sql=mysqli_query($conn, "UPDATE tbl_trans SET narration='$narration', total_amount='$amount' , created_date='$created_date', created_by='$userid', parent_id='$parent_id' where invoice_no='$invoice_no'");
$tranid = $trans_id; 




$sql=mysqli_query($conn, "SELECT user_privilege, created_by FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                                if($user_privilege!='branch' && $created_by=='1')
                                {
                                  $stock_acode='100300000';
                                }
                                else
                                {
                                  $stock_acode='100900000';
                                }


            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$cash_sale','$amount', '0.00','Completed','$narration', '$invoice_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            	$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$stock_acode', '0.00', '$net_amount','Completed', '$narration', '$invoice_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
	if($sql){
		header('Location: ../edit_ledger.php?updated=done&invoice_no='.$invoice_no.'&acode='.$cash_sale.'&created_at='.$date.'');
	}
	 


?>