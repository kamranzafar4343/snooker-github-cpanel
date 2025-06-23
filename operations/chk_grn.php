<?php 
include "../includes/config.php";
include "../includes/session.php";
if($_POST['i_s'])
{

$po = $_POST['i_s'];
$product = $_POST['product'];
$query = "SELECT * FROM tbl_purchase_detail where item_serial = '$po'";

$result = mysqli_query($conn,$query);

 if(mysqli_num_rows($result)>0){
  $data = 'already';
  
 }
 else
 {

 	$query = "SELECT * FROM tbl_single_purchase_detail  where item_serial = '$po'";

		$result = mysqli_query($conn,$query);

		 if(mysqli_num_rows($result)>0){
		  $data = 'already';
		  
		 }
		 else
		 {
		 	$data = 'no data found';
		 
		 }
 }
 
echo json_encode($data);

}

?>