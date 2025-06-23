<?php

include "../includes/config.php";

if($_POST['po'])
{


$po = $_POST['po'];
$edit_id = $_POST['edit_id'];

if($edit_id==''){

$query = "SELECT * FROM tbl_purchase_req_detail where purchase_req_id=$po and qty_rec!=''";

$result = mysqli_query($conn,$query);


if(mysqli_num_rows($result)=='')
{

  $query1 = "SELECT * FROM tbl_purchase_req_detail where purchase_req_id=$po";

  $result = mysqli_query($conn,$query1);
}

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      
                         
                       
                        $qty = $row['qty'];
                        $product = $row['product'];
                        $qty_rec = $row['qty_rec'];
                        $created_by = $row['created_by'];
                        $parent_id = $row['parent_id'];
                        $query_price = mysqli_query($conn,"SELECT cash_price,installment_price FROM tbl_item_price where item_id='$product' and user_id='$parent_id'");
                        $price_data = mysqli_fetch_assoc($query_price) ;
                        $cash_rate=$price_data['cash_price'];
                        $inst_rate=$price_data['installment_price'];
                        $qty_num=0;
                        $sql="SELECT SUM(qty) as qty, SUM(qty_rec) as qty_rec FROM tbl_purchase_req_detail where product='$product' and purchase_req_id='$po'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                         $qty_t=$data['qty'];
                         $qty_rec=$data['qty_rec'];
                         $qty_num=$qty-$qty_rec;
                        

                         
                         }
                         
                        $sql1="SELECT item_id,item_name, item_model, brand_id  FROM tbl_items where item_id='$product'";
                        $result3 = mysqli_query($conn,$sql1);
                        while($data = mysqli_fetch_array($result3) ){
                          $item_id=$data['item_id'];
                          $item_name=$data['item_name'];
                          $item_model=$data['item_model'];
                          $brand_id=$data['brand_id'];
                         }

                        $sql5="SELECT rate  FROM tbl_purchase_detail where product='$product'";
                        $result5 = mysqli_query($conn,$sql5);
                        while($data5 = mysqli_fetch_array($result5) ){
                          $pur_rate=$data5['rate'];
                        
                         }

                         $sql6="SELECT cat_name  FROM tbl_catagory where id='$brand_id'";
                        $result5 = mysqli_query($conn,$sql6);
                        while($data5 = mysqli_fetch_array($result5) ){
                          
                          $cat_name=$data5['cat_name'];
                        
                         }

                  
                        // $query="SELECT barcode,item_serial  FROM tbl_purchase_detail where product='$product'";
                        
                         

                          $query4="SELECT * FROM tbl_purchase_detail INNER JOIN tbl_items ON tbl_purchase_detail.product = tbl_items.item_id  WHERE
item_serial NOT IN (SELECT 
        tbl_sale_detail.item_serial
    FROM
        tbl_purchase_detail
            INNER JOIN
        tbl_sale_detail  ON tbl_purchase_detail.item_serial = tbl_sale_detail.item_serial)
 AND item_serial NOT IN (SELECT 
        tbl_installment.item_serial
    FROM
        tbl_purchase_detail
            INNER JOIN
        tbl_installment  ON tbl_purchase_detail.item_serial = tbl_installment.item_serial)
  
   AND item_serial NOT IN (SELECT 
        tbl_purchase_return_detail.item_serial
    FROM
        tbl_purchase_detail
            INNER JOIN
        tbl_purchase_return_detail  ON tbl_purchase_detail.item_serial = tbl_purchase_return_detail.item_serial)
  AND tbl_purchase_detail.qty_rec!='' and tbl_purchase_detail.product='$product' and tbl_purchase_detail.transfer='0' Limit $qty_num"; 

$return_query="SELECT * FROM tbl_purchase_detail INNER JOIN tbl_items ON tbl_purchase_detail.product = tbl_items.item_id   WHERE
                                  item_serial IN (SELECT 
                                    tbl_sale_return_detail.item_serial
                                 FROM
                                    tbl_purchase_detail
                                        INNER JOIN
                                  tbl_sale_return_detail  ON tbl_purchase_detail.item_serial = tbl_sale_return_detail.item_serial where tbl_sale_return_detail.sold='0' and tbl_sale_return_detail.returned='1' and tbl_sale_return_detail.iemi='1') and tbl_purchase_detail.transfer='0' Limit $qty_num";

   

                          $result2 = mysqli_query($conn,$query4);
                          $result3 = mysqli_query($conn,$return_query);
                       // if(mysqli_num_rows($result2)=='' && mysqli_num_rows($result3)==''){
                       //  $data = 'empty';
                       //  echo $data;
                       //  exit();
                       // }

for($z=0; $z<$qty_num; $z++)
{
 
  while($data1 = mysqli_fetch_array($result2) ){
$i++;

                          $item_serial = $data1['item_serial'];
                          $barcode = $data1['barcode'];
                          $pur_item_id = $data1['pur_item_id'];
                         

      echo '                

                                  <tr id="row_'.$i.'">
                                          <td>
                                          <select class="form-control select_group" data-row-id="row_'.$i.'" id="product_'.$i.'" name="product[]" style="width:100%;" readonly required >
                                          
                                          <option value='.$item_id.' selected>'.$cat_name.'  '.$item_name.'</option>
                                          </select>

                       
                        </td>
                        <td hidden><input type="number" name="created_by[]" id="created_by_'.$i.'" required readonly class="form-control" value="'.$created_by.'"></td>
                        <td hidden><input type="number" name="parent_id[]" id="parent_id_'.$i.'" required readonly class="form-control" value="'.$parent_id.'"><input type="number" name="pur_item_id[]" id="pur_item_id_'.$i.'" required readonly class="form-control" value="'.$pur_item_id.'"></td>
                        <td ><input type="text" name="item_serial[]" id="item_serial_'.$i.'" required readonly class="form-control" value="'.$item_serial.'"></td>
                        <td hidden><input type="number" name="barcode[]" id="barcode_'.$i.'" required readonly class="form-control" value="'.$barcode.'"></td>
                        <td ><input type="text" name="pur_rate[]" id="pur_rate_'.$i.'" required readonly class="form-control" value="'.$pur_rate .'"></td>
                        <td hidden><input type="number" name="stock_qty[]" id="stock_qty_'.$i.'" required readonly class="form-control"></td>
                        <td hidden><input type="text"  name="qty_rec[]" id="qty_rec_'.$i.'" class="form-control calculate" required onchange="getTotal('.$i.')" value="1"></td>
                        <td><input type="text" readonly="" name="qty1[]" id="qty_'.$i.'" class="form-control calculate" required onkeyup="getTotal('.$i.')" value="1"><input type="hidden" readonly="" name="qty[]" id="qty1_'.$i.'" class="form-control calculate" required onkeyup="getTotal('.$i.')" value="'.$qty.'"></td>
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
  while($data1 = mysqli_fetch_array($result3) ){
$i++;
                          $item_serial = $data1['item_serial'];
                          $barcode = $data1['barcode'];
                          
                         

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
                        <td hidden><input type="number" name="barcode[]" id="barcode_'.$i.'" required readonly class="form-control" value="'.$barcode.'"></td>
                        <td ><input type="number" name="pur_rate[]" id="pur_rate_'.$i.'" required readonly class="form-control" value="'.$pur_rate.'"></td>
                        <td hidden><input type="number" name="stock_qty[]" id="stock_qty_'.$i.'" required readonly class="form-control"></td>
                        <td><input type="text"  name="qty_rec[]" id="qty_rec_'.$i.'" class="form-control calculate" required onchange="getTotal('.$i.')" value="1"></td>
                        <td><input type="text" readonly="" name="qty[]" id="qty_'.$i.'" class="form-control calculate" required onkeyup="getTotal('.$i.')" value="1"></td>
                        <td>
                          <input type="text"  name="rate[]" id="rate_'.$i.'" class="form-control calculate"  required  autocomplete="off" onchange="getTotal('.$i.')" value="">

                          
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
                        <td ><input type="number" name="barcode[]" id="barcode_'.$i.'" required readonly class="form-control" value="'.$barcode.'"></td>
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
