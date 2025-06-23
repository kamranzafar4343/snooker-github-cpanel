<?php
include "../includes/config.php";
include "../includes/session.php";
if (isset($_POST['addbank'])) {
	// echo "string";exit;
	$bank=mysqli_real_escape_string($conn, $_POST['bank']);
	
	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	if($edit_id!=''){
$sql=mysqli_query($conn, "update tbl_bank set bank='$bank' where id='$edit_id' ");
	
	if($sql){
		header('Location:../bank_list.php?update=successfull');
	}
}else{

		$sql=mysqli_query($conn, "insert into tbl_bank(bank) values('$bank') ");
if($sql){
		header('Location:../bank_list.php?insert=successfull');
	}
}
}



?>