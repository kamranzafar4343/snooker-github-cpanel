<?php
include "../includes/config.php";
include "../includes/session.php";
error_reporting(0);
if(isset($_GET['voucher_id'])){
$voucher_id=$_GET['voucher_id'];

$query1 = "SELECT * FROM tbl_voucher where trans_id='$voucher_id'";

$result = mysqli_query($conn,$query1);
while($row = mysqli_fetch_array($result) ){
$account_id = $row['account_id'];
$invoice_no = $row['invoice_no'];
$narration = $row['narration'];
$total_amount = $row['total_amount'];
$v_type = $row['v_type'];
$bill_status = $row['bill_status'];
$payment_method = $row['payment_method'];
$created_date = $row['created_date'];
$created_by = $row['created_by'];
$parent_id = $row['parent_id'];

$sql=mysqli_query($conn, "INSERT INTO tbl_trans(account_id, invoice_no, narration, total_amount, v_type, bill_status ,payment_method ,created_date, created_by, parent_id) VALUES ('$account_id', '$invoice_no',  '$narration', '$total_amount',  '$v_type', 'Completed', 'Cash', '$created_date', '$created_by', '$parent_id')");
$tranid = mysqli_insert_id($conn); 
}
$sql2=mysqli_query($conn, "SELECT * FROM tbl_voucher_detail where trans_id='$voucher_id'");
while($row = mysqli_fetch_array($sql2) ){
$invoice_no = $row['invoice_no'];
$acode = $row['acode'];
$d_amount = $row['d_amount'];
$c_amount = $row['c_amount'];
$narration = $row['narration'];
$created_date = $row['created_date'];
$created_by = $row['created_by'];
$parent_id = $row['parent_id'];

$sql = mysqli_query($conn, "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, narration, created_date, created_by, parent_id) VALUES ('$tranid', '$invoice_no', '$acode' ,'$d_amount', '$c_amount' , '$narration', '$created_date', '$created_by', '$parent_id')");
}
	if($sql){
		header('Location: ../add_payment.php?complete=done');
	}
}
?>