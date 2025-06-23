<?php
error_reporting(0);
include "../includes/config.php";

if($_POST['email'])
{
	$email=mysqli_real_escape_string($conn, $_POST['email']);
	
	$query = mysqli_query($conn,"SELECT user_email FROM users where user_email='$email' limit 1");
	if(mysqli_num_rows($query)>0){

	while($row = mysqli_fetch_assoc($query)){
			$user_email=$row['user_email'];
		}
	}
	else
	{
		$user_email='';
	}
	echo $user_email;
}
