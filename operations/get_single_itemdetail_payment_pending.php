<?php

include "../includes/config.php";

if($_POST['po'])
{


$po = $_POST['po'];


// selecting posts
$query = "SELECT * FROM tbl_single_purchase_detail where purchase_id=$po";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      
                         $i++;
                        $qty = $row['qty'];
                        $rate = $row['rate'];
                        $amount = $row['amount'];
                        $product = $row['product'];
                        $qty_rec = $row['qty_rec'];
                        $item_serial = $row['item_serial'];
                        $barcode = $row['barcode'];
                        $sql="SELECT * FROM tbl_items where item_id='$product'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          $item_id=$data['item_id'];
                          $item_name=$data['item_name'];
                          $item_model=$data['item_model'];
                          $brand_id=$data['brand_id'];
                          $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
                          $value2 = mysqli_fetch_assoc($sql2);
                          $brand_name=$value2['cat_name'];
                         }



      echo '                

                                  <tr id="row_'.$i.'">
                                          <td>
                                          <select class="form-control select_group" data-row-id="row_'.$i.'" id="product_'.$i.'" tabindex="-1" name="product[]" style="width:100%;"  required readonly="">

                                          <option value='.$item_id.' selected>'.$brand_name.'  '.$item_name.'</option></select>

                       
                        </td>
                        <td><input type="text"  readonly="" name="item_serial[]" id="item_serial_'.$i.'" tabindex="-1" class="form-control" required  value="'.$item_serial.'"></td>
                        <td hidden><input type="text"  readonly="" name="barcode[]" id="barcode_'.$i.'" tabindex="-1" class="form-control" required value="'.$barcode.'"></td>
                        <td hidden><input type="text"  readonly=""  name="qty_rec[]" id="qty_rec_'.$i.'" class="form-control calculate" required onchange="getTotal('.$i.')" value="1"></td>
                        <td><input type="text" readonly="" name="qty[]" id="qty_'.$i.'" tabindex="-1" class="form-control calculate" required onkeyup="getTotal('.$i.')" value="'.$qty.'"></td>
                        <td>
                          <input type="text" readonly="" name="rate[]" id="rate_'.$i.'" tabindex="-1" class="form-control calculate"  required  autocomplete="off" onkeyup="getTotal('.$i.')" value="'.$rate.'">

                          
                        </td>
                        <td>
                          <input type="text" readonly="" name="amount[]" id="amount_'.$i.'" tabindex="-1" class="form-control"  autocomplete="off" readonly="" value="'.$amount.'">
                          
                        </td>
                        
                        
                     </tr>
                   
                   
   
';
}


}
?>
