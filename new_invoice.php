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
                        $sale_id=$_GET['sale_id'];
                        
                 
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
                    <link rel="shortcut icon" href="#"/>
                    <link href="assets/dist/styles.css" rel="stylesheet" type="text/css" />
                    <style type="text/css" media="all">
                        body { color: #000; }
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
  border-collapse: collapse;

                    }

tr {
 border-bottom:solid #000 !important;
}

th, td {
  padding: 6px;
  text-align: left;
 
}   
                    }
                      table {
  border-collapse: collapse;

                    }

tr {
}

th, td {
  padding: 6px;
  text-align: left;
 
}
                            .text-right { text-align: left; }
                            .text-left { text-align: right; }
                            tfoot tr th:first-child { text-align: left; }
                       
                            tfoot tr th:first-child { text-align: right; }
                    
                    
                    </style>
                </head>
                <body>
                
                <div id="wrapper">
                    <div id="receiptData" style="width: auto; max-width: 480px; min-width: 150px; margin: 0 auto;">
                        
                        <div id="receipt-data">
                            <div>

                                <div style="text-align:center;">
                                   <img src="<?php echo $image;?>" alt="<?php echo $c_name;?>" style="max-width: 100px;">
                                    <p style="text-align:center;">
                                    <h3><strong><?php echo $c_name;?></strong></h3>
                                    <?php echo $c_address;?>
                                    </p>
                                    <p><?php echo $c_mobile;?></p>
                                   
                                </div>
                             <div style="">
                            <div>
                                <h7  style="margin-right:40%;" >
                                  <?php
                                  $sql_date=mysqli_query($conn,"SELECT created_date from tbl_sale_detail where sale_id='$sale_id'");
                                              $value2 = mysqli_fetch_assoc($sql_date);
                                               $created_date=$value2['created_date'];
                                                          $month=date("F", strtotime($created_date));
                                                          $day = date("d",strtotime($created_date));
                                                          $year = date("Y",strtotime($created_date));
                                  ?>
                                    <?php echo $month." ".$day.", ".$year?>
                                   
                                </h7>
                              <h7>
                                   id<br>
                                </h7>
                             </div> <div>
                              <h7 style="margin-right:30%;">
                                    customer_name
                                </h7>
                              <h7 >
                                  created_by-first_name created_by-last_name<br>
                                  sales_person customer-user_name <br>
                                
                                </h7>
                             </div>
                             </div>
                                <div style="clear:both;"></div>
                                <table class="table table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50%; border-bottom: 2px solid #ddd;">Product Name</th>
                                            <th class="text-center" style="width: 12%; border-bottom: 2px solid #ddd;">Qty</th>
                                        
                                      
                                            <th class="text-center" style="width: 24%; border-bottom: 2px solid #ddd;">Price</th>
                                            <th class="text-center" style="width: 26%; border-bottom: 2px solid #ddd;">subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                      <td>Item</td>
                                      <td>1</td>
                                      <td>0.0</td>
                                      <td>0.0</td>
                                      <td>price</td>
                                      <td>total</td>
                                    </tr>
                                   
                                    <tr><th> Grand Total</th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th style="text-align:center"></th>
                                     <th>amount</th>
                                    </tr>

                                    <tr><th> Total Paid</th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th style="text-align:center"></th>
                                     <th>amount</th>
                                    </tr>

                                    <tr><th> Return Amount</th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th style="text-align:center"></th>
                                     <th>amount</th>
                                    </tr>
                                    
                                    </tbody>
                                  
                                </table>
                                
                               

                                <div class="well well-sm"  style="padding-top: 0px;margin-top:5px;">
                                    <div style="text-align: center;">Developed by <strong>Logix'199</strong><br>03067990000</div>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>

                        <!-- start -->
                        <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
                            <hr>
                            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                <div class="btn-group" role="group">
                                    <a href="#" id="print" class="btn btn-block btn-primary">print</a>
                                    <button onclick="window.print();" class="btn btn-block btn-primary">print</button>
                                    <button onclick="return printReceipt()" class="btn btn-block btn-primary">print</button>
                                </div>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-block btn-success" href="#" id="email">email</a>
                                </div>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                                </div>
                            </div>
                            
                            <span class="col-xs-12">
                                <a href="#"  class="btn btn-block bg-lime "  ><p style="color:black">Print Modify</p></a>
                                <a class="btn btn-block btn-warning" href="#">back_to_pos</a>
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
