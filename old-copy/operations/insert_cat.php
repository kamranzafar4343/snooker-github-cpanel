<?php
include "../includes/config.php";
include "../includes/session.php";
if (isset($_POST['add_catagory'])) {
	// echo "string";exit;
	$cat_name=mysqli_real_escape_string($conn, $_POST['cat_name']);
	$brand_id=mysqli_real_escape_string($conn, $_POST['brand']);
	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);

	$created_date=date('Y-m-d');
	if($edit_id!=''){

$sql=mysqli_query($conn, "update tbl_cat set catagory_name='$cat_name',brand_id='$brand_id', created_by='$userid',created_date='$created_date' where id='$edit_id' ");
	
	if($sql){
		header('Location:../catagory_list.php?update=successfull');
	}
}else{

		$sql=mysqli_query($conn, "insert into tbl_cat(catagory_name, brand_id, created_by, created_date) values('$cat_name','$brand_id', '$userid', '$created_date') ");
if($sql){
		header('Location:../catagory_list.php?insert=successfull');
	}
}
}



?>