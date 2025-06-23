<?php

include "../includes/config.php";

if($_POST['bill_no'])
{


$bill_no = $_POST['bill_no'];


// selecting posts
$query = "SELECT * FROM tbl_sale_detail where sale_id=$bill_no";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      
                         $i++;
                        $qty = $row['qty'];
                        $rate = $row['rate'];
                        $amount = $row['amount'];
                        $product = $row['product'];
                        $barcode = $row['barcode'];
                        $item_serial = $row['item_serial'];
                        $pur_item_id = $row['pur_item_id'];
                      
                        $sql="SELECT item_id,item_name, item_model  FROM tbl_items where item_id='$product'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          $item_id=$data['item_id'];
                          $item_name=$data['item_name'];
                          $item_model=$data['item_model'];
                         }

                         $query1 = mysqli_query($conn,"SELECT returned_qty,return_amount FROM `tbl_sale_return_detail` where product='$product' and sale_id='$bill_no'");

                          $data=mysqli_fetch_assoc($query1);
                           $returned_qty = $data['returned_qty'];
                           $returned_amount = $data['return_amount'];



      echo '                

                                  <tr id="row_'.$i.'">
                                          <td>
                                          <select class="form-control select_group" data-row-id="row_'.$i.'" id="product_'.$i.'" name="product[]" style="width:100%;"  required readonly="">

                                          <option value='.$item_id.' selected>'.$item_name.'  '.$item_model.'</option></select>

                       
                        </td>
                        <td><input type="text" readonly name="item_serial[]" id="item_serial_'.$i.'" class="form-control item_serial"  value="'.$item_serial.'" ></td>
                        <td hidden><input type="text" readonly name="barcode[]"  id="barcode_'.$i.'" class="form-control barcode"  value="'.$barcode.'"></td>
                        
                        <td><input type="text" name="return_qty[]" id="return_qty_'.$i.'" class="form-control calculate"  onkeyup="getTotal('.$i.')" value="'.$returned_qty.'"></td>
                        <td><input type="text" readonly="" name="qty[]" id="qty_'.$i.'" class="form-control calculate" required onkeyup="getTotal('.$i.')" value="'.$qty.'"></td>
                        <td>
                          <input type="text" readonly="" name="rate[]" id="rate_'.$i.'" class="form-control calculate"  required  autocomplete="off" onkeyup="getTotal('.$i.')" value="'.$rate.'">

                          
                        </td>
                        <td>
                          <input type="text" readonly="" name="amount[]" id="amount_'.$i.'" class="form-control"  autocomplete="off" readonly="" value="'.$amount.'">
                          
                        </td>
                        <td>
                          <input type="text" readonly="" name="return_amount[]" id="return_amount_'.$i.'" class="form-control"  autocomplete="off" readonly="" value="'.$returned_amount.'">
                          
                        </td>
                        
                     </tr>
                   
                   
   
';
}


}
?>
