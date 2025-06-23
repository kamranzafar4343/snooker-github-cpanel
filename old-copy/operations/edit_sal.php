<?php
include "../includes/config.php";
include "../includes/session.php";




  $edit_id=mysqli_real_escape_string($conn, $_POST['edit']);
  
  $created_by=$userid;
    $trans_id=mysqli_real_escape_string($conn, $_POST['trans_id']);
    $amount_old=mysqli_real_escape_string($conn, $_POST['amount_old']);
    $amount=mysqli_real_escape_string($conn, $_POST['amount']);
      
    $new_narration=mysqli_real_escape_string($conn, $_POST['narration']);


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

$invoice_no="Salary_".$edit_id;

 $sql="SELECT branch_id,user_privilege,created_by  FROM users where user_id='$userid'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          
                          $privilige = $data['user_privilege'];
                          $created_by = $data['created_by'];
                          $branch_id = $data['branch_id'];
                         }
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

                if($privilige!='branch' && $created_by=='1')
                {
              
                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300', '100100000') and created_by='$parent_id'");

                  $data3=mysqli_fetch_assoc($sql3);
                  $cash_in_hand = $data3['cash_in_hand'];

                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account` WHERE acode='100100000'");

                  $data4=mysqli_fetch_assoc($sql4);
                  $opening_bal = $data4['opening_bal'];
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
                  
             
                  $sql7=mysqli_query($conn, "SELECT SUM(total_amount) as cash_transfer FROM `tbl_trans` WHERE account_id='$branch_id'");

                  $data7=mysqli_fetch_assoc($sql7);
                  $cash_transfer = $data7['cash_transfer'];
                 
                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300', '$branch_id') and parent_id='$parent_id'");

                  $data3=mysqli_fetch_assoc($sql3);
                  $cash_in_hand = $data3['cash_in_hand']+$cash_transfer;

                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account_lv2` WHERE acode='$branch_id'");

                  $data4=mysqli_fetch_assoc($sql4);
                  $opening_bal = $data4['opening_bal'];

                  $total_balance=round($opening_bal+$cash_in_hand);
                }
            $sum_balance=round($amount+$amount_old);
            if($total_balance<$staff_mem_salary)
                 {
                    header('Location: ../salaries.php?add=fail');
                    exit();
                 } 
            

    $sql=mysqli_query($conn, "SELECT narration  FROM tbl_trans where invoice_no='$invoice_no'");
                                $data = mysqli_fetch_assoc($sql);
                                $narration=$data['narration']."( EDITED NARRATION = ".$new_narration." )";

                   

    $salaryid = $edit_id; 
 
    $sql=mysqli_query($conn, "UPDATE tbl_salary SET staff_mem_salary='$amount', created_date='$invoice_date' where id='$salaryid'");
 
        $sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");

     

////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////




$sql=mysqli_query($conn, "UPDATE tbl_trans SET narration='$narration', total_amount='$amount' , created_date='$created_date', created_by='$userid', parent_id='$parent_id' where invoice_no='$invoice_no'");
$tranid = $trans_id; 


$salary_acode='500100400';
$cash_code='100100000';
           $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$salary_acode','$amount', '0.00','Completed', '$narration',  '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

                $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration,  created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$cash_code', '0.00', '$amount','Completed','$narration', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
  if($sql){
    header('Location: ../salary_paid.php?insert=successfull');
  }
   


?>