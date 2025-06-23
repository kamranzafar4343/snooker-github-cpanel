<?php
include "../includes/config.php";
include "../includes/session.php";
	$table_id=$_GET['table_id'];

	$sql=mysqli_query($conn, "UPDATE tbl_tables SET table_status='0' where table_id='$table_id'");

	if($sql){
		header('Location: ../table_list.php?updated=done');
	}