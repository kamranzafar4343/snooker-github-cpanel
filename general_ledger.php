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

if($_POST)
{
  $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
  $parent_code=mysqli_real_escape_string($conn,$_POST['parent_code']);
  $sub_child1=mysqli_real_escape_string($conn,$_POST['sub_child1']);
  $sub_child2=mysqli_real_escape_string($conn,$_POST['sub_child2']);

}
else
{
    $f_date=date('Y-m-d');
    $t_date=date('Y-m-d');
    $parent_code="ALL";
    $sub_child1="ALL";
    $sub_child2="ALL";
}
if($parent_code=='ALL' && $sub_child1=='ALL' && $sub_child2=='ALL')
{
    $where_acode='';
    $where_acode_opening='';
    
}
else if($parent_code!='ALL' && $sub_child1=='ALL' && $sub_child2=='ALL')
{
    $acode=substr($parent_code, 0, -6);
    $where_acode='and left(acode, 3)="'.$acode.'"';
    $where_aname='tbl_head where acode="'.$parent_code.'"';
    $where_acode_opening='tbl_account where parent_code="'.$parent_code.'"';
    $where_acode_opening1='tbl_account_lv2 where parent_code="'.$parent_code.'"';
}
else if($parent_code!='ALL' && $sub_child1!='ALL' && $sub_child2=='ALL')
{
    // Don't use $sub_child1 to match exact if you want children — decide what you want
    // Option A: Match exact
    $where_acode = 'and acode="'.$sub_child1.'"';

    // Option B: Match children under sub_child1 (assuming 9-digit format)
    // $prefix = substr($sub_child1, 0, 6);
    // $where_acode = 'and left(acode, 6)="'.$prefix.'"';

    $where_aname='tbl_account where acode="'.$sub_child1.'"';
    $where_acode_opening='tbl_account where acode="'.$sub_child1.'"';
    $where_acode_opening1='tbl_account_lv2 where sub_child1="'.$sub_child1.'"';
}
else
{
    $acode=substr($sub_child2, 0, -3);
    $where_acode='and acode="'.$sub_child2.'"';
    $where_aname='tbl_account_lv2 where acode="'.$sub_child2.'"';
    $where_acode_opening='tbl_account_lv2 where acode="'.$sub_child2.'"';

}

$query = "SELECT * FROM tbl_account WHERE 1=1 $where_acode";
echo $query;
?>
<html lang="en" >
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets_light/css/main.css">
<link rel="stylesheet" href="assets_light/css/color_skins.css">

<body style="background-color: #a8abaa;">
    <br><br>
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
                                    <h3>General Ledger</h3>

                                  
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
              

              if(isset($_GET['data']) && $_GET['data']=='notfound'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry ! </strong>No Record Found !.
</div>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#danger-alert").hide();

    $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#danger-alert").slideUp(500);
    });
  });
    </script>
            
              <?php
              } ?>

                         <form  action="general_ledger_report.php" method="post" enctype="multipart/form-data">
                        <div class="body">
                            <div class="row clearfix">
                                
                                <div class="col-md-4 col-sm-12">
                                    <label>Account Type </label>
                                    <div class="form-group">
                                       <select class="form-control select_group" name="parent_code" id="parent_code" onchange="getsublev()">
                                        <option selected="selected" value="ALL">ALL</option>
                                        <?php

                                        $sql="SELECT * FROM tbl_head"; 


                                        foreach ($conn->query($sql) as $row){

                                        if($row['acode']==$parent_code){

                                        echo "<option value=$row[acode] selected>$row[aname]</option>"; 

                                        }else{

                                        echo "<option value=$row[acode]>$row[aname]</option>"; 

                                        }

                                        }

                                         echo "</select>";
                                         ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-12">
                                    <label   for="description">Head </label>
                                    <div class="form-group">
                                        <select class=" form-control select_group"  id="sub_child1" name='sub_child1' style="width: 100%;" onchange="getsublev1();">
                                            <option selected value="">Select Sub Head Lv 1</option>
                                      
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                   <label   for="description">Sub Head </label>
                                    <div class="form-group" >
                                       <select class=" form-control select_group"  id="sub_child2" name='sub_child2' style="width: 100%;">
                                            <option selected value="">Select Sub Head Lv 2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                
                              <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label   for="description">From Date </label>
                                        <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $f_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                              <div class="col-md-4">
                                     <label for="description">To Date </label>
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="t_date" name="t_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $t_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                   
                                    <div class="form-group" style="margin-top: 10%;">
                                        <button style="width:100%; " type="submit" class="btn btn-sm btn-dark" name="search">Search</button>
                                       
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                   
                                    <div class="form-group" style="margin-top: 10%;">
                                        <a  href="index.php">
                                        <button style="width:100%; " type="button" class="btn btn-sm btn-danger" name="back">Back</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
