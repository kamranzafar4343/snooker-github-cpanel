<?php

include "../includes/config.php";

$parent_code = $_POST['parent_code'];


// selecting posts
$query = "SELECT acode,aname FROM tbl_account where parent_code = '$parent_code' and acode!='100200000' and acode!='200200000'";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      $acode = $row['acode'];
      $aname = $row['aname'];

      $users_arr[] = array("acode" => $acode, "aname" => $aname);
   }
 



echo json_encode($users_arr);
