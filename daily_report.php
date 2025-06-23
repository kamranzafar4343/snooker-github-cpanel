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
if($_GET)
{
  $location=mysqli_real_escape_string($conn,$_GET['location']);
}
else
{
  $location='1';
}

$date_today = date('Y-m-d');  
$previous_date = date("Y-m-d",strtotime($date_today."-1 day"));
$query=mysqli_query($conn, "SELECT user_privilege,created_by FROM users where user_id='$location'");
                                    $data = mysqli_fetch_assoc($query);
                                    $user_privilege=$data['user_privilege'];
                                    $created_by=$data['created_by'];
                                    if($user_privilege=='branch')
                                    {
                                       $created_by=$location; 
                                    }
                                    else
                                    {
                                        $created_by=$created_by; 
                                    }
 if($user_privilege=='superadmin')
    {
        $where='';
    }
else
    {

         $where='and parent_id='.$created_by.'';
    }
?>
<html lang="en" >
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<style type="text/css">
@media print {
body {-webkit-print-color-adjust: exact;}
}
</style>
<style type="text/css">

     @media print {
  .nodisplay {
    display: none;
  }
  .title1 {
    display: none;
  }

  
.avoid {
    page-break-inside: avoid !important;
    margin: 4px 0 4px 0;  /* to keep the page break from cutting too close to the text in the div */
  }
}
 </style>
<!-- MAIN CSS -->
<link rel="stylesheet" href="assets_light/css/main.css">
<link rel="stylesheet" href="assets_light/css/color_skins.css">

