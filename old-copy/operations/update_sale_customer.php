<?php
include "../includes/config.php";
include "../includes/session.php";
$edit_id=mysqli_real_escape_string($conn, $_POST['sale_id']);
$customer_name=mysqli_real_escape_string($conn, $_POST['customer_name']);
$sql1=mysqli_query($conn, "SELECT invoice_no FROM tbl_sale_detail where sale_id=$edit_id");
$data=mysqli_fetch_assoc($sql1);
$invoice_no=$data['invoice_no'];
$sql2=mysqli_query($conn, "SELECT customer_name FROM tbl_sale where sale_id=$edit_id");
$data=mysqli_fetch_assoc($sql2);
$customer_name_old=$data['customer_name'];

$sql=mysqli_query($conn, "UPDATE tbl_trans SET customer_id='$customer_name' where invoice_no='$invoice_no' and customer_id='$customer_name_old'");
$sql=mysqli_query($conn, "UPDATE tbl_trans_detail SET acode='$customer_name' where invoice_no='$invoice_no' and acode='$customer_name_old'");
$sql=mysqli_query($conn, "UPDATE tbl_sale_temp SET customer='$customer_name' where ref_id='$invoice_no'");
$sql=mysqli_query($conn, "UPDATE tbl_sale SET customer_name='$customer_name' where sale_id='$edit_id'");
	if($sql){
		header('Location: ../pos_sale_list.php?edit_customer=done');
	}
?>

