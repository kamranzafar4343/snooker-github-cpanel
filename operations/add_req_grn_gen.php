<?php
error_reporting(0);
include "../includes/config.php";

if($_POST['po'])
{


$po = $_POST['po'];
$edit = $_POST['edit'];

// selecting posts
if($edit=='')
{
  $query = "SELECT * FROM tbl_purchase_req_detail where purchase_req_id=$po and qty_rec!='' and recieved='0' and pur_item_id!='0'";
}
else
{
  $query = "SELECT * FROM tbl_purchase_req_detail where purchase_req_id=$po and qty_rec!='' and recieved='1'";
}
$result = mysqli_query($conn,$query);

error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
      
                         $i++;
                        $cash_rate = $row['cash_rate'];
                 
                        $inst_rate = $row['inst_rate'];
                        $product = $row['product'];
                        $qty_rec = $row['qty_rec'];
                        $trans_id = $row['trans_id'];
                        $trans_parent_id = $row['trans_parent_id'];
                        $item_serial = $row['item_serial'];
                        $barcode = $row['barcode'];
                        $pur_item_id = $row['pur_item_id'];
                        $sql="SELECT item_id,item_name, item_model,brand_id  FROM tbl_items where item_id='$product'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          $item_id=$data['item_id'];
                          $item_name=$data['item_name'];
                          $item_model=$data['item_model'];
                          $brand_id=$data['brand_id'];
                         }

                          $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
                          $value2 = mysqli_fetch_assoc($sql2);
                          $brand_name=$value2['cat_name'];
                           $sql5="SELECT rate  FROM tbl_purchase_detail where product='$product'";
                        $result5 = mysqli_query($conn,$sql5);
                        while($data5 = mysqli_fetch_array($result5) ){
                          $pur_rate=$data5['rate'];
                        
                         }

                     



      echo '                

                                  <tr id="row_'.$i.'">
                                          <td>
                                          <select class="form-control select_group" data-row-id="row_'.$i.'" id="product_'.$i.'" name="product[]" style="width:100%;"  required readonly="">

                                          <option value='.$item_id.' selected>'.$brand_name.'  '.$item_name.'</option></select>

                       
                        </td>
                        <td hidden><input type="number" name="trans_id[]" id="trans_id_'.$i.'" required readonly class="form-control" value="'.$trans_id.'"></td>
                        <td hidden><input type="number" name="trans_parent_id[]" id="trans_parent_id_'.$i.'" required readonly class="form-control" value="'.$trans_parent_id.'"></td>

                        <td><input type="text"  name="item_serial[]" id="item_serial_'.$i.'" readonly="" class="form-control" required value="'.$item_serial.'" onchange="chkprodser('.$i.')"></td>
                        <td hidden><input type="text"  name="pur_item_id[]" id="pur_item_id_'.$i.'" readonly="" class="form-control" required value="'.$pur_item_id.'" onchange="chkprodser('.$i.')"></td>
                        <td><input type="text"  name="barcode[]" id="barcode_'.$i.'" readonly="" class="form-control" required value="'.$barcode.'" onchange="chkbar('.$i.')"></td>
                        <td ><input type="text"  name="qty_tran[]" id="qty_tran_'.$i.'" readonly=""  class="form-control calculate" onchange="getTotal('.$i.')" value="'.$qty_rec.'"></td>
                        <td hidden><input type="text"  name="qty_rec[]" id="qty_rec_'.$i.'" class="form-control calculate" required onchange="getTotal('.$i.')" value="'.$qty_rec.'"></td>
                        <td><input type="text" readonly="" name="qty1[]" id="qty_'.$i.'" class="form-control calculate" required onkeyup="getTotal('.$i.')" value="'.$qty_rec.'"><input type="hidden" readonly="" name="qty[]" id="qty1_'.$i.'" class="form-control calculate" required onkeyup="getTotal('.$i.')" value="'.$qty.'"></td>
                        <td hidden>
                          <input type="text"  name="cash_rate[]" id="cash_rate_'.$i.'" readonly="" class="form-control calculate"  required  autocomplete="off" onchange="getTotal('.$i.')" value="'.$cash_rate.'">
                          <input type="text" readonly="" name="inst_rate[]" readonly="" id="inst_rate_'.$i.'" class="form-control"  autocomplete="off" readonly="" value="'.$inst_rate.'">
                           <input type="text" readonly="" name="amount[]" readonly="" id="amount_'.$i.'" class="form-control"  autocomplete="off" readonly="" value="'.$pur_rate.'">
                        </td>
                   
                         <td><button type="button" class="btn btn-default" onclick="removeRow('.$i.')"><i class="fa fa-close"></i></button></td>
                        
                     </tr>
                   
                   
   
';
}


}
?>
