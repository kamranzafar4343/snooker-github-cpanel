<?php

include "../includes/config.php";
include "../includes/session.php";

$item_id = $_POST['item_id'];
$user_id = $_POST['user_id'];
$installment_price = $_POST['installment_price'];

$query_price = mysqli_query($conn,"SELECT cash_price,installment_price FROM tbl_item_price where item_id='$item_id' and user_id='$user_id'");  
if(mysqli_num_rows($query_price)>0)
{
	$sql=mysqli_query($conn, "UPDATE tbl_item_price SET installment_price='$installment_price' WHERE item_id='$item_id' and user_id='$user_id'");
}
else
{
	$sql=mysqli_query($conn, "INSERT INTO tbl_item_price(user_id, item_id, installment_price) VALUES('$user_id', '$item_id', '$installment_price')");
}                                
?>