<?php
include "includes/config.php";

// fetch records
$sql = "SELECT * FROM tbl_items";
$result = mysqli_query($conn, $sql);
$count=0;
if(mysqli_num_rows($result)>0)
{
  
while($data = mysqli_fetch_assoc($result)) {
$count++;
                        $id = $data['item_id'];
                        $item_name = $data['item_name'];
                        $barcode = $data['barcode'];
                        $category = $data['category'];
                        $created_date = $data['created_date'];
                        $branch=1;
                        $itemidmodel=$id;
                        $sql2=mysqli_query($conn, "SELECT catagory_name FROM tbl_cat WHERE id='$category'");
                        $data1= mysqli_fetch_assoc($sql2);
                        $catagory_name = $data1['catagory_name'];
                      
                  
                      $pur_qty=0;
                      $pur_rtn_qty=0;
                      $sold_qty=0;
                      $sale_returned_qty=0;  
                $sql0 = "SELECT  SUM(return_qty) as pur_rtn_qty FROM tbl_purchase_return_detail where product='$id'";
                  $result1 = mysqli_query($conn,$sql0);
                       while($row1 = mysqli_fetch_array($result1) ){
                        $pur_rtn_qty = $row1['pur_rtn_qty'];
                     }
                     if($pur_rtn_qty=='')
                     {
                       $pur_rtn_qty=0;
                     }
                $sql1 = "SELECT  SUM(qty_rec) as pur_qty FROM tbl_purchase_detail where product='$id'";
                  $result1 = mysqli_query($conn,$sql1);
                       while($row1 = mysqli_fetch_array($result1) ){
                        $pur_qty = $row1['pur_qty'];

                     }
                     if($pur_qty=='')
                     {
                       $pur_qty=0;
                     }

                    $sql2 = "SELECT sum(qty) as sold_qty FROM tbl_sale_detail where product = '$id'";
                                      

                      $result1 = mysqli_query($conn,$sql2);
                       while($row1 = mysqli_fetch_array($result1) ){
                        $sold_qty = $row1['sold_qty'];


                     }
                     if($sold_qty=='')
                     {
                       $sold_qty=0;
                     }
                

                    $sql3 = "SELECT sum(returned_qty) as sale_returned_qty FROM tbl_sale_return_detail where product = '$id'";
                        $result3 = mysqli_query($conn,$sql3);
                               while($row3 = mysqli_fetch_array($result3) ){
                                 $sale_returned_qty = $row3['sale_returned_qty'];


                             }
                        if($sale_returned_qty=='')
                     {
                       $sale_returned_qty=0;
                     }
                
                      $stock_qty=round(($pur_qty-$pur_rtn_qty)-($sold_qty-$sale_returned_qty), 3); 
                      if($stock_qty=='' || $stock_qty<=0)
                        {
                          $stock_disp='<span class="badge badge-danger">Empty</span>';
                      
                          
                        }
                        else
                        {
                          $stock_disp='<span class="badge badge-success">Available</span>';
                          
                        }
                      if($pur_qty==0 && $pur_rtn_qty==0 && $sold_qty==0 && $sale_returned_qty==0)
                      {
                        $button='';
                      }
                      else
                      {
                        $button='<button  type="button" class="btn btn-info text-white " onclick="get_details('.$itemidmodel.', 1);">Detail</button>';
                      }
$item_name= $catagory_name." ".$data['item_name'];
  
     $array[] = array(
       "count" => $count,
       "item_id" => $data['item_id'],
       "item_name" => $item_name,
       "barcode" => $barcode,
       "stock_qty" => $stock_qty,
       
       "stock_disp" => $stock_disp,
       "button" => $button
     );
    // $array[] = $row;
}
}
else
{
  $array[] = array(
       "count" => '',
       "item_id" => '',
       "item_name" => '',
       "barcode" => '',
       "stock_qty" => '',
       "stock_disp" => '',
       "button" => ''
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