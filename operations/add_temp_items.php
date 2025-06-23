<?php

include "../includes/config.php";
include "../includes/session.php";

$item_id = $_POST['item_id'];
$barcode = $_POST['barcode'];
$item_serial = $_POST['item_serial'];
$pur_item_id = $_POST['pur_item_id'];
$sale_rate = $_POST['sale_rate'];
$ref_id = $_POST['ref_id'];
$qty = 1;
$stock = $_POST['stock'];
$customer = $_POST['customer'];
$sales_men = $_POST['sales_men'];
$sql_selling = mysqli_query($conn, "SELECT over_selling FROM tbl_company");
$data_selling = mysqli_fetch_assoc($sql_selling);
$over_selling = $data_selling['over_selling'];
$created_by = $userid;
$sql_check = mysqli_query($conn, "SELECT * FROM tbl_sale_temp where ref_id='$ref_id' and item_id='$item_id' and user_id='$created_by'");

if (mysqli_num_rows($sql_check) > 0) {

   $sql_qty = mysqli_query($conn, "SELECT * FROM tbl_sale_temp where ref_id='$ref_id' and item_id='$item_id' and user_id='$created_by' order by temp_id desc");
   $data = mysqli_fetch_assoc($sql_qty);
   $qty = $data['qty'];
   $qty++;
   $sale_rate = $data['sale_rate'];
   $stock = $data['stock'];
   $amount = round($sale_rate * $qty);
   if ($over_selling == '0') {
      if ($qty > $stock) {
         $query1 = "SELECT * FROM tbl_sale_temp where ref_id='$ref_id' order by temp_id desc";

         $result = mysqli_query($conn, $query1);

         error_reporting(0);

         $i = 0;
         while ($row = mysqli_fetch_array($result)) {
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

            $sql_item = mysqli_query($conn, "SELECT * FROM tbl_items where item_id='$item_id'");
            $value1 = mysqli_fetch_assoc($sql_item);
            $item_name = $value1['item_name'];
            $category = $value1['category'];
            $brand_id = $value1['brand_id'];
            $retail = $value1['retail'];
            $mini_wholesale = $value1['mini_wholesale'];
            $wholesale = $value1['wholesale'];
            $type_a = $value1['type_a'];
            $type_b = $value1['type_b'];
            $type_c = $value1['type_c'];


            $sql_brand = mysqli_query($conn, "SELECT catagory_name from tbl_cat where id='$category'");
            $value2 = mysqli_fetch_assoc($sql_brand);
            $brand_name = $value2['catagory_name'];


            $sql_customer = mysqli_query($conn, "SELECT customer_type,fixed_discount FROM tbl_customer where customer_id='$customer'");
            $value3 = mysqli_fetch_assoc($sql_customer);
            $customer_type = $value3['customer_type'];
            $fixed_discount = $value3['fixed_discount'];
            if ($fixed_discount == '') {
               $fixed_discount = 0;
            }
            if ($customer_type == '1') {
               $sale_rate = $retail;
            } else if ($customer_type == '2') {
               $sale_rate = $mini_wholesale;
            } else if ($customer_type == '3') {
               $sale_rate = $wholesale;
            } else if ($customer_type == '4') {
               $sale_rate = $type_a;
            } else if ($customer_type == '5') {
               $sale_rate = $type_b;
            } else if ($customer_type == '6') {
               $sale_rate = $type_c;
            }

            if ($sale_rate == '') {
               $sale_rate = $retail;
            }


            echo ' 
                    <tr id="row_' . $i . '">
                        <td><input type="text" style="font-size: 16px; font-weight: 700; font-family: sans-serif;" name="product_name[]" id="product_name_' . $i . '" tabindex="-1" required readonly class="form-control" value="' . $brand_name . " " . $item_name . '"><input type="hidden" name="product[]" id="product_' . $i . '" required readonly class="form-control item_id" value="' . $item_id . '">
                        <input type="hidden"  name="stock_empty" id="stock_empty"  required readonly class="form-control" value="0">
                        <input type="hidden" name="fixed_discount" id="fixed_discount"  required readonly class="form-control" value="' . $fixed_discount . '">
                        </td>
                        <td hidden><input type="number" name="item_serial[]" id="item_serial_' . $i . '"  required readonly class="form-control" value="' . $item_serial . '"></td>
                    	<td hidden><input type="number" name="barcode[]" id="barcode_' . $i . '" required readonly class="form-control" value="' . $barcode . '"></td>
                    	<td hidden><input type="number" name="pur_item_id[]" id="pur_item_id_' . $i . '" required readonly class="form-control" value="' . $pur_item_id . '"></td>
                    	<td><input type="number" name="qty[]" style="font-size: 16px; font-weight: 700; font-family: sans-serif;" id="qty_' . $i . '" required class="form-control" onchange="getTotal(' . $i . ', ' . $temp_id . ')" value="' . $qty . '"><input type="hidden" name="stock_qty[]" id="stock_qty_' . $i . '"   required class="form-control" value="' . $stock . '"></td>
                    	<td><input type="text" name="rate[]" style="font-size: 16px; font-weight: 700;  font-family: sans-serif;" required readonly id="rate_' . $i . '"  class="form-control" value="' . $sale_rate . '" onchange="getTotal(' . $i . ', ' . $temp_id . ')"></td>
                    	<td><input type="text" name="amount[]" style="font-size: 16px; font-weight: 700; font-family: sans-serif;" id="amount_' . $i . '" tabindex="-1" class="form-control" readonly tabindex="-1" value="' . $amount . '"></td>
                    	<td><div class="card-toolbar" style="font-size: 16px; font-weight: 700; text-right"><a href="#" id="remove_' . $i . '" onclick="removeRow(' . $temp_id . ')" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt"></i></a></div></td>
                    </tr>';
         }
         exit();
      }
   }
   $sql_check = mysqli_query($conn, "UPDATE tbl_sale_temp SET qty='$qty', amount='$amount', stock='$stock' where ref_id='$ref_id' and item_id='$item_id' and user_id='$created_by'");
} else {
   $sql_item = mysqli_query($conn, "SELECT * FROM tbl_items where item_id='$item_id'");
   $value1 = mysqli_fetch_assoc($sql_item);
   $item_name = $value1['item_name'];
   $category = $value1['category'];
   $retail = $value1['retail'];
   $mini_wholesale = $value1['mini_wholesale'];
   $wholesale = $value1['wholesale'];
   $type_a = $value1['type_a'];
   $type_b = $value1['type_b'];
   $type_c = $value1['type_c'];


   $sql_brand = mysqli_query($conn, "SELECT catagory_name from tbl_cat where id='$category'");
   $value2 = mysqli_fetch_assoc($sql_brand);
   $brand_name = $value2['catagory_name'];
   $sql_customer = mysqli_query($conn, "SELECT customer_type,fixed_discount FROM tbl_customer where customer_id='$customer'");
   $value3 = mysqli_fetch_assoc($sql_customer);
   $customer_type = $value3['customer_type'];
   $fixed_discount = $value3['fixed_discount'];
   if ($fixed_discount == '') {
      $fixed_discount = 0;
   }
   if ($customer_type == '1') {
      $sale_rate = $retail;
   } else if ($customer_type == '2') {
      $sale_rate = $mini_wholesale;
   } else if ($customer_type == '3') {
      $sale_rate = $wholesale;
   } else if ($customer_type == '4') {
      $sale_rate = $type_a;
   } else if ($customer_type == '5') {
      $sale_rate = $type_b;
   } else if ($customer_type == '6') {
      $sale_rate = $type_c;
   }

   if ($sale_rate == '') {
      $sale_rate = $retail;
   }

   $sql = mysqli_query($conn, "INSERT INTO tbl_sale_temp(ref_id, customer, sales_men,  item_id, barcode, item_serial, pur_item_id, qty, sale_rate, amount, stock, user_id) VALUES ('$ref_id', '$customer', '$sales_men', '$item_id', '$barcode', '$item_serial', '$pur_item_id', '$qty', '$sale_rate', '$sale_rate', '$stock', '$created_by')");
}