<body style="background-color: #a8abaa;" class="avoid">
    <br><br>
 

            <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * .5);padding-left: calc(var(--bs-gutter-x) * 1.5);">
               
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
                        $query4=mysqli_query($conn, "SELECT user_name, user_address FROM users where user_id=$userid");
                        $data4=mysqli_fetch_assoc($query4);
                        $created_by = $data4['user_name'];
                        $user_address = $data4['user_address'];  
                 
                        ?>
                        <div class="row clearfix">
                                            <div class="col-md-4 col-sm-4">
                                                <div class="col-md-4">
                                                    <img src="<?php echo $image;?>" alt="user" class="img-fluid" style="max-width: 100%;">
                                                </div>
                                               
                                            </div>
                                             <div class="col-md-4 col-sm-4 text-center" style="margin-top: 30px;">
                                                    <h5 >Daily Report</h5>
                                                    <p><?php echo $created_by;?></p>
                                     
                                                </div>
                                               <div class="col-md-4 text-right" style="margin-top: 30px;">
                                                    <p><b>Print Date : <?php echo date('d-m-Y');?></b></p>
                                                    <p><b>Print Time : <?php date_default_timezone_set("Asia/Karachi");
                                                    echo $created_date=date("h:i:s A");?></b></p>
                                                </div>
                                        </div>
                               
                        
                        <?php

                    $sql=mysqli_query($conn, "SELECT SUM(amount_recieved) as cash_sale_today FROM tbl_sale where created_date = DATE(NOW()) $where");
                    $row=mysqli_fetch_assoc($sql);
                    $cash_sale_today = $row['cash_sale_today'];
                    $today_Sale=round($cash_sale_today);
                        if($today_Sale=='')
                        {
                           $today_Sale=0; 
                        }
                    //////////////////////////////////////////////////////////////////////////////////////////////
                    $monthsql=mysqli_query($conn, "SELECT SUM(amount_recieved) as cash_sale_total_monthly FROM tbl_sale where Date(created_date) != CURDATE() AND MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) $where");
                    $row=mysqli_fetch_assoc($monthsql);
                    $cash_sale_total_monthly = $row['cash_sale_total_monthly'];
                    $monthly_Sale=round($cash_sale_total_monthly);
                        if($monthly_Sale=='')
                        {
                           $monthly_Sale=0; 
                        }
                    ///////////////////////////////////////////////////////////////////////////////////////////////
                    $yearsql=mysqli_query($conn, "SELECT SUM(amount_recieved) as cash_sale_total_yearly FROM tbl_sale where created_date != DATE(NOW()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) $where");
                    $row=mysqli_fetch_assoc($yearsql);
                    $cash_sale_total_yearly = $row['cash_sale_total_yearly'];
                    $yearly_Sale=round($cash_sale_total_yearly);
                        if($yearly_Sale=='')
                        {
                           $yearly_Sale=0; 
                        }
                    ///////////////////////////////////////////////////////////////////////////////////////////////
                    $return_sql=mysqli_query($conn, "SELECT SUM(amount_returned) as sale_return_today FROM tbl_sale_return where created_date = DATE(NOW()) $where");
                    $row=mysqli_fetch_assoc($return_sql);
                    $sale_return_today = $row['sale_return_today'];
                    ///////////////////////////////////////////////////////////////////////////////////////////////
                    $return_monthsql2=mysqli_query($conn, "SELECT SUM(amount_returned) as sale_return_total_monthly FROM tbl_sale_return where  MONTH(created_date) = MONTH(CURRENT_DATE()) $where");
                    $row=mysqli_fetch_assoc($return_monthsql2);
                    $sale_return_total_monthly = $row['sale_return_total_monthly'];
                    ///////////////////////////////////////////////////////////////////////////////////////////////
                    $return_yearsql2=mysqli_query($conn, "SELECT SUM(amount_returned) as sale_return_total_yearly FROM tbl_sale_return where  YEAR(created_date) = YEAR(CURRENT_DATE()) $where");
                    $row=mysqli_fetch_assoc($return_yearsql2);
                    $sale_return_total_yearly = $row['sale_return_total_yearly'];

                    ////////////////////////////////////////Total /////////////////////////////
                

                    $row=mysqli_fetch_assoc($return_monthsql2);
                    $sale_return_total_monthly = $row['sale_return_total_monthly'];

                    $row=mysqli_fetch_assoc($return_yearsql2);
                    $sale_return_total_yearly = $row['sale_return_total_yearly'];
                    //////////////////////////////monthly////////////////////////////////////
                    $overall_Sale=round($monthly_Sale+$today_Sale);
                        if($overall_Sale=='')
                        {
                           $overall_Sale=0; 
                        }

                        if($sale_return_total_monthly=='')
                        {
                           $sale_return_total_monthly=0; 
                        }

                    $net_sale=round($overall_Sale-$sale_return_total_monthly);
                    ////////////////////////////////yearly//////////////////////////////////
                     $overall_Sale_year=round($yearly_Sale+$today_Sale);
                        if($overall_Sale_year=='')
                        {
                           $overall_Sale_year=0; 
                        }

                        if($sale_return_total_yearly=='')
                        {
                           $sale_return_total_yearly=0; 
                        }

                    $net_sale_yealy=round($overall_Sale_year-$sale_return_total_yearly);
                    /////////////////////////////////////////////////////////////////////////
                   
                    ?>
                            <hr> 
            <div class="row clearfix">
                
                   
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="col-md-12 col-sm-4 text-center" style="margin-top: 20px;">
                            <h5>Higest Selling Product</h5>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sr #</th>
                                            <th>Barcode #</th>
                                            <th>Product #</th> 
                                            <th>Sold Today</th>
                                            <th>Sale Rate</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $count=0;
                              
                                    $sql=mysqli_query($conn, "SELECT product, sum(amount), rate, SUM(qty) AS total_qty from tbl_sale_detail where  Date(created_date) = CURDATE() $where group by product order by sum(qty) desc limit 3");
                                    while($data=mysqli_fetch_assoc($sql)){
                                        $product = $data['product'];
                                        $rate = $data['rate'];
                                        $total_qty = $data['total_qty'];
                                        $amount = round($rate*$total_qty);
                                        
                                        $asql=mysqli_query($conn, "SELECT * FROM tbl_items where item_id=$product");
                                
                                        $data=mysqli_fetch_assoc($asql);
                                        $productname = $data['item_name'];
                                        $barcode = $data['barcode'];
                                        $brand_id = $data['brand_id'];

                                         $asql=mysqli_query($conn, "SELECT * FROM tbl_catagory where id=$brand_id");
                                        
                                        $data=mysqli_fetch_assoc($asql);
                                        $cat_name = $data['cat_name'];

                                        $item_name=$cat_name."/".$productname;

                                    $count++;
                                    
                                ?>
                            <tr style="">
                                <td><?php echo $count;?></td>
                                <td><?php echo $barcode;?></td>
                                <td><?php echo $item_name;?></td>
                                <td><?php echo $total_qty;?></td>
                                <td><?php echo number_format($rate);?></td>
                                <td><?php echo number_format($amount);?></td>
                            </tr>
                            <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <br><br>
            <div class="row clearfix">
                <div class="col-md-4">
                    <div class="table-responsive">
                        <table id="example" class="display" style="width:100%; line-height: 30px;">
                            <thead class="thead-dark bg-dark text-light">
                                <tr>  
                                    <th class="text-center">This Month Sales Detail</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                        <tbody>
                            <tr>
                                <?php

                                    $bfsalemonthsql=mysqli_query($conn, "SELECT SUM(amount_recieved) as bf_cash_sale_total_monthly FROM tbl_sale where  Date(created_date) != CURDATE()  AND MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) $where");


                                    $row=mysqli_fetch_assoc($bfsalemonthsql);
                                    $bf_cash_sale_total_monthly = $row['bf_cash_sale_total_monthly'];

                                    $bfsalemonthsqlinst=mysqli_query($conn, "SELECT SUM(total_price) as bf_inst_sale_total_monthly FROM tbl_installment where  Date(created_date) != CURDATE() AND MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) $where");


                                    $row=mysqli_fetch_assoc($bfsalemonthsqlinst);
                                    $bf_inst_sale_total_monthly = $row['bf_inst_sale_total_monthly'];


                                    $bf_overall_Sale_monthly=round($bf_cash_sale_total_monthly+$bf_inst_sale_total_monthly);
                                        if($bf_overall_Sale_monthly=='')
                                        {
                                           $bf_overall_Sale_monthly=0; 
                                        }
                                ?>
                                <td>B/F Sale</td>
                                <td><?php echo number_format($bf_overall_Sale_monthly);?></td> 
                            </tr>
                            <tr >
                                <?php

                                    $salemonthsql=mysqli_query($conn, "SELECT SUM(amount_recieved) as cash_sale_total_today FROM tbl_sale where  Date(created_date) = CURDATE() $where");
                                    $row=mysqli_fetch_assoc($salemonthsql);
                                    $cash_sale_total_today = $row['cash_sale_total_today'];


                                    $salemonthsqlinst=mysqli_query($conn, "SELECT SUM(total_price) as inst_sale_total_today FROM tbl_installment where  Date(created_date) = CURDATE() $where");
                                    $row=mysqli_fetch_assoc($salemonthsqlinst);
                                    $inst_sale_total_today = $row['inst_sale_total_today'];


                                    $overall_Sale_today=round($cash_sale_total_today+$inst_sale_total_today);
                                        if($overall_Sale_today=='')
                                        {
                                           $overall_Sale_today=0; 
                                        }
                                    $month_sale=round($overall_Sale_today+$bf_overall_Sale_monthly);
                                    $net_sale_month=round($month_sale-$sale_return_total_monthly);
                                ?>
                                <td>Today's Sale</td>
                                <td style="border-bottom: 1px solid black;"><?php echo number_format($overall_Sale_today);?></td> 
                            </tr>
                            
                            <tr>
                                <td ><b>This Month Sales</b></td>
                                <td ><?php echo $month_sale;?></td> 
                            </tr>
                            <tr>
                                <td style="border-bottom: 2px solid black;"><b>This Month Return</b></td>
                                <td style="border-bottom: 2px solid black;"><?php echo $sale_return_total_monthly;?></td> 
                            </tr>
                            <tr>
                                <td><b>Net Sales</b></td>
                                <td><?php echo $net_sale_month;?></td> 
                            </tr>

                            </tbody>
                         </table>
                    </div><br>
                    <div class="table-responsive">
                        <table id="example" class="display" style="width:100%; line-height: 30px;">
                            <thead class="thead-dark bg-dark text-white">
                                <tr>  
                                    <th class="text-center">This Year Sales Detail</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                        <tbody>
                    
                            <tr>
                                <?php

                                    $bfsaleyearsql=mysqli_query($conn, "SELECT SUM(amount_recieved) as bf_cash_sale_total_yearly FROM tbl_sale where  YEAR(created_date) < YEAR(CURRENT_DATE()) $where");

                                    
                                    $row=mysqli_fetch_assoc($bfsaleyearsql);
                                    $bf_cash_sale_total_yearly = $row['bf_cash_sale_total_yearly'];

                                    $bfsaleyearsqlinst=mysqli_query($conn, "SELECT SUM(total_price) as bf_inst_sale_total_yearly FROM tbl_installment where  YEAR(created_date) < YEAR(CURRENT_DATE()) $where");


                                    $row=mysqli_fetch_assoc($bfsaleyearsqlinst);
                                    $bf_inst_sale_total_yearly = $row['bf_inst_sale_total_yearly'];


                                    $bf_overall_Sale_yealy=round($bf_cash_sale_total_yearly+$bf_inst_sale_total_yearly);
                                        if($bf_overall_Sale_yealy=='')
                                        {
                                           $bf_overall_Sale_yealy=0; 
                                        }
                                ?>
                                <td>B/F Sale</td>
                                <td><?php echo number_format($bf_overall_Sale_yealy);?></td> 
                            </tr>
                            <tr >
                                <?php

                                    $salemonthsql=mysqli_query($conn, "SELECT SUM(amount_recieved) as cash_sale_total_today FROM tbl_sale where  Date(created_date) = CURDATE() $where");
                                    $row=mysqli_fetch_assoc($salemonthsql);
                                    $cash_sale_total_today = $row['cash_sale_total_today'];


                                    $salemonthsqlinst=mysqli_query($conn, "SELECT SUM(total_price) as inst_sale_total_today FROM tbl_installment where  Date(created_date) = CURDATE() $where");
                                    $row=mysqli_fetch_assoc($salemonthsqlinst);
                                    $inst_sale_total_today = $row['inst_sale_total_today'];


                                    $overall_Sale_today=round($cash_sale_total_today+$inst_sale_total_today);
                                        if($overall_Sale_today=='')
                                        {
                                           $overall_Sale_today=0; 
                                        }
                                    $year_sale=round($bf_overall_Sale_yealy+$month_sale);
                                    $net_sale_year=round($year_sale-$sale_return_total_yearly);
                                ?>
                                <td>Today's Sale</td>
                                <td><?php echo number_format($overall_Sale_today);?></td> 

                            </tr>
                            <tr>
                                <td >This Month Sales</td>
                                <td  style="border-bottom: 1px solid black;"><?php echo $month_sale;?></td> 
                            </tr>
                            <tr>
                                <td ><b>This Year Sales</b></td>
                                <td ><?php echo $year_sale;?></td> 
                            </tr>
                            <tr>
                                <td style="border-bottom: 2px solid black;"><b>This Year Return</b></td>
                                <td style="border-bottom: 2px solid black;"><?php echo $sale_return_total_yearly;?></td> 
                            </tr>
                            <tr>
                                <td><b>Net Sales</b></td>
                                <td><?php echo $net_sale_year;?></td> 
                            </tr>

                            </tbody>
                         </table>
                    </div><br>
                     
                    </div>
                    <div class="col-md-4">
                     <div class="table-responsive">
                        <table id="example" class="display" style="width:100%; line-height: 30px;">
                            <thead class="thead-dark bg-dark text-white">
                                <tr>  
                                    <th class="text-right"  style="width: 70% ;font-size: 12px;">Today’s Cash Sales & Return Detail</th>
                                    <th class="text-center"></th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                        <tbody>
                         <?php

                            $sql_count=mysqli_query($conn, "SELECT SUM(amount_recieved) as cash_sale_today, count(sale_id) as total_sale FROM tbl_sale where  DATE(created_date) = DATE(NOW()) $where");
                            $row=mysqli_fetch_assoc($sql_count);
                            $cash_sale_today = $row['cash_sale_today'];
                            $total_sale = $row['total_sale'];
                            if($cash_sale_today=='')
                                {
                                   $cash_sale_today=0; 
                                }
                            if($total_sale=='')
                                {
                                   $total_sale=0; 
                                }

                            $sql1=mysqli_query($conn, "SELECT SUM(amount_returned) as cash_sale_return_today, count(sale_return_id) as total_sale_return FROM tbl_sale_return where  DATE(created_date) = DATE(NOW()) $where");
                            $row=mysqli_fetch_assoc($sql1);
                            $cash_sale_return_today = $row['cash_sale_return_today'];
                            $total_sale_return = $row['total_sale_return'];
                            if($cash_sale_return_today=='')
                                {
                                   $cash_sale_return_today=0; 
                                }
                            if($total_sale_return=='')
                                {
                                   $total_sale_return=0; 
                                }

                            $net_sale_today_count=$total_sale-$total_sale_return;
                            $net_sale_today=round($cash_sale_today-$cash_sale_return_today);
                            ?>
                            <tr>
                                <td>Cash Sales</td>
                                <td ><?php echo $total_sale;?></td>
                                <td class="text-center"><?php echo $cash_sale_today;?></td> 
                            </tr>
                            <tr>
                                <td style="border-bottom: 2px solid black;">Cash Sale Return</td>
                                <td style="border-bottom: 2px solid black;"><?php echo $total_sale_return;?></td>
                                <td class="text-center" style="border-bottom: 2px solid black;"><?php echo $cash_sale_return_today;?></td> 
                            </tr>
                            <tr>
                                <td><b>Today Net Sales</b></td>
                                <td ><?php echo $net_sale_today_count;?></td>
                                <td class="text-center"><?php echo $net_sale_today;?></td> 
                            </tr>
                            </tbody>
                         </table>
                    </div><br>
                     <div class="table-responsive">
                        <table id="example" class="display" style="width:100%; line-height: 30px;">
                            <thead  class="thead-dark bg-dark text-white">
                                <tr>  
                                    <th class="text-right"  style="width: 70% ;font-size: 11px; font-weight: bold;">This Month Cash Sales & Return Detail</th>
                                    <th class="text-center"></th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                        <tbody>
                    <?php

                    $sql=mysqli_query($conn, "SELECT SUM(amount_recieved) as cash_sale_monthly, count(sale_id) as total_sale FROM tbl_sale where  MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) $where");
                            $row=mysqli_fetch_assoc($sql);
                            $cash_sale_monthly = $row['cash_sale_monthly'];
                            $total_sale = $row['total_sale'];
                            if($cash_sale_monthly=='')
                                {
                                   $cash_sale_monthly=0; 
                                }
                            if($total_sale=='')
                                {
                                   $total_sale=0; 
                                }

                            $sql1=mysqli_query($conn, "SELECT SUM(amount_returned) as cash_sale_return_monthly, count(sale_return_id) as total_sale_return FROM tbl_sale_return where MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) $where");
                            $row=mysqli_fetch_assoc($sql1);
                            $cash_sale_return_monthly = $row['cash_sale_return_monthly'];
                            $total_sale_return = $row['total_sale_return'];
                            if($cash_sale_return_monthly=='')
                                {
                                   $cash_sale_return_monthly=0; 
                                }
                            if($total_sale_return=='')
                                {
                                   $total_sale_return=0; 
                                }

                            $net_sale_monthly_count=$total_sale-$total_sale_return;
                            $net_sale_monthly=round($cash_sale_monthly-$cash_sale_return_monthly);
                    ?>
                            <tr>
                                <td>Cash Sales</td>
                                <td ><?php echo $total_sale;?></td>
                                <td class="text-center"><?php echo $cash_sale_monthly;?></td> 
                            </tr>
                            <tr>
                                <td style="border-bottom: 2px solid black;">Cash Sale Return</td>
                                <td style="border-bottom: 2px solid black;"><?php echo $total_sale_return;?></td>
                                <td class="text-center" style="border-bottom: 2px solid black;"><?php echo $cash_sale_return_monthly;?></td> 
                            </tr>
                            <tr>
                                <td><b>Monthly Net Sales</b></td>
                                <td ><?php echo $net_sale_monthly_count;?></td>
                                <td class="text-center"><?php echo $net_sale_monthly;?></td> 
                            </tr>
                            </tbody>
                         </table>
                    </div>
                 
                 
                    </div>
                    <div class="col-md-4">
                    <div class="table-responsive">
                        <table id="example" class="display" style="width:100%; line-height: 30px;">
                            <thead  class="thead-dark bg-dark text-white">
                                <tr>  
                                    <th class="text-right"  style="width: 70%">Receivable Detail</th>
                                    <th class="text-center"></th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                        <tbody>
                    <?php

                    $sql=mysqli_query($conn, "SELECT branch_id, created_by, user_privilege  FROM users where user_id='$location'");
                                $data = mysqli_fetch_assoc($sql);
                               $branch_id=$data['branch_id'];
                                $created=$data['created_by'];
                                $privilige=$data['user_privilege'];
                                if($branch_id=='')
                                {
                                  $parent_id=$location;
                                }
                                else
                                {
                                  $parent_id=$location;
                                }

                if($privilige=='superadmin')
                {

                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300','300200100', '100100000') and parent_id='$parent_id' and date(created_date) != curdate()");

                  $data3=mysqli_fetch_assoc($sql3);
                  $cash_in_hand1 = $data3['cash_in_hand'];

                  $cash_n=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300', '100100000') and parent_id='$parent_id' and date(created_date)=date(CURRENT_DATE())");

                  $data3=mysqli_fetch_assoc($cash_n);
                  $cash_in_hand = $data3['cash_in_hand'];

                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account` WHERE acode='100100000'");

                  $data4=mysqli_fetch_assoc($sql4);
                  $opening_bal = $data4['opening_bal'];

                  $cash_now=$opening_bal+$cash_in_hand+$cash_in_hand1;
                  $cash_bf=$opening_bal+$cash_in_hand1;
                }
                else
                {
                  if($branch_id=='')
                  {
                    $sql="SELECT branch_id FROM users where user_id='$created_by'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          
                          $branch_id = $data['branch_id'];
                          
                         }

                  }
                 
                  $sql7=mysqli_query($conn, "SELECT SUM(total_amount) as cash_transfer FROM `tbl_trans` WHERE account_id='$branch_id'");

                  $data7=mysqli_fetch_assoc($sql7);
                  $cash_transfer = $data7['cash_transfer'];
                  
                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300', '300200100', '$branch_id') and parent_id='$parent_id' and date(created_date)< date(CURRENT_DATE())");

                  $data3=mysqli_fetch_assoc($sql3);
                  $cash_in_hand1 = $data3['cash_in_hand']+$cash_transfer;

                  $cash_n=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300',  '$branch_id') and parent_id='$parent_id' and date(created_date)=date(CURRENT_DATE())");

                  $data3=mysqli_fetch_assoc($cash_n);
                  $cash_in_hand = $data3['cash_in_hand']+$cash_transfer;

                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account_lv2` WHERE acode='$branch_id'");

                  $data4=mysqli_fetch_assoc($sql4);
                  $opening_bal = $data4['opening_bal'];

                  $cash_now=$opening_bal+$cash_in_hand+$cash_in_hand1;
                  $cash_bf=$opening_bal+$cash_in_hand1;
                }
                
                    $monthsqlforacc1=mysqli_query($conn, "SELECT *  FROM tbl_installment where  installment_status = 'Pending'  $where");
                        $total_amount_pending_adv=0;
                        while($row=mysqli_fetch_assoc($monthsqlforacc1))
                        {
                             $plan_id = $row['plan_id'];

                             $sqlcheck1=mysqli_query($conn, "SELECT *  FROM tbl_installment_payment where plan_id='$plan_id' and date(created_date)= CURRENT_DATE() limit 1");
                          
                             if(mysqli_num_rows($sqlcheck1)>0)
                             {

                                $row1=mysqli_fetch_assoc($sqlcheck1);
                               $total_amount_pending_adv += $row1['per_month_amount'];
                             }


                             
                        }
                        
                        if($total_amount_pending_adv=='')
                        {
                           $total_amount_pending_adv=0; 
                        }
       
                   $monthsqlforacc2=mysqli_query($conn, "SELECT *  FROM tbl_installment where  installment_status = 'Pending'  $where");
                        $total_amount_pending_inst4=0;
                        $total_amount_pending_pay4=0;
                 
                        while($row=mysqli_fetch_assoc($monthsqlforacc2))
                        {
                             $plan_id = $row['plan_id'];

                             $per_month_amount = $row['per_month_amount'];
                             $total_amount_pending_inst4 += $per_month_amount;
                           
                             $sqlcheck=mysqli_query($conn, "SELECT *  FROM tbl_installment_payment where plan_id='$plan_id'  and date(created_date)< CURRENT_DATE() limit 1");
                           
                             if(mysqli_num_rows($sqlcheck)>0)
                             {
                                $row1=mysqli_fetch_assoc($sqlcheck);
                                $total_amount_pending_pay4 -= $row1['per_month_amount'];
                             }
                          
                        }

                       
                     
                        $total_amount_pending4=round($total_amount_pending_inst4+$total_amount_pending_pay4);
                       
                        if($total_amount_pending4=='')
                        {
                           $total_amount_pending4=0; 
                        }
                        
                       
                    ?>
                            <tr>
                                <td>B/F Live Balance</td>
                                <td></td>
                                <td class="text-right"><?php echo number_format($cash_bf);?></td> 
                            </tr>
                            <tr>
                                <td>Today Sale</td>
                                <td></td>
                                <td class="text-right"><?php echo number_format($overall_Sale_today);?></td> 
                            </tr>
                            <tr>
                                <td>Advance Payment</td>
                                <td style="border-bottom: 1px solid black;"></td>
                                <td class="text-right" style="border-bottom: 1px solid black;"><?php echo number_format($total_amount_pending_adv);?></td> 
                            </tr>
                            <tr>
                                <td style="border-bottom: 2px solid black;"><b>Today Receivable</b></td>
                                <td style="border-bottom: 2px solid black;"></td>
                                <td class="text-right " style="border-bottom: 2px solid black;"><?php echo number_format($total_amount_pending+$total_amount_pending1);?></td> 
                            </tr>
                            <!-- <tr>
                                <td style="border-bottom: 2px solid black;"><b>Total Receivable</b></td>
                                <td style="border-bottom: 2px solid black;"></td>
                                <td class="text-right" style="border-bottom: 2px solid black;"><?php echo number_format($total_amount_pending4);?></td> 
                            </tr> -->
                         
                            <tr>
                                <td ><b>Live Balance </b></td>
                                <td></td>
                                <td class="text-right"><b><?php echo number_format($cash_now);?></b></td> 
                            </tr>
                            
                            </tbody>
                         </table>
                    </div><br>
                    <div class="table-responsive">
                        <table id="example" class="display" style="width:100%; line-height: 30px;">
                            <thead  class="thead-dark bg-dark text-white">
                                <tr>  
                                    <th class="text-right"  style="width: 60%">Cash in Hand Detail</th>
                                    <th class="text-center"></th>
                                    <th class="text-right"></th>
                                   
                                </tr>
                            </thead>
                        <tbody>
                   <?php
                 $sql_exp_mon =mysqli_query($conn, "SELECT  SUM(d_amount-c_amount) as mon_exp FROM tbl_trans_detail WHERE left(acode, 3)='500' AND MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) AND parent_id='$created_by'");
                                    $expsqlmon_exp=mysqli_fetch_assoc($sql_exp_mon);
                                     $mon_exp=$expsqlmon_exp['mon_exp'];
                         
                  if($mon_exp=='')
                  {
                    $mon_exp = 0;
                  }
                    ?>
                            <tr>
                                <td><b>Total Expence</b></td>
                                <td></td>
                                <td class="text-right"><b><?php echo number_format($mon_exp, 0, ".", ",");?></b></td> 
                            </tr>
                            <tr>
                                <td><b>Total Payable</b></td>
                                <td></td>
                                <td class="text-right"><b><?php 

                                $payable=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as total_pay FROM `tbl_trans_detail` where LEFT(acode,6)='200200' $where");
                                $payable_tot=mysqli_fetch_assoc($payable);
                                $tot_pay=$payable_tot['total_pay'];
                                if($tot_pay=='')
                                  {
                                    $tot_pay = 0;
                                  }
                                else if($tot_pay<0)
                                {
                                    $tot_pay = abs($tot_pay);

                                }
                                echo number_format($tot_pay, 0, ".", ",");?></b></td> 
                            </tr>
                            <tr>
                                <td><b>Total Recievable</b></td>
                                <td></td>
                                <td class="text-right"><b><?php 
                                $recievable=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as total_rec FROM `tbl_trans_detail` where LEFT(acode,6)='100200' $where");
                            
                                $recievable_tot=mysqli_fetch_assoc($recievable);
                                $tot_rec=$recievable_tot['total_rec'];
                                echo number_format($tot_rec);?></b></td> 
                            </tr>
                            <tr>
                                <td><b>Live Balance</b></td>
                                <td></td>
                                <td class="text-right"><b><?php echo number_format($cash_now+$form_fee);?></b></td> 
                            </tr>
                          
                            </tbody>
                         </table>
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
<!-- <script type="text/javascript">
$(document).ready(function() {
          $('.display').DataTable({
      dom: 'Bfrtip',
      scrollY: true,
      scrollX: false,
      "paging":   false,
      "ordering": false,
      "info":     false,
      searching: true,
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
</script> -->
<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
