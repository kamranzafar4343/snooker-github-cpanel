	<?php
include "../includes/config.php";
include "../includes/session.php";

// echo "<script>console.log('asd');</script>";exit();
$sub_cat_id = $_POST['cat_id'];


// selecting posts
$query = "SELECT item_name,item_id,item_model FROM tbl_items where category = '$sub_cat_id'";
// print_r("SELECT item_name,id,item_model FROM tbl_items where brand_id = '$sub_cat_id'");
$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      $id = $row['item_id'];
      $item_name = $row['item_name']. " " .$row['item_model'];

      $users_arr[] = array("id" => $id, "item_name" => $item_name);
   }
 



echo json_encode($users_arr);


