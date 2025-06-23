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
		
		$sql=mysqli_query($conn, "UPDATE users set user_name='$user_name', user_country='$user_country', user_state='$user_state',user_city='$user_city',user_address='$user_address',user_phone='$user_phone',user_birthday='$user_birthday',user_gender='$user_gender'user_profile='$targetimage' where user_id='$userid'");
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
	$sql=mysqli_query($conn, "UPDATE users set user_name='$user_name', user_country='$user_country', user_state='$user_state',user_city='$user_city',user_address='$user_address',user_phone='$user_phone',user_birthday='$user_birthday',user_gender='$user_gender' where user_id='$userid'");
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
	$c_read=mysqli_real_escape_string($conn, $_POST['c_read']);
	$c_write=mysqli_real_escape_string($conn, $_POST['c_write']);
	$c_delete=mysqli_real_escape_string($conn, $_POST['c_delete']);

	$s_read=mysqli_real_escape_string($conn, $_POST['s_read']);
	$s_write=mysqli_real_escape_string($conn, $_POST['s_write']);
	$s_delete=mysqli_real_escape_string($conn, $_POST['s_delete']);

	$a_read=mysqli_real_escape_string($conn, $_POST['a_read']);
	$a_write=mysqli_real_escape_string($conn, $_POST['a_write']);
	$a_delete=mysqli_real_escape_string($conn, $_POST['a_delete']);


	$user_id=mysqli_real_escape_string($conn, $_POST['user_id']);
if($user_id!='')
{
	$userid=$user_id;
}
	$user_password=password_hash($user_password, PASSWORD_DEFAULT);
	$sql=mysqli_query($conn, "UPDATE users set c_read='$c_read', c_write='$c_write', c_delete='$c_delete', s_read='$s_read', s_write='$s_write', s_delete='$s_delete', a_read='$a_read', a_write='$a_write', a_delete='$a_delete', permission='1' where user_id='$userid'");
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


	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$username=mysqli_real_escape_string($conn,$_POST['username']);

	$mobile_no=mysqli_real_escape_string($conn,$_POST['mobile_no']);
	$address=mysqli_real_escape_string($conn,$_POST['address']);
	$edit_id=mysqli_real_escape_string($conn,$_POST['edit_id']);

	
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
		
		$sql=mysqli_query($conn, "UPDATE tbl_customer set username='$username',email='$email,mobile_no='$mobile_no',address='$address', user_profile='$targetimage' where c_id='$edit_id'");
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
	$sql=mysqli_query($conn, "UPDATE tbl_customer set username='$username',email='$email',mobile_no='$mobile_no',address='$address' where c_id='$edit_id'");
	if($sql){
		
			header('Location: ../client_list.php?update=successful');
		
	}
	else{
		header('Location: ../client_list.php?update=unsuccessful');
	}
}
}
else{
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
		
		$sql=mysqli_query($conn, "INSERT INTO tbl_customer( email,username,mobile_no,user_profile,address) VALUES('$email', '$username','$mobile_no', '$targetimage', '$address')");
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
	$sql=mysqli_query($conn, "INSERT INTO tbl_customer( email, username,mobile_no, address) VALUES( '$email', '$username' ,'$mobile_no', '$address')");
	if($sql){
		
			header('Location: ../client_list.php?update=successful');
		
	}
	else{
		header('Location: ../client_list.php?update=unsuccessful');
	}
}

}
}

///////////////////
if(isset($_POST['addvendors'])){


	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$username=mysqli_real_escape_string($conn,$_POST['username']);

	$mobile_no=mysqli_real_escape_string($conn,$_POST['mobile_no']);
	$c_address=mysqli_real_escape_string($conn,$_POST['c_address']);
	$edit_id=mysqli_real_escape_string($conn,$_POST['edit_id']);

	
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

		
		$sql=mysqli_query($conn, "UPDATE tbl_vendors set username='$username',email='$email',mobile_no='$mobile_no',address='$address', user_profile='$targetimage' where v_id='$edit_id'");
	if($sql){
		
			header('Location: ../vendor_list.php?update=successful');
		
		
	}
	else{
		header('Location: ../vendor_list.php?update=unsuccessful');
	}
}
	
	
}
}
else{
	$sql=mysqli_query($conn, "UPDATE tbl_vendors set username='$username',email='$email',mobile_no='$mobile_no',address='$address' where v_id='$edit_id'");
	if($sql){
		
			header('Location: ../vendor_list.php?update=successful');
		
	}
	else{
		header('Location: ../vendor_list.php?update=unsuccessful');
	}
}
}
else{
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
		
		$sql=mysqli_query($conn, "INSERT INTO tbl_vendors( email,username,mobile_no,user_profile,address) VALUES('$email', '$username','$mobile_no', '$targetimage', '$address')");
	if($sql){
		
			header('Location: ../vendor_list.php?update=successful');
		
		
	}
	else{
		header('Location: ../vendor_list.php?update=unsuccessful');
	}
}
	
	
}
}
else{
	$sql=mysqli_query($conn, "INSERT INTO tbl_vendors( email, username,mobile_no, address) VALUES( '$email', '$username' ,'$mobile_no', '$address')");
	if($sql){
		
			header('Location: ../vendor_list.php?update=successful');
		
	}
	else{
		header('Location: ../vendor_list.php?update=unsuccessful');
	}
}

}
}
///////////////////ADD COMPANY/////////////////

