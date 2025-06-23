<?php

include "../includes/config.php";
include "../includes/session.php";

$item_id = $_POST['item_id'];
$user_id = $userid;
$rate = $_POST['rate'];
$type = $_POST['type'];

if($type=='0')
{
	$sql=mysqli_query($conn, "UPDATE tbl_items SET purchase='$rate' WHERE item_id='$item_id'");
}
if($type=='1')
{
	$sql=mysqli_query($conn, "UPDATE tbl_items SET retail='$rate' WHERE item_id='$item_id'");
}
if($type=='2')
{
	$sql=mysqli_query($conn, "UPDATE tbl_items SET mini_wholesale='$rate' WHERE item_id='$item_id'");
}
if($type=='3')
{
	$sql=mysqli_query($conn, "UPDATE tbl_items SET wholesale='$rate' WHERE item_id='$item_id'");
}
if($type=='4')
{
	$sql=mysqli_query($conn, "UPDATE tbl_items SET type_a='$rate' WHERE item_id='$item_id'");
}
if($type=='5')
{
	$sql=mysqli_query($conn, "UPDATE tbl_items SET type_b='$rate' WHERE item_id='$item_id'");
}
if($type=='6')
{
	$sql=mysqli_query($conn, "UPDATE tbl_items SET type_c='$rate' WHERE item_id='$item_id'");
}

                             
?>