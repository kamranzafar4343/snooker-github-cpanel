<?php
include "../includes/config.php";
include "../includes/session.php";




		$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	
		$created_by=$userid;
		$sale_type=mysqli_real_escape_string($conn, $_POST['sale_type']);

	    $invoice_date=mysqli_real_escape_string($conn, $_POST['process_date']);
		$location=mysqli_real_escape_string($conn, $_POST['location']);
		$customer_name=mysqli_real_escape_string($conn, $_POST['customer']);
		$bill_no=mysqli_real_escape_string($conn, $_POST['bill_no']);


		$customer_address=mysqli_real_escape_string($conn, $_POST['customer_address']);
		$customer_phone=mysqli_real_escape_string($conn, $_POST['customer_phone']);
		$customer_cnic=mysqli_real_escape_string($conn, $_POST['customer_cnic']);
		$customer_email=mysqli_real_escape_string($conn, $_POST['customer_email']);
		$net_amount=mysqli_real_escape_string($conn, $_POST['net_amount']);
		
		$amount_recieved=mysqli_real_escape_string($conn, $_POST['amount_recieved']);
		$remarks=mysqli_real_escape_string($conn, $_POST['remarks']);
		$sales_men=mysqli_real_escape_string($conn, $_POST['sales_men_id']);
		$amount_returned=mysqli_real_escape_string($conn, $_POST['amount_payed']);
    $iemi=mysqli_real_escape_string($conn, $_POST['iemi']);
    
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
$sql=mysqli_query($conn, "SELECT sale_return_id FROM tbl_sale_return where sale_id='$bill_no'");
                                $data = mysqli_fetch_assoc($sql);
                                $sale_returnid=$data['sale_return_id'];
	
 $sql=mysqli_query($conn, "DELETE FROM tbl_stock WHERE sale_return_id = $sale_returnid");
 $sql=mysqli_query($conn, "DELETE FROM tbl_sale_return WHERE sale_id = $bill_no");
 $sql=mysqli_query($conn, "DELETE FROM tbl_sale_return_detail WHERE sale_id = $bill_no");

date_default_timezone_set("Asia/Karachi");
$invoice_date=mysqli_real_escape_string($conn, $_POST['process_date']);
$created_date=date("".$invoice_date." H:i:s");
 	$sql=mysqli_query($conn, "INSERT INTO tbl_sale_return(sale_id, iemi, location, sale_type, sales_men, customer_name, customer_address, customer_phone, customer_cnic, customer_email, net_amount, amount_returned, remarks,  created_date, created_by, parent_id) VALUES ('$bill_no','$iemi', '$location', '$sale_type', '$sales_men', '$customer_name', '$customer_address', '$customer_phone', '$customer_cnic', '$customer_email	', '$net_amount', '$amount_returned', '$remarks', '$invoice_date', '$created_by', '$parent_id')");

$salereturnid = mysqli_insert_id($conn); 
$invoice_no="Sale_Return"."_".$bill_no;
 $sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
 $sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");

     for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
            $qty=$_POST["return_qty"][$a];
            $product=$_POST["product"][$a];
            if($qty>0)
            {
            $sql=mysqli_query($conn,"INSERT INTO tbl_sale_return_detail (sale_id, iemi, sale_return_id, invoice_no, product, item_serial, pur_item_id, barcode, returned_qty, qty, rate, amount, return_amount, created_date, created_by, parent_id, returned) VALUES ('$bill_no', '$iemi','$salereturnid', '$invoice_no','" . $_POST["product"][$a] . "', '" . $_POST["item_serial"][$a] . "',  '" . $_POST["pur_item_id"][$a] . "','" . $_POST["barcode"][$a] . "', '" . $_POST["return_qty"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "','" . $_POST["return_amount"][$a] . "',  '$invoice_date', '$created_by', '$parent_id', '1')");
            
                $sql=mysqli_query($conn, "SELECT * FROM tbl_stock where parent_item='$product' and sale_final_id='$bill_no'");
                while($data = mysqli_fetch_assoc($sql)){
                    $items=$data['item_id'];
                    $sql=mysqli_query($conn, "INSERT INTO tbl_stock(item_id, sale_return_id, sale_return) VALUES ('$items', '$salereturnid', '$qty')");
                }
                                
            }
            
        }

////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////
$narration="Total Amount Paid Against Sale Return # ".$bill_no." is ".$amount_returned." on Date ".$invoice_date." and Customer CNIC is ".$customer_cnic." (CUSTOM NARRATION ". $remarks.")";
$v_type='CP';


$sql=mysqli_query($conn, "INSERT INTO tbl_trans(customer_id, invoice_no, narration, total_amount, v_type, bill_status ,payment_method ,created_date, created_by, parent_id) VALUES ('$customer_name', '$invoice_no', '$narration', '$amount_returned',  '$v_type', 'Completed', 'Cash', '$created_date', '$userid', '$parent_id')");
$tranid = mysqli_insert_id($conn); 


$cash_sale='300100100';
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
$sale_return='400300000';

$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
			
			$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration,  created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$customer_name',  '0.00', '$amount_returned', 'Completed', '$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$sale_return', '$amount_returned', '0.00', 'Completed','$narration',  '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$cash_sale', '0.00','$amount_returned','Completed','$narration',  '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$stock_acode', '$amount_returned', '0.00', 'Completed','$narration',  '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            	


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
	if($sql){
		header('Location: ../sale_return_list.php?added=done');
	}



?>