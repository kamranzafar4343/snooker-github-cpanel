<?php
date_default_timezone_set("Asia/Karachi");

$servername = "localhost";
$username = "admin_testSnokar";
$password = "DQA8JrZ+((vk";
$dbname = "admin_testing_snooker";
// $servername = "localhost";
// $username = "root";
// $password = "logics@199";
// $dbname = "demo2";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
