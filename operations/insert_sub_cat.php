<?php
include "../includes/config.php";
include "../includes/session.php";
if (isset($_POST['add_sub_catagory'])) {
	// echo "string";exit;

	$brand=mysqli_real_escape_string($conn, $_POST['brand']);
	$category=mysqli_real_escape_string($conn, $_POST['category']);
	$sub_cat=mysqli_real_escape_string($conn, $_POST['sub_cat']);
	
	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	$created_date=date('Y-m-d');
	if($edit_id!=''){

$sql=mysqli_query($conn, "update tbl_sub_cat set cat_name='$category',sub_cat_name='$sub_cat',brand_id='$brand', created_date='$created_date', created_by='$userid' where id='$edit_id' ");
	
	if($sql){
		header('Location:../sub_catagory_list.php?update=successfull');
	}
}else{

		$sql=mysqli_query($conn, "insert into tbl_sub_cat(cat_name,sub_cat_name,brand_id, created_date, created_by) values('$category','$sub_cat','$brand','$created_date','$userid') ");
if($sql){
		header('Location:../sub_catagory_list.php?insert=successfull');
	}
}
}



?>