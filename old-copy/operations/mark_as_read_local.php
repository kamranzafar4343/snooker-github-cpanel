<?php
error_reporting(0);
include "../includes/config.php";
include "../includes/session.php";
$output='';

$req_id=$_POST['req_id'];
if($req_id=='0')
{
	$where="";
}
else
{

	$where="where pur_req_id='".$req_id."'";
}
$sql = mysqli_query($conn,"UPDATE tbl_local_purchase SET user_read='1' $where");

?>