<?php

include "../includes/config.php";
if($_POST['product_name'])
{

	$product_name = $_POST['product_name'];
	$Installment_id = $_POST['Installment_id'];
    
	$query1 = "SELECT * FROM tbl_installment where item_id = '$product_name' and customer='$Installment_id'";

$result = mysqli_query($conn,$query1);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      
      $per_month_amount = $row['per_month_amount'];
      $plan_id = $row['plan_id'];
      $avo = $row['avo'];
      $mo = $row['mo'];
     
      $sales_men = $row['sales_men'];
      $query2 = mysqli_query($conn,"SELECT avo_per_amt FROM tbl_installment where item_id = '$product_name' and customer='$Installment_id'");
      $row2 = mysqli_fetch_array($query2);
      $avo_per_amt = $row2['avo_per_amt'];

       $query = mysqli_query($conn,"SELECT SUM(total_price-down_payment) as total_payment, amount_recieved  FROM `tbl_installment` where plan_id=$plan_id"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $total_payment=$zdata['total_payment'];
                                   $amount_recieved=$zdata['amount_recieved'];
                                   $remaining= $total_payment-$amount_recieved;
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
       $users_arr[] = array("plan_id" => $plan_id, "per_month_amount" => $per_month_amount, "avo_per_amt" => $avo_per_amt, "remaining" => $remaining, "salesman_id" => $salesman_id, "salesman" => $salesman,"avo_id" => $avo_id, "avoname" => $avoname,"mo_id" => $mo_id, "moname" => $moname);  
   }

echo json_encode($users_arr);
}







	
