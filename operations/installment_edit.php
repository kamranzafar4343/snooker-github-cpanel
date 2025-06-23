<?php
error_reporting(0);
include "../includes/config.php";
include "../includes/session.php";




		$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
		$created_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
		$created_by=$userid;



		$location=mysqli_real_escape_string($conn, $_POST['location']);
		$customer=mysqli_real_escape_string($conn, $_POST['customer']);
		$customer_cnic=mysqli_real_escape_string($conn, $_POST['client_cnic']);
		$customer_phone=mysqli_real_escape_string($conn, $_POST['mobile_no1']);
		$customer_email=mysqli_real_escape_string($conn, $_POST['email']);
		$customer_address=mysqli_real_escape_string($conn, $_POST['client_address']);
		$sales_men=mysqli_real_escape_string($conn, $_POST['sales_men']);
		
		$mo=mysqli_real_escape_string($conn, $_POST['mo']);
		$avo=mysqli_real_escape_string($conn, $_POST['avo']);



		$per_month_payment=mysqli_real_escape_string($conn, $_POST['per_month_payment']);
		$per_payment=mysqli_real_escape_string($conn, $_POST['per_payment']);
		$product_name=mysqli_real_escape_string($conn, $_POST['product_name']);
		$one_month_payment=mysqli_real_escape_string($conn, $_POST['one_month_payment']);
		$installment_month=mysqli_real_escape_string($conn, $_POST['installment_month']);
		$plan_id=mysqli_real_escape_string($conn, $_POST['plan_id']);
		$avo_per_amt=mysqli_real_escape_string($conn, $_POST['avo_per_amt']);

		$sql1=mysqli_query($conn, "SELECT SUM(per_month_amount), SUM(installment_number) as no_of_inst FROM tbl_installment_payment where plan_id='$plan_id' and payment_id!='$edit_id'");

		$data1=mysqli_fetch_assoc($sql1);
		$per_month_amount=round($data1['SUM(per_month_amount)'],2);

		$sql2=mysqli_query($conn, "UPDATE tbl_installment SET amount_recieved='$per_month_amount' where plan_id='$plan_id'");
		$invoice_no="Installment"."_".$plan_id;

		$sql2=mysqli_query($conn, "UPDATE tbl_trans SET amount_recieved='$per_month_amount' where invoice_no='$invoice_no'");

		$no_of_inst=$data1['no_of_inst'];
		$total_inst=$no_of_inst+$installment_month;


		$sql2=mysqli_query($conn, "SELECT total_price, down_payment, period FROM tbl_installment where plan_id='$plan_id'");
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
		$data2=mysqli_fetch_assoc($sql2);
		$total_price=round($data2['total_price'],2);
		$down_payment=round($data2['down_payment'],2);
		$period=$data2['period'];
		$remaining=$total_price-$down_payment;
		$invoice_no="Installment"."_".$plan_id;
		$payment_status='Pending';

		
		 $total_paid= round($per_month_amount)+round($per_month_payment);
		if($no_of_inst==0)
		{
			$no_of_inst=1;

		}
		else
		{
			$no_of_inst=$total_inst;
		}
		////////////////////////////////////
		$remaing_inst=$period-$no_of_inst;

		$amount_per_month=round(($remaining-$total_paid)/($remaing_inst), 2);
	
		///////////////////////////////////////
		
			$sql=mysqli_query($conn, "UPDATE tbl_installment SET amount_recieved='$total_paid', per_month_amount='$amount_per_month', rec_status='1', mo_rec_status='1' where plan_id='$plan_id'");
		if($period==$total_inst || $remaining==$total_paid)
		{	
			
			$payment_status='Completed';
			$sql=mysqli_query($conn, "UPDATE tbl_installment SET installment_status='Completed', amount_recieved='$total_paid',rec_status='1', mo_rec_status='1' where plan_id='$plan_id'");
			$sql=mysqli_query($conn, "UPDATE tbl_trans SET amount_recieved='$total_paid' where invoice_no='$invoice_no'");		
		}
	
			
			$sql=mysqli_query($conn, "UPDATE tbl_installment_payment  SET plan_id='$plan_id', location='$location',installment_number='$installment_month', customer='$customer', customer_cnic='$customer_cnic', customer_phone='$customer_phone', customer_email='$customer_email', customer_address='$customer_address', sales_men='$sales_men', avo='$avo', avo_per_amt='0', mo='$mo',  per_month_amount='$per_month_payment', item_id='$product_name', created_date='$created_date', created_by='$created_by', parent_id='$parent_id' WHERE payment_id='$edit_id'");


		
		
		
/////////////////////////////////////////////////////////////////////////////////////////////////////////Accounts/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	

	$invoice_no="Installment"."_".$plan_id;
	$lease_sale='300100300';
	$date=date('Y-m-d');
	$sql9=mysqli_query($conn, "SELECT trans_id,amount_recieved,total_amount FROM tbl_trans where invoice_no='$invoice_no'");
		
		$data9=mysqli_fetch_assoc($sql9);
		$trans_id=$data9['trans_id'];
		$total_amount=$data9['total_amount'];
		$amount_recieved=$data9['amount_recieved'];
		$left=$total_amount-$amount_recieved;	

	$narration1="Edited Installment Payment Against Lease Sale # ".$plan_id." is ".$per_month_payment." ".$plan_id." Last Amount was  For Month ".$installment_month." and Process Date was ".$created_date." and Customer CNIC is ".$customer_cnic."";
	$narration2="Payment Remaining against Lease Sale # ".$plan_id." is ".$left." and Customer CNIC is ".$customer_cnic."";
	$v_type='CR';
	$sql=mysqli_query($conn, "UPDATE tbl_trans SET amount_recieved='$total_paid', payment_status='$payment_status' where invoice_no='$invoice_no'");
	$sql=mysqli_query($conn, "UPDATE tbl_installment SET amount_recieved='$total_paid' where plan_id='$plan_id'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail where payment_id='$edit_id'");

			$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, payment_id, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$trans_id', '$invoice_no','$edit_id', '$lease_sale', '$per_month_payment', '0.00', '$payment_status', '$narration1', '$date', '$created_by', '$parent_id')";
		            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, payment_id, acode, d_amount, c_amount,  bill_status, narration, created_date, created_by, parent_id) VALUES ('$trans_id', '$invoice_no','$edit_id', '$customer', '0.00', '$per_month_payment',  '$payment_status', '$narration2', '$date', '$created_by', '$parent_id')";
            		mysqli_query($conn, $sql);




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($sql){
		header('Location: ../installment_customer.php?Installment=done');
		
	}
	


?>