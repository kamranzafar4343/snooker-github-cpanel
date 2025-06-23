<?php 
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
session_start();
if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}?>
 <?php 

  $purchase_id=mysqli_real_escape_string($conn,$_GET['purchase_id']);
  $invoice_no="Local_Purchase_".$purchase_id;
  $vendor_id = mysqli_real_escape_string($conn,$_GET['vendor_id']); 
  $created_at = mysqli_real_escape_string($conn,$_GET['created_at']);  
  
   ?>
<html lang="en" >
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets_light/css/main.css">
<link rel="stylesheet" href="assets_light/css/color_skins.css">

<body >

            <div class="row clearfix" >
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                        <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_company ");
                        $data=mysqli_fetch_assoc($sql);
                        $c_name = $data['c_name'];
                        $c_address = $data['c_address'];
                        $c_phone = $data['c_phone'];
                        $c_mobile = $data['c_mobile'];
                        $image = $data['user_profile'];
                 
                        ?>
                        <div class="row">
                            <div class="invoice-top clearfix col-md-12">

                                <div class="logo" style='width: 7%;'>
                                    <img src="<?php echo $image; ?>"  alt="user" class="img-fluid">
                                </div>
                                <div class="info text-right col-md-6" style="margin-top: 1%;" >
                                    <h1><?php echo $c_name;?></h1>
                                    <h3>Local Purchase Ledger</h3>

                                  
                                </div>

                            </div>
                              </div>
                                      <div class="row">
                            <div class="clearfix col-md-12" >
                                <div class="info text-center col-md-12"  >
                                   <p>(<?php echo $c_address;?>)<br><?php echo $c_phone;?></p>
                               </div> </div>
                              </div>
                       
                          
               <?php
                            if($vendors=='All'){
                              $vendornamee="All";
                            }else{
                        $sqll=mysqli_query($conn, "SELECT * FROM tbl_vendors where vendor_id=$vendor_id");
                        $dataa=mysqli_fetch_assoc($sqll);
                        $vendorname = $dataa['username']; }  ?>  

                               <div class="row">
                                   
                            <div class="clearfix text-right col-md-12" >

                            <span > <b>Vendor : </b> <?php echo $vendorname;?>
                       </span></div> </div> 
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                               <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>  
                                                            <th>Trans #</th>
                                                            <th>Purchase #</th>
                                                            <th>Date</th>
                                                            <th>Time</th>           
                                                            <th>Account</th>
                                                            <th style="width: 50%;">Narration</th>
                                                            <th>Debit</th>
                                                            <th>Credit</th>
                                                            <th>Balance</th>
                                                            <th>Edit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                    <?php

                    $sql6=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as opening FROM tbl_trans_detail where created_date < '$created_at' and acode='$vendor_id'");
                      $count=0;
                        while($row=mysqli_fetch_assoc($sql6))
                        {

                        $opening = $row['opening'];
                        if($opening=='')
                        {
                           $opening=0; 
                        }
                    }?>
                        <tr>
                            
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="width: 50%;">Opening Balance</td>
                            <td><h4 class="m-b-0 m-t-10"></td>
                            <td><h4 class="m-b-0 m-t-10"></td>
                            <td><?php echo $opening;?></td>
                            <td></td>
                            </tr>
                                                  
<?php