<?php 

if($parent_code!='ALL'){?>
            <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * -1.5);
    padding-left: calc(var(--bs-gutter-x) * -1.5);">
               
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
                                <div class="info text-center col-md-12" style="margin-top: 1%;" >
                                    <h1><?php  $sqll=mysqli_query($conn, "SELECT aname FROM $where_aname");
                                        $dataa=mysqli_fetch_assoc($sqll);
                                        $aname = $dataa['aname'];
                                        echo $aname;?></h1>
                                </div>
                            </div>
                        </div>
            
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                               <table id="example" class="display example" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>  
                                                            <th>Trans #</th>
                                                            <th>Invoice #</th>
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

                    $sql6=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as opening FROM tbl_trans_detail where created_date < '$f_date' $where_acode");
           
                        while($row=mysqli_fetch_assoc($sql6))
                        {

                        $opening = $row['opening'];
                        if($opening=='')
                        {
                           $opening=0; 
                        }
                    }
       
                    $sql7=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM $where_acode_opening");
                     
                        while($row=mysqli_fetch_assoc($sql7))
                        {

                        $opening_bal = $row['opening_bal'];
                        if($opening_bal=='')
                        {
                           $opening_bal=0; 
                        }
                    }
                    if($sub_child2!='All'){
            
                     $sql9=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal1 FROM $where_acode_opening1");
                     
                        while($row=mysqli_fetch_assoc($sql9))
                        {

                        $opening_bal1 = $row['opening_bal1'];
                        if($opening_bal1=='')
                        {
                           $opening_bal1=0; 
                        }
                    }
                    }
                    $total_opening=round($opening_bal+$opening+$opening_bal1);
                    ?>
                        <tr>
                            
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="width: 50%;">Opening Balance</td>
                            <td><h4 class="m-b-0 m-t-10"></td>
                            <td><h4 class="m-b-0 m-t-10"></td>
                            <td><?php echo $total_opening;?></td>
                            <td></td>
                            </tr>
                                                  
<?php

