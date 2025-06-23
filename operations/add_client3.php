<?php
include "../includes/config.php";
include "../includes/session.php";
if(isset($_POST['addclients'])){

	$sale_from=mysqli_real_escape_string($conn,$_POST['sale_from']);
	$edit_id=mysqli_real_escape_string($conn,$_POST['edit_id']);
	
	$username=mysqli_real_escape_string($conn,$_POST['username']);

	// Check if the username already exists in the database
	$checkDuplicate = mysqli_query($conn, "SELECT username FROM tbl_customer WHERE username='$username'");

	if (mysqli_num_rows($checkDuplicate) > 0) {
		// Show alert and stop further processing
		echo "<script>alert('The username already exists. Please choose a different one.'); window.history.back();</script>";
		exit;
	}

	$mobile_no1=mysqli_real_escape_string($conn,$_POST['mobile_no1']);
	$mobile_no2=mysqli_real_escape_string($conn,$_POST['mobile_no2']);
	$address_permanent=mysqli_real_escape_string($conn,$_POST['address_permanent']);
	$address_current=mysqli_real_escape_string($conn,$_POST['address_current']);
	$address_office=mysqli_real_escape_string($conn,$_POST['address_office']);
	
	$client_occupation=mysqli_real_escape_string($conn,$_POST['client_occupation']);
	
	$client_residential=mysqli_real_escape_string($conn,$_POST['client_residential']);
	$client_fathername=mysqli_real_escape_string($conn,$_POST['client_fathername']);
	$gender=mysqli_real_escape_string($conn,$_POST['gender']);
	$client_cnic=mysqli_real_escape_string($conn,$_POST['client_cnic']);
	$client_salary=mysqli_real_escape_string($conn,$_POST['client_salary']);
	$zone=mysqli_real_escape_string($conn,$_POST['zone']);
	$sub_zone=mysqli_real_escape_string($conn,$_POST['sub_zone']);
	$customer_type=mysqli_real_escape_string($conn,$_POST['customer_type']);
	$fixed_discount=mysqli_real_escape_string($conn,$_POST['fixed_discount']);
	$date=date('Y-m-d');
	$sql=mysqli_query($conn, "SELECT branch_id, created_by  FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $branch_id=$data['branch_id'];
                                $created_by=$data['created_by'];
                                if($branch_id=='')
                                {
                                  $parent_id=$created_by;
                                }
                                else
                                {
                                  $parent_id=$userid;
                                }

	
if($edit_id != '')	
{

	$rand=rand();
	$image = strtolower(pathinfo($_FILES["user_profile"]["name"], PATHINFO_EXTENSION));

	/* File upload begins here */
	$target_file = "../uploads/userprofiles/".$rand.time().".".$image;
	$targetimage = "uploads/userprofiles/".$rand.time().".".$image;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($image!='')
{
	$check = getimagesize($_FILES["user_profile"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
     header('Location: ../client_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../client_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["user_profile"]["size"] > 1500000) {
   header('Location: ../client_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../client_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../client_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {
	if(move_uploaded_file($_FILES["user_profile"]["tmp_name"], $target_file)) {


		$sql=mysqli_query($conn, "UPDATE tbl_customer set username='$username',mobile_no1='$mobile_no1',mobile_no2='$mobile_no2',address_permanent='$address_permanent',address_current='$address_current', address_office='$address_office', client_occupation='$client_occupation', client_salary='$client_salary',client_residential='$client_residential',client_fathername='$client_fathername',gender='$gender',client_cnic='$client_cnic',zone='$zone', sub_zone='$sub_zone', customer_type='$customer_type',fixed_discount='$fixed_discount', created_by='$userid',parent_id='$parent_id', created_date='$date',user_profile='$targetimage' where customer_id='$edit_id'");

		$sql=mysqli_query($conn, "UPDATE tbl_account_lv2 set aname='$username' where acode='$edit_id'");
	if($sql){
		
			header('Location: ../client_list.php?update=successful');
		
		
	}
	else{
		header('Location: ../client_list.php?update=unsuccessful');
	}
}
	
	
}
}
else{

	$sql=mysqli_query($conn, "UPDATE tbl_customer set username='$username',mobile_no1='$mobile_no1',mobile_no2='$mobile_no2',address_permanent='$address_permanent',address_current='$address_current', address_office='$address_office', client_occupation='$client_occupation', client_salary='$client_salary', client_residential='$client_residential',client_fathername='$client_fathername',gender='$gender',client_cnic='$client_cnic',created_by='$userid', zone='$zone', sub_zone='$sub_zone', customer_type='$customer_type',fixed_discount='$fixed_discount', parent_id='$parent_id', created_date='$date' where customer_id='$edit_id'");
	$sql=mysqli_query($conn, "UPDATE tbl_account_lv2 set aname='$username' where acode='$edit_id'");

	if($sql){
		
			header('Location: ../client_list.php?update=successful');
		
	}
	else{
		header('Location: ../client_list.php?update=unsuccessful');
	}
}
}
else
{

$lsql=mysqli_query($conn, "SELECT client_cnic FROM tbl_customer  WHERE client_cnic='$client_cnic'");
	// if(mysqli_num_rows($lsql)>0){ 
	// 		header('Location: ../client_list.php?record=exist');
	// 		exit;
	// }
	$acc_rec='100200';
	$date=date('Y-m-d');
	
	$query = "SELECT customer_id, seprate_customer_id FROM `tbl_customer` order by c_id DESC LIMIT 1";
	$result = mysqli_query($conn,$query);
	while($row = mysqli_fetch_array($result) ){
		      $customer = $row['customer_id'];
		      $seprate_id = $row['seprate_customer_id'];
		      ++$seprate_id;
		      ++$customer;

		      }
	if(mysqli_num_rows($result)>0)
	{
			$customer_id=$customer;
			$seprate_customer_id=$seprate_id;
		  
	}
	else
	{
		
		$customer_id=$acc_rec.'101' ;
		$seprate_customer_id='6000';
	}

$rand=rand();
	$image = strtolower(pathinfo($_FILES["user_profile"]["name"], PATHINFO_EXTENSION));

	/* File upload begins here */
	$target_file = "../uploads/userprofiles/".$rand.time().".".$image;
	$targetimage = "uploads/userprofiles/".$rand.time().".".$image;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($image!='')
{
	$check = getimagesize($_FILES["user_profile"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
     header('Location: ../client_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../client_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["user_profile"]["size"] > 1500000) {
   header('Location: ../client_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../client_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../client_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {
	if(move_uploaded_file($_FILES["user_profile"]["tmp_name"], $target_file)) {
	
		$sql=mysqli_query($conn, "INSERT INTO tbl_customer(customer_id,seprate_customer_id, username,mobile_no1, mobile_no2, address_permanent, address_current, address_office, client_occupation, client_salary, client_residential, client_fathername, gender, client_cnic, zone, sub_zone, customer_type, fixed_discount, created_by, parent_id, created_date,user_profile) VALUES('$customer_id', '$seprate_customer_id', '$username','$mobile_no1','$mobile_no2', '$address_permanent','$address_current', '$address_office','$client_occupation','$client_salary',  '$client_residential', '$client_fathername','$gender','$client_cnic', '$zone', '$sub_zone', '$customer_type','$fixed_discount', '$userid','$parent_id','$date','$targetimage')");

		$sql=mysqli_query($conn, "INSERT INTO tbl_account_lv2( parent_code,sub_child1,acode,aname,created_date,created_by) VALUES('100000000', '100200000', '$customer_id','$username', '$date', '$parent_id')");
	if($sql){
			
			if($sale_from=='0')
			{
				header('Location: ../client_list.php?add=successfull');
			}
			else if($sale_from=='1')
			{
				header('Location: ../installment.php?add=successfull');
			}
			else if($sale_from=='2')
			{
				header('Location: ../installment_iemi.php?add=successfull');
			}
			else if($sale_from=='3')
			{
				header('Location: ../local_installment.php?add=successfull');
			}
			else if($sale_from=='4')
			{
				header('Location: ../local_installment_iemi.php?add=successfull');
			}
			else if($sale_from=='5')
			{
				header('Location: ../add_sale.php?add=successfull');
			}
			else if($sale_from=='6')
			{
				header('Location: ../add_sale_iemi.php?add=successfull');
			}
			else if($sale_from=='7')
			{
				header('Location: ../add_local_sale.php?add=successfull');
			}
			else if($sale_from=='8')
			{
				header('Location: ../add_local_sale_iemi.php?add=successfull');
			}
	}
	else{
		header('Location: ../client_list.php?add=unsuccessful');
	}
}
	
	
}
}
else{
	$sql=mysqli_query($conn, "INSERT INTO tbl_customer(customer_id, seprate_customer_id,  username,mobile_no1, mobile_no2, address_permanent, address_current, address_office, client_occupation, client_salary, client_residential, client_fathername, gender, client_cnic, zone, sub_zone, customer_type, fixed_discount, created_by, parent_id,  created_date) VALUES('$customer_id', '$seprate_customer_id', '$username','$mobile_no1','$mobile_no2', '$address_permanent','$address_current', '$address_office','$client_occupation','$client_salary', '$client_residential', '$client_fathername','$gender','$client_cnic' ,  '$zone', '$sub_zone', '$customer_type', '$fixed_discount',  '$userid','$parent_id','$date')");

	$sql=mysqli_query($conn, "INSERT INTO tbl_account_lv2( parent_code,sub_child1,acode,aname,created_date,created_by) VALUES('100000000', '100200000', '$customer_id','$username', '$date', '$parent_id')");
	if($sql){
		
			if($sale_from=='0')
			{
				header('Location: ../client_list.php?add=successfull');
			}
			else if($sale_from=='1')
			{
				header('Location: ../installment.php?add=successfull');
			}
			else if($sale_from=='2')
			{
				header('Location: ../installment_iemi.php?add=successfull');
			}
			else if($sale_from=='3')
			{
				header('Location: ../local_installment.php?add=successfull');
			}
			else if($sale_from=='4')
			{
				header('Location: ../local_installment_iemi.php?add=successfull');
			}
			else if($sale_from=='5')
			{
				header('Location: ../add_sale.php?add=successfull');
			}
			else if($sale_from=='6')
			{
				header('Location: ../add_sale_iemi.php?add=successfull');
			}
			else if($sale_from=='7')
			{
				header('Location: ../add_local_sale.php?add=successfull');
			}
			else if($sale_from=='8')
			{
				header('Location: ../add_local_sale_iemi.php?add=successfull');
			}
		
	}
	else{
		header('Location: ../client_list.php?add=unsuccessful');
	}
}

}
}
if(isset($_POST['addclientspos'])){

	$username=mysqli_real_escape_string($conn,$_POST['username']);
	$mobile_no1=mysqli_real_escape_string($conn,$_POST['mobile_no1']);
	$address_permanent=mysqli_real_escape_string($conn,$_POST['address_permanent']);
	$address_current=mysqli_real_escape_string($conn,$_POST['address_current']);
	$client_cnic=mysqli_real_escape_string($conn,$_POST['client_cnic']);
	$client_fathername=mysqli_real_escape_string($conn,$_POST['client_fathername']);
	$date=date('Y-m-d');
	$sql=mysqli_query($conn, "SELECT branch_id, created_by  FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $branch_id=$data['branch_id'];
                                $created_by=$data['created_by'];
                                if($branch_id=='')
                                {
                                  $parent_id=$created_by;
                                }
                                else
                                {
                                  $parent_id=$userid;
                                }
    $lsql=mysqli_query($conn, "SELECT client_cnic FROM tbl_customer  WHERE client_cnic='$client_cnic'");
	// if(mysqli_num_rows($lsql)>0){ 

		
	// 		header('Location: ../pos.php?record=exist');
	// 		exit;
		
		
	// }
	$acc_rec='100200';
	$date=date('Y-m-d');
	
	$query = "SELECT customer_id, seprate_customer_id FROM `tbl_customer` order by c_id DESC LIMIT 1";
	$result = mysqli_query($conn,$query);
	while($row = mysqli_fetch_array($result) ){
		      $customer = $row['customer_id'];
		      $seprate_id = $row['seprate_customer_id'];
		      ++$seprate_id;
		      ++$customer;

		      }
	if(mysqli_num_rows($result)>0)
	{
			$customer_id=$customer;
			$seprate_customer_id=$seprate_id;
		  
	}
	else
	{
		
		$customer_id=$acc_rec.'101' ;
		$seprate_customer_id='6000';
	}
	$sql=mysqli_query($conn, "INSERT INTO tbl_customer(customer_id, seprate_customer_id,  username, mobile_no1, address_permanent, address_current, client_fathername, client_cnic, created_by, parent_id,  created_date) VALUES('$customer_id', '$seprate_customer_id', '$username', '$mobile_no1', '$address_permanent', '$address_current', '$client_fathername', '$client_cnic' , '$userid','$parent_id','$date')");

	$sql=mysqli_query($conn, "INSERT INTO tbl_account_lv2( parent_code,sub_child1,acode,aname,created_date,created_by) VALUES('100000000', '100200000', '$customer_id','$username', '$date', '$parent_id')");
	if($sql)
	{
		header('Location: ../pos.php?add=successfull&dinein_items=1');
	}
	else
	{
		header('Location: ../pos.php?add=unsuccessful&dinein_items=1');
	}

}
?>