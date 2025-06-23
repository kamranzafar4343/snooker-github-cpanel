<?php
error_reporting(0);
include "../includes/config.php";

if($_POST['secret'])
{
	$secret=mysqli_real_escape_string($conn, $_POST['secret']);
	
	$query = mysqli_query($conn, "SELECT secret FROM tbl_company where comp_id='1' and secret='$secret' limit 1");
	if(mysqli_num_rows($query)>0){

	while($row = mysqli_fetch_assoc($query)){
			$secret_check=$row['secret'];
		}
	}
	else
	{
		$secret_check='';
	}
	echo $secret_check;
}
