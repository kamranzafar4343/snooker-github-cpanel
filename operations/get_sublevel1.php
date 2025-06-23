<?php
error_reporting(0);
include "../includes/config.php";

$sub_child1 = $_POST['sub_child1'];


// selecting posts
$query = "SELECT acode,aname FROM tbl_account_lv2 where sub_child1 = '$sub_child1'";

$result = mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
if($count!=0)
{

     while($row = mysqli_fetch_array($result) ){
      $acode = $row['acode'];
      $aname = $row['aname'];

      $users_arr[] = array("acode" => $acode, "aname" => $aname);
   }
	
}
else
{
$users_arr[] = array("acode" => "", "aname" => "Select Child");

 }



echo json_encode($users_arr);
