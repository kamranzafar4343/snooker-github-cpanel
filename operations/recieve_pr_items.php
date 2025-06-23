<?php

include "../includes/config.php";

if($_POST['po'])
{


$po = $_POST['po'];


// selecting posts
$query = "SELECT * FROM tbl_purchase_req where purchase_req_id = '$po'";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      $purchase_req_id = $row['purchase_req_id'];
     
      $invoice_date = $row['invoice_date'];
      $po_remarks = $row['po_remarks'];
      $invoice_no = $row['invoice_no'];
      $net_amount = $row['net_amount'];
      $amount_payed = $row['amount_payed'];
      $gross_amount = $row['gross_amount'];
      $amount_remaining = $row['amount_remaining'];
      $discount = $row['discount'];
      $created_by = $row['created_by'];
      $query1 = mysqli_query($conn,"SELECT item_total as qty FROM `tbl_purchase_req` where purchase_req_id='$purchase_req_id'");

      $data=mysqli_fetch_assoc($query1);
       $qty = $data['qty'];
      
       $query2 = mysqli_query($conn,"SELECT user_name,user_id FROM `users` where user_id='$created_by'");

      $data=mysqli_fetch_assoc($query2);
       $username = $data['user_name'];
      $branch_id = $data['user_id'];

      
      $users_arr[] = array("purchase_req_id" => $purchase_req_id,  "invoice_date" => $invoice_date, "invoice_no" => $invoice_no, "po_remarks" => $po_remarks,  "net_amount" => $net_amount, "gross_amount" => $gross_amount, "discount" => $discount, "qty" => $qty, "username" => $username, "branch_id" => $branch_id);
   }
 



echo json_encode($users_arr);

}