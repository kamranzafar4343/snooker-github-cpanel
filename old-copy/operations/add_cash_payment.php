<?php
include "../includes/config.php";
include "../includes/session.php";



  $edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
  
  $created_by=$userid;


    $payment_date=mysqli_real_escape_string($conn, $_POST['payment_date']);
    $bank_id=mysqli_real_escape_string($conn, $_POST['bank_id']);
    $check_no=mysqli_real_escape_string($conn, $_POST['check_no']);
    $voucher_type=mysqli_real_escape_string($conn, $_POST['voucher_type']);


    $location=mysqli_real_escape_string($conn, $_POST['location']);
    $total=mysqli_real_escape_string($conn, $_POST['total']);
    $remarks=mysqli_real_escape_string($conn, $_POST['remarks']);
  
date_default_timezone_set("Asia/Karachi");
    $payment_date=date("".$payment_date." h:i:s");
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

  
if($edit_id!='')
{

$invoice_no="Cash_Payment_".$edit_id;

 $sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
 $sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");


    $sql=mysqli_query($conn, "UPDATE tbl_payment SET location='$location', remarks='$remarks', total='$total', payment_date='$payment_date', created_date='$created_date', created_by='$created_by' where id='$edit_id'");


    

      $cash_payment = mysqli_insert_id($conn); 

      $v_type='CP';

      $cash_in_hand='100100000';

     for ($a = 0; $a < count($_POST["debit"]); $a++)
        {
          $sql=mysqli_query($conn, "INSERT INTO tbl_trans(account_id, invoice_no, narration, total_amount, v_type, bill_status ,payment_method ,created_date, created_by) VALUES ('" . $_POST["account"][$a] . "', '$invoice_no',  '" . $_POST["narration"][$a] . "', '" . $_POST["debit"][$a] . "',  '$v_type', 'Completed', 'Cash', '$payment_date', '$created_by')");

          $tranid = mysqli_insert_id($conn); 

          $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by) VALUES ('$tranid', '$invoice_no', '" . $_POST["account"][$a] . "' ,'" . $_POST["debit"][$a] . "', '0.00' , '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by')";
            mysqli_query($conn, $sql);

              $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by) VALUES ('$tranid', '$invoice_no', '$cash_in_hand', '0.00', '" . $_POST["debit"][$a] . "' , '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by')";
            mysqli_query($conn, $sql);
        }


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
  if($sql){
    header('Location: ../add_payment.php?updated=done');
  }
   
}
//////////////////////////////////////////////
else
{

       $sql=mysqli_query($conn, "INSERT INTO tbl_payment( location, remarks, total, payment_type,  payment_date, created_date, created_by, parent_id) VALUES ('$location', '$remarks', '$total', '$voucher_type', '$payment_date', '$created_date', '$created_by', '$parent_id')");
       
       $voucher = mysqli_insert_id($conn);
       $v_type=$voucher_type; 
/////////////////////////////////////// JV //////////////////////////////////////////////
if($voucher_type=='JV')
{


      $invoice_no="JV_".$voucher;      
      
     for ($a = 0; $a < count($_POST["debit"]); $a++)
        {
          $sql=mysqli_query($conn, "INSERT INTO tbl_trans(account_id, invoice_no, narration, total_amount, v_type, bill_status ,payment_method ,created_date, created_by, parent_id) VALUES ('" . $_POST["account"][$a] . "', '$invoice_no',  '" . $_POST["narration"][$a] . "', '" . $_POST["debit"][$a] . "',  '$v_type', 'Completed', 'Cash', '$payment_date', '$created_by', '$parent_id')");

          $tranid = mysqli_insert_id($conn); 

          $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '" . $_POST["account"][$a] . "' ,'" . $_POST["debit"][$a] . "', '" . $_POST["credit"][$a] . "' , '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);

    }
}
///////////////////////////////////////////////// cash payment ///////////////////////     
if($voucher_type=='CP')
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

      $invoice_no="CP"."_".$voucher;      
      
     for ($a = 0; $a < count($_POST["debit"]); $a++)
        {
          $sql=mysqli_query($conn, "INSERT INTO tbl_trans(account_id, invoice_no, narration, total_amount, v_type, bill_status ,payment_method ,created_date, created_by, parent_id) VALUES ('" . $_POST["account"][$a] . "', '$invoice_no',  '" . $_POST["narration"][$a] . "', '" . $_POST["debit"][$a] . "',  '$v_type', 'Completed', 'Cash', '$payment_date', '$created_by', '$parent_id')");

          $tranid = mysqli_insert_id($conn); 

          $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '" . $_POST["account"][$a] . "' ,'" . $_POST["debit"][$a] . "', '0.00' , '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);

              $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$cash_in_hand', '0.00', '" . $_POST["debit"][$a] . "' , '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);
    }
}
///////////////////////////////////////////////// cash receipt   ///////////////////////
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

  $invoice_no="CR_".$voucher;
     for ($a = 0; $a < count($_POST["debit"]); $a++)
        {

          $sql=mysqli_query($conn, "INSERT INTO tbl_trans(account_id, invoice_no, narration, total_amount, v_type, bill_status ,payment_method ,created_date, created_by, parent_id) VALUES ('" . $_POST["account"][$a] . "', '$invoice_no',  '" . $_POST["narration"][$a] . "', '" . $_POST["debit"][$a] . "',  '$v_type', 'Completed', 'Cash_Receipt', '$payment_date', '$created_by', '$parent_id')");

          $tranid = mysqli_insert_id($conn); 

          $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$cash_in_hand', '" . $_POST["debit"][$a] . "' ,  '0.00', '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);

          $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '" . $_POST["account"][$a] . "', '0.00' ,'" . $_POST["debit"][$a] . "',  '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);
        }     
}
///////////////////////////////////////////////// bank payment ///////////////////////
else if ($voucher_type=='BP') 
{
  $invoice_no="BP"."_".$voucher;

    for ($a = 0; $a < count($_POST["debit"]); $a++)
        {
          $sql=mysqli_query($conn, "INSERT INTO tbl_trans(account_id, invoice_no, narration, bank_id, check_no ,total_amount, v_type, bill_status ,payment_method ,created_date, created_by, parent_id) VALUES ('" . $_POST["account"][$a] . "', '$invoice_no',  '" . $_POST["narration"][$a] . "', '$bank_id', '$check_no', '" . $_POST["debit"][$a] . "',  '$v_type', 'Completed', 'Bank Payment', '$payment_date', '$created_by', '$parent_id')");

          $tranid = mysqli_insert_id($conn); 

          $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '" . $_POST["account"][$a] . "' ,'" . $_POST["debit"][$a] . "', '0.00' , '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);

              $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$bank_id', '0.00', '" . $_POST["debit"][$a] . "' , '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);
        }     
}
///////////////////////////////////////////////// bank receipt ///////////////////////
else if ($voucher_type=='BR') 
{
  $invoice_no="BR"."_".$voucher;    

     for ($a = 0; $a < count($_POST["debit"]); $a++)
        {
          $sql=mysqli_query($conn, "INSERT INTO tbl_trans(account_id, invoice_no, narration, bank_id, check_no ,total_amount, v_type, bill_status ,payment_method ,created_date, created_by, parent_id) VALUES ('" . $_POST["account"][$a] . "', '$invoice_no',  '" . $_POST["narration"][$a] . "', '$bank_id', '$check_no', '" . $_POST["debit"][$a] . "',  '$v_type', 'Completed', 'Bank Receipt', '$payment_date', '$created_by', '$parent_id')");

          $tranid = mysqli_insert_id($conn); 

          $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$bank_id',  '" . $_POST["debit"][$a] . "' , '0.00', '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);

          $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '" . $_POST["account"][$a] . "' , '0.00' , '" . $_POST["debit"][$a] . "', '" . $_POST["narration"][$a] . "', '$payment_date', '$created_by', '$parent_id')";
            mysqli_query($conn, $sql);

              
        }     
}
      
      

  
  if($sql){
    header('Location: ../add_payment.php?added=done');
  }

}

?>