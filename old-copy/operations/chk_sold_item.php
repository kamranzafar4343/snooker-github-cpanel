<?php 
include "../includes/config.php";
include "../includes/session.php";


$item_serial = $_POST['item_serial'];
$barcode = $_POST['barcode'];
$product = $_POST['product'];
// $type = $_POST['type'];

$query = "SELECT * FROM tbl_sale_detail where item_serial = '$item_serial' and product='$product' and barcode='$barcode' and returned='0'";

$result = mysqli_query($conn,$query);

 if(mysqli_num_rows($result)>0){
  $data = 'already';
  
 }
 else
 {

 	$query = "SELECT * FROM tbl_installment  where item_serial = '$item_serial' and item_id='$product' and barcode='$barcode'";

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



?>