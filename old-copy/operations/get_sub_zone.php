<?php

include "../includes/config.php";

$zone_id = $_POST['zone_id'];


// selecting posts
$query = "SELECT zone_name,zone_id FROM tbl_zone where parent_zone_id = '$zone_id'";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      $zone_id = $row['zone_id'];
      $zone_name = $row['zone_name'];

      $users_arr[] = array("zone_id" => $zone_id, "zone_name" => $zone_name);
   }
 



echo json_encode($users_arr);