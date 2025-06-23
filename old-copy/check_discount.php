<?php

include "includes/config.php";
include "includes/session.php";

$customer = $_POST['customer'];
$sql_customer=mysqli_query($conn, "SELECT customer_type,fixed_discount FROM tbl_customer where customer_id='$customer'");
$value3 = mysqli_fetch_assoc($sql_customer);
$customer_type=$value3['customer_type'];
$fixed_discount=$value3['fixed_discount'];
if($fixed_discount=='')
{
  $fixed_discount=0;
}
echo $fixed_discount;
?>