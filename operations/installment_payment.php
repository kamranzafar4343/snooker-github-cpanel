<?php
error_reporting(0);
include "../includes/config.php";
include "../includes/session.php";




		$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
		$created_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
		$created_by=$userid;


		$custome_narration=mysqli_real_escape_string($conn, $_POST['narration']);
		$location=mysqli_real_escape_string($conn, $_POST['location']);
		$customer=mysqli_real_escape_string($conn, $_POST['customer']);
		$customer_cnic=mysqli_real_escape_string($conn, $_POST['client_cnic']);
		$customer_phone=mysqli_real_escape_string($conn, $_POST['mobile_no1']);
		$customer_email=mysqli_real_escape_string($conn, $_POST['email']);
		$customer_address=mysqli_real_escape_string($conn, $_POST['client_address']);
		$sales_men=mysqli_real_escape_string($conn, $_POST['sales_men']);
		
		
		$mo=mysqli_real_escape_string($conn, $_POST['mo']);
		$avo=mysqli_real_escape_string($conn, $_POST['avo']);

		date_default_timezone_set("Asia/Karachi");
		$created_date1=date("".$created_date." h:i:s");

		$per_month_payment=mysqli_real_escape_string($conn, $_POST['per_month_payment']);

		$product_name1=mysqli_real_escape_string($conn, $_POST['product_name']);
		$item=explode(',', $product_name1);
		$product_name=$item[0];
		$one_month_payment=mysqli_real_escape_string($conn, $_POST['one_month_payment']);
		$installment_month=mysqli_real_escape_string($conn, $_POST['installment_month']);
		$installment_month_plus=$installment_month-1;
		$to_date=mysqli_real_escape_string($conn, $_POST['to_date']);
		$time = strtotime($to_date);
      $final = date("Y-m-d", strtotime("+".$installment_month_plus." month", $time));
      $to_date_final = $final;
		$from_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
		$plan_id=mysqli_real_escape_string($conn, $_POST['plan_id']);
		$avo_per_amt=mysqli_real_escape_string($conn, $_POST['avo_per_amt']);

		$sql1=mysqli_query($conn, "SELECT SUM(per_month_amount), SUM(installment_number) as no_of_inst FROM tbl_installment_payment where plan_id='$plan_id'");

		$data1=mysqli_fetch_assoc($sql1);
		$per_month_amount=round($data1['SUM(per_month_amount)'],2);
		
		$no_of_inst=$data1['no_of_inst'];
		$total_inst=$no_of_inst+$installment_month;

		$sql2=mysqli_query($conn, "SELECT * FROM tbl_installment where plan_id='$plan_id'");
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
		$amount_recieved=round($data2['amount_recieved'],2);
		$remaining_bal=round($total_price-($amount_recieved+$one_month_payment));
		if($amount_recieved=='' || $amount_recieved=='0')
		{
			$prev_bal=round($total_price);
		}
		else
		{
			$prev_bal=round($remaining_bal+$one_month_payment);
		}
		$down_payment=round($data2['down_payment'],2);
		$period=$data2['period'];
		$iemi=$data2['iemi'];
		$local=$data2['local'];
		$remaining=$total_price-$down_payment;
		$invoice_no="Installment"."_".$plan_id;
		$payment_status='Pending';


		$total_paid= round($per_month_amount)+round($per_month_payment);
		// if($no_of_inst==0)
		// {
		// 	$no_of_inst=1;

		// }
		// else
		// {
		// 	$no_of_inst=$total_inst;
		// }
		$no_of_inst=$total_inst;
		////////////////////////////////////
		$remaing_inst=($period-1)-$no_of_inst;
		
		$amount_per_month=round(($remaining-$total_paid)/($remaing_inst), 0);
		
		///////////////////////////////////////
		if($period==$total_inst || $remaining==$total_paid)
		{	
			
			$payment_status='Completed';
			$sql=mysqli_query($conn, "UPDATE tbl_installment SET installment_status='Completed', amount_recieved='$total_paid',rec_status='1', mo_rec_status='1' where plan_id='$plan_id'");
			$sql=mysqli_query($conn, "UPDATE tbl_trans SET amount_recieved='$total_paid' where invoice_no='$invoice_no'");		
		}
	
		if($no_of_inst==1)
		{			
			$sql=mysqli_query($conn, "UPDATE tbl_installment SET amount_recieved='$total_paid' , per_month_amount='$amount_per_month'  where plan_id='$plan_id'");
		
			$sql=mysqli_query($conn, "INSERT INTO tbl_installment_payment(plan_id, location,installment_number, customer, customer_cnic, customer_phone, customer_email, customer_address, sales_men, avo, avo_per_amt, mo,  per_month_amount, prev_balance, remaing,  item_id, created_date, created_by, parent_id, to_date, from_date) VALUES ('$plan_id', '$location','$installment_month', '$customer', '$customer_cnic', '$customer_phone', '$customer_email','$customer_address','$sales_men','$avo','0', '$mo', '$per_month_payment', '$prev_bal', '$remaining_bal','$product_name', '$created_date1', '$created_by', '$parent_id', '$to_date_final', '$from_date')");
			$payment_id = mysqli_insert_id($conn);
			
		}
		else
		{		
			
			$sql=mysqli_query($conn, "UPDATE tbl_installment SET amount_recieved='$total_paid', per_month_amount='$amount_per_month', rec_status='1', mo_rec_status='1'   where plan_id='$plan_id'");
			
			$sql=mysqli_query($conn, "INSERT INTO tbl_installment_payment(plan_id, location,installment_number, customer, customer_cnic, customer_phone, customer_email, customer_address, sales_men, avo, avo_per_amt, mo,  per_month_amount, prev_balance, remaing, item_id, created_date, created_by, parent_id, to_date, from_date) VALUES ('$plan_id', '$location','$installment_month', '$customer', '$customer_cnic', '$customer_phone', '$customer_email','$customer_address','$sales_men','$avo','0', '$mo', '$per_month_payment', '$prev_bal', '$remaining_bal','$product_name', '$created_date1', '$created_by', '$parent_id', '$to_date_final', '$from_date')");
			$payment_id = mysqli_insert_id($conn);

			

			

		}
		
		
