<?php

include "../includes/config.php";
include "../includes/session.php";


// $sql=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
//                                 $data = mysqli_fetch_assoc($sql);
//                                 $user_privilege=$data['user_privilege'];
//                                 if($user_privilege=='superadmin')
//                                 {
//                                  $query = $sql=mysqli_query($conn,"SELECT DISTINCT customer,sales_men,avo, mo FROM `tbl_installment` where installment_status!='Completed' ");
//                                 }
//                                 else
//                                 {
                                  $query = $sql=mysqli_query($conn,"SELECT DISTINCT customer,sales_men,avo, mo FROM `tbl_installment` where installment_status!='Completed' ");
                                //}
// selecting posts


error_reporting(0);


     while($row = mysqli_fetch_array($query) ){
      $customer = $row['customer'];
      $sales_men = $row['sales_men'];
      $avo = $row['avo'];
      $mo = $row['mo'];

      $query1 = mysqli_query($conn,"SELECT * FROM tbl_customer where customer_id='$customer' ");

		$data=mysqli_fetch_assoc($query1);
		$customer_id = $data['customer_id'];
     $seprate_customer_id = $data['seprate_customer_id'];
      $username = $data['username'];
      $mobile_no1 = $data['mobile_no1'];
      $client_cnic = $data['client_cnic'];
      $customer_by=$data['created_by'];
                                              $sql=mysqli_query($conn, "SELECT user_name FROM users where user_id='$customer_by'");
                                              $data = mysqli_fetch_array($sql);
                                                $branchname = $data['user_name'];
                                                $iden = str_split($branchname);
                                                $iden3 = str_split($branchname,3);
                                                $iden2=end($iden3);
                                                $iden1=$iden[0];
                                                $s_is=$iden1.$iden2."_".$seprate_customer_id;
      



      $users_arr[] = array( "customer_id" => $customer_id, "seprate_customer_id" => $s_is, "username" => $username, "mobile_no1" => $mobile_no1, "client_cnic" => $client_cnic);
   }
 



echo json_encode($users_arr);