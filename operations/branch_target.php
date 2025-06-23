<?php
include "../includes/config.php";
include "../includes/session.php";


if(isset($_POST)){

	
	$branch_id=mysqli_real_escape_string($conn,$_POST['branch_id']);
	$target=mysqli_real_escape_string($conn,$_POST['target']);
	$created_date=date('y-m-d');
	$created_by=$userid;
	$lsql=mysqli_query($conn, "SELECT branch_id FROM tbl_branch_target where branch_id='$branch_id'");  
                                    
    if(mysqli_num_rows($lsql)>0){ 

		$sql=mysqli_query($conn, "UPDATE tbl_branch_target SET target='$target', created_date='$created_date', created_by='$created_by' WHERE branch_id='$branch_id'");
		
	}
	else
	{
		$sql=mysqli_query($conn, "INSERT INTO tbl_branch_target( branch_id, target, created_date, created_by) VALUES('$branch_id', '$target', '$created_date', '$created_by')");
	}
	
	

	if($sql){
		header('Location: ../add_company.php?target=successful');
	}
	else{
		echo mysqli_error($conn);
	}
		}
	  




?>