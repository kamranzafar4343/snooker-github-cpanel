<?php
include "../includes/config.php";
include "../includes/session.php";




		$plan_id=mysqli_real_escape_string($conn, $_POST['plan_notes_id']);
		$plan_notes=mysqli_real_escape_string($conn, $_POST['plan_notes']);
		$created_by=$userid;
		$created_date=date('Y-m-d');
		$sql=mysqli_query($conn, "INSERT INTO tbl_plan_notes(plan_id, plan_notes, created_date, created_by) VALUES ('$plan_id', '$plan_notes', '$created_date', '$created_by')");
		if($sql){
		header('Location: ../installment_payment.php?notes=done');
		
	}
?>