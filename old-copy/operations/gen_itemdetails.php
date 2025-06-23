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
      
                         
                        $qty = $row['qty'];
                        $rate = $row['rate'];
                        $amount = $row['amount'];
                        $product = $row['product'];
                        $qty_rec = $row['qty_rec'];
                        $item_serial = $row['item_serial'];
                        $barcode = $row['barcode'];
                        $sale_rate = $row['sale_rate'];
                        $qty_num=0;
                        $sql="SELECT SUM(qty) as qty,rate  FROM tbl_purchase_detail where product='$product' and purchase_id='$po'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                         $qty_num=$data['qty'];
                         $rate_single=$data['rate'];

                         
                         }
                        $sql1="SELECT item_id,item_name, item_model,brand_id  FROM tbl_items where item_id='$product'";
                        $result2 = mysqli_query($conn,$sql1);
                        while($data = mysqli_fetch_array($result2) ){
                          $item_id=$data['item_id'];
                          $item_name=$data['item_name'];
                          $item_model=$data['item_model'];
                          $category=$data['category'];
                          $sql2=mysqli_query($conn,"SELECT catagory_name from tbl_cat where id='$category'");
                                                $value2 = mysqli_fetch_assoc($sql2);
                                                $catagory_name=$value2['catagory_name'];
                         }

                        

//                          for($z=0; $z<$qty_num; $z++)
// {
  $i++;

      echo '                

                                  <tr id="row_'.$i.'">
                                          <td>
                                          <select class="form-control product" data-row-id="row_'.$i.'" tabindex="-1"  id="product_'.$i.'" name="product[]" style="width:100%;"  required readonly="" >

                                          <option value='.$item_id.' selected>'.$catagory_name.'  '.$item_name.'</option></select>

                       
                        </td>
                        <td hidden><input type="text"  name="item_serial[]" id="item_serial_'.$i.'" class="form-control item_serial"  value="" onchange="chkprodser('.$i.')"></td>
                        <td><input type="text"  name="barcode[]"  id="barcode_'.$i.'" class="form-control barcode" readonly="" onchange="chkbar('.$i.')" value="'.$barcode.'"></td>
                        <td hidden><input type="text"  readonly="" name="qty_rec[]" id="qty_rec_'.$i.'" tabindex="-1" class="form-control calculate" required onchange="getTotal('.$i.')" value="'.$qty_num.'"></td>
                        <td><input type="text"  name="qty[]" id="qty_'.$i.'" tabindex="-1" class="form-control calculate" required onkeyup="getTotal('.$i.')" value="'.$qty_num.'"></td>
                        <td>
                          <input type="text" readonly="" name="rate[]" id="rate_'.$i.'" tabindex="-1"  class="form-control calculate"  required  autocomplete="off" onkeyup="getTotal('.$i.')" value="'.$rate_single.'">
                          <input type="hidden" readonly="" name="sale_rate[]" id="sale_rate_'.$i.'" tabindex="-1"  class="form-control calculate"  required  autocomplete="off" onkeyup="getTotal('.$i.')" value="'.$sale_rate.'">

                          
                        </td>
                        <td>
                          <input type="text" readonly="" name="amount[]" id="amount_'.$i.'" tabindex="-1"  class="form-control"  autocomplete="off" readonly="" value="'.$amount.'">
                          
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('.$i.')"><i class="fa fa-close"></i></button></td>

                     </tr>
                   
                   
   
';
// }
}


}
?>
