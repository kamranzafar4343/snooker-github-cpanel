<?php
include "../includes/config.php";
include "../includes/session.php";

$created_by=$userid;
$created_date=date('Y-m-d');
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

             
              
                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300', '100100000') and created_by='$parent_id'");

                  $data3=mysqli_fetch_assoc($sql3);
                  $cash_in_hand = $data3['cash_in_hand'];

                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account` WHERE acode='100100000'");

                  $data4=mysqli_fetch_assoc($sql4);
                  $opening_bal = $data4['opening_bal'];
               
                  
             
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
                

            if($total_balance<$staff_mem_salary)
             {
                header('Location: ../salaries.php?add=fail');
                exit();
             }  
$staff_mem_id=mysqli_real_escape_string($conn, $_POST['staff_mem_id']);
$staff_mem_salary=mysqli_real_escape_string($conn, $_POST['staff_mem_salary']);

$sqla=mysqli_query($conn, "SELECT * FROM tbl_salesmen where s_id=$staff_mem_id");
                        $dataa=mysqli_fetch_assoc($sqla);

                        $username=$dataa['username'];
$sql=mysqli_query($conn, "INSERT INTO tbl_salary( staff_mem_id, staff_mem_salary, created_date, created_by) VALUES ('$staff_mem_id', '$staff_mem_salary', '$created_date', '$userid')");

$salaryid = mysqli_insert_id($conn); 
$invoice_no="Salary"."_".$salaryid;



$narration="Salary Paid to ".$username." is ".$staff_mem_salary." on Date ".$created_date."";
$v_type='CP';


$sql=mysqli_query($conn, "INSERT INTO tbl_trans(account_id, invoice_no, narration, total_amount, v_type, bill_status ,payment_method , created_by, parent_id) VALUES ('$staff_mem_id', '$invoice_no', '$narration', '$staff_mem_salary',  '$v_type', 'Completed', 'Cash',  '$userid', '$parent_id')");
$tranid = mysqli_insert_id($conn); 


$salary_acode='500800000';



            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$salary_acode','$staff_mem_salary', '0.00','Completed', '$narration',  '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            	$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration,  created_by, parent_id) VALUES ('$tranid', '$invoice_no', '100100000', '0.00', '$staff_mem_salary','Completed','$narration', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
	if($sql){
		header('Location: ../salaries.php?insert=successfull');
	}

?>