
<?php
error_reporting(0);
include "../includes/config.php";
include "../includes/session.php";
if($_POST)
{
$item_id=$_POST['itemid'];
$branch=$_POST['branchid'];
}
$output=0;
                                                      if($item_id)
                                                            {
                                                            
                                                                
                                                                $where_items='where item_id="'.$item_id.'"';
                                                               
                                            
                                                            }
                                                            if($branch=='0')
                                                              {

                                                                  $where_branch='';
                                                                
                                                              }
                                                              else
                                                              {

                                                                  $where_branch='where user_id="'.$branch.'"';
                                                             

                                                              }
                                                                      
                                                                $sql=mysqli_query($conn, "SELECT user_privilege,created_by,user_id FROM users  $where_branch");
                                                                $data = mysqli_fetch_assoc($sql);
                                                                $user_privilege=$data['user_privilege'];
                                                                $created_by=$data['created_by'];
                                                                $user_id=$data['user_id'];
                                                                
                                                               if($user_privilege=='branch')
                                                               {
                                                                $created_by=$user_id;
                                                               }
                                                               else
                                                               {
                                                                $created_by=$created_by;
                                                               }

                                                               if($branch=='' || $branch=='1')
                                                                  {

                                                                      $where_created='';
                                                                  }
                                                                  else
                                                                  {
                                                                      $where_created=' and parent_id="'.$created_by.'"';

                                                                  }
                                                                   $date=date('Y-m-d');
                                                       
                                                        $bsql=mysqli_query($conn,"SELECT item_id, item_name
                                                          FROM tbl_items $where_items");
                                                      
                                                     
                                                        $datafound=mysqli_num_rows($bsql);

                                                      
                                                            $count=0;
                                                      while($value = mysqli_fetch_assoc($bsql))   
                                                            {   
                                        
                                                                $itemid=$value['item_id']; 
                                                                $item_name=$value['item_name']; 
                                                                ///////////////////////////////////////////////////// 
                                                                // and created_date='$date'
                                                                //Purchase  ////////////////////////////////////////////////////

                                                                $pur_query=mysqli_query($conn,"SELECT rate, created_date, SUM(qty_rec) as pur_items FROM tbl_purchase_detail where product='$itemid' $where_created");
                                                                $pur_query_value = mysqli_fetch_assoc($pur_query);
                                                                $pur_rate=$pur_query_value['rate']; 
                                                                $pur_items=$pur_query_value['pur_items']; 
                                                                $pur_created_date=$pur_query_value['created_date'];
                                                                $newDate = date("d-m-Y", strtotime($pur_created_date));
                                                                ///////////////////////////////////////////////////// Purchase Return  /////////////////////////////////////////////
                                                                $pur_rtn_query=mysqli_query($conn,"SELECT rate,created_date, SUM(return_qty) as pur_return_items  FROM tbl_purchase_return_detail as pur_return_items where product='$itemid' $where_created");
                                                                $pur_rtn_query_value = mysqli_fetch_assoc($pur_rtn_query);
                                                                $pur_rtn_rate=$pur_rtn_query_value['rate']; 
                                                                $pur_return_items=$pur_rtn_query_value['pur_return_items'];
                                                                $pur_return_date=$pur_rtn_query_value['created_date'];
                                                                if($pur_return_date!='')
                                                                {
                                                                $newDate1 = date("d-m-Y", strtotime($pur_return_date));
                                                                }
                                                                 /////////////////////////////////////////////////////  


                                                                ///////////////////////////////////////////////////// Sale  /////////////////////////////////////////////////////////////
                                                                $sale_query=mysqli_query($conn,"SELECT rate,created_date, SUM(qty) as sale_items FROM tbl_sale_detail  where product='$itemid' $where_created");
                                                                $sale_query_value = mysqli_fetch_assoc($sale_query);
                                                                $sale_rate=$sale_query_value['rate']; 
                                                                $sale_items=$sale_query_value['sale_items'];
                                                                $sale_items_date=$sale_query_value['created_date'];
                                                               
                                                                if($sale_items_date!='')
                                                                {
                                                                $newDate2 = date("d-m-Y", strtotime($sale_items_date));
                                                                }
                                                                ///////////////////////////////////////////////////// Sale Return /////////////////////////////////////////////
                                                                $sale_rtn_query=mysqli_query($conn,"SELECT rate,created_date, SUM(returned_qty) as sale_return_items FROM tbl_sale_return_detail  where product='$itemid' $where_created");
                                                                $sale_rtn_query_value = mysqli_fetch_assoc($sale_rtn_query);
                                                                $sale_rtn_rate=$sale_rtn_query_value['rate']; 
                                                                $sale_rtn_items=$sale_rtn_query_value['sale_return_items'];
                                                                $sale_rtn_date=$sale_rtn_query_value['created_date'];
                                              
                                                                if($sale_rtn_date!='')
                                                                {
                                                                $newDate3 = date("d-m-Y", strtotime($sale_rtn_date));
                                                                }
                                                                
                                                                /////////////////////////////////////////////////////
                                                                ///////////////////////////////////////////////////// Lease  /////////////////////////////////////////////////////////////
                                                                $sale_query=mysqli_query($conn,"SELECT total_price,created_date, count(item_id) as lease_items FROM tbl_installment  where item_id='$itemid' $where_created ");
                                                                $sale_query_value = mysqli_fetch_assoc($sale_query);
                                                                $lease_rate=$sale_query_value['total_price']; 
                                                                $lease_items=$sale_query_value['lease_items'];
                                                                $lease_items_date=$sale_query_value['created_date'];
                                                            
                                                                 if($lease_items_date!='')
                                                                {
                                                                $newDate5 = date("d-m-Y", strtotime($lease_items_date));
                                                                }
                                                                /////////////////////////////////////////////////////////

                                                                ///////////////////////////////////////////////////// Local Purchase  /////////////////////////////////////////////
                                                                $purchase_loc_query=mysqli_query($conn,"SELECT rate,created_date, SUM(qty_rec) as loc_items FROM tbl_single_purchase_detail where product='$itemid' $where_created ");
                                                                $purchase_loc_query_value = mysqli_fetch_assoc($purchase_loc_query);
                                                                $purchase_loc_rate=$purchase_loc_query_value['rate']; 
                                                                $purchase_loc_items=$purchase_loc_query_value['loc_items'];
                                                                $purchase_loc_items_date=$purchase_loc_query_value['created_date'];
                                                         
                                                                 if($purchase_loc_items_date!='')
                                                                {
                                                                $newDate4 = date("d-m-Y", strtotime($purchase_loc_items_date));
                                                                }

                                                                /////////////////////////////////////////////////////////
                                                               

                                                                 if($branch!='0')
                                                                  {
                                                                    
                                                         
                                                                    if($user_privilege!='branch')
                                                                               {

                                                                                $purchase_req_query=mysqli_query($conn,"SELECT rate,created_date,purchase_req_id, SUM(qty_rec) as purchase_req_items FROM tbl_purchase_req_detail where product='$itemid' and trans_parent_id='$userid' $where_created and qty_rec!=''");
                                                                                $purchase_req_query_value = mysqli_fetch_assoc($purchase_req_query);
                                                                                $purchase_req_rate=$purchase_req_query_value['rate']; 
                                                                                $purchase_req_id=$purchase_req_query_value['purchase_req_id']; 
                                                                                $purchase_req_items=$purchase_req_query_value['purchase_req_items'];
                                                                                $purchase_req_items_date=$purchase_req_query_value['created_date']; 
                                                                             
                                                                                  if($purchase_req_items_date!='')
                                                                                  {
                                                                                  $newDate5 = date("d-m-Y", strtotime($purchase_req_items_date));
                                                                                  }
                                                                                $purchase_remarks_query=mysqli_query($conn,"SELECT po_remarks FROM tbl_purchase_req where purchase_req_id='$purchase_req_id'");
                                                                    $purchase_remarks_query_value = mysqli_fetch_assoc($purchase_remarks_query);
                                                                    $po_remarks=$purchase_remarks_query_value['po_remarks']; 
                                                                               }
                                                                               else
                                                                               {

                                                                                $purchase_req_query=mysqli_query($conn,"SELECT rate,created_date,purchase_req_id, SUM(qty_rec) as purchase_req_items FROM tbl_purchase_req_detail where product='$itemid' and created_by='$created_by' $where_created and qty_rec!=''");
                                                                                $purchase_req_query_value = mysqli_fetch_assoc($purchase_req_query);
                                                                                $purchase_req_rate=$purchase_req_query_value['rate']; 
                                                                                $purchase_req_id=$purchase_req_query_value['purchase_req_id']; 
                                                                                $purchase_req_items=$purchase_req_query_value['purchase_req_items'];
                                                                                $purchase_req_items_date=$purchase_req_query_value['created_date']; 
                                                                                if($purchase_req_items_date!='')
                                                                                  {
                                                                                  $newDate5 = date("d-m-Y", strtotime($purchase_req_items_date));
                                                                                  }
                                                                                $purchase_remarks_query=mysqli_query($conn,"SELECT po_remarks FROM tbl_purchase_req where purchase_req_id='$purchase_req_id'");
                                                                    $purchase_remarks_query_value = mysqli_fetch_assoc($purchase_remarks_query);
                                                                    $po_remarks=$purchase_remarks_query_value['po_remarks']; 
                                                                               }
                                                                  }
                                                                  else
                                                                  {

                                                                    $purchase_req_query=mysqli_query($conn,"SELECT rate,created_date, purchase_req_id, SUM(qty_rec) as purchase_req_items FROM tbl_purchase_req_detail where product='$itemid' and qty_rec!=''");
                                                                    $purchase_req_query_value = mysqli_fetch_assoc($purchase_req_query);
                                                                    $purchase_req_rate=$purchase_req_query_value['rate']; 
                                                                    $purchase_req_items=$purchase_req_query_value['purchase_req_items'];
                                                                    $purchase_req_items_date=$purchase_req_query_value['created_date'];
                                                                    if($purchase_req_items_date!='')
                                                                                  {
                                                                                  $newDate5 = date("d-m-Y", strtotime($purchase_req_items_date));
                                                                                  }
                                                                    $purchase_req_id=$purchase_req_query_value['purchase_req_id'];
                                                                    if($purchase_req_rate=='')
                                                                    {
                                                                      $disabled="disabled";
                                                                    }

                                                                    $purchase_remarks_query=mysqli_query($conn,"SELECT po_remarks FROM tbl_purchase_req where purchase_req_id='$purchase_req_id'");
                                                                    $purchase_remarks_query_value = mysqli_fetch_assoc($purchase_remarks_query);
                                                                    $po_remarks=$purchase_remarks_query_value['po_remarks']; 
                                                                    
                                                                  } 
                                                                    /////////////////////////////////////////////////////  Purchase Req /////////////////////////////////////////////
                                                             
                                                                
                                                                
                                                                }
                                                                  
$output .= '
 	  <tr style="background-color: #5dd0dd;">
        <th>Pur Qty</th>
        <th>Pur Rate</th>
        <th>Last Pur Date</th>
        <th></th>
        <th>Details</th>
      </tr>
      <tr>
        <td>'.$pur_items.'</td>
        <td>'.$pur_rate.'</td>
        <td>'.$newDate.'</td>
        <td></td>
        <th><a href="model_report.php?item_id='.$item_id.'" target="_blank"><button type="button" class="btn btn-sm btn-info text-white">Details</button></a></th>
      </tr>
      <tr style="background-color: #62dbb3;">
        <th>Pur Rtn Qty</th>
        <th>Pur Rtn Rate</th>
        <th>Last Pur Rtn Date</th>
        <th></th>
        <th>Details</th>
      </tr>
      <tr>
        <td>'.$pur_return_items.'</td>
        <td>'.$pur_rtn_rate.'</td>
        <td>'.$newDate1.'</td>
        <td></td>
        <th><a href="model_report.php?return_item_id='.$item_id.'" target="_blank"><button type="button" class="btn btn-sm btn-info text-white">Details</button></a></th>
      </tr>

      <tr style="background-color: #d09fea;">
        <th>Sale Qty</th>
        <th>Sale Rate</th>
        <th>Last Sale Date</th>
        <th></th>
        <th>Details</th>
      </tr>
      <tr>
        <td>'.$sale_items.'</td>
        <td>'.$sale_rate.'</td>
        <td>'.$newDate2.'</td>
        <td></td>
        <th><a href="model_report.php?sale_item_id='.$item_id.'" target="_blank"><button type="button" class="btn btn-sm btn-info text-white">Details</button></a></th>
      </tr>
      <tr style="background-color: #87ea7c;">
        <th>Sale Rtn Qty</th>
        <th>Sale Rtn Rate</th>

        <th>Last Sale Rtn Date</th>
        <th></th>
        <th>Details</th>
      </tr>
      <tr>
        <td>'.$sale_rtn_items.'</td>
        <td>'.$sale_rtn_rate.'</td>
        <td>'.$newDate3.'</td>
        <td></td>
        <th><a href="model_report.php?sale_rtn_item_id='.$item_id.'" target="_blank"><button type="button" class="btn btn-sm btn-info text-white">Details</button></a></th>
      </tr>
';



  //echo $purchase_req_id;                                                               
  echo  $output;
                                                                ?>
                                                    