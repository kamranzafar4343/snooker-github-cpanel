<?php

include "../includes/config.php";

if($_POST['po'])
{


$po = $_POST['po'];


// selecting posts
$query = "SELECT * FROM tbl_purchase where purchase_id = '$po'";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      $purchase_id = $row['purchase_id'];
     
      $invoice_date = $row['invoice_date'];
      $po_remarks = $row['po_remarks'];
      $vendor_id = $row['vendor_id'];
      $net_amount = $row['net_amount'];
      $amount_payed = $row['amount_payed'];
      $gross_amount = $row['gross_amount'];
      $amount_remaining = $row['amount_remaining'];
      $discount = $row['discount'];
      $narration = $row['narration'];
      $invoice_no = $row['invoice_no'];

      $query1 = mysqli_query($conn,"SELECT SUM(qty) FROM `tbl_purchase_detail` where purchase_id='$purchase_id'");

      $data=mysqli_fetch_assoc($query1);
       $qty = $data['SUM(qty)'];

       $query2 = mysqli_query($conn,"SELECT username FROM `tbl_vendors` where vendor_id='$vendor_id'");

      $data2=mysqli_fetch_assoc($query2);
       $username = $data2['username'];

       $query3 = mysqli_query($conn,"SELECT SUM(d_amount-c_amount) as balance FROM `tbl_trans_detail` where acode='$vendor_id'");

      $data3=mysqli_fetch_assoc($query3);
       $balance = $data3['balance'];
      
      $users_arr[] = array("purchase_id" => $purchase_id, "invoice_date" => $invoice_date, "po_remarks" => $po_remarks, "vendor_id" => $vendor_id, "net_amount" => $net_amount, "amount_payed" => $amount_payed, "gross_amount" => $gross_amount, "amount_remaining" => $amount_remaining, "discount" => $discount, "qty" => $qty, "username" => $username, "balance" => $balance, "narration" => $narration, "invoice_no" => $invoice_no);
   }
 



echo json_encode($users_arr);

}