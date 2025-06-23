<?php

include "../includes/config.php";
include "../includes/session.php";

$payment_id = $_POST['payment_id'];
// $sql=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
//                                 $data = mysqli_fetch_assoc($sql);
//                                 $user_privilege=$data['user_privilege'];
//                                 if($user_privilege=='superadmin')
//                                 {
//                                  $query = $sql=mysqli_query($conn,"SELECT DISTINCT customer,sales_men,avo, mo FROM `tbl_installment` where installment_status!='Completed' ");
//                                 }
//                                 else
//                                 {
                                  $query = $sql=mysqli_query($conn,"SELECT DISTINCT customer,sales_men,avo, mo FROM `tbl_installment_payment` where payment_id='$payment_id' ");
                                //}
// selecting posts


error_reporting(0);


     while($row = mysqli_fetch_array($query) ){
      $customer = $row['customer'];
      $sales_men = $row['sales_men'];
      $avo = $row['avo'];
      $mo = $row['mo'];

      $query1 = mysqli_query($conn,"SELECT username,customer_id FROM tbl_customer where customer_id='$customer' ");

		$data=mysqli_fetch_assoc($query1);
		$customer_id = $data['customer_id'];
     
      $username = $data['username'];

      $query2 = mysqli_query($conn,"SELECT username,s_id FROM tbl_salesmen where s_id='$sales_men'");

		$data1=mysqli_fetch_assoc($query2);
		$salesman = $data1['username'];
     	$salesman_id = $data1['s_id'];
      

      $query3 = mysqli_query($conn,"SELECT username,s_id FROM tbl_salesmen where s_id='$avo' ");

		$data2=mysqli_fetch_assoc($query3);
		$avoname = $data2['username'];
		$avo_id = $data2['s_id'];
     
    

      $query4 = mysqli_query($conn,"SELECT username,s_id FROM tbl_salesmen where s_id='$mo' ");

		$data3=mysqli_fetch_assoc($query4);
		$moname = $data3['username'];
		$mo_id = $data3['s_id'];

      $users_arr[] = array( "customer_id" => $customer_id, "username" => $username,"salesman_id" => $salesman_id, "salesman" => $salesman,"avo_id" => $avo_id, "avoname" => $avoname,"mo_id" => $mo_id, "moname" => $moname);
   }
 



echo json_encode($users_arr);