<?php
include "../includes/config.php";
include "../includes/session.php";
if(isset($_POST['add_contact']))
{
  $contact_name=$_POST['contact_name'];
  $contact_number=$_POST['contact_number'];
  $date=date('Y-m-d');

  $sql=mysqli_query($conn, "INSERT INTO  tbl_contacts (contact_name, contact_number,  created_by, created_date) VALUES ('$contact_name', '$contact_number', '$userid', '$date')");
if($sql){
      header('Location: ../contact_list.php?add=done');  
  }
}
if(isset($_GET['contact_id']))
{
  $contact_id=$_GET['contact_id'];
  $sql=mysqli_query($conn, "DELETE FROM tbl_contacts WHERE contact_id='$contact_id'");
if($sql){
      header('Location: ../contact_list.php?delete=done');  
  }
}
if(isset($_POST['add_message']))
{
  $contact_id=$_POST['contact_id'];
  $contact_number=$_POST['contact_number'];
  $message=$_POST['message'];
  $date=date('Y-m-d');
  $m= urlencode($message);
  $sql=mysqli_query($conn, "INSERT INTO  tbl_message (contact_id, contact_number,  message, created_by, created_date) VALUES ('$contact_id', '$contact_number', '$message', '$userid', '$date')");
if($sql){
    $newURL="https://wa.me/".$contact_number."?text=".$m."";
	header('Location: '.$newURL);
	exit();
  }
}
if(isset($_POST['add_message_main']))
{
  $message=$_POST['message'];
  $date=date('Y-m-d');
  $sql=mysqli_query($conn, "DELETE FROM tbl_message_main WHERE created_by='$userid'");
  $sql=mysqli_query($conn,  "INSERT INTO  tbl_message_main (message,  created_by, created_date) VALUES ('$message', '$userid', '$date')");
if($sql){
      header('Location: ../contact_list.php?add=done');  
  }
}
?>