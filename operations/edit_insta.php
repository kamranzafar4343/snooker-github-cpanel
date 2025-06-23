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

	$down_payment=mysqli_real_escape_string($conn, $_POST['down_payment']);
	$sales_men=mysqli_real_escape_string($conn, $_POST['sales_men']);
	$mo=mysqli_real_escape_string($conn, $_POST['mo']);
	$avo=mysqli_real_escape_string($conn, $_POST['avo']);
	$bm=mysqli_real_escape_string($conn, $_POST['bm']);
	$process_date=mysqli_real_escape_string($conn, $_POST['process_date']);
	$remarks=mysqli_real_escape_string($conn, $_POST['remarks']);
	$barcode=mysqli_real_escape_string($conn, $_POST['barcode']);
	$item_serial=mysqli_real_escape_string($conn, $_POST['item_serial']);
	$period=mysqli_real_escape_string($conn, $_POST['period']);
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

	$plan_id=mysqli_real_escape_string($conn, $_POST['plan_id']);

            
	$sql=mysqli_query($conn, "UPDATE tbl_installment SET mo='$mo',avo='$avo',bm='$bm',sales_men='$sales_men', gran1_name='$gran1_name', gran1_fname='$gran1_fname',gran1_mobile_no='$gran1_mobile_no',gran1_office_no='$gran1_office_no',gran1_client_cnic='$gran1_client_cnic',gran1_relation='$gran1_relation',gran1_occup='$gran1_occup',gran1_address='$gran1_address',gran1_office='$gran1_office', gran2_name='$gran2_name', gran2_fname='$gran2_fname',gran2_mobile_no='$gran2_mobile_no',gran2_office_no='$gran2_office_no',gran2_client_cnic='$gran2_client_cnic',gran2_relation='$gran2_relation', gran2_occup='$gran2_occup',gran2_address='$gran2_address',gran2_office='$gran2_office', gran3_name='$gran3_name', gran3_fname='$gran3_fname',gran3_mobile_no='$gran3_mobile_no',gran3_office_no='$gran3_office_no',gran3_client_cnic='$gran3_client_cnic',gran3_relation='$gran3_relation', gran3_occup='$gran3_occup',gran3_address='$gran3_address',gran3_office='$gran3_office',gran4_name='$gran4_name', gran4_fname='$gran4_fname',gran4_mobile_no='$gran4_mobile_no',gran4_office_no='$gran4_office_no',gran4_client_cnic='$gran4_client_cnic',gran4_relation='$gran4_relation', gran4_occup='$gran4_occup',gran4_address='$gran4_address',gran4_office='$gran4_office', remarks='$remarks',created_date='$process_date' where plan_id='$plan_id'");





	if($sql){
			header('Location: ../installment_detail.php?planid='.$plan_id.'');	
	}
	else{
		header('Location: ../installment.php?insert=unsuccessful');
	}


}

	
?>