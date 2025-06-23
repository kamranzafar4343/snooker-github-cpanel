<?php

include "../includes/config.php";

if($_POST['po'])
{


$po = $_POST['po'];
$edit_id = $_POST['edit_id'];
$location = $_POST['location'];
if($location)
{
  $created="and tbl_purchase_req_detail.parent_id='$location'";
}
else
{
  $created="";
}

if($edit_id==''){
// selecting posts
$query = "SELECT * FROM tbl_purchase_req_detail where purchase_req_id=$po";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      
                         
                        $qty = $row['qty'];
                        $rate = $row['rate'];
                        $amount = $row['amount'];
                        $product = $row['product'];
                        $qty_rec = $row['qty_rec'];
                        $created_by = $row['created_by'];
                        $parent_id = $row['parent_id'];

                        $qty_num=0;
                        $sql="SELECT SUM(qty) as qty,rate  FROM tbl_purchase_req_detail where product='$product' and purchase_req_id='$po'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                         $qty_num=$data['qty'];
                         $rate_single=$data['rate'];

                         
                         }
                         
                        $sql1="SELECT item_id,item_name, item_model  FROM tbl_items where item_id='$product'";
                        $result3 = mysqli_query($conn,$sql1);
                        while($data = mysqli_fetch_array($result3) ){
                          $item_id=$data['item_id'];
                          $item_name=$data['item_name'];
                          $item_model=$data['item_model'];
                         }

                        

                        // $query="SELECT barcode,item_serial  FROM tbl_purchase_req_detail where product='$product'";
                        


                          $query4="SELECT * FROM tbl_purchase_req_detail INNER JOIN tbl_items ON tbl_purchase_req_detail.product = tbl_items.item_id  WHERE
pur_item_id NOT IN (SELECT 
        tbl_sale_detail.pur_item_id
    FROM
        tbl_purchase_req_detail
            INNER JOIN
        tbl_sale_detail  ON tbl_purchase_req_detail.pur_item_id = tbl_sale_detail.pur_item_id)
 AND pur_item_id NOT IN (SELECT 
        tbl_installment.pur_item_id
    FROM
        tbl_purchase_req_detail
            INNER JOIN
        tbl_installment  ON tbl_purchase_req_detail.pur_item_id = tbl_installment.pur_item_id)
 AND pur_item_id NOT IN (SELECT 
        tbl_purchase_return_detail.pur_item_id
    FROM
        tbl_purchase_req_detail
            INNER JOIN
        tbl_purchase_return_detail  ON tbl_purchase_req_detail.pur_item_id = tbl_purchase_return_detail.pur_item_id)
  AND tbl_purchase_req_detail.recieved!='0' and tbl_purchase_req_detail.iemi='0' and tbl_purchase_req_detail.product='$product' and tbl_purchase_req_detail.transfer='0' $created Limit $qty_num"; 


   
   
                          $result2 = mysqli_query($conn,$query4);
                       // if(mysqli_num_rows($result2)==''){
                       //  $data = 'empty';
                       //  echo $data;
                       //  exit();
                       // }

                         for($z=0; $z<$qty_num; $z++)
{
  $i++;
  while($data1 = mysqli_fetch_array($result2) ){

                         
                          $item_serial = $data1['item_serial'];
                          $barcode = $data1['barcode'];
                          $pur_rate = $data1['rate'];
                          $pur_item_id = $data1['pur_item_id'];
                         $brand_id=$data1['brand_id'];
    $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
    $value2 = mysqli_fetch_assoc($sql2);
    $brand_name=$value2['cat_name'];

      echo '                

                                  <tr id="row_'.$i.'">
                                          <td>
                                          <select class="form-control select_group" data-row-id="row_'.$i.'" id="product_'.$i.'" name="product[]" style="width:100%;" readonly required >
                                          
                                          <option value='.$item_id.' selected>'.$brand_name.'  '.$item_name.'</option>
                                          </select>

                       
                        </td>
                        <td hidden><input type="number" name="created_by[]" id="created_by_'.$i.'" required readonly class="form-control" value="'.$created_by.'"></td>
                        <td hidden><input type="number" name="parent_id[]" id="parent_id_'.$i.'" required readonly class="form-control" value="'.$parent_id.'"></td>
                        <td ><input type="number" name="item_serial[]" id="item_serial_'.$i.'" required readonly class="form-control" value="'.$item_serial.'"></td>
                        <td hidden><input type="number" name="pur_item_id[]" id="pur_item_id_'.$i.'" required readonly class="form-control" value="'.$pur_item_id.'"></td>
                        <td><input type="number" name="barcode[]" id="barcode_'.$i.'" required readonly class="form-control" value="'.$barcode.'"></td>
                         <td ><input type="number" name="pur_rate[]" id="pur_rate_'.$i.'" required readonly class="form-control" value="'.$pur_rate.'"></td>
                        <td hidden><input type="number" name="stock_qty[]" id="stock_qty_'.$i.'" required readonly class="form-control"></td>
                        <td><input type="text"  name="qty_rec[]" id="qty_rec_'.$i.'" class="form-control calculate" required onchange="getTotal('.$i.')" value="1"></td>
                        <td><input type="text" readonly="" name="qty[]" id="qty_'.$i.'" class="form-control calculate" required onkeyup="getTotal('.$i.')" value="1"></td>
                        <td>
                          <input type="text"  name="rate[]" id="rate_'.$i.'" class="form-control calculate"  required  autocomplete="off" onkeyup="getTotal('.$i.')" value="">

                          
                        </td>
                        <td>
                          <input type="text" readonly="" name="amount[]" id="amount_'.$i.'" class="form-control"  autocomplete="off" readonly="" value="">
                          
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('.$i.')"><i class="fa fa-close"></i></button></td>
                        
                     </tr>
                   
                   
   
';
}
}
}
}
else{
$query = "SELECT * FROM tbl_purchase_req_detail where purchase_req_id=$po";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
                        $qty = $row['qty'];
                        $rate = $row['rate'];
                        $amount = $row['amount'];
                        $product = $row['product'];
                        $qty_rec = $row['qty_rec'];
                        $created_by = $row['created_by'];
                        $parent_id = $row['parent_id'];
                        $item_serial = $row['item_serial'];
                        $barcode = $row['barcode'];
      $sql1="SELECT item_id,item_name, item_model  FROM tbl_items where item_id='$product'";
                        $result3 = mysqli_query($conn,$sql1);
                        while($data = mysqli_fetch_array($result3) ){
                          $item_id=$data['item_id'];
                          $item_name=$data['item_name'];
                          $item_model=$data['item_model'];
                         }
       echo '                

                                  <tr id="row_'.$i.'">
                                          <td>
                                          <select class="form-control select_group" data-row-id="row_'.$i.'" id="product_'.$i.'" name="product[]" style="width:100%;" readonly required >
                                          
                                          <option value='.$item_id.' selected>'.$item_name.'  '.$item_model.'</option>
                                          </select>

                       
                        </td>
                        <td hidden><input type="number" name="created_by[]" id="created_by_'.$i.'" required readonly class="form-control" value="'.$created_by.'"></td>
                        <td hidden><input type="number" name="parent_id[]" id="parent_id_'.$i.'" required readonly class="form-control" value="'.$parent_id.'"></td>
                        <td ><input type="number" name="item_serial[]" id="item_serial_'.$i.'" required readonly class="form-control" value="'.$item_serial.'"></td>
                        <td><input type="number" name="barcode[]" id="barcode_'.$i.'" required readonly class="form-control" value="'.$barcode.'"></td>
                        <td hidden><input type="number" name="stock_qty[]" id="stock_qty_'.$i.'" required readonly class="form-control"></td>
                        <td><input type="text"  name="qty_rec[]" id="qty_rec_'.$i.'" class="form-control calculate" required onchange="getTotal('.$i.')" value="1"></td>
                        <td><input type="text" readonly="" name="qty[]" id="qty_'.$i.'" class="form-control calculate" required onkeyup="getTotal('.$i.')" value="1"></td>
                        <td>
                          <input type="text"  name="rate[]" id="rate_'.$i.'" class="form-control calculate"  required  autocomplete="off" onkeyup="getTotal('.$i.')" value="'.$rate.'">

                          
                        </td>
                        <td>
                          <input type="text" readonly="" name="amount[]" id="amount_'.$i.'" class="form-control"  autocomplete="off" readonly="" value="'.$amount.'">
                          
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('.$i.')"><i class="fa fa-close"></i></button></td>
                        
                     </tr>
                   
                   
   
';
      }


}
}
?>
