<?php

include "../includes/config.php";

if($_POST['po'])
{


$po = $_POST['po'];


// selecting posts
$query = "SELECT * FROM tbl_purchase_detail where purchase_id=$po";

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
                           $query1 = mysqli_query($conn,"SELECT return_qty, return_amount FROM tbl_purchase_return_detail where product='$product' and  purchase_id='$po' and created_by=$userid"); 
                          
                                   $cdata = mysqli_fetch_assoc($query1) ;
                                   $return_qty=$cdata['return_qty'];
                                   $return_amount=$cdata['return_amount'];
                                   
                        $sql="SELECT * FROM tbl_items where item_id='$product'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          $item_id=$data['item_id'];
                          $item_name=$data['item_name'];
                          $item_model=$data['item_model'];
                          $category=$data['category'];
                          $sql2=mysqli_query($conn,"SELECT catagory_name from tbl_cat where id='$category'");
                          $value2 = mysqli_fetch_assoc($sql2);
                          $catagory_name=$value2['catagory_name'];
                         }





      echo '                

                                  <tr id="row_'.$i.'">
                                          <td>
                                          <select class="form-control select_group" data-row-id="row_'.$i.'" id="product_'.$i.'" name="product[]" style="width:100%;"  required readonly="">

                                          <option value='.$item_id.' selected>'.$catagory_name.'  '.$item_name.'</option></select>

                       
                        </td>
                        <td hidden><input type="text"  readonly="" name="item_serial[]" id="item_serial_'.$i.'" class="form-control" required value="'.$item_serial.'"></td>
                        <td><input type="text"  readonly="" name="barcode[]" id="barcode_'.$i.'" class="form-control" required value="'.$barcode.'"></td>
                        <td hidden><input type="text"  name="return_qty[]" id="return_qty_'.$i.'" class="form-control calculate"  onchange="getTotal('.$i.')" value="1"></td>
                        <td><input type="text" readonly="" name="qty[]" id="qty_'.$i.'" class="form-control calculate" required onkeyup="getTotal('.$i.')" value="'.$qty_rec.'"></td>
                        <td >
                          <input type="text" readonly="" name="rate[]" id="rate_'.$i.'" class="form-control calculate"  required  autocomplete="off" onkeyup="getTotal('.$i.')" value="'.$rate.'">

                          
                        </td>
                        <td>
                          <input type="text" readonly="" name="amount[]" id="amount_'.$i.'" class="form-control"  autocomplete="off" readonly="" value="'.$amount.'">
                          
                        </td>

                        <td hidden>
                          <input type="text" readonly="" name="return_amount[]" id="return_amount_'.$i.'" class="form-control"  autocomplete="off" readonly="" value="'.$amount.'">
                          
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('.$i.')"><i class="fa fa-close"></i></button></td>
                        
                     </tr>
                   
                   
   
';
}


}
?>
