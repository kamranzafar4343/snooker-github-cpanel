<?php
include "../includes/config.php";
include "../includes/session.php";

if (isset($_GET['id'])) {
	$id=mysqli_real_escape_string($conn, $_GET['id']);
	
	$sql=mysqli_query($conn, "DELETE FROM tbl_expense WHERE id=$id");
	if($sql){
		header('Location: ../expense_list.php?delete=successfull');
	}
}
?>