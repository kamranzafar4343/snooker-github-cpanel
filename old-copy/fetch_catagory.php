<?php
include "includes/config.php";

// fetch records
$sql = "SELECT tbl_cat.*, tbl_catagory.cat_name FROM tbl_cat INNER JOIN tbl_catagory ON tbl_cat.brand_id = tbl_catagory.id";
$result = mysqli_query($conn, $sql);
$count=0;
if(mysqli_num_rows($result)>0)
{
while($row = mysqli_fetch_assoc($result)) {
  
  $count++;
	$updateButton = "<a href='add_catagory.php?edit_id=".$row['id']."'><button  class='btn btn-sm btn-outline-secondary' title='Edit'><i class='fa fa-edit'></i></button></a>";

     // Delete Button
     $deleteButton = "<a href='operations/delete_cat.php?id=".$row['id']."'><button  class='btn btn-sm btn-outline-danger deleteUser' title='Delete' ><i class='fa fa-trash-o'></i></button></a>";

     $action = $updateButton." ".$deleteButton;
     $created_date = $row['created_date'];

     $newDate = date("d-m-Y", strtotime($created_date));
   
     $array[] = array(
       "count" => $count,
       "cat_name" => $row['cat_name'],
       "catagory_name" => $row['catagory_name'],
       "created_date" => $row['created_date'],
       "action" => $action
     );
    // $array[] = $row;
}
}
else
{
  $array[] = array(
       "count" => '',
       "cat_name" => '',
       "created_date" => '',
       "action" => ''
     );
}
$dataset = array(
    "echo" => 1,
    "totalrecords" => count($array),
    "totaldisplayrecords" => count($array),
    "data" => $array
);

echo json_encode($dataset);
?>