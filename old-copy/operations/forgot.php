<?php
session_start();
include "../includes/config.php";

if(isset($_POST['forgot'])){
	$email=mysqli_real_escape_string($conn, $_POST['email']);
	$lsql=mysqli_query($conn, "SELECT user_id FROM users WHERE user_email='$email'");
	$data=mysqli_fetch_assoc($lsql);
	$user_id=$data['user_id'];
	$password=mysqli_real_escape_string($conn, $_POST['password']);
	$password=password_hash($password, PASSWORD_DEFAULT);

	$sql=mysqli_query($conn, "UPDATE users set user_password='$password' where user_id='$user_id'");

	if($sql){

		header('Location: ../forgot.php?update=done');
	}
	else{

	header('Location: ../forgot.php?update=fail');
	}
}


?>