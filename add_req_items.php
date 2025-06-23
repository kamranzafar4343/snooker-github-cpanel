<?php

include "../includes/config.php";

if($_POST['po'])
{


$po = $_POST['po'];


// selecting posts
$query = "SELECT * FROM tbl_purchase_req_detail where purchase_req_id=$po";

$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      
                         $i++;
                       $qty = $row['qty'];
                        $rate = $row['rate'];
                        $amount = $row['amount'];
                        $product = $row['product'];
                        $qty_rec = $row['qty_rec'];
                       
                        $sql="SELECT item_id,item_name, item_model  FROM tbl_items where item_id='$product'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          $item_id=$data['item_id'];
                          $item_name=$data['item_name'];
                          $item_model=$data['item_model'];
                         }



      echo '                

                                  <tr id="row_'.$i.'">
                                          <td>
                                          <select class="form-control select_group" data-row-id="row_'.$i.'" id="product_'.$i.'" name="product[]" style="width:100%;"  required readonly="">

                                          <option value='.$item_id.' selected>'.$item_name.'  '.$item_model.'</option></select>

                       
                        </td>
                        <td><input type="number" name="stock_qty[]" id="stock_qty_'.$i.'" required readonly class="form-control"></td>
                        <td><input type="text"  name="qty_rec[]" id="qty_rec_'.$i.'" class="form-control calculate" required onchange="getTotal('.$i.')" value="'.$qty_rec.'"></td>
                        <td><input type="text" readonly="" name="qty[]" id="qty_'.$i.'" class="form-control calculate" required onkeyup="getTotal('.$i.')" value="'.$qty.'"></td>
                        <td>
                          <input type="text" readonly="" name="rate[]" id="rate_'.$i.'" class="form-control calculate"  required  autocomplete="off" onkeyup="getTotal('.$i.')" value="'.$rate.'">

                          
                        </td>
                        <td>
                          <input type="text" readonly="" name="amount[]" id="amount_'.$i.'" class="form-control"  autocomplete="off" readonly="" value="'.$amount.'">
                          
                        </td>
                        
                     </tr>
                   
                   
   
';
}


}
?>
