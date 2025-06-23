<?php
include "../includes/config.php";
include "../includes/session.php";
if(isset($_POST['add_leave'])){

	$emp_id=mysqli_real_escape_string($conn, $_POST['emp_id']);
	$leave_type=mysqli_real_escape_string($conn, $_POST['leave_type']);
	$f_date=mysqli_real_escape_string($conn, $_POST['f_date']);
	$t_date=mysqli_real_escape_string($conn, $_POST['t_date']);
	$reason=mysqli_real_escape_string($conn, $_POST['reason']);

	$created_date=date('y-m-d');
	$created_by=$userid;

	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	

	$sql=mysqli_query($conn, "INSERT INTO tbl_emp_leave (emp_id, leave_type, f_date, t_date, reason, created_date, created_by) VALUES ('$emp_id', '$leave_type','$f_date','$t_date','$reason', '$created_date', '$userid')");
	if($sql){
		
	
			header('Location: ../emp_leave_list.php?add=successful');
	
		
	}
	else{
		header('Location: ../emp_leave_list.php?add=unsuccessful');
	}


}

if(isset($_GET['approve'])){

	$approve=mysqli_real_escape_string($conn, $_GET['approve']);
	$approved_by=$userid;



	$sql=mysqli_query($conn, "UPDATE tbl_emp_leave SET status='Approved', approved_by='$approved_by' where id='$approve'");
	if($sql){
		
	
			header('Location: ../emp_leave_list.php?approved=successful');
	
		
	}
	else{
		header('Location: ../emp_leave_list.php?approved=unsuccessful');
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