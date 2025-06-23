<?php

include "../includes/config.php";

$customer_id = $_POST['customer_id'];


// selecting posts
$query = "SELECT client_cnic,mobile_no1,address_permanent FROM tbl_customer where customer_id = '$customer_id'";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      $client_cnic = $row['client_cnic'];
      $mobile_no1 = $row['mobile_no1'];
  
      $address_permanent = $row['address_permanent'];


      $users_arr[] = array("client_cnic" => $client_cnic, "mobile_no1" => $mobile_no1, "address_permanent" => $address_permanent);
   }
 



echo json_encode($users_arr);