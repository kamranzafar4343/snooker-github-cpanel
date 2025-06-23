<?php
include "../includes/config.php";
include "../includes/session.php";


if(isset($_GET['emp_id'])){

	$emp_id=mysqli_real_escape_string($conn, $_GET['emp_id']);
	$attadance_by=$userid;
	date_default_timezone_set("Asia/Karachi");
	$created_date=date("Y-m-d h:i:s");



	$sql=mysqli_query($conn, "INSERT INTO tbl_attendence (emp_id, status, attadance_date, attadance_by) VALUES ('$emp_id', '1', '$created_date', '$attadance_by')");
	if($sql){
		
	
			header('Location: ../employee_attandence.php?approved=successful');
	
		
	}
	else{
		header('Location: ../employee_attandence.php?approved=unsuccessful');
	}


}
if(isset($_GET['emp_id_abb'])){

	$emp_id=mysqli_real_escape_string($conn, $_GET['emp_id_abb']);
	$attadance_by=$userid;
	date_default_timezone_set("Asia/Karachi");
	$created_date=date("Y-m-d h:i:s");



	$sql=mysqli_query($conn, "INSERT INTO tbl_attendence (emp_id, status, attadance_date, attadance_by) VALUES ('$emp_id', '0', '$created_date', '$attadance_by')");
	if($sql){
		
	
			header('Location: ../employee_attandence.php?approved=successful');
	
		
	}
	else{
		header('Location: ../employee_attandence.php?approved=unsuccessful');
	}


}
if(isset($_GET['delete'])){

	$delete=mysqli_real_escape_string($conn, $_GET['delete']);




	$sql=mysqli_query($conn, "DELETE FROM tbl_emp_leave  where id='$delete'");
	if($sql){
		
	
			header('Location: ../emp_leave_list.php?delete=successful');
	
		
	}
	else{
		header('Location: ../emp_leave_list.php?delete=unsuccessful');
	}


}
?>