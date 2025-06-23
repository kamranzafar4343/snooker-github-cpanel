<?php
include "includes/config.php";
include "includes/session.php";


      $data = array();
      $sql=mysqli_query($conn, "SELECT * FROM tbl_items order by id");
      while($result=mysqli_fetch_assoc($sql)){
      		$created_date = $result['created_date'];
      		$brand_id = $result['brand_id'];
            $newDate = date("d-m-Y", strtotime($created_date));
            $query1 = mysqli_query($conn,"SELECT cat_name FROM tbl_catagory where id=$brand_id"); 
            $cdata = mysqli_fetch_assoc($query1) ;
            $catname=$cdata['cat_name'];
          $row = array();
          $row[] = $result['item_id'];
          $row[] = $catname;
          $row[] = $result['item_name'];
          $row[] = $result['barcode'];
          $row[] = $result['item_image'];
          $row[] = $newDate;

     
          $output = array(
                  "data" => $data,
          );
          echo json_encode($output);
          }
?>