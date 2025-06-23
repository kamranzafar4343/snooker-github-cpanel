<?php
include "../includes/config.php";
include "../includes/session.php";




	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	
	$created_by=$userid;
	$sale_type=mysqli_real_escape_string($conn, $_POST['sale_type']);

		$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
		$location=mysqli_real_escape_string($conn, $_POST['location']);
		$credit_customer=mysqli_real_escape_string($conn, $_POST['credit_customer']);

		$sql=mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$credit_customer");
		$data=mysqli_fetch_assoc($sql);
		$customer_name=$data['username'];


		$sales_men=mysqli_real_escape_string($conn, $_POST['sales_men']);
		$customer_address=mysqli_real_escape_string($conn, $_POST['client_address']);
		$customer_phone=mysqli_real_escape_string($conn, $_POST['mobile_no1']);
		$customer_cnic=mysqli_real_escape_string($conn, $_POST['client_cnic']);
		$customer_email=mysqli_real_escape_string($conn, $_POST['email']);
		$net_amount=mysqli_real_escape_string($conn, $_POST['net_amount']);
		$gross_amount=mysqli_real_escape_string($conn, $_POST['gross_amount']);
		$discount=mysqli_real_escape_string($conn, $_POST['discount']);
		$amount_recieved=mysqli_real_escape_string($conn, $_POST['amount_recieved']);
		$remarks=mysqli_real_escape_string($conn, $_POST['remarks']);
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
date_default_timezone_set("Asia/Karachi");
$created_date=date("".$invoice_date." h:i:s");

if($iemi=='1')
    {
        $sale_type='Cash Sale (IEMI)';
    }
    else
    {

        $sale_type='Cash Sale';
     
    }
	
