<?php
include "../includes/config.php";
include "../includes/session.php";

if(isset($_POST['signup'])){

	$user_name=mysqli_real_escape_string($conn, $_POST['user_name']);
	$email=mysqli_real_escape_string($conn, $_POST['email']);

	$lsql=mysqli_query($conn, "SELECT * FROM users WHERE user_email='$email'");
	
	if(mysqli_num_rows($lsql)>0){ 

		header('Location: ../add_users.php?exist=true');
		exit();
	}
	$password=mysqli_real_escape_string($conn, $_POST['password']);
	$user_privilege=mysqli_real_escape_string($conn, $_POST['user_privilege']);
	$date=date('Y-m-d');

	$password=password_hash($password, PASSWORD_DEFAULT);
	$sql=mysqli_query($conn, "INSERT INTO users (user_name, user_email, user_password, user_privilege, created_date, created_by) VALUES ('$user_name', '$email', '$password', '$user_privilege', '$date', '$userid')");
	if($sql){
		header('Location: ../add_users.php?registration=successful');
	}
	else{
		echo mysqli_error($conn);
	}
	
}
if(isset($_POST['signup_branch'])){

	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$branchname=mysqli_real_escape_string($conn,$_POST['branchname']);

	$mobile_no=mysqli_real_escape_string($conn,$_POST['mobile_no']);
	$address=mysqli_real_escape_string($conn,$_POST['address']);
	$contact_no=mysqli_real_escape_string($conn,$_POST['contact_no']);
	$owner_name=mysqli_real_escape_string($conn,$_POST['name']);
	$user_password=mysqli_real_escape_string($conn,$_POST['user_password']);
	$confirm_password=mysqli_real_escape_string($conn,$_POST['confirm_password']);

	$lsql=mysqli_query($conn, "SELECT * FROM users WHERE user_email='$email'");
	
	if(mysqli_num_rows($lsql)>0){ 

		header('Location: ../branch_list.php?email=true');
		exit();
	}
	

	

	$password=password_hash($user_password, PASSWORD_DEFAULT);
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

	$sql=mysqli_query($conn, "INSERT INTO users(user_email, branch_id, user_privilege, user_phone, user_address, contact_no, user_name, user_password, created_date, created_by) VALUES ('$email',	'$branch_id',	'branch',	'$mobile_no','	$address',	'$contact_no',	'$branchname','$password', '$date', '$userid')");

	$sql=mysqli_query($conn, "INSERT INTO tbl_account_lv2( parent_code,sub_child1,acode,aname,created_date,created_by) VALUES('100000000', '100100000', '$branch_id', '$branchname', '$date', '$userid')");
	if($sql){
		header('Location: ../branch_list.php?add=successful');
	}
	else{
		echo mysqli_error($conn);
	}
	
}
if(isset($_POST['add_catagory'])){

	$cat_name=mysqli_real_escape_string($conn, $_POST['cat_name']);
	$transfer_perc=mysqli_real_escape_string($conn, $_POST['transfer_perc']);

	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	$date=date('Y-m-d');

if($edit_id != '')	
{
	$rand=rand();
	$image = strtolower(pathinfo($_FILES["cat_image"]["name"], PATHINFO_EXTENSION));

	/* File upload begins here */
	$target_file = "../uploads/catagory/".$rand.time().".".$image;
	$targetimage = "uploads/catagory/".$rand.time().".".$image;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($image!='')
{ 
	$check = getimagesize($_FILES["cat_image"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
     header('Location: ../brand_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../brand_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["cat_image"]["size"] > 1500000) {
   header('Location: ../brand_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../brand_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../brand_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {
	if(move_uploaded_file($_FILES["cat_image"]["tmp_name"], $target_file)) {
		
		$sql=mysqli_query($conn, "UPDATE tbl_catagory set cat_name='$cat_name', transfer_perc='$transfer_perc', cat_image='$targetimage', created_date='$date',created_by='$created_by' where id='$edit_id'");
	if($sql){

			header('Location: ../brand_list.php?update=successful');
		
		
	}
	else{
		header('Location: ../brand_list.php?update=unsuccessful');
	}
}
	
	
}
}
else{
	$sql=mysqli_query($conn,"UPDATE tbl_catagory set cat_name='$cat_name', transfer_perc='$transfer_perc', created_date='$date',created_by='$created_by' where id='$edit_id'");
	if($sql){
	
			header('Location: ../brand_list.php?update=successful');
	
		
	}
	else{
		header('Location: ../brand_list.php?update=unsuccessful');
	}
}
}
else{
	$rand=rand();
	$image = strtolower(pathinfo($_FILES["cat_image"]["name"], PATHINFO_EXTENSION));

	/* File upload begins here */
	$target_file = "../uploads/catagory/".$rand.time().".".$image;
	$targetimage = "uploads/catagory/".$rand.time().".".$image;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($image!='')
{
	$check = getimagesize($_FILES["cat_image"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
     header('Location: ../brand_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../brand_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["cat_image"]["size"] > 1500000) {
   header('Location: ../brand_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../brand_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../brand_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {
	if(move_uploaded_file($_FILES["cat_image"]["tmp_name"], $target_file)) {
	

		$sql=mysqli_query($conn, "INSERT INTO tbl_catagory (cat_name, cat_image, transfer_perc, created_date, created_by) VALUES ('$cat_name', '$transfer_perc', '$targetimage', '$date', '$userid')");
		
	if($sql){

			header('Location: ../brand_list.php?insert=successful');
		
		
	}
	else{
		header('Location: ../brand_list.php?insert=unsuccessful');
	}
}
	
	
}
}
else{

	$sql=mysqli_query($conn, "INSERT INTO tbl_catagory (cat_name, transfer_perc, created_date, created_by) VALUES ('$cat_name', '$transfer_perc', '$date', '$userid')");
	if($sql){
		
	
			header('Location: ../brand_list.php?insert=successful');
	
		
	}
	else{
		header('Location: ../brand_list.php?insert=unsuccessful');
	}
}
}
}

if(isset($_POST['add_period'])){

	$months=mysqli_real_escape_string($conn, $_POST['months']);
	$percentage=mysqli_real_escape_string($conn, $_POST['percentage']);
	$created_date=date('y-m-d');
	$created_by=$userid;

	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	

if($edit_id != '')	
{

	$sql=mysqli_query($conn,"UPDATE tbl_period set months='$months', percentage='$percentage', created_date='$created_date',created_by='$created_by' where id='$edit_id'");
	if($sql){
	
			header('Location: ../period_list.php?update=successful');
	
		
	}
	else{
		header('Location: ../period_list.php?update=unsuccessful');
	}
}


else{

	$sql=mysqli_query($conn, "INSERT INTO tbl_period (months, percentage, created_date, created_by) VALUES ('$months', '$percentage', '$created_date', '$userid')");
	if($sql){
		
	
			header('Location: ../period_list.php?insert=successful');
	
		
	}
	else{
		header('Location: ../period_list.php?insert=unsuccessful');
	}
}

}

if(isset($_POST['assign_avo'])){

	$avo_new=mysqli_real_escape_string($conn, $_POST['avo_new']);
	$avo_old=mysqli_real_escape_string($conn, $_POST['avo_old']);
	for ($a = 0; $a < count($_POST["accounts"]); $a++)
        {
            $accounts=$_POST["accounts"][$a];
            $sql=mysqli_query($conn,"UPDATE tbl_installment set assigned_avo='$avo_new' where plan_id='$accounts'");
         }

	
	if($sql){
	
			header('Location: ../avo_assign.php?update=successful');
	
		
	}
	else{
		header('Location: ../avo_assign.php?update=unsuccessful');
	}





}
if(isset($_POST['unassign_avo'])){

	$avo_assigned=mysqli_real_escape_string($conn, $_POST['avo_assigned']);
	for ($a = 0; $a < count($_POST["accounts_unassign"]); $a++)
        {
            $accounts=$_POST["accounts_unassign"][$a];
            $sql=mysqli_query($conn,"UPDATE tbl_installment set assigned_avo='0' where plan_id='$accounts'");
         }

	
	if($sql){
	
			header('Location: ../avo_assign.php?update=successful');
	
		
	}
	else{
		header('Location: ../avo_assign.php?update=unsuccessful');
	}





}

if(isset($_POST['add_zone'])){

	$zone_name=mysqli_real_escape_string($conn, $_POST['zone_name']);
	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	$date=date('Y-m-d');

	if($edit_id!='')
	{
	$sql=mysqli_query($conn,"UPDATE tbl_zone set zone_name='$zone_name' where zone_id='$edit_id'");
	if($sql){
	
			header('Location: ../zone_list.php?update=successful');
	
		
	}
	else{
		header('Location: ../zone_list.php?update=unsuccessful');
	}
	}
	else
	{
	$sql=mysqli_query($conn,"INSERT INTO tbl_zone (zone_name, parent_zone_id, created_date, created_by) VALUES ('$zone_name', '0', '$date', '$userid')");
	if($sql){
	
			header('Location: ../zone_list.php?update=successful');
	
		
	}
	else{
		header('Location: ../zone_list.php?update=unsuccessful');
	}
}




}

if(isset($_POST['add_sub_zone'])){

	$zone_name=mysqli_real_escape_string($conn, $_POST['zone_name']);
	$parent_zone_id=mysqli_real_escape_string($conn, $_POST['parent_zone_id']);
	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	$date=date('Y-m-d');

	if($edit_id!='')
	{
	$sql=mysqli_query($conn,"UPDATE tbl_zone set zone_name='$zone_name', parent_zone_id='$parent_zone_id' where zone_id='$edit_id'");
	if($sql){
	
			header('Location: ../sub_zone_list.php?update=successful');
	
		
	}
	else{
		header('Location: ../sub_zone_list.php?update=unsuccessful');
	}
	}
	else
	{
	$sql=mysqli_query($conn,"INSERT INTO tbl_zone (zone_name, parent_zone_id, created_date, created_by) VALUES ('$zone_name', '$parent_zone_id', '$date', '$userid')");
	if($sql){
	
			header('Location: ../sub_zone_list.php?update=successful');
	
		
	}
	else{
		header('Location: ../sub_zone_list.php?update=unsuccessful');
	}
}




}
if(isset($_POST['designation'])){

	$designation_name=mysqli_real_escape_string($conn, $_POST['designation_name']);
	$designation_name=strtoupper($designation_name);
	$designation_id=mysqli_real_escape_string($conn, $_POST['designation_id']);
	$date=date('Y-m-d');

	if($designation_id!='')
	{
	$sql=mysqli_query($conn,"UPDATE tbl_designation set designation_name='$designation_name' where designation_id='$designation_id'");
	if($sql){
	
			header('Location: ../designation_list.php?update=successful');
	
		
	}
	else{
		header('Location: ../designation_list.php?update=unsuccessful');
	}
	}
	else
	{
	$sql=mysqli_query($conn,"INSERT INTO tbl_designation (designation_name, created_date, created_by) VALUES ('$designation_name', '$date', '$userid')");
	if($sql){
	
			header('Location: ../designation_list.php?update=successful');
	
		
	}
	else{
		header('Location: ../designation_list.php?update=unsuccessful');
	}
}
}	
if(isset($_POST['add_client_type'])){

	$type=mysqli_real_escape_string($conn, $_POST['type']);
	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	$date=date('Y-m-d H:i:s');

	if($edit_id!='')
	{
	$sql=mysqli_query($conn,"UPDATE tbl_client_type set type='$type' where type_id='$edit_id'");
	if($sql){
	
			header('Location: ../client_type.php?update=successful');
	
		
	}
	else{
		header('Location: ../client_type.php?update=unsuccessful');
	}
	}
	else
	{
	$sql=mysqli_query($conn,"INSERT INTO tbl_client_type (type, created_date, created_by) VALUES ('$type', '$date', '$userid')");
	if($sql){
	
			header('Location: ../client_type.php?insert=successful');
	
		
	}
	else{
		header('Location: ../client_type.php?insert=unsuccessful');
	}
}
}	
?>