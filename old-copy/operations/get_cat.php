<?php

include "../includes/config.php";

if($_POST['cat_id'])
{


$cat_id = $_POST['cat_id'];


// selecting posts
$query = "SELECT catagory_name,id FROM tbl_cat where brand_id = '$cat_id'";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      $id = $row['id'];
      $catagory_name = $row['catagory_name'];
      
      $users_arr[] = array("id" => $id, "catagory_name" => $catagory_name);
   }
 



echo json_encode($users_arr);

}
//////////////////////////////////////////////////////////////////////////////






