<?php

include "../includes/config.php";
include "../includes/session.php";

$item_id = $_POST['itemid'];
$user_id = $userid;
$total_qty = $_POST['total_qty'];

$sql1=mysqli_query($conn, "SELECT * FROM tbl_purchase_detail WHERE product='$item_id' and created_by='$user_id' and purchase_id='1'");

if(mysqli_num_rows($sql1)>1)
{
		$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_detail WHERE product='$item_id' and created_by='$user_id' and purchase_id='1' order by id ASC limit 1");
}


	$sql=mysqli_query($conn, "UPDATE tbl_purchase_detail SET qty_rec='$total_qty', qty='$total_qty' WHERE product='$item_id' and created_by='$user_id' and purchase_id='1' order by id desc limit 1");

                             
?>