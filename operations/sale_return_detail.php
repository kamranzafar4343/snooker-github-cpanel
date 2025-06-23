<?php

include "../includes/config.php";

if($_POST['bill_no'])
{


$bill_no = $_POST['bill_no'];


// selecting posts
$query = "SELECT * FROM tbl_sale where sale_id = '$bill_no'";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      $sale_id = $row['sale_id'];
     
      $created_date = $row['created_date'];
      $remarks = $row['remarks'];
      $customer_id = $row['customer_name'];
      $customer_address = $row['customer_address'];
      $customer_phone = $row['customer_phone'];
      $customer_cnic = $row['customer_cnic'];
      $customer_email = $row['customer_email'];
      $net_amount = $row['net_amount'];
      $gross_amount = $row['gross_amount'];
      $discount = $row['discount'];
      $amount_recieved = $row['amount_recieved'];
      $sales_men_id = $row['sales_men'];

      $query1 = mysqli_query($conn,"SELECT amount_returned FROM `tbl_sale_return` where sale_id='$bill_no'");

      $data=mysqli_fetch_assoc($query1);
       $amount_returned = $data['amount_returned'];

       $query2 = mysqli_query($conn,"SELECT username FROM `tbl_customer` where customer_id='$customer_id'");

      $data2=mysqli_fetch_assoc($query2);
       $customer_name = $data2['username'];

       $query4 = mysqli_query($conn,"SELECT username FROM `tbl_salesmen` where s_id='$sales_men_id'");

      $data4=mysqli_fetch_assoc($query4);
       $sales_man = $data4['username'];

      
      $users_arr[] = array("sale_id" => $sale_id, "created_date" => $created_date, "remarks" => $remarks, "customer_id" => $customer_id, "customer_name" => $customer_name,  "customer_address" => $customer_address, "customer_phone" => $customer_phone, "customer_cnic" => $customer_cnic, "customer_email" => $customer_email, "net_amount" => $net_amount, "gross_amount" => $gross_amount, "discount" => $discount, "amount_recieved" => $amount_recieved, "sales_men_id" => $sales_men_id , "sales_man" => $sales_man, "amount_returned" => $amount_returned);
   }
 



echo json_encode($users_arr);

}