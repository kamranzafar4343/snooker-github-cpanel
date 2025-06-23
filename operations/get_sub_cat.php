<?php

include "../includes/config.php";

$cat = $_POST['cat'];


// selecting posts
$query = "SELECT sub_cat_name,id FROM tbl_sub_cat where brand_id = '$cat'";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      $id = $row['id'];
      $sub_cat_name = $row['sub_cat_name'];

      $users_arr[] = array("id" => $id, "sub_cat_name" => $sub_cat_name);
   }
 



echo json_encode($users_arr);