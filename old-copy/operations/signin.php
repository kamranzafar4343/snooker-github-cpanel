<?php
session_start();
include "../includes/config.php";

if(isset($_POST['login'])){
	$email=mysqli_real_escape_string($conn, $_POST['email']);
	$lsql=mysqli_query($conn, "SELECT * FROM users WHERE user_email='$email'");
	
	if(mysqli_num_rows($lsql)>0){ 
		$vsql=mysqli_query($conn, "SELECT * FROM tbl_company WHERE comp_status!='Approved'");
		if(mysqli_num_rows($vsql)>0){ 
			header('Location: ../login.php?log=blocked');
			exit();
		}
	else{
	$data=mysqli_fetch_assoc($lsql);
	$oldpass=$data['user_password'];
	$name=$data['user_name'];
	$id=$data['user_id'];
	
	$password=mysqli_real_escape_string($conn, $_POST['password']);
	

	$verify=password_verify($password, $oldpass);

	if($verify){
	
		$_SESSION['useremail']=$email;
		$_SESSION['userid']=$id;
		$_SESSION['adminid']=$id;
		$_SESSION['username']=$name;
		$_SESSION['user_password']=$user_password;
		header('Location: ../index.php');
	}
	else{

		header('Location: ../login.php?log=incorrect');
	}
}
}
else{

	header('Location: ../login.php?log=denied');
} 
}



?>