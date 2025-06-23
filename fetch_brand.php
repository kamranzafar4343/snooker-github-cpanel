<?php
include "includes/config.php";

// fetch records
$sql = "SELECT * FROM tbl_catagory order by id desc";
$result = mysqli_query($conn, $sql);
$count=0;
if(mysqli_num_rows($result)>0)
{
while($row = mysqli_fetch_assoc($result)) {
  $count++;
	$updateButton = "<a href='add_catagory.php?edit_id=".$row['id']."'><button  class='btn btn-sm btn-outline-secondary' title='Edit'><i class='fa fa-edit'></i></button></a>";

     // Delete Button
     $deleteButton = "<a href='operations/delete.php?cat_id=".$row['id']."'><button  class='btn btn-sm btn-outline-danger deleteUser' title='Delete' ><i class='fa fa-trash-o'></i></button></a>";

     $action = $updateButton." ".$deleteButton;
     $created_date = $row['created_date'];
     $newDate = date("d-m-Y", strtotime($created_date));
     $array[] = array(
       "count" => $count,
       "cat_name" => $row['cat_name'],
       "created_date" => $newDate,
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