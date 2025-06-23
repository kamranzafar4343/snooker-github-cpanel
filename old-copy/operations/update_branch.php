<?php
include "../includes/config.php";
include "../includes/session.php";



if(isset($_POST['update_branch'])){
	$name=mysqli_real_escape_string($conn,$_POST['name']);
	$user_address=mysqli_real_escape_string($conn,$_POST['user_address']);
	$contact_no=mysqli_real_escape_string($conn,$_POST['contact_no']);
	$user_phone=mysqli_real_escape_string($conn,$_POST['user_phone']);
	$user_email=mysqli_real_escape_string($conn,$_POST['user_email']);
	$edit_id=mysqli_real_escape_string($conn,$_POST['edit_id']);
	$branch_id=mysqli_real_escape_string($conn,$_POST['branch_id']);
	
	$sql=mysqli_query($conn,"UPDATE users set user_name='$name', user_email='$user_email',user_address='$user_address',contact_no='$contact_no',user_phone='$user_phone' where user_id='$edit_id'");
	$sql=mysqli_query($conn, "UPDATE  tbl_account_lv2 set aname='$name' where acode='$branch_id'");
	if($sql){
	
			header('Location: ../branch_list.php?update=successful');
	
		
	}
	else{
		// echo $user_address;
		// echo $contact_no;
		// echo $user_phone;	
		// echo $user_email;
		// echo $edit_id;
		// echo $name;
				header('Location: ../branch_list.php?update=unsuccessful');
	}
}
?>