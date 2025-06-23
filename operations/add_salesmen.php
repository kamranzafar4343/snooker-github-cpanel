<?php

include "../includes/config.php";
include "../includes/session.php";



	$edit_id=mysqli_real_escape_string($conn,$_POST['edit_id']);
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$username=mysqli_real_escape_string($conn,$_POST['username']);

	$mobile_no1=mysqli_real_escape_string($conn,$_POST['mobile_no1']);
	$mobile_no2=mysqli_real_escape_string($conn,$_POST['mobile_no2']);
	$address_permanent=mysqli_real_escape_string($conn,$_POST['address_permanent']);
	$address_current=mysqli_real_escape_string($conn,$_POST['address_current']);
	
	$salemen_cnic=mysqli_real_escape_string($conn,$_POST['salemen_cnic']);
	$salemen_fathername=mysqli_real_escape_string($conn,$_POST['salemen_fathername']);
	$gender=mysqli_real_escape_string($conn,$_POST['gender']);
	$salemen_residential=mysqli_real_escape_string($conn,$_POST['salemen_residential']);
	//$designation=mysqli_real_escape_string($conn,$_POST['designation']);
	$salary=mysqli_real_escape_string($conn,$_POST['salary']);
	$date=date('Y-m-d');

	$designation = implode(",", $_POST['designation']);

	
if($edit_id != '')	
{

	$rand=rand();
	$image = strtolower(pathinfo($_FILES["user_profile"]["name"], PATHINFO_EXTENSION));

	/* File upload begins here */
	$target_file = "../uploads/salesmen/".$rand.time().".".$image;
	$targetimage = "uploads/salesmen/".$rand.time().".".$image;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($image!='')
{
	$check = getimagesize($_FILES["user_profile"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
     header('Location: ../salesmen_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../salesmen_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["user_profile"]["size"] > 1500000) {
   header('Location: ../salesmen_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../salesmen_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../salesmen_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {
	if(move_uploaded_file($_FILES["user_profile"]["tmp_name"], $target_file)) {


		$sql=mysqli_query($conn, "UPDATE tbl_salesmen set username='$username',email='$email', designation='$designation',salary='$salary', mobile_no1='$mobile_no1',mobile_no2='$mobile_no2',address_permanent='$address_permanent',address_current='$address_current', salemen_cnic='$salemen_cnic',salemen_fathername='$salemen_fathername',salemen_residential='$salemen_residential',gender='$gender',created_by='$userid', created_date='$date',user_profile='$targetimage' where s_id='$edit_id'");

	if($sql){
		
			header('Location: ../salesmen_list.php?update=successful');
		
		
	}
	else{
		header('Location: ../salesmen_list.php?update=unsuccessful');
	}
}
	
	
}
}
else{
	
	$sql=mysqli_query($conn, "UPDATE tbl_salesmen set username='$username',email='$email', designation='$designation',salary='$salary', mobile_no1='$mobile_no1',mobile_no2='$mobile_no2',address_permanent='$address_permanent',address_current='$address_current', salemen_cnic='$salemen_cnic',salemen_fathername='$salemen_fathername',salemen_residential='$salemen_residential',gender='$gender',created_by='$userid', created_date='$date' where s_id='$edit_id'");

	if($sql){
		
			header('Location: ../salesmen_list.php?update=successful');
		
	}
	else{
		header('Location: ../salesmen_list.php?update=unsuccessful');
	}
}
}
else
{

$lsql=mysqli_query($conn, "SELECT salemen_cnic FROM tbl_salesmen  WHERE salemen_cnic='$salemen_cnic'");
	if(mysqli_num_rows($lsql)>0){ 

		
			header('Location: ../add_salemen.php?record=exist');
			exit;
		
		
	}
	
	$rand=rand();
	$image = strtolower(pathinfo($_FILES["user_profile"]["name"], PATHINFO_EXTENSION));

	/* File upload begins here */
	$target_file = "../uploads/salesmen/".$rand.time().".".$image;
	$targetimage = "uploads/salesmen/".$rand.time().".".$image;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($image!='')
{
	$check = getimagesize($_FILES["user_profile"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
     header('Location: ../salesmen_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../salesmen_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["user_profile"]["size"] > 1500000) {
   header('Location: ../salesmen_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../salesmen_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../salesmen_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {
	if(move_uploaded_file($_FILES["user_profile"]["tmp_name"], $target_file)) {

		$sql=mysqli_query($conn, "INSERT INTO tbl_salesmen(email, username , designation, salary, mobile_no1, mobile_no2, address_permanent, address_current, salemen_cnic, salemen_residential, salemen_fathername, gender, created_by, created_date,user_profile) VALUES('$email', '$username', '$designation','$salary', '$mobile_no1','$mobile_no2', '$address_permanent','$address_current', '$salemen_cnic', '$salemen_residential','$salemen_fathername','$gender', '$userid','$date','$targetimage')");

	if($sql){
		
			header('Location: ../salesmen_list.php?update=successful');
		
		
	}
	else{
		header('Location: ../salesmen_list.php?update=unsuccessful');
	}
}
	
	
}
}
else{

	$sql=mysqli_query($conn, "INSERT INTO tbl_salesmen(email, username, designation, salary, mobile_no1, mobile_no2, address_permanent, address_current, salemen_cnic, salemen_residential, salemen_fathername, gender, created_by, created_date) VALUES('$email', '$username', '$designation', '$salary', '$mobile_no1','$mobile_no2', '$address_permanent','$address_current', '$salemen_cnic', '$salemen_residential','$salemen_fathername','$gender', '$userid','$date')");

	if($sql){
		
			header('Location: ../salesmen_list.php?update=successful');
		
	}
	else{
		header('Location: ../salesmen_list.php?update=unsuccessful');
	}
}

}


?>