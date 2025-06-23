<?php 
include "../includes/config.php";
include "../includes/session.php";


$po = $_POST['bc'];
$product = $_POST['product'];

$query = "SELECT * FROM tbl_purchase_detail where barcode = '$po' and product!='$product'";

$result = mysqli_query($conn,$query);

 if(mysqli_num_rows($result)>0){
  $data = 'already';
  
 }
 else
 {
	$data = 'no data found';
 }
 



echo json_encode($data);



?>