if($edit_id!='')
{
$sql=mysqli_query($conn, "SELECT sale_id FROM tbl_sale_return where sale_id='$edit_id'");
    if(mysqli_num_rows($sql)>0){
        header('Location: ../sale_list.php?updated=fail');
        exit();
    }
$saleid = $edit_id; 
   if($iemi=='1')
    {
        $Sale='Sale (IEMI)';
        $invoice_no="Sale (IEMI)"."_".$saleid;
        $sale_type='Cash Sale (IEMI)';
    }
    else
    {
        $Sale='Sale';
        $invoice_no="Sale"."_".$saleid;
        $sale_type='Cash Sale';
    }
  
	 	$sql=mysqli_query($conn, "UPDATE tbl_sale SET location='$location',iemi='$iemi', sale_type='$sale_type', sales_men='$sales_men', customer_name='$credit_customer', customer_address='$customer_address', customer_phone='$customer_phone', customer_cnic='$customer_cnic', customer_email='$customer_email', net_amount='$net_amount', gross_amount='$gross_amount', discount='$discount',amount_recieved='$amount_recieved', remarks='$remarks', created_date='$created_date', created_by='$created_by', parent_id='$parent_id' where sale_id='$edit_id'");

   

      



 $sql=mysqli_query($conn, "DELETE FROM tbl_sale_detail WHERE sale_id = $edit_id");

 $sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
 $sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");
     for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
            $product=$_POST["product"][$a];
            $item=explode(',', $product);
            $item=$item[0];

            $sql = mysqli_query($conn, "INSERT INTO tbl_sale_detail (sale_id, invoice_no, product, item_serial, pur_item_id, barcode, qty, rate, amount, created_date, created_by, parent_id) VALUES ('$saleid', '$invoice_no','$item','" . $_POST["item_serial"][$a] . "','" . $_POST["pur_item_id"][$a] . "','" . $_POST["barcode"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "', '$created_date', '$created_by', '$parent_id')");

            $sql=mysqli_query($conn, "UPDATE tbl_sale_return_detail SET sold='1' where item_serial='" . $_POST["item_serial"][$a] . "' and barcode='" . $_POST["barcode"][$a] . "' and product='$item'");
            
        }

////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////
$saleid = $edit_id; 
   if($iemi=='1')
    {
        $Sale='Sale (IEMI)';
        $invoice_no="Sale"."_".$saleid;
      
    }
    else
    {
        $Sale='Sale';
        $invoice_no="Sale"."_".$saleid;
     
    }

$narration="Total Amount Recieved Against ".$Sale." # ".$saleid." is ".$amount_recieved." on Date ".$invoice_date." and Customer Name is ".$customer_name." and Customer CNIC is ".$customer_cnic." // ".$remarks."";
$v_type='CR';


$sql=mysqli_query($conn, "INSERT INTO tbl_trans(customer_id, invoice_no, narration, total_amount, v_type, bill_status ,payment_method ,created_date, created_by, parent_id) VALUES ('$credit_customer', '$invoice_no', '$narration', '$amount_recieved',  '$v_type', 'Completed', 'Cash', '$created_date', '$userid', '$parent_id')");
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

$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$cash_sale','$amount_recieved', '0.00','Completed','$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            	$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$stock_acode', '0.00', '$net_amount','Completed', '$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
	if($sql){
		header('Location: ../sale_list.php?updated=done');
	}
	 
}
//////////////////////////////////////////////
else
{


 	$sql=mysqli_query($conn, "INSERT INTO tbl_sale(location,iemi, sale_type, sales_men, customer_name, customer_address, customer_phone, customer_cnic, customer_email, net_amount, gross_amount, discount, amount_recieved, remarks,  created_date, created_by, parent_id) VALUES ('$location','$iemi', '$sale_type', '$sales_men', '$credit_customer', '$customer_address', '$customer_phone', '$customer_cnic', '$customer_email	', '$net_amount', '$gross_amount', '$discount', '$amount_recieved', '$remarks', '$created_date', '$created_by', '$parent_id')");
    $saleid = mysqli_insert_id($conn); 
if($iemi=='1')
    {
        $Sale='Sale (IEMI)';
        $invoice_no="Sale"."_".$saleid;
        $sale_type='Cash Sale (IEMI)';
    }
    else
    {
        $Sale='Sale';
        $invoice_no="Sale"."_".$saleid;
        $sale_type='Cash Sale';
    }


     for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
            $product=$_POST["product"][$a];
            $item=explode(',', $product);
            $item=$item[0];
            $sql = mysqli_query($conn, "INSERT INTO tbl_sale_detail (sale_id, invoice_no, product, item_serial, pur_item_id, barcode, qty, rate, amount, created_date, created_by, parent_id) VALUES ('$saleid', '$invoice_no','$item','" . $_POST["item_serial"][$a] . "','" . $_POST["pur_item_id"][$a] . "','" . $_POST["barcode"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "', '$created_date', '$created_by', '$parent_id')");
           
            $sql=mysqli_query($conn, "UPDATE tbl_sale_return_detail SET sold='1' where item_serial='" . $_POST["item_serial"][$a] . "' and barcode='" . $_POST["barcode"][$a] . "' and product='$item'");
            
        }

////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////
       if($iemi=='1')
    {
        $Sale='Sale (IEMI)';
        $invoice_no="Sale"."_".$saleid;
        $sale_type=='Cash Sale (IEMI)';
    }
    else
    {
        $Sale='Sale';
        $invoice_no="Sale"."_".$saleid;
        $sale_type=='Cash Sale';
    }
$narration="Total Amount Recieved Against ".$Sale." # ".$saleid." is ".$amount_recieved." on Date ".$invoice_date." and Customer Name is ".$customer_name." and Customer CNIC is ".$customer_cnic." // ".$remarks."";
$v_type='CR';


$sql=mysqli_query($conn, "INSERT INTO tbl_trans(customer_id, invoice_no, narration, total_amount, v_type, bill_status ,payment_method ,created_date, created_by,parent_id) VALUES ('$credit_customer', '$invoice_no', '$narration', '$amount_recieved',  '$v_type', 'Completed', 'Cash', '$invoice_date', '$userid', '$parent_id')");
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

$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$invoice_no', '$cash_sale','$amount_recieved', '0.00','Completed', '$narration', '$invoice_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            	$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$invoice_no', '$stock_acode', '0.00', '$net_amount','Completed','$narration', '$invoice_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
	if($sql){
		header('Location: ../sale_list.php?added=done');
	}

}

?>