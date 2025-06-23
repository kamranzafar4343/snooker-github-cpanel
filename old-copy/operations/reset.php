<?php
error_reporting(0);
include "../includes/session.php";
include "../includes/config.php";

$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_trans");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_trans_detail");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_single_purchase");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_single_purchase_detail");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_sale_return");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_sale_return_detail");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_sale");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_sale_detail");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_salary");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_purchase_return");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_purchase_return_detail");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_purchase_req");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_purchase_req_detail");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_purchase");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_purchase_detail");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_plan_notes");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_payment");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_installment");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_installment_payment");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_grn_documents");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_emp_leave");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_grn_documents");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_customer");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_vendors");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_cat");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_catagory");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_items");
$sql=mysqli_query($conn,"TRUNCATE TABLE tbl_item_price");

if($sql){
		header('Location: ../backup.php?reset=done');
	}
else
{
	header('Location: ../backup.php?reset=fail');
}
?>