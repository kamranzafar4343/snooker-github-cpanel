<?php
include "../includes/config.php";
include "../includes/session.php";

	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);

	$created_by=$userid;
	$sale_type=mysqli_real_escape_string($conn, $_POST['sale_type']);


    $fixed_discount=mysqli_real_escape_string($conn, $_POST['after_fdiscount']);

		
		$location=$userid;
		$credit_customer=mysqli_real_escape_string($conn, $_POST['customer']);
        
		$sql=mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$credit_customer");
		$data=mysqli_fetch_assoc($sql);
		$customer_name=$data['username'];
        $customer_address=$data['address_current'];
        $customer_phone=$data['mobile_no1'];
        $customer_cnic=$data['client_cnic'];

        $customer_email='';
        

		$sales_men=$userid;
		$ref_id=mysqli_real_escape_string($conn, $_POST['ref_id']);
        $table=mysqli_real_escape_string($conn, $_POST['table']);
        $sql=mysqli_query($conn, "UPDATE tbl_tables SET table_status='1' where table_id='$table'");
		$net_amount=mysqli_real_escape_string($conn, $_POST['sub_total']);
		$tax=mysqli_real_escape_string($conn, $_POST['tax']);
        $gross_amount=mysqli_real_escape_string($conn, $_POST['after_tax']);
		$discount=mysqli_real_escape_string($conn, $_POST['discount']);
		$total_amount=mysqli_real_escape_string($conn, $_POST['total_amount']);
        $amount_recieved=mysqli_real_escape_string($conn, $_POST['total_amount_recieved']);
     
        $iemi='0';
         if($total_amount==$amount_recieved)
        {
            $status=1;
        }
        else
        {
            $status=0;
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
date_default_timezone_set("Asia/Karachi");
$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
if($invoice_date!='')
{
    $created_date=$invoice_date;
}
else
{
    $created_date=date("Y-m-d H:i:s");
}


	
if($edit_id!='')
{
$sql=mysqli_query($conn, "SELECT sale_id FROM tbl_sale_return where sale_id='$edit_id'");
    if(mysqli_num_rows($sql)>0){
        header('Location: ../sale_list.php?updated=fail');
        exit();
    }
$saleid = $edit_id; 

        $sql=mysqli_query($conn, "UPDATE tbl_tables SET table_status='0' where table_id='$table'");
	 	$sql=mysqli_query($conn, "UPDATE tbl_sale SET location='$location', sale_status='Completed', table_id='$table',iemi='$iemi', sale_type='$sale_type', status='$status', sales_men='$sales_men', customer_name='$credit_customer', customer_address='$customer_address', customer_phone='$customer_phone', customer_cnic='$customer_cnic', customer_email='$customer_email', net_amount='$net_amount', tax='$tax', gross_amount='$gross_amount',fixed_discount='$fixed_discount', discount='$discount',amount_recieved='$amount_recieved', remarks='', created_date='$created_date', created_by='$created_by', parent_id='$parent_id' where sale_id='$edit_id'");

   

      



 

 $sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$ref_id'");
 $sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$ref_id'");
$query_main = mysqli_query($conn, "SELECT * FROM tbl_sale_temp where ref_id='$ref_id'");
if(mysqli_num_rows($query_main)>0)
{
$sql=mysqli_query($conn, "DELETE FROM tbl_sale_detail WHERE sale_id = $edit_id");
$query1 = "SELECT * FROM tbl_sale_temp where ref_id='$ref_id'";

$result = mysqli_query($conn,$query1);

error_reporting(0);

 $i=0;
while($row = mysqli_fetch_array($result)){
$i++;
$temp_id = $row['temp_id'];
$item_id = $row['item_id'];
$barcode = $row['barcode'];
$item_serial = $row['item_serial'];
$pur_item_id = $row['pur_item_id'];
$brand_name = $row['brand_name'];
$item_name = $row['item_name'];
$sale_rate = $row['sale_rate'];
$amount = $row['amount'];
$qty = $row['qty'];

$sql = mysqli_query($conn, "INSERT INTO tbl_sale_detail (sale_id, invoice_no, product, item_serial, pur_item_id, barcode, qty, rate, amount, created_date, created_by, parent_id) VALUES ('$saleid', '$ref_id', '$item_id', '$item_serial', '$pur_item_id','$barcode', '$qty',  '$sale_rate',  '$amount', '$created_date', '$created_by', '$parent_id')");

}
}
////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////
$saleid = $edit_id; 


$narration="Total Amount Recieved Against ".$ref_id." is ".$amount_recieved." on Date ".$invoice_date." and Customer Name is ".$customer_name."";
$v_type='CR';


$sql=mysqli_query($conn, "INSERT INTO tbl_trans(customer_id, invoice_no, narration, total_amount, v_type, bill_status ,payment_method ,created_date, created_by, parent_id) VALUES ('$credit_customer', '$ref_id', '$narration', '$amount_recieved',  '$v_type', 'Completed', 'Cash', '$created_date', '$userid', '$parent_id')");
$tranid = mysqli_insert_id($conn); 




$cash_sale='300100100';
$credit_sale='300100300';
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

$invoice_date=mysqli_real_escape_string($conn, $_POST['created_date']);

if($sale_type=='Cash')
{
           $remaining=$total_amount-$amount_recieved;
            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$cash_sale','$total_amount', '0.00','Completed', '$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

                $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$stock_acode', '0.00', '$total_amount','Completed','$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);
            if($remaining>0)
            {
            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$credit_customer', '0.00', '$remaining',  'Completed','$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);
            }
}
else
{
   $remaining=$total_amount-$amount_recieved;
   if($amount_recieved!=0){
            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$credit_sale','$total_amount', '0.00','Completed', '$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);
        }
            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$stock_acode', '0.00', '$total_amount','Completed','$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$credit_customer', '$remaining', '0.00',  'Completed','$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
	if($sql){
		header('Location: ../sale_pos_invoice_kod.php?sale_id='.$saleid.'');
	}
	 
}
//////////////////////////////////////////////
else
{

 if($total_amount==$amount_recieved)
    {
        $status=1;
    }
    else
    {
        $status=0;
    }

 	$sql=mysqli_query($conn, "INSERT INTO tbl_sale(location,iemi, pos, table_id, sale_type, status, sales_men, customer_name, customer_address, customer_phone, customer_cnic, customer_email, net_amount, tax, gross_amount, fixed_discount, discount, amount_recieved, remarks,  created_date, created_by, parent_id) VALUES ('$location','$iemi', '1', '$table', '$sale_type', '$status', '$sales_men', '$credit_customer', '$customer_address', '$customer_phone', '$customer_cnic', '$customer_email', '$net_amount', '$tax', '$gross_amount', '$fixed_discount', '$discount', '$amount_recieved', '', '$created_date', '$created_by', '$parent_id')");
    $saleid = mysqli_insert_id($conn); 

$query1 = "SELECT * FROM tbl_sale_temp where ref_id='$ref_id'";

$result = mysqli_query($conn,$query1);

error_reporting(0);

 $i=0;
while($row = mysqli_fetch_array($result) ){
 $i++;
$temp_id = $row['temp_id'];
$item_id = $row['item_id'];
$barcode = $row['barcode'];
$item_serial = $row['item_serial'];
$pur_item_id = $row['pur_item_id'];
$brand_name = $row['brand_name'];
$item_name = $row['item_name'];
$sale_rate = $row['sale_rate'];
$amount = $row['amount'];
$qty = $row['qty'];

$sql = mysqli_query($conn, "INSERT INTO tbl_sale_detail (sale_id, invoice_no, product, item_serial, pur_item_id, barcode, qty, rate, amount, created_date, created_by, parent_id) VALUES ('$saleid', '$ref_id', '$item_id', '$item_serial', '$pur_item_id','$barcode', '$qty',  '$sale_rate',  '$amount', '$created_date', '$created_by', '$parent_id')");

}
$query1 = mysqli_query($conn,"UPDATE tbl_sale_temp SET status='1' where ref_id='$ref_id'");

            //$sql=mysqli_query($conn, "UPDATE tbl_sale_return_detail SET sold='1' where item_serial='" . $_POST["item_serial"][$a] . "' and barcode='" . $_POST["barcode"][$a] . "' and product='$item'");

////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////

$narration="Total Amount Recieved Against ".$ref_id." is ".$amount_recieved." Total Amount was ".$total_amount." on Date ".$invoice_date." and Customer Name is ".$customer_name."";
$v_type='CR';


$sql=mysqli_query($conn, "INSERT INTO tbl_trans(customer_id, invoice_no, narration, total_amount, v_type, bill_status ,payment_method ,created_date, created_by,parent_id) VALUES ('$credit_customer', '$ref_id', '$narration', '$total_amount',  '$v_type', 'Completed', 'Cash', '$created_date', '$userid', '$parent_id')");
$tranid = mysqli_insert_id($conn); 




$cash_sale='300100100';
$credit_sale='300100300';
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

$invoice_date=mysqli_real_escape_string($conn, $_POST['created_date']);

if($sale_type=='Cash')
{
           $remaining=$total_amount-$amount_recieved;
            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$cash_sale','$total_amount', '0.00','Completed', '$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            	$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$stock_acode', '0.00', '$total_amount','Completed','$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);
            if($remaining>0)
            {
            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$credit_customer', '0.00', '$remaining',  'Completed','$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);
            }
}
else
{
   $remaining=$total_amount-$amount_recieved;
   if($amount_recieved!=0){
            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$credit_sale','$total_amount', '0.00','Completed', '$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);
        }

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$stock_acode', '0.00', '$total_amount','Completed','$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$credit_customer', '$remaining', '0.00',  'Completed','$narration', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  
	if($sql){
		header('Location: ../sale_pos_invoice_kod.php?sale_id='.$saleid.'');
	}

}

?>