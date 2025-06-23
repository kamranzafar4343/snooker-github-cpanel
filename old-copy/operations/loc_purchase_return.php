<?php
include "../includes/config.php";
include "../includes/session.php";






	$edit_id=mysqli_real_escape_string($conn, $_POST['po']);
	$invoice_no=mysqli_real_escape_string($conn, $_POST['invoice_no']);
	$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
	$location=mysqli_real_escape_string($conn, $_POST['location']);
	$po_remarks=mysqli_real_escape_string($conn, $_POST['po_remarks']);
	$vendor_id=mysqli_real_escape_string($conn, $_POST['vendor']);
	$net_amount=mysqli_real_escape_string($conn, $_POST['net_amount']);
	$discount=mysqli_real_escape_string($conn, $_POST['discount']);
	$amount_received=mysqli_real_escape_string($conn, $_POST['amount_received']);
	$payment_method=mysqli_real_escape_string($conn, $_POST['payment_method']);
	$bank_id=mysqli_real_escape_string($conn, $_POST['bank_id']);
	$check_no=mysqli_real_escape_string($conn, $_POST['check_no']);	
	$created_date=date('Y-m-d');
	$created_by=$userid;
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
	 	
$tranid = $edit_id;
$invoice_no="Local_Purchase_Return_".$edit_id;
		
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_return WHERE invoice_no = $invoice_no");
	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_return_detail WHERE invoice_no = $invoice_no");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");;

$sql=mysqli_query($conn, "INSERT INTO tbl_purchase_return(purchase_id, location, invoice_no, return_type, invoice_date, po_remarks, vendor_id, net_amount, discount, amount_received, payment_method, bank_id, check_no, created_date, created_by, parent_id) VALUES ('$edit_id', '$location', '$invoice_no', 'Local_purchase','$invoice_date', '$po_remarks', '$vendor_id', '$net_amount', '$discount', '$amount_received','$payment_method','$bank_id', '$check_no', '$created_date' ,'$created_by', '$parent_id')");

$purchase_return_id = mysqli_insert_id($conn); 

for ($a = 0; $a < count($_POST["return_qty"]); $a++)
        {
        
            $sql = mysqli_query($conn, "INSERT INTO tbl_purchase_return_detail (purchase_id, purchase_return_id	,  product, return_qty, qty, rate, amount, return_amount, item_serial, barcode,created_date, created_by, parent_id) VALUES ('$edit_id', '$purchase_return_id','" . $_POST["product"][$a] . "', '" . $_POST["return_qty"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "',   '" . $_POST["return_amount"][$a] . "',  '" . $_POST["item_serial"][$a] . "',  '" . $_POST["barcode"][$a] . "','$created_date', '$created_by', '$parent_id')");

            $sql=mysqli_query($conn, "UPDATE tbl_sale_return_detail SET returned='1' where item_serial='" . $_POST["item_serial"][$a] . "' and barcode='" . $_POST["barcode"][$a] . "' and product='" . $_POST["product"][$a] . "'");

         
        }
$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_return_detail WHERE return_qty = '0'");

////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////

if($payment_status='Completed')
{
	$narration="Amount Recieved Against PO # ".$tranid." from Vendor , Net Amount was ".$net_amount." Amount Recieved was ".$amount_received." Payment Date was ".$created_date."  Complete Stock Returned on ".$invoice_date."";
	if($payment_method=='Bank Payment')
	{
		$v_type='BR';
		$acode=mysqli_real_escape_string($conn, $_POST['bank_id']);
	}
	if($payment_method=='Cash Payment')
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
			$acode='100100000';
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
			$acode=$branch_id;
        }
	}
}	

	$acc_payable='200200000';
	$bank_id=mysqli_real_escape_string($conn, $_POST['bank_id']);
	$check_no=mysqli_real_escape_string($conn, $_POST['check_no']);
	$payment_method=mysqli_real_escape_string($conn, $_POST['payment_method']);
	$payment_status='Completed';


$sql=mysqli_query($conn, "INSERT INTO tbl_trans(vendor_id, invoice_no, narration, bank_id, check_no, total_amount, v_type, bill_status ,payment_method ,created_date, created_by, parent_id) VALUES ('$vendor_id', '$invoice_no',  '$narration', '$bank_id', '$check_no',  '$amount_received',  '$v_type', 'Completed', '$payment_method', '$created_date', '$userid', '$parent_id')");

$tran_id = mysqli_insert_id($conn); 


		
$invoice_no="Local_Purchase_Return_".$edit_id;

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


$narration1 =" Amount Recieved from Vendor against PO # ".$tranid." was ".$amount_received." Transaction Date was ".$created_date."  Complete Stock Returned on ".$invoice_date."";
$narration2 =" Payment Cleared by Vendor against PO # ".$tranid." is ".$amount_received." Transaction Date was ".$created_date."";

			$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no,  acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tran_id', '$invoice_no', '$acode', '$amount_received', '0.00','$payment_status', '$narration1', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);   

			$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tran_id', '$invoice_no', '$stock_acode','0.00' ,'$amount_received','$payment_status', '$narration2', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);  

                  
            

            
      
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////            	
            

  
	if($sql){
		header('Location: ../loc_purchase_return_list.php?updated=done');
	}
	 
}
    

?>