<?php
include "../includes/config.php";
include "../includes/session.php";

		$edit_id=mysqli_real_escape_string($conn, $_POST['edit']);	
		$created_by=$userid;
		$trans_id=mysqli_real_escape_string($conn, $_POST['trans_id']);
		$amount_old=mysqli_real_escape_string($conn, $_POST['amount_old']);
		$amount=mysqli_real_escape_string($conn, $_POST['amount']);
		$voucher_type=mysqli_real_escape_string($conn, $_POST['type']);
		$new_narration=mysqli_real_escape_string($conn, $_POST['narration']);

		$sql=mysqli_query($conn, "SELECT account_id  FROM tbl_trans where trans_id='$trans_id'");
                                $data = mysqli_fetch_assoc($sql);
                                $account_id=$data['account_id'];

	date_default_timezone_set("Asia/Karachi");
    $payment_date=date("Y-m-d h:i:s");
    $time = new DateTime($payment_date);
                        $date = $time->format('Y-m-d');
                        $time = $time->format('h:i');
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



			 $sql=mysqli_query($conn, "UPDATE tbl_payment SET total='$amount' where id='$edit_id'");
			 
			 $voucher = $edit_id;
			 $v_type=$voucher_type; 

/////////////////////////////////////// JV //////////////////////////////////////////////
if($voucher_type=='JV')
{
      $invoice_no="JV_".$voucher;      
      
            $sql=mysqli_query($conn, "SELECT account_id, trans_id FROM tbl_trans where invoice_no='$invoice_no' and total_amount!='0'");
                                $data = mysqli_fetch_assoc($sql);
                                $account_id=$data['account_id'];
                                $trans_id1=$data['trans_id'];
            $sql=mysqli_query($conn, "SELECT account_id, trans_id FROM tbl_trans where invoice_no='$invoice_no' and total_amount='0'");
                                $data = mysqli_fetch_assoc($sql);
                                $account_id1=$data['account_id'];
                                $trans_id2=$data['trans_id'];

            $query3 = mysqli_query($conn,"SELECT SUM(d_amount-c_amount) as balance FROM `tbl_trans_detail` where acode='$account_id1'");

               $data3=mysqli_fetch_assoc($query3);
               $balance = $data3['balance'];

               $sql9=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal1 FROM tbl_account_lv2 where acode='$account_id1'");
                             
                       while($row=mysqli_fetch_assoc($sql9))
                            {

                                $opening_bal1 = $row['opening_bal1'];
                                if($opening_bal1=='')
                                {
                                   $opening_bal1=0; 
                                }
                            }
               $sql7=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where acode='$account_id1'");
                             
                            while($row=mysqli_fetch_assoc($sql7))
                            {

                                $opening_bal = $row['opening_bal'];
                                if($opening_bal=='')
                                {
                                   $opening_bal=0; 
                                }
                            }

             $total_opening=round($balance+$opening_bal+$opening_bal1);
             
             $sum_balance=round($total_opening+$amount_old);
             if($sum_balance<$amount)
             {
                header('Location: ../edit_ledger.php?voucher=fail&invoice_no='.$invoice_no.'&acode='.$account_id.'&created_at='.$date.'');
                exit();
             }
             else
             {

                 $sql=mysqli_query($conn, "UPDATE tbl_trans SET narration = '$new_narration', total_amount='$amount', created_date='$payment_date', created_by='$userid', parent_id='$parent_id' WHERE trans_id='$trans_id1'");

                 $sql=mysqli_query($conn, "UPDATE tbl_trans SET narration = '$new_narration', total_amount='0', created_date='$payment_date', created_by='$userid', parent_id='$parent_id' WHERE trans_id='$trans_id2'");

                 $sql=mysqli_query($conn, "UPDATE tbl_trans_detail SET narration = '$new_narration', d_amount='$amount', created_date='$payment_date', created_by='$userid', parent_id='$parent_id' WHERE trans_id='$trans_id1'");

                 $sql=mysqli_query($conn, "UPDATE tbl_trans_detail SET narration = '$new_narration', c_amount='$amount', created_date='$payment_date', created_by='$userid', parent_id='$parent_id' WHERE trans_id='$trans_id2'");
             }

}
/////////////////////////////////////////////////	cash payment ///////////////////////		 
if($voucher_type=='CP')
{
    $sql="SELECT branch_id ,user_privilege, created_by  FROM users where user_id='$userid'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          $branch_id=$data['branch_id'];
                          $privilige = $data['user_privilege'];
                          $created_by = $data['created_by'];
                   
                         }

            $invoice_no="CP_".$voucher;
        if($privilige!='branch' && $created_by=='1')
        {
            $v_type='CP';
            $cash_in_hand='100100000';

        }
        else
        {
            if($branch_id=='')
                  {
                    $sql="SELECT branch_id FROM users where user_id='$created_by'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          
                          $branch_id = $data['branch_id'];
                          
                         }

                  }
            $v_type='CP';
            $cash_in_hand=$branch_id;
        }
            $query3 = mysqli_query($conn,"SELECT SUM(d_amount-c_amount) as balance FROM `tbl_trans_detail` where acode='$cash_in_hand'");

               $data3=mysqli_fetch_assoc($query3);
               $balance = $data3['balance'];

               $sql9=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal1 FROM tbl_account_lv2 where acode='$cash_in_hand'");
                             
                       while($row=mysqli_fetch_assoc($sql9))
                            {

                                $opening_bal1 = $row['opening_bal1'];
                                if($opening_bal1=='')
                                {
                                   $opening_bal1=0; 
                                }
                            }
               $sql7=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where acode='$cash_in_hand'");
                             
                            while($row=mysqli_fetch_assoc($sql7))
                            {

                                $opening_bal = $row['opening_bal'];
                                if($opening_bal=='')
                                {
                                   $opening_bal=0; 
                                }
                            }

             $total_opening=round($balance+$opening_bal+$opening_bal1);
             
             $sum_balance=round($total_opening+$amount_old);
			if($sum_balance<$amount)
             {
                header('Location: ../edit_ledger.php?voucher=fail&invoice_no='.$invoice_no.'&acode='.$account_id.'&created_at='.$date.'');
                exit();
             }	
			
        	$sql=mysqli_query($conn, "UPDATE tbl_trans SET narration = '$new_narration', total_amount='$amount', created_date='$payment_date', created_by='$userid', parent_id='$parent_id' WHERE trans_id='$trans_id'");

        	$tranid = $trans_id; 
             $sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE trans_id = $trans_id");
        	$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$account_id' ,'$amount', '0.00' , '$new_narration', '$payment_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$cash_in_hand', '0.00', '$amount' , '$new_narration' , '$payment_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);
		
}
/////////////////////////////////////////////////	cash receipt   ///////////////////////
else if ($voucher_type=='CR') 
{
	$sql="SELECT branch_id ,user_privilege, created_by  FROM users where user_id='$userid'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          $branch_id=$data['branch_id'];
                          $privilige = $data['user_privilege'];
                          $created_by = $data['created_by'];
                   
                         }
        if($privilige!='branch' && $created_by=='1')
        {
            $v_type='CR';
            $cash_in_hand='100100000';

        }
        else
        {
            if($branch_id=='')
                  {
                    $sql="SELECT branch_id FROM users where user_id='$created_by'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          
                          $branch_id = $data['branch_id'];
                          
                         }

                  }
            $v_type='CR';
            $cash_in_hand=$branch_id;
        }

			$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE trans_id = $trans_id");
    		$invoice_no="CR_".$voucher;
   
        	$sql=mysqli_query($conn, "UPDATE tbl_trans SET narration = '$new_narration', total_amount='$amount', created_date='$payment_date', created_by='$userid', parent_id='$parent_id' WHERE trans_id='$trans_id'");

        	$tranid = $trans_id;

        	$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$cash_in_hand' ,'$amount', '0.00' , '$new_narration', '$payment_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$account_id', '0.00', '$amount' , '$new_narration' , '$payment_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

        			
}
/////////////////////////////////////////////////	bank payment ///////////////////////
else if ($voucher_type=='BP') 
{
	$invoice_no="BP_".$voucher;
            $query3 = mysqli_query($conn,"SELECT SUM(d_amount-c_amount) as balance FROM `tbl_trans_detail` where acode='$bank_id'");

               $data3=mysqli_fetch_assoc($query3);
               $balance = $data3['balance'];

               $sql9=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal1 FROM tbl_account_lv2 where acode='$bank_id'");
                             
                       while($row=mysqli_fetch_assoc($sql9))
                            {

                                $opening_bal1 = $row['opening_bal1'];
                                if($opening_bal1=='')
                                {
                                   $opening_bal1=0; 
                                }
                            }
               $sql7=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where acode='$bank_id'");
                             
                            while($row=mysqli_fetch_assoc($sql7))
                            {

                                $opening_bal = $row['opening_bal'];
                                if($opening_bal=='')
                                {
                                   $opening_bal=0; 
                                }
                            }

             $total_opening=round($balance+$opening_bal+$opening_bal1);
             
             $sum_balance=round($total_opening+$amount_old);
            if($sum_balance<$amount)
             {
                header('Location: ../edit_ledger.php?voucher=fail&invoice_no='.$invoice_no.'&acode='.$account_id.'&created_at='.$date.'');
                exit();
             }  
			$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE trans_id = $trans_id");
    		
   
        	$sql=mysqli_query($conn, "UPDATE tbl_trans SET narration = '$new_narration', total_amount='$amount', created_date='$payment_date', created_by='$userid', parent_id='$parent_id' WHERE trans_id='$trans_id'");

        	$tranid = $trans_id;

        	$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$account_id' ,'$amount', '0.00' , '$new_narration', '$payment_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$bank_id', '0.00', '$amount' , '$new_narration' , '$payment_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);


        		
}
/////////////////////////////////////////////////	bank receipt ///////////////////////
else if ($voucher_type=='BR') 
{
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE trans_id = $trans_id");
    		$invoice_no="BR_".$voucher;
   
        	$sql=mysqli_query($conn, "UPDATE tbl_trans SET narration = '$new_narration', total_amount='$amount', created_date='$payment_date', created_by='$userid', parent_id='$parent_id' WHERE trans_id='$trans_id'");

        	$tranid = $trans_id;

        	$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$bank_id' ,'$amount', '0.00' , '$new_narration', '$payment_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$account_id', '0.00', '$amount' , '$new_narration' , '$payment_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);
			
}
			
			

  
	if($sql){
		header('Location: ../edit_ledger.php?updated=done&invoice_no='.$invoice_no.'&acode='.$account_id.'&created_at='.$date.'');
	}



?>