<?php
include "../includes/config.php";
include "../includes/session.php";

if(isset($_POST['plan'])){

	$customer=mysqli_real_escape_string($conn, $_POST['customer']);
	$sql=mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$customer");
		$data=mysqli_fetch_assoc($sql);
		$customer_name=$data['username'];
	$item_id=mysqli_real_escape_string($conn, $_POST['item_id']);

	$total_price=mysqli_real_escape_string($conn, $_POST['total_price']);
	$client_cnic=mysqli_real_escape_string($conn, $_POST['client_cnic']);
	$client_mobile_no=mysqli_real_escape_string($conn, $_POST['mobile_no1']);

	$client_email=mysqli_real_escape_string($conn, $_POST['email']);
	$client_address=mysqli_real_escape_string($conn, $_POST['client_address']);

	$down_payment=mysqli_real_escape_string($conn, $_POST['advance']);
	$per_month_amount=mysqli_real_escape_string($conn, $_POST['per_month_amount']);
	$sales_men=mysqli_real_escape_string($conn, $_POST['sales_men']);
	$mo=mysqli_real_escape_string($conn, $_POST['mo']);
	$avo=mysqli_real_escape_string($conn, $_POST['avo']);
	$bm=mysqli_real_escape_string($conn, $_POST['bm']);

	$srm=mysqli_real_escape_string($conn, $_POST['srm']);
	$rm=mysqli_real_escape_string($conn, $_POST['rm']);
	$crc=mysqli_real_escape_string($conn, $_POST['crc']);
	$pto=mysqli_real_escape_string($conn, $_POST['pto']);

	$process_date=mysqli_real_escape_string($conn, $_POST['process_date']);
	$remarks=mysqli_real_escape_string($conn, $_POST['remarks']);
	$barcode=mysqli_real_escape_string($conn, $_POST['barcode']);
	$item_serial=mysqli_real_escape_string($conn, $_POST['item_serial']);
	$period=mysqli_real_escape_string($conn, $_POST['period']);
	$installment_till=$period-1;
	$time = strtotime($process_date);
  $final = date("Y-m-d", strtotime("+".$installment_till." month", $time));
  $end_final = $final;
	$pur_item_id=mysqli_real_escape_string($conn, $_POST['pur_item_id']);
	
	$gran1_name=mysqli_real_escape_string($conn, $_POST['gran1_name']);
	$gran1_fname=mysqli_real_escape_string($conn, $_POST['gran1_fname']);
	$gran1_mobile_no=mysqli_real_escape_string($conn, $_POST['gran1_mobile_no']);
	$gran1_office_no=mysqli_real_escape_string($conn, $_POST['gran1_office_no']);
	$gran1_client_cnic=mysqli_real_escape_string($conn, $_POST['gran1_client_cnic']);
	$gran1_relation=mysqli_real_escape_string($conn, $_POST['gran1_relation']);
	$gran1_occup=mysqli_real_escape_string($conn, $_POST['gran1_occup']);
	$gran1_address=mysqli_real_escape_string($conn, $_POST['gran1_address']);
	$gran1_office=mysqli_real_escape_string($conn, $_POST['gran1_office']);

	$gran2_name=mysqli_real_escape_string($conn, $_POST['gran2_name']);
	$gran2_fname=mysqli_real_escape_string($conn, $_POST['gran2_fname']);
	$gran2_mobile_no=mysqli_real_escape_string($conn, $_POST['gran2_mobile_no']);
	$gran2_office_no=mysqli_real_escape_string($conn, $_POST['gran2_office_no']);
	$gran2_client_cnic=mysqli_real_escape_string($conn, $_POST['gran2_client_cnic']);
	$gran2_relation=mysqli_real_escape_string($conn, $_POST['gran2_relation']);
	$gran2_occup=mysqli_real_escape_string($conn, $_POST['gran2_occup']);
	$gran2_address=mysqli_real_escape_string($conn, $_POST['gran2_address']);
	$gran2_office=mysqli_real_escape_string($conn, $_POST['gran2_office']);


	$gran3_name=mysqli_real_escape_string($conn, $_POST['gran3_name']);
	$gran3_fname=mysqli_real_escape_string($conn, $_POST['gran3_fname']);
	$gran3_mobile_no=mysqli_real_escape_string($conn, $_POST['gran3_mobile_no']);
	$gran3_office_no=mysqli_real_escape_string($conn, $_POST['gran3_office_no']);
	$gran3_client_cnic=mysqli_real_escape_string($conn, $_POST['gran3_client_cnic']);
	$gran3_relation=mysqli_real_escape_string($conn, $_POST['gran3_relation']);
	$gran3_occup=mysqli_real_escape_string($conn, $_POST['gran3_occup']);
	$gran3_address=mysqli_real_escape_string($conn, $_POST['gran3_address']);
	$gran3_office=mysqli_real_escape_string($conn, $_POST['gran3_office']);


	$gran4_name=mysqli_real_escape_string($conn, $_POST['gran4_name']);
	$gran4_fname=mysqli_real_escape_string($conn, $_POST['gran4_fname']);
	$gran4_mobile_no=mysqli_real_escape_string($conn, $_POST['gran4_mobile_no']);
	$gran4_office_no=mysqli_real_escape_string($conn, $_POST['gran4_office_no']);
	$gran4_client_cnic=mysqli_real_escape_string($conn, $_POST['gran4_client_cnic']);
	$gran4_relation=mysqli_real_escape_string($conn, $_POST['gran4_relation']);
	$gran4_occup=mysqli_real_escape_string($conn, $_POST['gran4_occup']);
	$gran4_address=mysqli_real_escape_string($conn, $_POST['gran4_address']);
	$gran4_office=mysqli_real_escape_string($conn, $_POST['gran4_office']);

	$location=mysqli_real_escape_string($conn, $_POST['location']);
	$form_fee=mysqli_real_escape_string($conn, $_POST['form_fee']);
	$mo_per_amt=mysqli_real_escape_string($conn, $_POST['mo_per_amt']);
	$avo_per_amt=mysqli_real_escape_string($conn, $_POST['avo_per_amt']);
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
	
	$created_by=$userid;
	$product=$item_id;
  $item=explode(',', $product);
  $item=$item[0];
            
	$sql=mysqli_query($conn, "UPDATE tbl_sale_return_detail SET sold='1' where item_serial='$item_serial' and barcode='$barcode' and pur_item_id='$pur_item_id' and product='$item'");

	$sql=mysqli_query($conn, "INSERT INTO tbl_installment (location, iemi, customer, client_cnic, client_mobile_no, client_email, client_address, item_id, item_serial, pur_item_id, barcode, total_price, down_payment, period, per_month_amount, mo, mo_per_amt, avo, avo_per_amt, bm, sales_men, srm, rm, crc, pto,  gran1_name, gran1_fname, gran1_mobile_no, gran1_office_no, gran1_client_cnic, gran1_relation, gran1_occup, gran1_address,gran1_office , gran2_name, gran2_fname, gran2_mobile_no, gran2_office_no, gran2_client_cnic, gran2_relation, gran2_occup, gran2_address, gran2_office, gran3_name, gran3_fname, gran3_mobile_no, gran3_office_no, gran3_client_cnic, gran3_relation, gran3_occup,gran3_address, gran3_office , gran4_name, gran4_fname, gran4_mobile_no, gran4_office_no, gran4_client_cnic, gran4_relation, gran4_occup, gran4_address, gran4_office, created_date, created_by, parent_id, installment_status, remarks, end_date) VALUES ('$location','$iemi', '$customer', '$client_cnic', '$client_mobile_no', '$client_email', '$client_address', '$item_id', '$item_serial', '$pur_item_id', '$barcode', '$total_price', '$down_payment', '$period' , '$per_month_amount', '$mo', '$mo_per_amt', '$avo','$avo_per_amt', '$bm', '$sales_men', '$srm' , '$rm'  , '$crc', '$pto' , '$gran1_name','$gran1_fname','$gran1_mobile_no', '$gran1_office_no','$gran1_client_cnic','$gran1_relation','$gran1_occup','$gran1_address','$gran1_office','$gran2_name','$gran2_fname','$gran2_mobile_no','$gran2_office_no', '$gran2_client_cnic','$gran2_relation','$gran2_occup','$gran2_address','$gran2_office', '$gran3_name','$gran3_fname','$gran3_mobile_no', '$gran3_office_no','$gran3_client_cnic','$gran3_relation','$gran3_occup','$gran3_address','$gran3_office','$gran4_name','$gran4_fname','$gran4_mobile_no', '$gran4_office_no','$gran4_client_cnic','$gran4_relation','$gran4_occup','$gran4_address','$gran4_office','$process_date', '$userid','$parent_id', 'Pending', '$remarks', '$end_final')");
	$leasesaleid = mysqli_insert_id($conn); 
	
	if($iemi=='1')
    {
        $sale_type='Lease Sale (IEMI)';
        $invoice_no="Installment"."_".$leasesaleid;
    }
    else
    {

        $sale_type='Lease Sale';
        $invoice_no="Installment"."_".$leasesaleid;
     
    }
	

	$narration="".$sale_type." # ".$leasesaleid." Total Amount was ".$total_price." Per Month Istallment is ".$per_month_amount." Installment Period was ".$period." Month Process Date was ".$process_date." and Customer Name is ".$customer_name." and Customer CNIC is ".$client_cnic." (CUSTOM NARRATION= ".$remarks.")";
	$v_type='CR';
	$narration1="Form Fee of ".$form_fee." Against Lease Sale # ".$leasesaleid." (CUSTOM NARRATION= ".$remarks.")";
	

$sql=mysqli_query($conn, "INSERT INTO tbl_trans(customer_id, invoice_no, narration, total_amount, v_type, bill_status, payment_status ,payment_method ,created_date, created_by, parent_id) VALUES ('$customer', '$invoice_no', '$narration', '$total_price',  '$v_type', 'Completed', 'Pending', 'Cash', '$process_date', '$created_by', '$parent_id')");
$tran_id = mysqli_insert_id($conn); 

$amount_remaining=$total_price-$down_payment;
$lease_sale='300100300';
$sale_form='300200100';
$total_price+=$form_fee;
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



            
			
			$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tran_id', '$invoice_no', '$lease_sale', '$down_payment', '0.00', 'Pending', '$narration', '$process_date', '$created_by','$parent_id')";
            mysqli_query($conn, $sql);


            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tran_id', '$invoice_no', '$stock_acode', '0.00', '$total_price', 'Pending', '$narration', '$process_date', '$created_by','$parent_id')";
            mysqli_query($conn, $sql);


            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by, parent_id) VALUES ('$tran_id', '$invoice_no', '$customer', '$amount_remaining', '0.00',  'Pending', '$narration', '$process_date', '$created_by','$parent_id')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by, parent_id) VALUES ('$tran_id', '$invoice_no', '$sale_form', '$form_fee', '0.00',  'Pending', '$narration1', '$process_date', '$created_by','$parent_id')";
            mysqli_query($conn, $sql);


	if($sql){
			header('Location: ../installment_detail.php?planid='.$leasesaleid.'');	
	}
	else{
		header('Location: ../installment.php?insert=unsuccessful');
	}


}

	
?>