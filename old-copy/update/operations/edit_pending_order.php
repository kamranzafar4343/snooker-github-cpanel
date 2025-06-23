<?php

include "../includes/config.php";
include "../includes/session.php";
$ref_id = $_POST['ref_id'];
$query1 = "SELECT * FROM tbl_sale_temp where ref_id='$ref_id' order by temp_id desc";

$result = mysqli_query($conn,$query1);

error_reporting(0);
$output='';
 $i=0;
while($row = mysqli_fetch_array($result) ){
 $i++;
$temp_id = $row['temp_id'];
$item_id = $row['item_id'];
$barcode = $row['barcode'];
$item_serial = $row['item_serial'];
$pur_item_id = $row['pur_item_id'];
$brand_name = $row['brand_name'];
$item_name = $row['item_name'];
$sale_rate = $row['sale_rate'];
$amount = $row['amount'];
$qty = $row['qty'];
$stock = $row['stock'];
$sql_item=mysqli_query($conn, "SELECT * FROM tbl_items where item_id='$item_id'");
$value1 = mysqli_fetch_assoc($sql_item);
$item_name=$value1['item_name'];
$brand_id=$value1['brand_id'];
$category=$value1['category'];
$sql_brand=mysqli_query($conn,"SELECT catagory_name from tbl_cat where id='$category'");
$value2 = mysqli_fetch_assoc($sql_brand);
$brand_name=$value2['catagory_name'];
$output .= '                

                    <tr id="row_'.$i.'">
                        <td><input type="text" name="product_name[]" id="product_name_'.$i.'" tabindex="-1" required readonly class="form-control" value="'.$brand_name." ".$item_name.'"><input type="hidden" name="product[]" id="product_'.$i.'" required readonly class="form-control item_id" value="'.$item_id.'">
                        </td>
                        <td hidden><input type="number" name="item_serial[]" id="item_serial_'.$i.'" required readonly class="form-control" value="'.$item_serial.'"></td>
                    	<td hidden><input type="number" name="barcode[]" id="barcode_'.$i.'" required readonly class="form-control" value="'.$barcode.'"></td>
                    	<td hidden><input type="number" name="pur_item_id[]" id="pur_item_id_'.$i.'" required readonly class="form-control" value="'.$pur_item_id.'"></td>
                    	<td><input type="number" name="qty[]" id="qty_'.$i.'" required class="form-control" onchange="getTotal('.$i.', '.$temp_id.')" value="'.$qty.'"><input type="hidden" name="stock_qty[]" id="stock_qty_'.$i.'"   required class="form-control" value="'.$stock.'"></td>
                    	<td><input type="text" name="rate[]" id="rate_'.$i.'" class="form-control" value="'.$sale_rate.'" onchange="getTotal('.$i.', '.$temp_id.')"></td>
                    	<td><input type="text" name="amount[]" id="amount_'.$i.'" tabindex="-1" class="form-control" readonly tabindex="-1" value="'.$amount.'"></td>
                    	<td><div class="card-toolbar text-right"><a href="#" id="remove_'.$i.'" onclick="removeRow('.$temp_id.')" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt"></i></a></div></td>
                    </tr>';

                  }
 $output.='<input type="hidden" name="ref_id_edit"  id="ref_id_edit" value="'.$ref_id.'">';
echo $output;
?>