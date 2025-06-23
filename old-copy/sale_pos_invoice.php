       <?php 
                        error_reporting(0);
                        include "includes/config.php";
                        include "includes/session.php";
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_company ");
                        $data=mysqli_fetch_assoc($sql);
                        $c_name = $data['c_name'];
                        $c_address = $data['c_address'];
                        $c_phone = $data['c_phone'];
                        $c_mobile = $data['c_mobile'];
                        $c_email = $data['c_email'];
                        $image = $data['user_profile'];

                        $sql_user=mysqli_query($conn, "SELECT * FROM users where user_id='$userid'");
                        $data=mysqli_fetch_assoc($sql_user);
                        $user_name = $data['user_name'];
                        if(isset($_GET['sale_id']))
                          {

                            $sale_id=mysqli_real_escape_string($conn, $_GET['sale_id']);
                            $sql=mysqli_query($conn, "SELECT * FROM tbl_sale_detail where sale_id=$sale_id");

                        $data_d=mysqli_fetch_assoc($sql);
                        $invoice_no = $data_d['invoice_no'];
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_sale where sale_id=$sale_id");

                        $data=mysqli_fetch_assoc($sql);
                        $customer_name = $data['customer_name'];
                        $customer_by=$data['created_by'];
                        $table_id=$data['table_id'];
                     
                    $sql1=mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$customer_name");
                    $data1=mysqli_fetch_assoc($sql1);
                    $customername=$data1['username'];
                    $client_cnic=$data1['client_cnic'];
                    
                    
                    $query = mysqli_query($conn,"SELECT user_name,created_by FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                  
                                   $created=$zdata['created_by'];

                        $query2 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$created"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query2) ;
                                   $branch_name=$zdata1['user_name'];
                        $query3 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$customer_by"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query3) ;
                                   $customer_from=$zdata1['user_name'];
                        $query4 = mysqli_query($conn,"SELECT table_name FROM tbl_tables where table_id=$table_id"); 
                                   
                                   $zdata2 = mysqli_fetch_assoc($query4) ;
                                   $table_name=$zdata2['table_name'];
                        }
                          $sql_date=mysqli_query($conn,"SELECT created_date from tbl_sale where sale_id='$sale_id'");
                                                  $value2 = mysqli_fetch_assoc($sql_date);
                                                   $created_date=$value2['created_date'];
                                                              $month=date("F", strtotime($created_date));
                                                              $day = date("d",strtotime($created_date));
                                                              $year = date("Y",strtotime($created_date));
                                                              $hour = date("H",strtotime($created_date));
                                                              $min = date("i",strtotime($created_date));
                                                              $a = date("a",strtotime($created_date));

                                      
                        ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <!doctype html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <title>Invoice</title>
                    <base href="#"/>
                    <meta http-equiv="cache-control" content="max-age=0"/>
                    <meta http-equiv="cache-control" content="no-cache"/>
                    <meta http-equiv="expires" content="0"/>
                    <meta http-equiv="pragma" content="no-cache"/>
                    <link rel="icon" href="<?php echo $image; ?>" type="image/x-icon">
                    <link href="assets/dist/styles.css" rel="stylesheet" type="text/css" />
                    <style type="text/css" media="all">
                      @media print {
    .page-break { display: block; page-break-before: always; }
    .buttons-cash { display: none;}
    .logo {display: none; }
      }
                        body { color: #000; }
                        .logo {max-width: 100%;
  height: auto;
  display: block;}
                    
                        #wrapper { max-width: 520px; margin: 0 auto; padding-top: 10px; }
                        .btn { margin-bottom: 5px; }
                        .table { border-radius: 3px; }
                        .table th { background: #f5f5f5; }
                        .table th, .table td { vertical-align: middle !important; }
                        h3 { margin: 5px 0; }

                        @media print {
                            .no-print { display: none; }
                            #wrapper { max-width: 680px; width: 100%; min-width: 250px; margin: 0 auto ; }
                       table {
    }
  border-collapse: collapse;

                    }

/*tr {
 border-bottom:solid #000 !important;
}*/

th, td {
  padding: 6px;
  text-align: left;
 
}   
                    }                      table {
  border-collapse: collapse;

                    }

tr {
}

th, td {
  padding: 6px;
  text-align: left;
 
}
                            
                    
                    
                    </style>
                </head>
                <body>
                
                <div id="wrapper">
                    <div id="receiptData" style="width: auto; max-width: 480px; min-width: 150px; margin: 0 auto;">
                        
                        <div id="receipt-data">
                            <div style="margin-top: -10px;">

                                <div style="clear:both;"></div>
                                <table class="table table-striped table-condensed">
                                  <thead>
                                        <tr>
                                            <th class="text-right " colspan="2" style="border-bottom: 2px solid #ddd;">Invoice # <?php echo $invoice_no; ?></th>
                                            <th class="text-right" style="border-bottom: 2px solid #ddd;">Table # <?php echo $table_name; ?></th>
                                            <th class="text-right" style="border-bottom: 2px solid #ddd;"><?php echo $month." ".$day.", ".$year?> <?php echo date('g:i A ', strtotime($created_date));?></th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <th class="text-left" style="width: 30%; border-bottom: 2px solid #ddd;">Product Name</th>
                                            <th class="text-center" style="width: 12%; border-bottom: 2px solid #ddd;">Qty</th>
                                        
                                      
                                            <th class="text-right" style="width: 34%; border-bottom: 2px solid #ddd;">Price</th>
                                            <th class="text-right" style="width: 36%; border-bottom: 2px solid #ddd;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $sql_detail = mysqli_query($conn,"SELECT * FROM tbl_sale_detail where sale_id='$sale_id'");
                                           while($detail_data = mysqli_fetch_assoc($sql_detail)){
                                            $item_id=$detail_data['product'];
                                            $qty=$detail_data['qty'];
                                            $rate=$detail_data['rate'];
                                            $amount=$detail_data['amount'];
                                           
                                            $sql2=mysqli_query($conn,"SELECT item_name, brand_id from tbl_items where item_id='$item_id'");
                                $value2 = mysqli_fetch_assoc($sql2);

                                $item_name=$value2['item_name'];
                                $brand_id=$value2['brand_id'];
                            $sql3=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
                                $value3 = mysqli_fetch_assoc($sql3);
                                $brand_name=$value3['cat_name'];
                                      ?>
                                    <tr>
                                      <td class="text-left"><?php echo $brand_name;?> <?php echo $item_name;?></td>
                                      <td><?php echo $qty;?></td>
                                      <td class="text-center">Rs <?php echo $rate;?></td>
                                      <td class="text-center">Rs <?php echo $amount;?></td>
                                    </tr>
                                   <?php }?>
                                    <?php 
                                    $sql_main = mysqli_query($conn,"SELECT * FROM tbl_sale where sale_id='$sale_id'");
                                            $main_data = mysqli_fetch_assoc($sql_main);
                                            $discount=$main_data['discount'];
                                            $sale_id=$main_data['sale_id'];
                                            $tax=$main_data['tax'];
                                            $net_amount=$main_data['net_amount'];
                                            $fixed_discount=$main_data['fixed_discount'];
                                            $gross_amount=$main_data['gross_amount'];
                                            $amount_recieved=$main_data['amount_recieved'];
                                            $amount_return=$amount_recieved-$gross_amount;
                                      ?>
                                    <tr style="border-top:solid #000 !important">
                                     <th>Net Amount</th>
                                     <th></th>
                                     <th style="text-align:center"></th>
                                     <th class="text-center">Rs <?php echo round($net_amount);?></th>
                                    </tr>
                                    <tr >
                                    <!-- <?php if($fixed_discount>0){?>
                                    <tr>
                                     <th>Fixed Discount</th>
                                     <th></th>
                                     <th style="text-align:center"></th>
                                     <th class="text-center">Rs <?php echo round($fixed_discount);?></th>
                                    </tr>
                                    <tr >
                                    <?php }?>
                                    <?php if($discount>0){?>
                                     <th> Discount</th>
                                     <th></th>
                                     <th style="text-align:center"></th>
                                     <th class="text-center">Rs <?php echo round($discount);?></th>
                                    </tr>
                                    <?php }?>
                                    <?php if($tax>0){?>
                                    <tr>
                                     <th> Tax</th>
                                     <th></th>
                                     <th style="text-align:center"></th>
                                     <th class="text-center"><?php echo $tax;?>%</th>
                                    </tr>
                                    <?php }?>
                                    <tr>
                                     <th> Grand Total</th>
                                     <th></th>
                                     <th style="text-align:center"></th>
                                     <th class="text-center">Rs <?php echo round($gross_amount);?></th>
                                    </tr>

                                    <tr>
                                     <th> Total Recieved</th>
                                     <th></th>
                                     <th style="text-align:center"></th>
                                     <th class="text-center">Rs <?php echo round($amount_recieved);?></th>
                                    </tr>
                                    <?php if($amount_return>0){?>
                                   <tr>
                                     <th> Total Returned</th>
                                     <th></th>
                                     <th style="text-align:center"></th>
                                     <th class="text-center">Rs <?php echo round($amount_return);?></th>
                                    </tr>
                                    <?php }?> -->
                                    </tbody>
                                  
                                </table>
                                
                                <!-- <div class="well well-sm"  style="padding-top: 0px;margin-top:5px;">
                                    <div style="text-align: center;"><br>Thanks For Shopping</div>
                                    <div style="text-align: center;">Developed by <strong>Logix'199</strong><br>03067990000</div>
                                </div> -->

                            </div>
                            <div style="clear:both;"></div>
                        </div>

                        <!-- start -->
                        <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
                            <hr>
                           
                            <span class="col-xs-12">
                              <a class="btn btn-block btn-primary" href="#" onclick="window.print();">print</a>
                              <a  href="pos_sale_invoice.php?sale_id=<?php echo $sale_id;?>" class="btn btn-block btn-success" title='Print'>Full Print</a>
                                <a class="btn btn-block btn-warning" href="pos.php">back to pos</a>
                            </span>
                         
                            <div style="clear:both;"></div>
                        </div>
                        <!-- end -->
                    </div>
                </div>
                <!-- start -->
                
            
                </div>
            </div>
        </div>

    </body>
    </html>
