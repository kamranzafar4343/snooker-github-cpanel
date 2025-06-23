<?php
error_reporting(0);
include "../includes/config.php";

if($_POST['invoice'])
{
	$invoice = $_POST['invoice'];
	
	$query = mysqli_query($conn,"SELECT sale_id FROM tbl_sale_detail where invoice_no='$invoice' limit 1");
	if(mysqli_num_rows($query)>0){

	while($row = mysqli_fetch_assoc($query)){
			$sale_id=$row['sale_id'];
		}
	}
	else
	{
		$sale_id=='';
	}
	echo $sale_id;
}
