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
      $po_remarks = $row['narration'];
      $vendor_id = $row['vendor_id'];
      $net_amount = $row['net_amount'];
      $amount_payed = $row['amount_payed'];
      $gross_amount = $row['gross_amount'];
      $amount_remaining = $row['amount_remaining'];
      $discount = $row['discount'];
      $payment_method = $row['payment_method'];
      $bank_id = $row['bank_id'];
      $check_no = $row['check_no'];
      $invoice_no = $row['invoice_no'];

      $query1 = mysqli_query($conn,"SELECT SUM(qty) FROM `tbl_purchase_detail` where purchase_id='$purchase_id'");

      $data=mysqli_fetch_assoc($query1);
       $qty = $data['SUM(qty)'];

       $query3 = mysqli_query($conn,"SELECT SUM(qty_rec) FROM `tbl_purchase_detail` where purchase_id='$purchase_id'");

      $data=mysqli_fetch_assoc($query3);
       $qty_rec = $data['SUM(qty_rec)'];

       $query2 = mysqli_query($conn,"SELECT username FROM `tbl_vendors` where vendor_id='$vendor_id'");

      $data2=mysqli_fetch_assoc($query2);
       $username = $data2['username'];

       $query4 = mysqli_query($conn,"SELECT aname FROM `tbl_account_lv2` where acode='$bank_id'");

      $data4=mysqli_fetch_assoc($query4);
       $aname = $data4['aname'];

      
      $users_arr[] = array("purchase_id" => $purchase_id, "invoice_date" => $invoice_date, "po_remarks" => $po_remarks, "vendor_id" => $vendor_id, "net_amount" => $net_amount, "amount_payed" => $amount_payed, "gross_amount" => $gross_amount, "amount_remaining" => $amount_remaining, "discount" => $discount, "qty" => $qty, "qty_rec" => $qty_rec, "username" => $username, "payment_method" => $payment_method, "check_no" => $check_no, "bank_id" => $bank_id, "aname" => $aname, "invoice_no" => $invoice_no);
   }
 



echo json_encode($users_arr);

}