$sql5=mysqli_query($conn, "SELECT * FROM tbl_trans_detail where DATE(created_date) BETWEEN '$f_date' and '$t_date' $where_acode");
                      $count=0;
                        while($row=mysqli_fetch_assoc($sql5))
                        {

                        $invoice_no = $row['invoice_no'];
                        $po=explode('_', $invoice_no);
                        $edit=$po[1];
                       
                        $narration = $row['narration'];
                        $created_date = $row['created_date'];
                        $d_amount = $row['d_amount'];
                        $created_date = $row['created_date'];
                        $newdate = date("d-m-Y", strtotime($created_date));
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
                                    
                        
                        $sql10=mysqli_query($conn, "SELECT * FROM tbl_account where acode='$acode1'");
                        $data=mysqli_fetch_assoc($sql10);
                        $aname = $data['aname'];
                        if($aname=='')
                        {
                        $sql11=mysqli_query($conn, "SELECT * FROM tbl_account_lv2 where acode='$acode1'");
                        $data=mysqli_fetch_assoc($sql11);
                        $aname = $data['aname'];
                        }   
                        $balance_edit=$d_amount-$c_amount;
                        

$count++;
  ?>
                            <tr>
                            <td><?php echo $trans_id;?></td>
                            <td><a href="edit_ledger.php?invoice_no=<?php echo $invoice_no;?>&acode=<?php echo $acode1;?>&created_at=<?php echo $date;?>" target="_blank"><?php echo $invoice_no;?></a></td>
                            <td><?php echo $newdate;?></td>
                            <td><?php echo $time;?></td>
                            <td><a href="single_ledger.php?invoice=<?php echo $invoice_no;?>&acode=<?php echo $acode1;?>&f_date=<?php echo $f_date;?>&t_date=<?php echo $t_date;?>" target="_blank"><?php echo $aname; ?></a></td>
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
                                                    <form action="operations/purchase_edit.php" method="post" enctype="multipart/form-data">
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
                            <td><h4 class="m-b-0 m-t-10"><?php echo $total_balance=($total_damount-$total_camount)+$total_opening;?></h4></td>
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
<?php } else { ?>
            <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * -1.5);padding-left: calc(var(--bs-gutter-x) * -1.5);">
               <?php 
                        error_reporting(0);
                     
                        $sql0=mysqli_query($conn, "SELECT * FROM tbl_head");
                        while($data=mysqli_fetch_assoc($sql0)){
                            $total_damount=0;
                        $total_camount=0;
                        $balance=0;
                        $total_balance=0;
                             $main_account = $data['aname'];
                             $parent_code1= $data['acode'];
                             $acode=substr($parent_code1, 0, -6);
                             if($parent_code=='ALL')
                             {
                                $where_acode='and left(acode, 3)="'.$acode.'"';
                                
                             }
                             $where_acode_opening='tbl_account where parent_code="'.$parent_code1.'"';
                             $where_acode_opening1='tbl_account_lv2 where parent_code="'.$parent_code1.'"';
                ?>
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                        <?php if($POST){
                            if($vendors=='All'){
                              $vendornamee="All";
                            }else{
                              
                        $sqll=mysqli_query($conn, "SELECT aname FROM $where_aname");
                        $dataa=mysqli_fetch_assoc($sqll);
                        $aname = $dataa['aname']; } } else {
                            $account_name=$main_account;

                        }  ?> 
                        <div class="row">
                            <div class="invoice-top clearfix col-md-12">
                                <div class="info text-center col-md-12" style="margin-top: 1%;" >
                                    <h1><?php echo $account_name;?></h1>
                                </div>

                            </div>
                        </div>
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                               <table id="example" class="display example" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>  
                                                            <th>Trans #</th>
                                                            <th>Invoice #</th>
                                                            <th>Date</th>
                                                            <th>Time</th>           
                                                            <th>Account</th>
                                                            <th style="width: 50%;">Narration</th>
                                                            <th>Debit</th>
                                                            <th>Credit</th>
                                                            <th>Balance</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                    <?php
                    
                    $sql6=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as opening FROM tbl_trans_detail where DATE(created_date) < '$f_date' $where_acode");
           
                        while($row=mysqli_fetch_assoc($sql6))
                        {

                        $opening = $row['opening'];
                        if($opening=='')
                        {
                           $opening=0; 
                        }
                    }
                    
                    $sql7=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM $where_acode_opening");
                     
                        while($row=mysqli_fetch_assoc($sql7))
                        {

                        $opening_bal = $row['opening_bal'];
                        if($opening_bal=='')
                        {
                           $opening_bal=0; 
                        }
                    }
                    if($sub_child2!='All'){
            
                     $sql9=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal1 FROM $where_acode_opening1");
                     
                        while($row=mysqli_fetch_assoc($sql9))
                        {

                        $opening_bal1 = $row['opening_bal1'];
                        if($opening_bal1=='')
                        {
                           $opening_bal1=0; 
                        }
                    }
                    }
                    $total_opening=round($opening_bal+$opening+$opening_bal1);
                    ?>
                        <tr>
                            
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="width: 50%;">Opening Balance</td>
                            <td><h4 class="m-b-0 m-t-10"></td>
                            <td><h4 class="m-b-0 m-t-10"></td>
                            <td><?php echo $total_opening;?></td>
                           
                            </tr>
                                                  
<?php

$sql5=mysqli_query($conn, "SELECT * FROM tbl_trans_detail where DATE(created_date) BETWEEN '$f_date' and '$t_date' $where_acode");
                      $count=0;
                        while($row=mysqli_fetch_assoc($sql5))
                        {

                        $invoice_no = $row['invoice_no'];
                        $po=explode('_', $invoice_no);
                        $edit=$po[1];
                       
                        $narration = $row['narration'];
                        $created_date = $row['created_date'];
                        $d_amount = $row['d_amount'];
                        $created_date = $row['created_date'];
                        $newdate = date("d-m-Y", strtotime($created_date));
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
                                    
                        
                        $sql10=mysqli_query($conn, "SELECT * FROM tbl_account where acode='$acode1'");
                        $data=mysqli_fetch_assoc($sql10);
                        $aname = $data['aname'];
                        if($aname=='')
                        {
                        $sql11=mysqli_query($conn, "SELECT * FROM tbl_account_lv2 where acode='$acode1'");
                        $data=mysqli_fetch_assoc($sql11);
                        $aname = $data['aname'];
                        }   
                        $balance_edit=$d_amount-$c_amount;

                        

$count++;
  ?>
                            <tr>
                            <td><?php echo $trans_id;?></td>
                            <td><a href="edit_ledger.php?invoice_no=<?php echo $invoice_no;?>&acode=<?php echo $acode1;?>&created_at=<?php echo $date;?>" target="_blank"><?php echo $invoice_no;?></a></td>
                            <td><?php echo $newdate;?></td>
                            <td><?php echo $time;?></td>
                            <td><a href="single_ledger.php?invoice=<?php echo $invoice_no;?>&acode=<?php echo $acode1;?>&f_date=<?php echo $f_date;?>&t_date=<?php echo $t_date;?>" target="_blank"><?php echo $aname; ?></a></td>
                            <td style="width: 50%;"><?php echo $narration;?></td>
                            <td><?php echo $d_amount; $total_damount+=$d_amount;?></td>
                            
                            <td><?php echo $c_amount; $total_camount+=$c_amount;?></td>
                            <td><?php echo $balance=($total_damount-$total_camount); $total_balance+=$balance;?></td>
                           
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
                            <td><h4 class="m-b-0 m-t-10"><?php echo $total_balance=($total_damount-$total_camount)+$total_opening;?></h4></td>
                        
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
                 <?php }?> 
                    </div>
                    <?php }  ?>
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
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>

