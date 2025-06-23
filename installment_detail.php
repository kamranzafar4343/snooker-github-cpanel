<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";



session_start();

if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}



?>

<?php
              
              if(isset($_GET['planid']))
              {

                $planid=mysqli_real_escape_string($conn, $_GET['planid']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_installment where plan_id=$planid");

                $data=mysqli_fetch_assoc($sql);
                        $id = $data['plan_id'];
                        $customer = $data['customer'];
                        $cat_id = $data['cat_id'];
                        $item_id = $data['item_id'];
                        $total_price = $data['total_price'];
                        $amount_recieved = $data['amount_recieved'];
                        $down_payment = $data['down_payment'];
                        $created_by = $data['created_by'];
                        $installment_status = $data['installment_status'];
                        $remaining = $total_price-$amount_recieved;

                        $period = $data['period'];
                        
                        $x=$period;
                        $per_month_amount = $data['per_month_amount'];
                        $created_date = $data['created_date'];
                        $created_by = $data['created_by'];
                        $avo = $data['avo'];
                        $mo = $data['mo'];
                        $bm = $data['bm'];
                        $srm = $data['srm'];
                        $rm = $data['rm'];
                        $crc = $data['crc'];
                        $pto = $data['pto'];
                        $sale_men = $data['sales_men'];

                        $gran1_name=$data['gran1_name'];
                        $gran1_fname=$data['gran1_fname'];
                        $gran1_mobile_no=$data['gran1_mobile_no'];
                        $gran1_mobile_no=$data['gran1_mobile_no'];
                        $gran1_client_cnic=$data['gran1_client_cnic'];
                        $gran1_relation=$data['gran1_relation'];
                        $gran1_occup=$data['gran1_occup'];
                        $gran1_address=$data['gran1_address'];
                        $gran1_office=$data['gran1_office'];

                        $gran2_name=$data['gran2_name'];
                        $gran2_fname=$data['gran2_fname'];
                        $gran2_mobile_no=$data['gran2_mobile_no'];
                        $gran2_client_cnic=$data['gran2_client_cnic'];
                        $gran2_relation=$data['gran2_relation'];
                        $gran2_occup=$data['gran2_occup'];
                        $gran2_address=$data['gran2_address'];
                        $gran2_office=$data['gran2_office'];

                        $gran3_name=$data['gran3_name'];
                        $gran3_fname=$data['gran3_fname'];
                        $gran3_mobile_no=$data['gran3_mobile_no'];
                        $gran3_client_cnic=$data['gran3_client_cnic'];
                        $gran3_relation=$data['gran3_relation'];
                        $gran3_occup=$data['gran3_occup'];
                        $gran3_address=$data['gran3_address'];
                        $gran3_office=$data['gran3_office'];

                        $gran4_name=$data['gran4_name'];
                        $gran4_fname=$data['gran4_fname'];
                        $gran4_mobile_no=$data['gran4_mobile_no'];
                        $gran4_client_cnic=$data['gran4_client_cnic'];
                        $gran4_relation=$data['gran4_relation'];
                        $gran4_occup=$data['gran4_occup'];
                        $created_by = $data['created_by'];
                        $gran4_address=$data['gran4_address'];
                        $gran4_office=$data['gran4_office'];
         

                

                $query2=mysqli_query($conn, "SELECT item_name,item_model,brand_id FROM tbl_items where item_id=$item_id");
                $data2=mysqli_fetch_assoc($query2);
                $item_name = $data2['item_name'];
                $item_model = $data2['item_model'];
                $brand_id = $data2['brand_id'];

                $query1=mysqli_query($conn, "SELECT cat_name FROM tbl_catagory where id=$brand_id");
                $data1=mysqli_fetch_assoc($query1);
                $cat_name = $data1['cat_name'];

                $query3=mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$customer");
                $data3=mysqli_fetch_assoc($query3);
                $customer_name = $data3['username'];
                $seprate_customer_id = $data3['seprate_customer_id'];
                $customer_profile = $data3['user_profile'];
                $customer_address1 = $data3['address_office'];
                $customer_address2 = $data3['address_current'];
                $customer_phone2 = $data3['mobile_no2'];
                $customer_phone = $data3['mobile_no1'];
                $client_cnic = $data3['client_cnic'];
                $client_fname = $data3['client_fathername'];
                $client_occupation = $data3['client_occupation'];     
                $client_residential = $data3['client_residential'];
                $gender = $data3['gender'];

                $customer_by=$data3['created_by'];
                
                                              $sql=mysqli_query($conn, "SELECT user_name FROM users where user_id='$customer_by'");
                                              $data = mysqli_fetch_array($sql);
                                                $branchname = $data['user_name'];
                                                $iden = str_split($branchname);
                                                $iden3 = str_split($branchname,3);
                                                $iden2=end($iden3);
                                                $iden1=$iden[0];
                    $query9= mysqli_query($conn,"SELECT user_name,created_by FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query9) ;
                                   $creator_name=$zdata['user_name'];
                                  
                                   $created=$zdata['created_by'];

                        $query10 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$created"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query10) ;
                                   $branch_name=$zdata1['user_name'];
                        $query11 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$customer_by"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query11) ;
                                   $customer_from=$zdata1['user_name'];

                $query4=mysqli_query($conn, "SELECT user_name, user_address FROM users where user_id=$created_by");
                $data4=mysqli_fetch_assoc($query4);
                $created_by = $data4['user_name'];
                $user_address = $data4['user_address'];   

                $query5=mysqli_query($conn, "SELECT username FROM tbl_salesmen where s_id=$sale_men");
                $data5=mysqli_fetch_assoc($query5);
                $sales_men = $data5['username'];   

                $query6=mysqli_query($conn, "SELECT username FROM tbl_salesmen where s_id=$avo");
                $data6=mysqli_fetch_assoc($query6);
                $avo_name = $data6['username'];   

                $query7=mysqli_query($conn, "SELECT username FROM tbl_salesmen where s_id=$mo");
                $data7=mysqli_fetch_assoc($query7);
                $mo_name = $data7['username'];   

                $query8=mysqli_query($conn, "SELECT username FROM tbl_salesmen where s_id=$bm");
                $data8=mysqli_fetch_assoc($query8);
                $bm_name = $data8['username'];   

                $query9=mysqli_query($conn, "SELECT username FROM tbl_salesmen where s_id=$srm");
                $data9=mysqli_fetch_assoc($query9);
                $srm_name = $data9['username'];

                $query10=mysqli_query($conn, "SELECT username FROM tbl_salesmen where s_id=$rm");
                $data10=mysqli_fetch_assoc($query10);
                $rm_name = $data10['username'];  

                $query11=mysqli_query($conn, "SELECT username FROM tbl_salesmen where s_id=$crc");
                $data11=mysqli_fetch_assoc($query11);
                $crc_name = $data11['username'];   
              }
              ?>
<html lang="en" >

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets_light/css/main.css">
<link rel="stylesheet" href="assets_light/css/color_skins.css">

<!-- <body onload="window.print();">
 -->
 <style type="text/css">
     .card-header
     {
        border-bottom: 1px solid black !important;
     }
     @media print {
  .nodisplay {
    display: none;
  }
  .title1 {
    display: none;
  }
}
  
.avoid {
    page-break-inside: avoid !important;
    margin: 4px 0 4px 0;  /* to keep the page break from cutting too close to the text in the div */
  }
 </style>
  <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_company");
                        $data=mysqli_fetch_assoc($sql);
                        $c_name = $data['c_name'];
                        $c_address = $data['c_address'];
                        $c_phone = $data['c_phone'];
                        $c_mobile = $data['c_mobile'];
                        $image = $data['user_profile'];
                 
                        ?>
            <div class="row clearfix" style="line-height: 13px;">
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                            
                                <div class="row clearfix">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row clearfix">
                                            <div class="col-md-4 col-sm-4">
                                                <div class="col-md-4">
                                                    <img src="<?php echo $image;?>" alt="user" class="img-fluid" style="max-width: 100%;">
                                                </div>
                                               
                                            </div>
                                             <div class="col-md-4 col-sm-4 text-center" >
                                                    <h1 class="title1">CUSTOMER COMPLETE DETAILS</h1>
                                                    <h5><?php echo $created_by ." : ". $user_address;?></h5>
                                     
                                                </div>
                                               <div class="col-md-4 text-right">
                                                    <img src="<?php if($customer_profile){echo $customer_profile;}else {echo "assets/images/d_profile.jpg";}?>" alt="user" class="img-fluid" style="max-width: 20%;">
                                                </div>
                                        </div>
                                    </div>
                              
                            </div>
                            <hr>
                            <div class="row clearfix">
                            <div class="col-md-12 col-sm-12"  >
                                  <div class="card bg-default text-dark mb-3" >
                                    
                                   <div class="row clearfix" style="border: 1px solid black !important;">
                                    <div class="col-md-4 col-sm-12"  style="border: 1px solid black !important;">
                                       
                                     <div class="title">
                                        <h4 style="margin-top: 10px;">Customer Detail</h4></div><hr>
                                        <p><b>ID </b> :  <?php echo $iden1.$iden2."_".$seprate_customer_id;?></p>
                                        <p><b>NAME </b> :  <?php echo $customer_name;?></p>
                                    <!--     <p><b>CUSTOMER CREATED BY</b> :  <?php echo $customer_from;?></p> -->
                                        <p><b>CUSTOMER GENDER </b> :  <?php echo $gender;?></p>
                                        <p><b>RESIDENTIAL ADDRESS : </b> <?php echo $customer_address2;?></p>
                                        <p><b>OFFICE ADDRESS : </b> <?php echo $customer_address1;?></p>
                                        <p><b>PHONE 1: </b><?php echo $customer_phone;?></p>
                                        <p><b>PHONE 2: </b><?php echo $customer_phone2;?></p>
                                        <p><b>CUSTOMER CNIC : </b><?php echo $client_cnic;?></p>
                                        <p><b>CUSTOMER FATHER : </b><?php echo $client_fname;?></p>
                                        <p><b>CUSTOMER OCCUPATION : </b><?php echo $client_occupation;?></p>
                                       <!--  <p><b>CUSTOMER RESIDENCE : </b><?php echo $client_residential;?></p> -->
                                    
                                  </div>
                                    <div class="col-md-4 col-sm-12"  style="border: 1px solid black !important;">
                                      
                                     <div class="title">
                                        <h4 style="margin-top: 10px;">Office Detail</h4></div><hr>
                                        <p><b>SALE TYPE </b> : Installment</p>
                                        <p><b>BRANCH : </b> <?php echo $branch_name;?></p>
                                        <p><b>CREATED BY : </b> <?php echo $creator_name;?></p>
                                        <p><b>APPROVING MANAGER : </b> <?php echo $bm_name;?></p>
                                        <p><b>MO : </b> <?php echo $mo_name;?></p>
                                        <p><b>AVO : </b> <?php echo $avo_name;?></p>
                                        <p><b>SALE'S MAN : </b> <?php echo $sales_men;?></p>
                                        <p><b>SRM : </b> <?php echo $srm_name;?></p>
                                        <p><b>RM : </b> <?php echo $rm_name;?></p>
                                        <p><b>CRC : </b> <?php echo $crc_name;?></p>
                                        <p><b>PTO : </b> <?php echo $pto;?></p>
                                 
                                  </div>
                                  <div class="col-md-4 col-sm-12"  style="border: 1px solid black !important;">

                                    
                                     <div class="title">
                                        <h4 style="margin-top: 10px;">Product Detail</h4></div><hr>
                                        <p><b>CATAGORY NAME : </b> <?php echo $cat_name;?></p>
                                        <p><b>ITEM NAME : </b> <?php echo $item_name;?></p>
                                        <p><b>ITEM MODEL : </b> <?php echo $item_model;?></p>
                                        <p><b>TOTAL AMOUNT : </b> <?php echo $total_price;?></p>
                                
                                        <p><b>REMAINING PAYMENT : </b> <?php echo $remaining-$down_payment;?></p>
                                        <p><b>PER MONTH PAYMENT : </b> <?php echo $per_month_amount;?></p>
                                    </div>
                                  
                              </div>
                                </div>
                            </div>
                            </div>
                            
                           <div class="row clearfix" style="border: 1px solid black !important;">
                            <div class="col-md-3 col-sm-6"  style="border: 1px solid black !important;">
                                 
                                    <div class="col-md-12 col-sm-12" >
                                     <div class="title" >
                                    <h4 style="margin-top: 10px;">Guarantor 1</h4><hr></div>
                                    <p>Guarantor Name : <?php echo $gran1_name;?></p>
                                    <p>Guarantor Father Name : <?php echo $gran1_fname;?></p>
                                    <p>Guarantor Phone : <?php echo $gran1_mobile_no;?></p>
                                    <p>Guarantor CNIC : <?php echo $gran1_client_cnic;?></p>
                                    <p>Guarantor Relation : <?php echo $gran1_relation;?></p>
                                    <p>Guarantor Occupation : <?php echo $gran1_occup;?></p>
                                    <p>Guarantor Address : <?php echo $gran1_address;?></p>
                                    <p>Guarantor Office Address : <?php echo $gran1_office;?></p>
                                  </div>
                                
                            </div>
                            <div class="col-md-3 col-sm-6" style="border: 1px solid black !important;">
                          
                                    <div class="col-md-12 col-sm-12">
                                     <div class="title">
                                     <h4 style="margin-top: 10px;">Guarantor 2</h4><hr></div>
                                    <p>Guarantor Name : <?php echo $gran2_name;?></p>
                                    <p>Guarantor Father Name : <?php echo $gran2_fname;?></p>
                                    <p>Guarantor Phone : <?php echo $gran2_mobile_no;?></p>
                                    <p>Guarantor CNIC : <?php echo $gran2_client_cnic;?></p>
                                    <p>Guarantor Relation : <?php echo $gran2_relation;?></p>
                                    <p>Guarantor Occupation : <?php echo $gran2_occup;?></p>
                                    <p>Guarantor Address : <?php echo $gran2_address;?></p>
                                    <p>Guarantor Office Address : <?php echo $gran2_office;?></p>
                                    </div>
                                  
                            </div>
                            <div class="col-md-3 col-sm-6" style="border: 2px solid black !important;">
                            
                                    <div class="col-md-12 col-sm-12">
                                     <div class="title">
                                    <h4 style="margin-top: 10px;">Guarantor 3</h4><hr></div>
                                    <p>Guarantor Name : <?php echo $gran3_name;?></p>
                                    <p>Guarantor Father Name : <?php echo $gran3_fname;?></p>
                                    <p>Guarantor Phone : <?php echo $gran3_mobile_no;?></p>
                                    <p>Guarantor CNIC : <?php echo $gran3_client_cnic;?></p>
                                    <p>Guarantor Relation : <?php echo $gran3_relation;?></p>
                                    <p>Guarantor Occupation : <?php echo $gran3_occup;?></p>
                                    <p>Guarantor Address : <?php echo $gran3_address;?></p>
                                    <p>Guarantor Office Address : <?php echo $gran3_office;?></p>
                                    </div>
                                
                            </div>
                            <div class="col-md-3 col-sm-6" style="border: 1px solid black !important;">
                                  
                                    <div class="col-md-12 col-sm-12">
                                     <div class="title">
                                        <h4 style="margin-top: 10px;">Guarantor 4</h4><hr></div>
                                    <p>Guarantor Name : <?php echo $gran4_name;?></p>
                                    <p>Guarantor Father Name : <?php echo $gran4_fname;?></p>
                                    <p>Guarantor Phone : <?php echo $gran4_mobile_no;?></p>
                                    <p>Guarantor CNIC : <?php echo $gran4_client_cnic;?></p>
                                    <p>Guarantor Relation : <?php echo $gran4_relation;?></p>
                                    <p>Guarantor Occupation : <?php echo $gran4_occup;?></p>
                                    <p>Guarantor Address : <?php echo $gran4_address;?></p>
                                    <p>Guarantor Office Address : <?php echo $gran4_office;?></p>
                                    </div>
                                 
                            </div>
                            </div><br>


          
                            <div class="row clearfix" id="Installment_detail">
                                
                                    <div class="table-responsive">
                                        <table class="table table-hover" style="border: 2px solid black; ">
                                            <thead class="thead-default ">
                                                <tr >
                                                    <th hidden="" >Installment#</th>
                                                    <th>For Month</th>
                                                    <th>Monthly Installment</th>

                                                    <th >Created By</th>
                                                    <th >Receiving Branch</th>
                                                    <th >Status</th>
                                                    <th class="text-right">Paid Date</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody id="Installmentdetail1">
                                            </tbody>
                                                <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                              
            
                            </div>                            
                        
                            <hr>
                       <!--      <div class="row clearfix nodisplay">
                                <div class="col-md-6">
                                    <h5>Note</h5>
                                    <p>Sale Items can only be returend in given period of time.</p>
                                </div>
                                
                            </div> -->
                             <div class="row clearfix nodisplay">
                                <div class="col-md-12 text-center">
                                    <a href="installment_customer.php"><button type="button"  class="btn btn-danger">Back</button></a>
                                    <button class="btn btn-info" id="printPageButton" onClick="window.print();">Print</button>
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

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
</body>
<script type="text/javascript">
    get_installmentdetail();
     function get_installmentdetail(){

        var planid=<?php echo $planid;?>;


          $.ajax({
            type: "POST",
            url:"operations/inst_invoice.php",
            data: {planid:planid},
         
           success:function(data)
           {

            $('#Installmentdetail1').html(data);
           }
          })

        }
</script>
<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
