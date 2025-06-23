<?php
include "../includes/config.php";
include "../includes/session.php";


if(isset($_POST)){

	// echo "in php";
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$branchname=mysqli_real_escape_string($conn,$_POST['owner_name']);

	$mobile_no=mysqli_real_escape_string($conn,$_POST['mobile_no']);
	$address=mysqli_real_escape_string($conn,$_POST['address']);
	$contact_no=mysqli_real_escape_string($conn,$_POST['contact_no']);
	$owner_name=mysqli_real_escape_string($conn,$_POST['name']);
	$user_password=mysqli_real_escape_string($conn,$_POST['user_password']);
	$confirm_password=mysqli_real_escape_string($conn,$_POST['confirm_password']);
	$date=date('Y-m-d');

	$query = mysqli_query($conn,"SELECT * from users WHERE user_email = '$email'");
	$row =mysqli_fetch_assoc($query);
// print_r($query);
	// $num_row = mysqli_num_rows($query);
	if(mysqli_num_rows($query)>0){
		// echo "exist";
		$email_error = 'Email Exist';
	echo json_encode($email_error);
		// exit;
		// header('Location: ../branch_list.php?email=exist');
	}else{

			if($user_password == $confirm_password){
				$user_password=password_hash($user_password, PASSWORD_DEFAULT);
		$user_password=password_hash($user_password, PASSWORD_DEFAULT);

	$cash_in_hand='100100';
	$date=date('Y-m-d');
	
	$query = "SELECT branch_id FROM `users` where user_privilege='branch' order by branch_id DESC LIMIT 1";
	$result = mysqli_query($conn,$query);
	while($row = mysqli_fetch_array($result) ){
		      $branch = $row['branch_id'];
		      ++$branch;

		      }
	if(mysqli_num_rows($result)>0)
	{
			$branch_id=$branch;
		
		  
	}
	else
	{
		
		$branch_id=$cash_in_hand.'101' ;
	}

	$sql=mysqli_query($conn, "INSERT INTO users(user_email, branch_id, user_privilege,user_phone,user_address,contact_no,user_name,user_password,created_date, created_by) VALUES ('$email','$branch_id','branch','$mobile_no','$address','$contact_no','$owner_name','$user_password','$date', '$userid')");

	$sql=mysqli_query($conn, "INSERT INTO tbl_account_lv2( parent_code,sub_child1,acode,aname,created_date,created_by) VALUES('100000000', '100100000', '$branch_id', '$owner_name', '$date', '$userid')");
	

	if($sql){
		
		// header('Location: ../branch_list.php?added=successful');
		// echo "string";exit();
		// $data['success'] = false;
		$data = 'data inserted';
		echo json_encode($data);

		
	}
	else{
		$data = 'error';
		echo json_encode($data);


		// header('Location: ../branch_list.php?added=unsuccessful');
			}
		}
	  
	}
	
	// exit();

	
	

	// echo $email;
	// $edit_id=mysqli_real_escape_string($conn,$_POST['edit_id']);
	
}



?>