$sql5=mysqli_query($conn, "SELECT * FROM tbl_trans_detail where invoice_no = '$invoice_no' and acode='$vendor_id'");
                      $count=0;
                        while($row=mysqli_fetch_assoc($sql5))
                        {

                        $invoice_no = $row['invoice_no'];
                        $po=explode('_', $invoice_no);
                        $edit=$po[2];
                       
                        $narration = $row['narration'];
                        $created_date = $row['created_date'];
                        $d_amount = $row['d_amount'];
                        $created_date = $row['created_date'];
                        $time = new DateTime($created_date);
                        $date = $time->format('Y-m-d');
                        $time = $time->format('h:i');
                        // $parent_id = $row['parent_id'];
                        // $installment_number+=$row['installment_number'];
                        // $count++;
                        

                        $query10 = mysqli_query($conn,"SELECT username FROM tbl_vendors where vendor_id=$vendor_id"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query10) ;
                                   $vendor_name=$zdata1['username'];
  
 

      
                                    $acode=$row['left(acode,6)'];
                                    $d_amount=$row['d_amount']; 
                                    $trans_id=$row['trans_id'];
                                    $c_amount=$row['c_amount'];
                                    $narration=$row['narration'];
                                    $acode1=$row['acode'];
                                    

                        $sql=mysqli_query($conn, "SELECT * FROM tbl_account where left(acode,6)=$acode");
                        $data=mysqli_fetch_assoc($sql);
                        $aname = $data['aname'];
                        
                       
                        $sql1=mysqli_query($conn, "SELECT * FROM tbl_account_lv2 where acode=$acode1");
                        $data=mysqli_fetch_assoc($sql1);
                        $aname1 = $data['aname'];
                        $balance_edit=$d_amount-$c_amount;
                        // echo $balance;

$count++;
  ?>
                            <tr>
                            <td><?php echo $trans_id;?></td>
                            <td><?php echo $invoice_no;?></td>
                            <td><?php echo $date;?></td>
                            <td><?php echo $time;?></td>
                            <td><?php echo $aname; if($aname1!=''){?> ( <?php echo $aname1;?> ) <?php }?></td>
                            <td style="width: 50%;"><?php echo $narration;?></td>
                            <td><?php echo $d_amount; $total_damount+=$d_amount;?></td>
                            
                            <td><?php echo $c_amount; $total_camount+=$c_amount;?></td>
                            <td><?php echo $balance=($total_damount-$total_camount); $total_balance+=$balance;?></td>
                            <td>
                                <?php if($balance_edit>0){?>
                                <button type="button" data-toggle="modal" data-target="#edit<?php echo $trans_id;?>" class="btn btn-success waves-effect waves-light update" name="pckg_pin"><i class="icon-pencil"></i></button>
                                <?php }?>
                                <div id="edit<?php echo $trans_id;?>" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                
                                                  <div class="modal-body">
                                                    <form action="operations/loc_pur_edit.php" method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-12">
                                                               
                                              
                                                                <div class="form-row">
                                                             
                                                                    
                                                                 
                                                                   
                                                                 
                                                                   <input type="hidden" name="trans_id" value="<?php echo $trans_id;?>" />
                                                                   <input type="hidden" name="po" value="<?php echo $edit;?>" />
                                                                   
                                                                   <div class="form-group col-md-12"> 
                                                                        <label for="inputState" class="col-form-label"> Old Amount</label>
                                                                        <input type="text" readonly="" name="amount_old" id="deposit_pic" class="form-control" required="" value="<?php echo $d_amount-$c_amount;?>"></input>
                                                     
                                                                    </div>
                                                                    <div class="form-group col-md-12"> 
                                                                        <label for="inputState" class="col-form-label"> Amount </label>
                                                                        <input type="text" name="amount" id="amount" class="form-control" required=""></input>
                                                     
                                                                    </div>
                                                                   
                                                                                                                                    
                                                                </div>
                                                               
                                                             
                                                                <input type="submit"  class="btn btn-primary" name="deposit_details_first" id="submit" value="Send"/>
                                                                <button type="button"  class="btn btn-danger text-center" data-dismiss="modal" id="docmode">Close</button> 
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->                                            
                                                    </form>      
                                                  </div>
                                                </div>
                                            </div>
                                        </div>



                            </td>
                            </tr>
                                                       
                                                      <?php } ?>
                            <tr>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="width: 50%;"><h4 class="m-b-0 m-t-10">Total</h4></td>
                            <td><h4 class="m-b-0 m-t-10"><?php echo $total_damount;?></h4></td>
                            <td><h4 class="m-b-0 m-t-10"><?php echo $total_camount;?></h4></td>
                            <td><h4 class="m-b-0 m-t-10"><?php echo $total_balance=($total_damount-$total_camount)+$opening;?></h4></td>
                            <td></td>
                            </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                   
                                        </div>
                                        <div class="col-md-6 text-right">
                                  
                                                                                   
                                            <h3 class="m-b-0 m-t-10">Balance ( <?php echo $total_balance; ?> )</h3>
                                        </div>                                    
                                        <div class="hidden-print col-md-12 text-right">
                                            <hr>
                                            
                                        </div>
                                    </div>                                    
                                </div>  
                        
                            </div>   
                                            
                          
                            <div class="row clearfix ">
                                <div class="col-md-6 ">
                               
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    
</body>
<!-- Javascript -->
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
</body>
<script type="text/javascript">
$(document).ready(function() {
          $('#example').DataTable({
      dom: 'Bfrtip',
      scrollY: true,
      scrollX: false,
      "paging":   false,
      "ordering": false,
      "info":     false,
      searching: false,
      buttons: [
        
          {
          extend: 'pdf',
          text: 'PDF',
          title: 'Alkareem (General Ledger)',
          orientation: 'landscape',
          text:'<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
          pageSize: 'LEGAL',
          className: 'btn btn-danger',
          customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.styles.tableHeader = {
                           
                           alignment: 'left'
                         }
                      }  
        },
        {
          extend: 'print',
          className: 'btn btn-success',
          titleAttr: 'print',
          text:'<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>', 

          
          title: 'Alkareem (General Ledger)',

          
        },


      ]


    });
} );
</script>
<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
