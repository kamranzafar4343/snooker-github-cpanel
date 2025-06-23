<?php

include "../includes/config.php";

if($_POST['period'])
{


$period = $_POST['period'];


// selecting posts
$query = "SELECT percentage FROM tbl_period where months = '$period'";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      $percentage = $row['percentage'];

      
      
      $users_arr[] = array("percentage" => $percentage);
   }
 



echo json_encode($users_arr);

}
//////////////////////////////////////////////////////////////////////////////






