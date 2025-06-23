<?php

include "../includes/config.php";
include "../includes/session.php";

$color = $_POST['i'];

	$sql=mysqli_query($conn, "UPDATE tbl_company SET color='$color'");
                             
?>