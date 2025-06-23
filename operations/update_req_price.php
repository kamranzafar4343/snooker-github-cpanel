<?php
error_reporting(0);
include "../includes/config.php";
include "../includes/session.php";
if($_POST)
{
$item_id=$_POST['item_id'];

$rate=$_POST['purchase_req_rate'];
}
$sql=mysqli_query($conn, "UPDATE tbl_purchase_req_detail SET rate='$rate' WHERE product='$item_id'");
if($sql){
		header('Location: ../inventory.php?update=done');
	}
?>