$query1 = "SELECT * FROM tbl_sale_temp where ref_id='$ref_id' order by temp_id desc";

$result = mysqli_query($conn, $query1);

error_reporting(0);

$i = 0;
while ($row = mysqli_fetch_array($result)) {
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
   $sql_item = mysqli_query($conn, "SELECT * FROM tbl_items where item_id='$item_id'");
   $value1 = mysqli_fetch_assoc($sql_item);
   $item_name = $value1['item_name'];
   $category = $value1['category'];
   $sql_brand = mysqli_query($conn, "SELECT catagory_name from tbl_cat where id='$category'");
   $value2 = mysqli_fetch_assoc($sql_brand);
   $brand_name = $value2['catagory_name'];
   $sql_customer = mysqli_query($conn, "SELECT customer_type,fixed_discount FROM tbl_customer where customer_id='$customer'");
   $value3 = mysqli_fetch_assoc($sql_customer);
   $customer_type = $value3['customer_type'];
   $fixed_discount = $value3['fixed_discount'];
   if ($fixed_discount == '') {
      $fixed_discount = 0;
   }
   echo '                

                    <tr id="row_' . $i . '">
                        <td><input type="text" name="product_name[]" style="font-size: 16px; font-weight: 700; font-family: sans-serif;" id="product_name_' . $i . '" tabindex="-1" required readonly class="form-control" value="' . $brand_name . " " . $item_name . '"><input type="hidden" name="product[]" id="product_' . $i . '" required readonly class="form-control item_id" value="' . $item_id . '">
                        <input type="hidden" name="stock_empty" id="stock_empty"  required readonly class="form-control" value="1">
                        <input type="hidden" name="fixed_discount" id="fixed_discount"  required readonly class="form-control" value="' . $fixed_discount . '">
                        </td>
                        <td hidden><input type="number" name="item_serial[]" id="item_serial_' . $i . '" required readonly class="form-control" value="' . $item_serial . '"></td>
                    	<td hidden><input type="number" name="barcode[]" id="barcode_' . $i . '" required readonly class="form-control" value="' . $barcode . '"></td>
                    	<td hidden><input type="number" name="pur_item_id[]" id="pur_item_id_' . $i . '" required readonly class="form-control" value="' . $pur_item_id . '"></td>
                    	<td><input type="number" name="qty[]" style="font-size: 16px; font-weight: 700; font-family: sans-serif;" id="qty_' . $i . '" required class="form-control" onchange="getTotal(' . $i . ', ' . $temp_id . ')" value="' . $qty . '"><input type="hidden" name="stock_qty[]" id="stock_qty_' . $i . '"   required class="form-control" value="' . $stock . '"></td>
                    	<td><input type="text" name="rate[]" style="font-size: 16px;  font-weight: 700; font-family: sans-serif;" required readonly id="rate_' . $i . '" class="form-control" value="' . $sale_rate . '" onchange="getTotal(' . $i . ', ' . $temp_id . ')"></td>
                    	<td><input type="text" name="amount[]" style="font-size: 16px; font-weight: 700; font-family: sans-serif;" id="amount_' . $i . '" tabindex="-1" class="form-control" readonly tabindex="-1" value="' . $amount . '"></td>
                    	<td><div class="card-toolbar text-right"><a href="#" id="remove_' . $i . '" onclick="removeRow(' . $temp_id . ')" class="confirm-delete" title="Delete"><i class="fas fa-trash-alt" style="font-size: 25px;"></i></a></div></td>
                    </tr>';
}
