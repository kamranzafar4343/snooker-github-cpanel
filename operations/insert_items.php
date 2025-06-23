<?php
include "../includes/config.php";
include "../includes/session.php";

if(isset($_POST['add_items'])){

	$brand_id=mysqli_real_escape_string($conn, $_POST['brand_id']);

	$category=mysqli_real_escape_string($conn, $_POST['category']);
	$sub_category=mysqli_real_escape_string($conn, $_POST['sub_category']);
	$item_name=mysqli_real_escape_string($conn, $_POST['item_name']);
	$item_id=mysqli_real_escape_string($conn, $_POST['item_id']);

	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	$item_description=mysqli_real_escape_string($conn, $_POST['item_description']);
	$item_model=mysqli_real_escape_string($conn, $_POST['item_model']);
	$barcode=mysqli_real_escape_string($conn, $_POST['barcode']);
	$purchase=mysqli_real_escape_string($conn, $_POST['purchase']);
	$retail=mysqli_real_escape_string($conn, $_POST['retail']);
	$mini_wholesale=mysqli_real_escape_string($conn, $_POST['mini_wholesale']);
	$wholesale=mysqli_real_escape_string($conn, $_POST['wholesale']);
	$type_a=mysqli_real_escape_string($conn, $_POST['type_a']);
	$type_b=mysqli_real_escape_string($conn, $_POST['type_b']);
	$type_c=mysqli_real_escape_string($conn, $_POST['type_c']);
	$date=date('Y-m-d');

if($edit_id != '')	
{

	$rand=rand();
	$image = strtolower(pathinfo($_FILES["item_image"]["name"], PATHINFO_EXTENSION));

	/* File upload begins here */
	$target_file = "../uploads/items/".$rand.time().".".$image;
	$targetimage = "uploads/items/".$rand.time().".".$image;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($image!='')
{ 
	$check = getimagesize($_FILES["item_image"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
     header('Location: ../item_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../item_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["item_image"]["size"] > 1500000) {
   header('Location: ../item_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../item_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../item_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {

	if(move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file)) {

		$sql=mysqli_query($conn, "UPDATE tbl_items set  brand_id='$brand_id', category='$category', sub_category='$sub_category', item_name='$item_name', barcode='$barcode', item_model='$item_model', item_image='$targetimage', item_description='$item_description', created_date='$date',created_by='$userid', purchase='$purchase' ,retail='$retail',mini_wholesale='$mini_wholesale',wholesale='$wholesale',type_a='$type_a',type_b='$type_b',type_c='$type_c' where item_id='$edit_id'");
	if($sql){

			header('Location: ../add_item.php?update=successful');
		
		
	}
	else{
		header('Location: ../add_item.php?update=unsuccessful');
	}
}
	
	
}
}
else{
	
	$sql=mysqli_query($conn, "UPDATE tbl_items set  brand_id='$brand_id', category='$category', sub_category='$sub_category', item_name='$item_name', item_model='$item_model',  barcode='$barcode',  item_description='$item_description', created_date='$date',created_by='$userid', purchase='$purchase' ,retail='$retail',mini_wholesale='$mini_wholesale',wholesale='$wholesale',type_a='$type_a',type_b='$type_b',type_c='$type_c' where item_id='$edit_id'");
	if($sql){
	
			header('Location: ../add_item.php?update=successful');
	
		
	}
	else{
		header('Location: ../add_item.php?update=unsuccessful');
	}
}
}
else{

	$query = "SELECT item_id FROM `tbl_items` order by item_id DESC LIMIT 1";

	$result = mysqli_query($conn,$query);
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result) ){
	      $item_id = $row['item_id'];
	      ++$item_id;
	  }
	}
	else
	{
		$item_id = '1001';
	}

	$rand=rand();
	$image = strtolower(pathinfo($_FILES["item_image"]["name"], PATHINFO_EXTENSION));

	/* File upload begins here */
	$target_file = "../uploads/items/".$rand.time().".".$image;
	$targetimage = "uploads/items/".$rand.time().".".$image;

	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($image!='')
{
	$check = getimagesize($_FILES["item_image"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
     header('Location: ../item_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
  }
if (file_exists($target_file)) {
   header('Location: ../item_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($_FILES["item_image"]["size"] > 1500000) {
   header('Location: ../item_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header('Location: ../item_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
}
if ($uploadOk == 0) {
   header('Location: ../item_list.php?wronguploaded=true');                
    $uploadOk = 0;
     exit;
} else {
	if(move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file)) {
	

		$sql=mysqli_query($conn, "INSERT INTO tbl_items (item_id, brand_id, category, sub_category ,item_name, barcode, item_model, item_image, item_description, purchase ,retail, mini_wholesale, wholesale, type_a, type_b, type_c, created_date, created_by) VALUES ('$item_id','$brand_id', '$category','$sub_category', '$item_name', '$barcode', '$item_model', '$targetimage', '$item_description', '$purchase', '$retail','$mini_wholesale','$wholesale','$type_a','$type_b','$type_c', '$date', '$userid')");
		
	if($sql){

			header('Location: ../add_item.php?insert=successful');
		
		
	}
	else{
		header('Location: ../add_item.php?insert=unsuccessful');
	}
}
	
	
}
}
else{
	
	$sql=mysqli_query($conn, "INSERT INTO tbl_items (item_id, brand_id, category, sub_category ,item_name, barcode, item_model, item_description, purchase, retail, mini_wholesale, wholesale, type_a, type_b, type_c, created_date, created_by) VALUES ('$item_id','$brand_id', '$category','$sub_category', '$item_name', '$barcode', '$item_model', '$item_description', '$purchase', '$retail','$mini_wholesale','$wholesale','$type_a','$type_b','$type_c', '$date', '$userid')");
	if($sql){
			header('Location: ../add_item.php?insert=successful');	
	}
	else{
		header('Location: ../add_item.php?insert=unsuccessful');
	}
}
}
}

	
?>