</body>
<script type="text/javascript">
              $(function() {
  $(".select_group").select2();
  });
  getsublev();
            function getsublev(){

    var parent_code = $('#parent_code').val();

      $.ajax({
                  method: "POST",
                  url: "operations/get_sublevel.php",
                  data: {parent_code:parent_code},
                  dataType: 'json',                 
                })
                .done(function(response){
                   var len = response.length;
                 
                     $("#sub_child1").empty();
                     $("#sub_child1").append("<option value='ALL'>ALL</option>");
                        for( var i = 0; i<len; i++){
                            var acode = response[i]['acode'];
                            var aname = response[i]['aname'];

                            $("#sub_child1").append("<option value='"+acode+"'>"+aname+"</option>");

                        }
    
                     getsublev1();
                });


}
            function getsublev1(){

    var sub_child1 = $('#sub_child1').val();

      $.ajax({
                  method: "POST",
                  url: "operations/get_sublevel1.php",
                  data: {sub_child1:sub_child1},
                  dataType: 'json',                 
                })
                .done(function(response){
                   var len = response.length;
                 
                     $("#sub_child2").empty();
                     $("#sub_child2").append("<option value='ALL'>ALL</option>");
                        for( var i = 0; i<len; i++){
                            var acode = response[i]['acode'];
                            var aname = response[i]['aname'];

                            $("#sub_child2").append("<option value='"+acode+"'>"+aname+"</option>");

                        }
    
                    
                });


}


