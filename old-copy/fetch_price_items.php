<?php
include "includes/config.php";
include "includes/session.php";

// fetch records
$sql = "SELECT * FROM tbl_items order by id desc";
$result = mysqli_query($conn, $sql);
$sale_input='';
$opening_qty='';
$count=0;

while($row = mysqli_fetch_assoc($result)) {
                        $id = $row['item_id'];
                        $brand_id = $row['brand_id'];
                        $item_name = $row['item_name'];
                        $created_date = $row['created_date'];
                        $barcode = $row['barcode'];
                        $count++;

                        $query1 = mysqli_query($conn,"SELECT cat_name FROM tbl_catagory where id='$brand_id'"); 
                        $cdata = mysqli_fetch_assoc($query1) ;
                        $catname=$cdata['cat_name'];
                        $item=$catname." ".$item_name;

                        $query_price = mysqli_query($conn,"SELECT rate,sale_rate FROM tbl_purchase_detail where product='$id'");  
                                  if(mysqli_num_rows($query_price)>0){
                                   $price_data = mysqli_fetch_assoc($query_price);
                                   $rate=$price_data['rate'];
                                   $sale_rate=$price_data['sale_rate'];
                                    }
                                  else
                                  {
                                     $rate=0;
                                     $sale_rate=0;
                                  }

                        $query3 = mysqli_query($conn,"SELECT SUM(qty_rec) as total_qty FROM tbl_purchase_detail where product='$id' and purchase_id='1'"); 
                        if(mysqli_num_rows($query3)>0){
                                   $cdata = mysqli_fetch_assoc($query3) ;
                                   $total_qty=$cdata['total_qty'];
                                 }
                        else
                        {
                          $total_qty=0;
                        }
                        $sql10=mysqli_query($conn, "SELECT user_privilege,created_by,user_id FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql10);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                                $user_id=$data['user_id'];
                                
                               if($user_privilege=='branch')
                               {
                                $created_by=$user_id;
                               }
                               else
                               {
                                $created_by=$created_by;
                               }
                            
               $sql1 = mysqli_query($conn, "SELECT  SUM(qty_rec) as pur_qty FROM tbl_purchase_detail where product='$id' and parent_id='$created_by'");
               $row1 = mysqli_fetch_assoc($sql1);
               $pur_qty = $row1['pur_qty'];
               if($pur_qty=='')
               {
                $pur_qty = 0;
               }
               $sql2 = mysqli_query($conn, "SELECT sum(qty) as sold_qty FROM tbl_sale_detail where product = '$id' and parent_id='$created_by'");
               $row2 = mysqli_fetch_assoc($sql2);
               $sold_qty = $row2['sold_qty'];
               if($sold_qty=='')
               {
                $sold_qty = 0;
               }
               $sql3 = mysqli_query($conn, "SELECT sum(returned_qty) as sale_returned_qty FROM tbl_sale_return_detail where product = '$id' and parent_id='$created_by'");
               $row3 = mysqli_fetch_assoc($sql3);
               $sale_returned_qty = $row3['sale_returned_qty'];
               if($sale_returned_qty=='')
               {
                $sale_returned_qty = 0;
               }

                      $stock_qty=$pur_qty-($sold_qty-$sale_returned_qty); 
                      if($stock_qty=='' || $stock_qty==0)
                        {
                          $stock_qty=0;
                        }
    


                                              if($sale_rate>0 && $stock_qty>0 && $total_qty>0){
                                               $opening_qty = '<div class="body">

                                                        <div class="row clearfix">
                                                            <div class="col-md-12 col-sm-12">
                                                                 <input type="text" class="form-control calculate " onchange="update_qty('.$count.', '.$id.', '.$total_qty.')" maxlength="7"  name="total_qty" id="qty_'.$count.'"  style="border-width: 3px; border-style: transparent;" value="'.$total_qty.'"></input>
                                                            </div>
                                                        </div>
                                                    </div>';
                                             }
                                        //            }else{
                                        //              $opening_qty = '
                                        
                                        //           } 
                                       // if($sale_rate>0){
                                       //  $sale_input='<div class="body">

                                       //                  <div class="row clearfix">
                                       //                      <div class="col-md-12 col-sm-12">
                                       //                          <input type="text" class="form-control calculate cash_price" maxlength="7"  name="sale_rate" data-id="'.$id.'" style="border-width: 3px; border-style: transparent;" value="'.$sale_rate.'"></input>
                                       //                      </div>
                                       //                  </div>
                                       //              </div>';
                                       // }
	
     $array[] = array(
       "count" => $count,
       "item" => $item,
       "barcode" => $barcode,
       "sale_rate" => $opening_qty
    
     );
    // $array[] = $row;
}

$dataset = array(
    "echo" => 1,
    "totalrecords" => count($array),
    "totaldisplayrecords" => count($array),
    "data" => $array
);

echo json_encode($dataset);
?>