<style>
  .productCard .productThumb img {
    height: 63%;
    object-fit: cover;
}

#product_search_side{
  max-height: 79px;
    font-size: 20px;
    font-weight: 800;
}

.side_products{
padding: 5px;
}

.product-items{
  height: 658px;
}

.product-items .badge-secondary{
  border-radius: 10px;
}

.product-items::-webkit-scrollbar {
    width: 15px !important;
    height: 8px !important;
    border-radius: 10px;
}
.product-items::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}
.product-items::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>

<?php


include "../includes/config.php";
include "../includes/session.php";

$product_search_side = $_POST['product_search_side'];
if($product_search_side=='')
{
    $where_item='group by tbl_items.item_id order by tbl_items.id';
}
else{
    $where_item='and tbl_items.item_name LIKE "%'.$product_search_side.'%" OR tbl_cat.catagory_name LIKE "%'.$product_search_side.'%" group by tbl_items.item_id order by tbl_items.id ASC limit 9 ';
}
$sql="SELECT branch_id,created_by, user_privilege  FROM users where user_id='$userid'";
                                                  $result1 = mysqli_query($conn,$sql);
                                                  
                                                  while($data = mysqli_fetch_array($result1) ){
                                                    $created_by = $data['created_by'];
                                                    $branch_id = $data['branch_id'];
                                                    $user_privilege = $data['user_privilege'];
                                                    }
if($user_privilege!='branch' && $created_by=='1')
                            {
                    $item_query="SELECT tbl_items.*, tbl_cat.catagory_name, tbl_purchase_detail.* FROM tbl_items INNER JOIN tbl_cat ON tbl_items.category = tbl_cat.id INNER JOIN tbl_purchase_detail ON tbl_items.item_id = tbl_purchase_detail.product WHERE tbl_purchase_detail.qty_rec!='' and tbl_purchase_detail.parent_id='$created_by' $where_item "; 
                }

  else
  {
    if($user_privilege=='branch')
    {
      $created_by=$userid;
    }
    else
    {
      $created_by=$created_by;
    }
$item_query="SELECT * FROM tbl_purchase_req_detail INNER JOIN tbl_items ON tbl_purchase_req_detail.product = tbl_items.item_id  WHERE
   tbl_purchase_req_detail.recieved!='0' and tbl_purchase_req_detail.transfer='0' and tbl_purchase_req_detail.parent_id='$created_by' $where_item"; 
  }
  $sale_rate=0;
  foreach ($conn->query($item_query) as $row){
    $brand_id=$row['brand_id'];
    $pur_item_id=$row['pur_item_id'];
    $brand_name=$row['catagory_name'];
    if($user_privilege!='branch'  && $created_by=='1')
    {
        $sale_rate=$row['retail'];
    }
    else
    {
        $sale_rate=$row['retail'];
    }
   
  if($row['barcode']!=0)
  {
    $barcode=$row['barcode'];    
  }
  else
  {
    $barcode=""; 
  }
  if($row['item_serial']!=0)
  {
    $item_serial=$row['item_serial'];    
  }
  else
  {
    $item_serial=""; 
  }
  $item_image=$row['item_image'];
  if($item_image!='')
                                      {
                                        $item_image=$item_image;    
                                      }
                                      else
                                      {
                                        $item_image="no_image.png"; 
                                      }
$item_id=$row['item_id'];
$item_name=$row['item_name'];
echo '<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 side_products">
                                        <div class="productCard text-center" style="padding:5px; background-color: #e9ecef; height: 142px;">
                                            <a href="#"  onclick="add_row_side('.$item_id.', '.$barcode.', '.$pur_item_id.',  '.$sale_rate.', '.$item_serial.')">
                                            <div class="productThumb" style="margin-bottom: -36px">
                                                <img class="img-fluid" src="'.$item_image.'" alt="ix">
                                            </div>
                                            <div class="productContent badge-secondary" style="font-size: 14px; font-weight: 800; font-family: sans-serif;">
                                                    '.$brand_name." ".$item_name.'
                                                  
                                            </div>
                                            </a>
                                        </div>
                                    </div>';
}
?>