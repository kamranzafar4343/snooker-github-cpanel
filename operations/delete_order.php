<?php

include "../includes/config.php";
include "../includes/session.php";

$ref_id = $_POST['ref_id'];
$created_by = $userid;
$sql_check=mysqli_query($conn, "DELETE FROM tbl_sale_temp where ref_id='$ref_id' and user_id='$created_by'");
?>