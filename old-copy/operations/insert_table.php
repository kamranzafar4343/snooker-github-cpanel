<?php
include "../includes/config.php";
include "../includes/session.php";
if (isset($_POST['add_table'])) {
	// echo "string";exit;
	$table_name=mysqli_real_escape_string($conn, $_POST['table_name']);
	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	$status=0;
	$created_date=date('Y-m-d');
	if($edit_id!=''){

$sql=mysqli_query($conn, "update tbl_tables set table_name='$table_name', created_by='$userid',created_date='$created_date' where table_id='$edit_id' ");
	
	if($sql){
		header('Location:../table_list.php?update=successful');
	}
}else{

		$sql=mysqli_query($conn, "insert into tbl_tables(table_name, table_status, created_by, created_date) values('$table_name','$status', '$userid', '$created_date') ");
if($sql){
		header('Location:../table_list.php?insert=successful');
	}
}
}



?>