if(isset($_POST['addsecret'])){
	$secret=mysqli_real_escape_string($conn,$_POST['secret']);
	$comp_id=mysqli_real_escape_string($conn,$_POST['comp_id']);
	$sql=mysqli_query($conn, "UPDATE tbl_company set secret='$secret' where comp_id='$comp_id'");
	if($sql){
		
			header("Location: ../setting.php?comp_id=".$comp_id);
		
		
	}
	else{
			header("Location: ../setting.php?comp_id=".$comp_id);
			}
}
if(isset($_POST['addcompany'])){


	$c_name=mysqli_real_escape_string($conn,$_POST['c_name']);
	$c_email=mysqli_real_escape_string($conn,$_POST['c_email']);

	$c_mobile=mysqli_real_escape_string($conn,$_POST['c_mobile']);
	$c_phone=mysqli_real_escape_string($conn,$_POST['c_phone']);
	$c_address=mysqli_real_escape_string($conn,$_POST['c_address']);
	// $edit_id=mysqli_real_escape_string($conn,$_POST['edit_id']);
  	$sale_per=mysqli_real_escape_string($conn, $_POST['sale_per']);
  	$lang=mysqli_real_escape_string($conn, $_POST['lang']);
  	
  	$over_selling=mysqli_real_escape_string($conn, $_POST['over_selling']);
$check=mysqli_query($conn,"select * from tbl_company  ");

		$check_row=mysqli_fetch_assoc($check);
		$comp_id=$check_row['comp_id'];


	
if($comp_id != '')	
{

	$rand=rand();
	$image = strtolower(pathinfo($_FILES["user_profile"]["name"], PATHINFO_EXTENSION));

	/* File upload begins here */
	$target_file = "../uploads/company_img/".$rand.time().".".$image;
	$targetimage = "uploads/company_img/".$rand.time().".".$image;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($image!='')
{
	$check = getimagesize($_FILES["user_profile"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
     header('Location: ../setting.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../setting.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["user_profile"]["size"] > 1500000) {
   header('Location: ../setting.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../setting.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../setting.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {
	if(move_uploaded_file($_FILES["user_profile"]["tmp_name"], $target_file)) {

		$sql=mysqli_query($conn, "UPDATE tbl_company set c_name='$c_name',c_email='$c_email',c_mobile='$c_mobile',c_address='$c_address',c_phone='$c_phone', user_profile='$targetimage',sale_per='$sale_per', lang='$lang', over_selling='$over_selling'   where comp_id='$comp_id'");
	if($sql){
		
			header("Location: ../setting.php?comp_id=".$comp_id);
		
		
	}
	else{
			header("Location: ../setting.php?comp_id=".$comp_id);
			}
}
	
	
}
}
else{

	$sql=mysqli_query($conn, "UPDATE tbl_company set c_name='$c_name',c_email='$c_email',c_mobile='$c_mobile',c_address='$c_address',c_phone='$c_phone',sale_per='$sale_per', lang='$lang',  over_selling='$over_selling'  where comp_id='$comp_id'");
	if($sql){
		
	header("Location: ../setting.php?comp_id=".$comp_id);
		
	}
	else{
header("Location: ../setting.php?comp_id=".$comp_id);
	}
}
}
else{

$rand=rand();
	$image = strtolower(pathinfo($_FILES["user_profile"]["name"], PATHINFO_EXTENSION));

	/* File upload begins here */
	$target_file = "../uploads/company_img/".$rand.time().".".$image;
	$targetimage = "uploads/company_img/".$rand.time().".".$image;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($image!='')
{
	$check = getimagesize($_FILES["user_profile"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
     header('Location: ../setting.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../setting.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["user_profile"]["size"] > 1500000) {
   header('Location: ../setting.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../setting.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../setting.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {


	// $check=mysql_query($conn,"select * from tbl_company where comp_id='$' ");
	if(move_uploaded_file($_FILES["user_profile"]["tmp_name"], $target_file)) {
		
		$sql=mysqli_query($conn, "INSERT INTO tbl_company( c_name,c_email,c_mobile,c_phone,user_profile,c_address,sale_per, lang, over_selling) VALUES('$c_name', '$c_email','$c_mobile','$c_phone', '$targetimage', '$c_address','$sale_per', '$lang', '$over_selling')");
	if($sql){
		
	

			header("Location: ../setting.php?comp_id=".$comp_id);
			
		
		
	}
	else{
	header("Location: ../setting.php?comp_id=".$comp_id);
	}
}
	
	
}
}
else{
	$sql=mysqli_query($conn, "INSERT INTO tbl_company( c_name,c_email,c_mobile,c_phone,c_address,sale_per, lang, over_selling) VALUES('$c_name', '$c_email','$c_mobile','$c_phone','$c_address','$sale_per','$lang' ,'$over_selling')");
	if($sql){
		header("Location: ../setting.php?comp_id=".$comp_id);
		
	}
	else{
	header("Location: ../setting.php?comp_id=".$comp_id);
	}
}

}
}
?>