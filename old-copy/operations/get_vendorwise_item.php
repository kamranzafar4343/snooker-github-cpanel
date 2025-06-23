
<?php
error_reporting(0);
include "../includes/config.php";
include "../includes/session.php";
if($_POST)
{
$trans_id=$_POST['trans_id'];
}
$output=0;
$count=0;
$output .= '
    <tr style="background-color: #5dd0dd;">
        <th>Sr #</th>
        <th>Item #</th>
        <th>Brand</th>
        <th>Item Name</th>
        <th>Barcode</th>
        <th>Qty</th>
        <th>Rate</th>
        <th>Amount</th>
        <th>Date</th>

      </tr>';
                                                      if($trans_id)
                                                            {
                                                            
                                                                
                                                                $where_trans='where trans_id="'.$trans_id.'"';
                                                               
                                            
                                                            }
                                                      else
                                                      {
                                                        $where_trans='';
                                                      }
                                                         
                                                        $bsql1=mysqli_query($conn,"SELECT invoice_no FROM tbl_trans $where_trans");      
                                                        $value = mysqli_fetch_assoc($bsql1);
                                                        $invoice_no=$value['invoice_no'];

                                                        $check_purchase=explode('_', $invoice_no);
                                                        $type=$check_purchase[0];
                                                        if($type=='Local')
                                                        {
                                                          $bsql=mysqli_query($conn,"SELECT * FROM tbl_single_purchase_detail where invoice_no='$invoice_no'");
                                                      
                                                        }
                                                        else
                                                        {
                                                          $bsql=mysqli_query($conn,"SELECT * FROM tbl_purchase_detail where invoice_no='$invoice_no'");
                                                        }
                                                        
                                                     
                                                        $datafound=mysqli_num_rows($bsql);

                                                      
                                                            $count=0;
                                                      while($value = mysqli_fetch_assoc($bsql))   
                                                            {   
                                                                $count++;
                                                                $itemid=$value['product']; 
                                                                $item_serial=$value['item_serial']; 
                                                                $pur_item_id=$value['pur_item_id']; 
                                                                $rate=$value['rate'];
                                                                $qty=$value['qty'];
                                                                $amount=$value['amount'];
                                                                $created_date=$value['created_date'];
                                                                if($item_serial!='')
                                                                {
                                                                  $display=$item_serial;
                                                                }
                                                                else
                                                                {
                                                                  $display=$pur_item_id;
                                                                }
                                                                $bsql3=mysqli_query($conn,"SELECT * FROM tbl_items where item_id='$itemid'");      
                                                                $value1 = mysqli_fetch_assoc($bsql3);
                                                                $item_name=$value1['item_name'];
                                                                $brand_id=$value1['brand_id'];
                                                                $category=$value1['category'];
                                                                $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
                                                                $value2 = mysqli_fetch_assoc($sql2);
                                                                $brand_name=$value2['cat_name'];


                                                                $category=$value1['category'];
                                                                  $sql2=mysqli_query($conn,"SELECT catagory_name from tbl_cat where id='$category'");
                                                                                        $value2 = mysqli_fetch_assoc($sql2);
                                                                                        $catagory_name=$value2['catagory_name'];
                                                                
                                                                  
$output .= '

      <tr>
        <td>'.$count.'</td>
        <td>'.$itemid.'</td>
        <td>'.$brand_name.'</td>
        <td>'.$catagory_name." ".$item_name.'</td>
        <td>'.$display.'</td>
        <td>'.$qty.'</td>
        <td>'.$rate.'</td>
        <td>'.$amount.'</td>
        <td>'.$created_date.'</td>
      </tr>
      
';

}

  //echo $purchase_req_id;                                                               
  echo  $output;
                                                                ?>
                                                    