/////////////////////////////////////////////////////////////////////////////////////////////////////////Accounts/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


																		if($iemi=='0' && $local=='1')
                                    {
                                        $type='Local Lease';
                                        $type1='Local_Installment';
                                        $color="background-color: white;";
                                       
                                    }
                                    else if($iemi=='1' && $local=='1')
                                    {
                                       $color="background-color: #abe0e3;";
                                       $type='Local Lease (IEMI)';
                                       $type1='Local_Installment(IEMI)';
                                       
                                    }
                                    else if($iemi=='1' && $local=='0')
                                    {
                                       $color="background-color: #abe0e3;";
                                       $type='Lease (IEMI)';
                                       $type1='Installment(IEMI)';
                                    }
                                    else if($iemi=='0' && $local=='0')
                                    {
                                       $color="background-color: white;";
                                       $type='Lease';
                                       $type1='Installment';
                                    }

	$invoice_no="Installment"."_".$plan_id;
	$invoice_no_inst=$type1."_".$plan_id;

	$lease_sale='300100300';
	$date=date('Y-m-d');
	$sql9=mysqli_query($conn, "SELECT trans_id,amount_recieved,total_amount FROM tbl_trans where invoice_no='$invoice_no_inst'");
		
		$data9=mysqli_fetch_assoc($sql9);
		$trans_id=$data9['trans_id'];
		$total_amount=$data9['total_amount'];
		$amount_recieved=$data9['amount_recieved'];
		$left=$total_amount-$amount_recieved;	

	$narration1="Installment Payment Against Lease Sale # ".$plan_id." is ".$per_month_payment." For Month ".$installment_month." and Process Date was ".$created_date." and Customer CNIC is ".$customer_cnic."";
	$narration2="Payment Remaining against Lease Sale # ".$plan_id." is ".$left." and Customer CNIC is ".$customer_cnic." (CUSTOM NARRATION ". $custom_narration.")";
	$v_type='CR';
	$sql=mysqli_query($conn, "UPDATE tbl_trans SET amount_recieved='$total_paid', payment_status='$payment_status' where invoice_no='$invoice_no'");
	$sql=mysqli_query($conn, "UPDATE tbl_installment SET amount_recieved='$total_paid' where plan_id='$plan_id'");


						$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, payment_id, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$trans_id', '$invoice_no','$payment_id',  '$lease_sale', '$per_month_payment', '0.00', '$payment_status', '$narration1', '$created_date1', '$created_by', '$parent_id')";
		            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, payment_id, acode, d_amount, c_amount,  bill_status, narration, created_date, created_by, parent_id) VALUES ('$trans_id', '$invoice_no', '$payment_id', '$customer', '0.00', '$per_month_payment',  '$payment_status', '$narration2', '$created_date1', '$created_by', '$parent_id')";
            		mysqli_query($conn, $sql);


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($sql){
		header('Location: ../single_inst_invoice.php?payment_id='.$payment_id.'');
		
	}
	


?>