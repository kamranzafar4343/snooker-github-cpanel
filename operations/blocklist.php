<?php
include "../includes/config.php";
include "../includes/session.php";
if(isset($_GET['block_id'])){
	$customer_id=$_GET['block_id'];
	
$sql=mysqli_query($conn, "UPDATE tbl_customer SET blacklist='1' where customer_id='$customer_id'");

	
	if($sql){
		
			header('Location: ../client_list.php?blocked=successful');
		
	}
	else{
		header('Location: ../client_list.php?blocked=unsuccessful');
	}
}
if(isset($_GET['unblock_id'])){
	$customer_id=$_GET['unblock_id'];
	
$sql=mysqli_query($conn, "UPDATE tbl_customer SET blacklist='0' where customer_id='$customer_id'");

	
	if($sql){
		
			header('Location: ../client_list.php?unblocked=successful');
		
	}
	else{
		header('Location: ../client_list.php?unblocked=unsuccessful');
	}
}

?>