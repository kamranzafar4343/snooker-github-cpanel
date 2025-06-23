<?php
include "../includes/config.php";
include "../includes/session.php";
if (isset($_POST['addexpenses'])) {
	// echo "string";exit;
	$expenses=mysqli_real_escape_string($conn, $_POST['expenses']);
	
	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	if($edit_id!=''){
$sql=mysqli_query($conn, "update tbl_expense set expense='$expenses' where id='$edit_id' ");
	
	if($sql){
		header('Location:../expense_list.php?update=successfull');
	}
}else{

		$sql=mysqli_query($conn, "insert into tbl_expense(expense) values('$expenses') ");
if($sql){
		header('Location:../expense_list.php?insert=successfull');
	}
}
}



?>