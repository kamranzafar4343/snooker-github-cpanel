<?php
include "../includes/config.php";
include "../includes/session.php";

if(isset($_POST['update_gen'])){

	$user_name=mysqli_real_escape_string($conn, $_POST['user_name']);
	$user_country=mysqli_real_escape_string($conn, $_POST['user_country']);
	$user_state=mysqli_real_escape_string($conn, $_POST['user_state']);
	$user_city=mysqli_real_escape_string($conn, $_POST['user_city']);
	$user_address=mysqli_real_escape_string($conn, $_POST['user_address']);
	$user_phone=mysqli_real_escape_string($conn, $_POST['user_phone']);
	$user_birthday=mysqli_real_escape_string($conn, $_POST['user_birthday']);
	$user_gender=mysqli_real_escape_string($conn, $_POST['user_gender']);
	$dashboard=mysqli_real_escape_string($conn, $_POST['dashboard']);

	$user_id=mysqli_real_escape_string($conn, $_POST['user_id']);
if($user_id!='')
{
	$userid=$user_id;
}

	
	$rand=rand();
	$image = strtolower(pathinfo($_FILES["user_profile"]["name"], PATHINFO_EXTENSION));

	/* File upload begins here */
	$target_file = "../uploads/Profiles/".$rand.time().".".$image;
	$targetimage = "uploads/Profiles/".$rand.time().".".$image;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($image!='')
{
	$check = getimagesize($_FILES["user_profile"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
     header('Location: ../profile.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../profile.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["user_profile"]["size"] > 1500000) {
   header('Location: ../profile.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../profile.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../profile.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {
	if(move_uploaded_file($_FILES["user_profile"]["tmp_name"], $target_file)) {
		
		$sql=mysqli_query($conn, "UPDATE users set user_name='$user_name', user_country='$user_country', user_state='$user_state',user_city='$user_city',user_address='$user_address', dashboard='$dashboard', user_phone='$user_phone',user_birthday='$user_birthday',user_gender='$user_gender', user_profile='$targetimage' where user_id='$userid'");
	if($sql){
		if($user_id!='')
		{
			header('Location: ../users.php?update=successful');
		}
		else{
			header('Location: ../profile.php?update=successful');
		}
		
	}
	else{
		header('Location: ../profile.php?update=unsuccessful');
	}
}
	
	
}
}
else{

	$sql=mysqli_query($conn, "UPDATE users set user_name='$user_name', user_country='$user_country', user_state='$user_state',user_city='$user_city',user_address='$user_address', dashboard='$dashboard', user_phone='$user_phone',user_birthday='$user_birthday',user_gender='$user_gender' where user_id='$userid'");
	if($sql){
		if($user_id!='')
		{
			header('Location: ../users.php?update=successful');
		}
		else{
			header('Location: ../profile.php?update=successful');
		}
		
	}
	else{
		header('Location: ../profile.php?update=unsuccessful');
	}
}
}

if(isset($_POST['update_acc'])){

	
	$user_email=mysqli_real_escape_string($conn, $_POST['user_email']);
	$user_password=mysqli_real_escape_string($conn, $_POST['user_password']);
	
	$user_id=mysqli_real_escape_string($conn, $_POST['user_id']);
if($user_id!='')
{
	$userid=$user_id;
}
	$user_password=password_hash($user_password, PASSWORD_DEFAULT);
	$sql=mysqli_query($conn, "UPDATE users set user_email='$user_email', user_password='$user_password' where user_id='$userid'");
	if($sql){
		if($user_id!='')
		{
			header('Location: ../users.php?update=successful');
		}
		else{
			header('Location: ../profile.php?update=successful');
		}
		
	}
	else{
		header('Location: ../profile.php?update=unsuccessful');
	}
	
}

if(isset($_POST['permission'])){

	error_reporting(0);
	
	$user_id=mysqli_real_escape_string($conn, $_POST['user_id']);
if($user_id!='')
{
	$userid=$user_id;
}
$sql=mysqli_query($conn,"DELETE FROM tbl_permission WHERE user_id='$user_id'");



	for ($a = 0; $a < count($_POST["page_id"]); $a++)
        {
        	$page_id=$_POST["page_id"][$a];
        	$parent_page_id=$_POST["parent_page_id"][$a];
        	$w=$_POST["W"][$page_id];
        	if($w=='')
        	{
        		$w=0;
        	}
        	$r=$_POST["R"][$page_id];
        	if($r=='')
        	{
        		$r=0;
        	}
        	$d=$_POST["D"][$page_id];
        	if($d=='')
        	{
        		$d=0;
        	}
        	$p=$_POST["P"][$page_id];
        	if($p=='')
        	{
        		$p=0;
        	}
        	$u=$_POST["U"][$page_id];
        	if($u=='')
        	{
        		$u=0;
        	}
        	
            $sql = "INSERT into tbl_permission(user_id, parent_page_id, page_id, W, R, D, P, U) VALUES ('$user_id', '$parent_page_id', '$page_id', '$w', '$r', '$d', '$p', '$u')";

            mysqli_query($conn, $sql);
        }
    
	if($sql){
		if($user_id!='')
		{
			header('Location: ../users.php?update=successful');
		}
		else{
			header('Location: ../profile.php?update=successful');
		}
		
	}
	else{
		header('Location: ../profile.php?update=unsuccessful');
	}
	
}



if(isset($_POST['addclients'])){

	$edit_id=mysqli_real_escape_string($conn,$_POST['edit_id']);
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$username=mysqli_real_escape_string($conn,$_POST['username']);

	$mobile_no1=mysqli_real_escape_string($conn,$_POST['mobile_no1']);
	$mobile_no2=mysqli_real_escape_string($conn,$_POST['mobile_no2']);
	$address_permanent=mysqli_real_escape_string($conn,$_POST['address_permanent']);
	$address_current=mysqli_real_escape_string($conn,$_POST['address_current']);

	
	$client_occupation=mysqli_real_escape_string($conn,$_POST['client_occupation']);
	
	$client_residential=mysqli_real_escape_string($conn,$_POST['client_residential']);
	$client_fathername=mysqli_real_escape_string($conn,$_POST['client_fathername']);
	$gender=mysqli_real_escape_string($conn,$_POST['gender']);
	$client_cnic=mysqli_real_escape_string($conn,$_POST['client_cnic']);
	$date=date('Y-m-d');


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
		echo 
		$sql=mysqli_query($conn, "UPDATE tbl_customer set username='$username',email='$email',mobile_no1='$mobile_no1',mobile_no2='$mobile_no2',address_permanent='$address_permanent',address_current='$address_current', client_occupation='$client_occupation',client_residential='$client_residential',client_fathername='$client_fathername',gender='$gender',client_cnic='$client_cnic', created_by='$userid', created_date='$date',user_profile='$targetimage' where c_id='$edit_id'");
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
	
	$sql=mysqli_query($conn, "UPDATE tbl_customer set username='$username',email='$email',mobile_no1='$mobile_no1',mobile_no2='$mobile_no2',address_permanent='$address_permanent',address_current='$address_current', client_occupation='$client_occupation',client_residential='$client_residential',client_fathername='$client_fathername',gender='$gender',client_cnic='$client_cnic',created_by='$userid', created_date='$date' where c_id='$edit_id'");
	if($sql){
		
			header('Location: ../client_list.php?update=successful');
		
	}
	else{
		header('Location: ../client_list.php?update=unsuccessful');
	}
}
}
else{
	$lsql=mysqli_query($conn, "SELECT email FROM tbl_customer  WHERE email='$email'");
	if(mysqli_num_rows($lsql)>0){ 

		
			header('Location: ../add_clients.php?record=exist');
			exit;
		
		
	}
	$query = "SELECT customer_id FROM `tbl_customer` order by c_id DESC LIMIT 1";

	$result = mysqli_query($conn,$query);
	while($row = mysqli_fetch_array($result) ){
      $customer_id = $row['customer_id'];
      ++$customer_id;
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
		
		$sql=mysqli_query($conn, "INSERT INTO tbl_customer(customer_id, email,username,mobile_no1, mobile_no2, address_permanent, address_current, client_occupation, client_residential, client_fathername, gender, client_cnic, created_by, created_date,user_profile) VALUES('$customer_id','$email', '$username','$mobile_no1','$mobile_no2', '$address_permanent','$address_current','$client_occupation', '$client_residential', '$client_fathername','$gender','$client_cnic', '$userid','$date','$targetimage')");
	if($sql){
		
			header('Location: ../client_list.php?add=successful');
		
		
	}
	else{
		header('Location: ../client_list.php?add=unsuccessful');
	}
}
	
	
}
}
else{
	$sql=mysqli_query($conn, "INSERT INTO tbl_customer(customer_id, email,username,mobile_no1, mobile_no2, address_permanent, address_current, client_occupation, client_residential, client_fathername, gender, client_cnic, created_by, created_date) VALUES('$customer_id', '$email', '$username','$mobile_no1','$mobile_no2', '$address_permanent','$address_current','$client_occupation', '$client_residential', '$client_fathername','$gender','$client_cnic' ,'$userid','$date')");
	if($sql){
		
			header('Location: ../client_list.php?update=successful');
		
	}
	else{
		header('Location: ../client_list.php?update=unsuccessful');
	}
}

}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if(isset($_POST['addvendors'])){


	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$username=mysqli_real_escape_string($conn,$_POST['username']);

	$mobile_no=mysqli_real_escape_string($conn,$_POST['mobile_no']);
	$address=mysqli_real_escape_string($conn,$_POST['address']);
	$edit_id=mysqli_real_escape_string($conn,$_POST['edit_id']);
	$add_from=mysqli_real_escape_string($conn,$_POST['add_from']);
	$created_date =	date('Y-m-d');
	$created_by = $userid;
	
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
     header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["user_profile"]["size"] > 1500000) {
   header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {
	if(move_uploaded_file($_FILES["user_profile"]["tmp_name"], $target_file)) {
		
		$sql=mysqli_query($conn, "UPDATE tbl_vendors set username='$username',email='$email',mobile_no='$mobile_no',address='$address', user_profile='$targetimage' where vendor_id='$edit_id'");
		$sql=mysqli_query($conn, "UPDATE tbl_account_lv2 set aname='$username' where acode='$edit_id'");
	if($sql){
		
			header('Location: ../add_vendors.php?update=successful');
		
		
	}
	else{
		header('Location: ../add_vendors.php?update=unsuccessful');
	}
}
	
	
}
}
else{
	$sql=mysqli_query($conn, "UPDATE tbl_vendors set username='$username',email='$email',mobile_no='$mobile_no',address='$address' where v_id='$edit_id'");
	$sql=mysqli_query($conn, "UPDATE tbl_account_lv2 set aname='$username' where acode='$edit_id'");
	if($sql){
		
			header('Location: ../add_vendors.php?update=successful');
		
	}
	else{
		header('Location: ../add_vendors.php?update=unsuccessful');
	}
}
}
else{
	$acc_payable='200200';
	$date=date('Y-m-d');
	
	$query = "SELECT vendor_id FROM `tbl_vendors` order by v_id DESC LIMIT 1";
	$result = mysqli_query($conn,$query);
	while($row = mysqli_fetch_array($result) ){
		      $vendor = $row['vendor_id'];
		      ++$vendor;

		      }
	if(mysqli_num_rows($result)>0)
	{
			$vendor_id=$vendor;
		
		  
	}
	else
	{
		
		$vendor_id=$acc_payable.'101' ;
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
     header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["user_profile"]["size"] > 1500000) {
   header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../client_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {
	if(move_uploaded_file($_FILES["user_profile"]["tmp_name"], $target_file)) {
		
		$sql=mysqli_query($conn, "INSERT INTO tbl_vendors( vendor_id,email,username,mobile_no,user_profile,address, created_date, created_by) VALUES('$vendor_id', '$email', '$username','$mobile_no', '$targetimage', '$address', '$created_date', '$created_by')");
		$sql=mysqli_query($conn, "INSERT INTO tbl_account_lv2( parent_code,sub_child1,acode,aname,created_date,created_by) VALUES('200000000', '200200000', '$vendor_id','$username', '$date', '$userid')");

	if($sql){

		if($add_from=='0')
			{
				header('Location: ../add_vendors.php?update=successfull');
			}
			else if($add_from=='1')
			{
				header('Location: ../add_purchase_po.php?add=successfull');
			}
			else if($add_from=='2')
			{
				header('Location: ../purchase_po.php?add=successfull');
			}
			else if($add_from=='3')
			{
				header('Location: ../add_single_purchase_po.php?add=successfull');
			}
			else if($add_from=='4')
			{
				header('Location: ../single_purchase_po.php?add=successfull');
			}
	}
	else{
		header('Location: ../add_vendors.php?update=unsuccessful');
	}
}
	
	
}
}
else{
	$sql=mysqli_query($conn, "INSERT INTO tbl_vendors(vendor_id, email, username,mobile_no, address, created_date, created_by) VALUES('$vendor_id', '$email', '$username' ,'$mobile_no', '$address', '$created_date', '$created_by')");
	$sql=mysqli_query($conn, "INSERT INTO tbl_account_lv2( parent_code,sub_child1,acode,aname,created_date,created_by) VALUES('200000000', '200200000', '$vendor_id','$username', '$date', '$userid')");
	if($sql){
		if($add_from=='0')
			{
				header('Location: ../add_vendors.php?update=successfull');
			}
			else if($add_from=='1')
			{
				header('Location: ../add_purchase_po.php?add=successfull');
			}
			else if($add_from=='2')
			{
				header('Location: ../purchase_po.php?add=successfull');
			}
			else if($add_from=='3')
			{
				header('Location: ../add_single_purchase_po.php?add=successfull');
			}
			else if($add_from=='4')
			{
				header('Location: ../single_purchase_po.php?add=successfull');
			}
		
		
	}
	else{
		header('Location: ../add_vendors.php?update=unsuccessful');
	}
}

}
}

