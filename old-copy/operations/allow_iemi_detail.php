<?php

include "../includes/config.php";

if($_POST['po'])
{


$po = $_POST['po'];

$query = "SELECT * FROM tbl_purchase_req_detail where purchase_req_id=$po";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      
                         
                        $qty = $row['qty'];
                        $product = $row['product'];
                        $created_by = $row['created_by'];
                        $parent_id = $row['parent_id'];

                        $qty_num=0;
                        $sql="SELECT SUM(qty) as qty  FROM tbl_purchase_req_detail where product='$product' and purchase_req_id='$po'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          $qty_num=$data['qty'];

                         
                         }
                         
                        $sql1="SELECT item_id,item_name, brand_id  FROM tbl_items where item_id='$product'";
                        $result3 = mysqli_query($conn,$sql1);
                        while($data = mysqli_fetch_array($result3) ){
                          $item_id=$data['item_id'];
                          $item_name=$data['item_name'];
                          $brand_id=$data['brand_id'];
                         }
                          $sql6="SELECT cat_name  FROM tbl_catagory where id='$brand_id'";
                        $result5 = mysqli_query($conn,$sql6);
                        while($data5 = mysqli_fetch_array($result5) ){
                          
                          $cat_name=$data5['cat_name'];
                        
                         }
                         $query_price = mysqli_query($conn,"SELECT cash_price,installment_price FROM tbl_item_price where item_id='$product' and user_id='$parent_id'");
                        $price_data = mysqli_fetch_assoc($query_price) ;
                        $cash_rate=$price_data['cash_price'];
                        $inst_rate=$price_data['installment_price'];

                        

  $i++;

                         

      echo '                

                                  <tr id="row_'.$i.'">
                                          <td>
                                          <select class="form-control select_group" data-row-id="row_'.$i.'" id="product_'.$i.'" name="product[]" style="width:100%;" readonly required >
                                          
                                          <option value='.$item_id.' selected>'.$cat_name.'  '.$item_name.'</option>
                                          </select>

                       
                        </td>
                        <td><input type="text" readonly="" name="qty[]" id="qty_'.$i.'" class="form-control calculate" required onkeyup="getTotal('.$i.')" value='.$qty_num.'></td>
                        <td>
                          <input type="text"  name="cash_rate[]" id="cash_rate_'.$i.'" readonly="" class="form-control calculate"  required  autocomplete="off" onchange="getTotal('.$i.')" value="'.$cash_rate.'">

                          
                        </td>
                        <td>
                        <input type="text" readonly="" name="inst_rate[]" readonly="" id="inst_rate_'.$i.'" class="form-control"  autocomplete="off" readonly="" value="'.$inst_rate.'">
                        <input type="hidden" readonly="" name="amount[]" readonly="" id="amount_'.$i.'" class="form-control"  autocomplete="off" readonly="" value="'.$pur_rate.'">
                      
                          
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('.$i.')"><i class="fa fa-close"></i></button></td>
                        
                     </tr>
                   
                   
   
';


}
}
?>