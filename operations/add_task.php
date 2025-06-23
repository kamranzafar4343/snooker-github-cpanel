<?php
include "../includes/config.php";
include "../includes/session.php";
if(isset($_POST['add_task']))
{
  $task_name=$_POST['task_name'];
  $task_description=$_POST['task_description'];
  $date=$_POST['task_date'];

  $sql=mysqli_query($conn, "INSERT INTO  tbl_task (task_name, task_description,  created_by, created_date) VALUES ('$task_name', '$task_description', '$userid', '$date')");
if($sql){
      header('Location: ../task_list.php?add=done');  
  }
}
if(isset($_GET['task_id']))
{
  $task_id=$_GET['task_id'];
  $sql=mysqli_query($conn, "DELETE FROM tbl_task WHERE task_id='$task_id'");
if($sql){
      header('Location: ../task_list.php?delete=done');  
  }
}

?>