if(isset($_POST['add_vendors'])){

	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$username=mysqli_real_escape_string($conn,$_POST['username']);

	$mobile_no=mysqli_real_escape_string($conn,$_POST['mobile_no']);
	$address=mysqli_real_escape_string($conn,$_POST['address']);
	$edit_id=mysqli_real_escape_string($conn,$_POST['edit_id']);

	$acc_payable='200200';
	$date=date('Y-m-d');
	
	$query = "SELECT vendor_id FROM `tbl_vendors` order by v_id DESC LIMIT 1";
	$result = mysqli_query($conn,$query);
	while($row = mysqli_fetch_array($result) ){
		      $vendor = $row['vendor_id'];
		      ++$vendor;

		      }
	if(mysqli_num_rows($result)>0)
	{
			$vendor_id=$vendor;
		
		  
	}
	else
	{
		
		$vendor_id=$acc_payable.'101' ;
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
     header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["user_profile"]["size"] > 1500000) {
   header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../vendor_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {
	if(move_uploaded_file($_FILES["user_profile"]["tmp_name"], $target_file)) {
		
		$sql=mysqli_query($conn, "INSERT INTO tbl_vendors( vendor_id,email,username,mobile_no,user_profile,address, created_date, created_by) VALUES('$vendor_id', '$email', '$username','$mobile_no', '$targetimage', '$address', '$created_date', '$created_by')");
		$sql=mysqli_query($conn, "INSERT INTO tbl_account_lv2( parent_code,sub_child1,acode,aname,created_date,created_by) VALUES('200000000', '200200000', '$vendor_id','$username', '$date', '$userid')");
	if($sql){
		
			header('Location: ../add_vendors.php?update=successful');
		
		
	}
	else{
		header('Location: ../add_vendors.php?update=unsuccessful');
	}
}
	
	
}
}
else{
	$sql=mysqli_query($conn, "INSERT INTO tbl_vendors(vendor_id, email, username,mobile_no, address, created_date, created_by) VALUES('$vendor_id', '$email', '$username' ,'$mobile_no', '$address', '$created_date', '$created_by')");
	$sql=mysqli_query($conn, "INSERT INTO tbl_account_lv2( parent_code,sub_child1,acode,aname,created_date,created_by) VALUES('200000000', '200200000', '$vendor_id','$username', '$date', '$userid')");
	if($sql){
		
			header('Location: ../add_vendors.php?update=successful');
		
	}
	else{
		header('Location: ../add_vendors.php?update=unsuccessful');
	}
}

}



?>