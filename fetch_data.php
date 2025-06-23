<?php
include "includes/config.php";

// fetch records
$sql = "SELECT tbl_items.*, tbl_catagory.cat_name, tbl_cat.catagory_name FROM ((tbl_items INNER JOIN tbl_catagory ON tbl_items.brand_id = tbl_catagory.id) INNER JOIN tbl_cat ON tbl_items.category = tbl_cat.id)";
$result = mysqli_query($conn, $sql);
$count=0;
if(mysqli_num_rows($result)>0)
{
  
while($row = mysqli_fetch_assoc($result)) {
$count++;
	$updateButton = "<a href='add_item.php?edit_id=".$row['item_id']."'><button  class='btn btn-sm btn-outline-secondary' title='Edit'><i class='fa fa-edit'></i></button></a>";

     // Delete Button
     $deleteButton = "<a href='operations/delete.php?item_id=".$row['item_id']."'><button  class='btn btn-sm btn-outline-danger deleteUser' title='Delete' ><i class='fa fa-trash-o'></i></button></a>";

     $action = $updateButton." ".$deleteButton;
     if($row['item_name']=='')
     {
      $item_name=$row['cat_name'];
     }
     else{
      $item_name=$row['catagory_name']." ".$row['item_name'];
     }
     $array[] = array(
       "item_id" => $count,
       "cat_name" => $row['cat_name'],
       "item_name" => $item_name,
       "barcode" => $row['barcode'],
       "created_date" => $row['created_date'],
       "action" => $action
     );
    // $array[] = $row;
}
}
else
{
  $array[] = array(
       "item_id" => '',
       "cat_name" => '',
       "item_name" => '',
       "barcode" => '',
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