</script>
<script type="text/javascript">
$(document).ready(function() {

          $('.example').DataTable({
      dom: 'Bfrtip',
      scrollY: true,
      scrollX: false,
      "paging":   false,
      "ordering": false,
      "info":     false,
      searching: true,
     buttons: [
    {
        text: '<span class="text-default"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
        title: '<?php echo $c_name;?> (General Ledger)',
        extend: 'pdfHtml5',
    message: '<?php if($_POST){echo $aname;}?> \n Created at : (<?php echo date('m/d/Y h:i:s a', time());?>)',
    orientation: 'landscape',
    exportOptions: {
                    columns: [ 1, 2, 4, 5, 6, 7, 8 ]
                },
    
    customize: function (doc) {
        doc.pageMargins = [10,10,10,10];
        doc.defaultStyle.fontSize = 7;
        doc.styles.tableHeader.fontSize = 7;
        doc.styles.title.fontSize = 9;
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();
        // Create a footer
        doc['footer']=(function(page, pages) {
            return {
                columns: [
                    'This is your left footer column',
                    {
                        // This is the right column
                        alignment: 'right',
                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                    }
                ],
                margin: [10, 0]
            }
        });
        // Styling the table: create style object
        var objLayout = {};
        // Horizontal line thickness
        objLayout['hLineWidth'] = function(i) { return .5; };
        // Vertikal line thickness
        objLayout['vLineWidth'] = function(i) { return .5; };
        // Horizontal line color
        objLayout['hLineColor'] = function(i) { return '#aaa'; };
        // Vertical line color
        objLayout['vLineColor'] = function(i) { return '#aaa'; };
        // Left padding of the cell
        objLayout['paddingLeft'] = function(i) { return 4; };
        // Right padding of the cell
        objLayout['paddingRight'] = function(i) { return 4; };
        // Inject the object in the document
        doc.content[1].layout = objLayout;
    }
    },
    {
        text: '<span class="text-default"><i class="fa fa-print"></i></span><span class="text"> Print</span>',
        title: '<?php echo $c_name;?> (General Ledger)',
        extend: 'print',
    message: '<?php if($_POST){echo $aname;}?> \n Created at : (<?php echo date('m/d/Y h:i:s a', time());?>)',
    orientation: 'landscape',
    exportOptions: {
                    columns: [ 1, 2, 4, 5, 6, 7, 8 ]
                },
    
    customize: function (doc) {
        doc.pageMargins = [10,10,10,10];
        doc.defaultStyle.fontSize = 7;
        doc.styles.tableHeader.fontSize = 7;
        doc.styles.title.fontSize = 9;
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();
        // Create a footer
        doc['footer']=(function(page, pages) {
            return {
                columns: [
                    'This is your left footer column',
                    {
                        // This is the right column
                        alignment: 'right',
                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                    }
                ],
                margin: [10, 0]
            }
        });
        // Styling the table: create style object
        var objLayout = {};
        // Horizontal line thickness
        objLayout['hLineWidth'] = function(i) { return .5; };
        // Vertikal line thickness
        objLayout['vLineWidth'] = function(i) { return .5; };
        // Horizontal line color
        objLayout['hLineColor'] = function(i) { return '#aaa'; };
        // Vertical line color
        objLayout['vLineColor'] = function(i) { return '#aaa'; };
        // Left padding of the cell
        objLayout['paddingLeft'] = function(i) { return 4; };
        // Right padding of the cell
        objLayout['paddingRight'] = function(i) { return 4; };
        // Inject the object in the document
        doc.content[1].layout = objLayout;
    }
    },
]


    });
} );
</script>
<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
