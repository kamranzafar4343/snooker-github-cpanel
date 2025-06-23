<!doctype html>
<html lang="en">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
include "includes/head.php";
include "user_permission.php";

session_start();

if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}
?>

<body class="theme-orange">

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->
   <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>
<div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Local Purchase Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Local Purchase Report</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
 <?php    
 if($_POST){
  // print_r($_POST);
  $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
  $newDate1 = date("d-m-Y", strtotime($f_date));
  $newDate2 = date("d-m-Y", strtotime($t_date));
  $branch=mysqli_real_escape_string($conn,$_POST['branch']);
  $vendors=mysqli_real_escape_string($conn,$_POST['vendors']);
  $cat=mysqli_real_escape_string($conn,$_POST['cat']);
  $items=mysqli_real_escape_string($conn,$_POST['items']);
}
else
{
    $vendors='All';
    $items='Alll';
    $cat = "All";
    $branch=$userid;
    $f_date = date('Y-m-d');  
    $t_date = date('Y-m-d');
    $newDate1 = date("d-m-Y", strtotime($f_date));
    $newDate2 = date("d-m-Y", strtotime($t_date));

}
if($_GET){
  $items='Alll';
  $cat = "All";
  $branch=$userid;
  // $items = 'All';
  $f_date =mysqli_real_escape_string($conn,$_GET['fdate']);
  $t_date=mysqli_real_escape_string($conn,$_GET['tdate']);
  $newDate1 = date("d-m-Y", strtotime($f_date));
  $newDate2 = date("d-m-Y", strtotime($t_date));
  $vendors=mysqli_real_escape_string($conn,$_GET['u_id']);

  // print_r($_GET);
  // echo $f_date;exit();
  }
  // echo $vendors;exit();  




   ?>


<body >
   <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * 0.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5); margin-top: 30px;">
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
                                    <h1 class="text-center"><?php echo $c_name;?></h1>
                                    <h3  class="text-center">Local Purchase Report</h3>

                                  
                                </div>

                            </div>
                              </div>
                                      <div class="row">
                            <div class="clearfix text-center col-md-12" >
                                <div class="info text-center col-md-12"  >
                                   <p>(<?php echo $c_address;?>)<br><?php echo $c_phone;?></p>
                               </div> </div>
                              </div>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                <div class="alert alert-danger"   id="danger-alert" style="display:none;">
                                  
                                  <strong>Sorry ! </strong>From Date Should be Smaller Then To Date!.
                                </div>
                         <form  action="loc_single.php" method="post" enctype="multipart/form-data" id='form1'>
                        <div class="body">

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
                                <div class="col-md-4 col-sm-12">
                                    <label for="description">Branch </label>
                                    <div class="form-group">
                                    <select class="form-control mb-3 show-tick select_group" name="branch" >

                                  <?php
                                           $sql="SELECT branch_id,created_by  FROM users where user_id='$userid'";
                                              $result1 = mysqli_query($conn,$sql);
                                              while($data = mysqli_fetch_array($result1) ){
                                                $created_by = $data['created_by'];
                                                $branch_id = $data['branch_id'];
                                               }
                                            if($branch_id=='')
                                            {
                                              $sql="SELECT * FROM users where user_privilege='superadmin' or user_privilege='branch'"; 
                                              ?>
                                              <option value="">All</option>
                                              <?php
                                            }
                                            else
                                            {
                                              $sql="SELECT * FROM users where user_id='$userid'";
                                            }
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['user_id']==$branch)
                                            {
                                            echo "<option value=$row[user_id] selected>$row[user_name]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[user_id]>$row[user_name] </option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>
                                </select>
                                        </div>
                                          </div>
                                <div class="col-md-4 col-sm-12">
                                    <label for="description">Vendors </label>
                                    <div class="form-group">
                                        <select class="form-control mb-3 show-tick select_group" name="vendors" >
                                            <option value="All">All Vendors</option>
                                        <?php
                                           $sql="SELECT username,vendor_id  FROM tbl_vendors";
                                            
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['vendor_id']==$vendors)
                                            {
                                            echo "<option value=$row[vendor_id] selected>$row[username]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[vendor_id]>$row[username] </option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="description">Category </label>
                                    <div class="form-group">
                                        <select class="form-control select_group" name="cat" id="cat_id" onchange="getitem()" >
                                          <option value="All">All Category</option>
                                               <!--  <option selected="selected">Choose one</option> -->
                                                <?php

                                                $sql="SELECT cat_name,id  FROM tbl_catagory"; 


                                                foreach ($conn->query($sql) as $row){

                                                    if($row['id']==$cat)
                                                    {
                                                    echo "<option value=$row[id] selected>$row[cat_name]</option>"; 
                                                    }
                                                    else
                                                    {
                                                    echo "<option value=$row[id]>$row[cat_name] </option>"; 
                                                    }
                                                }

                                                 echo "</select>";
                                                 ?>
                                        </select>
                                        </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="description">Items </label>
                                    <div class="form-group">
                                        <select class=" form-control select_group"  id="item_id" name='items' >
                                              <option value="Alll">All Items</option>
                                                
                                            </select>
                                        </div>
                                </div>
                               <div class="col-md-2 col-sm-12" style="margin-top:30px;">
                                        <button style="width:100%; " type="submit" class="btn btn-sm btn-dark" name="purchase_rep" onclick="check()" target='_blank'>Search</button>
                                 </div>
                             
                                </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
            <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * -1.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5);">
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                
                       
                       
                          
               <?php
                            if($vendors=='All'){
                              $vendornamee="All";
                            }else{
                        $sqll=mysqli_query($conn, "SELECT * FROM tbl_vendors where vendor_id='$vendors'");
                        $dataa=mysqli_fetch_assoc($sqll);
                        // print_r($dataa);
                        $vendornamee = $dataa['username']; }  ?>  

                               <div class="row">
                                   <div class="clearfix text-left col-md-6" >

                            <span > <b>VENDOR  : </b> <?php echo $vendornamee;?>
                       </span></div> 
                            <div class="clearfix text-right col-md-6" >

                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $newDate1.'/'.$newDate2;?>
                       </span></div> </div> 
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Local PO#</th>                                      
                                                            <!-- <th>P_ID</th>                                       -->
                                                            <th>Vendor</th>                                      
                                                      
                                                            <th>Total</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  
<?php

if($items=="Alll")
{

  $where_items="";

}
else
{

  $where_items=" and  tbl_single_purchase_detail.product='$items'";

}

if($vendors == "All"){

  $where_vendors="";
}
else{
    $where_vendors="and tbl_single_purchase.vendor_id='$vendors'";
    
}
if($cat == "All"){

  $where_cat="";
}
else{
    $where_cat="and tbl_items.brand_id='$cat'";

}


                                    if($branch=='')
                                      {

                                          $where_branch='';
                                        
                                      }
                                      else
                                      {

                                          $where_branch='where user_id="'.$branch.'"';
                                         ;

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

                                    if($branch=='')
                                      {

                                          $where_created='';
                                      }
                                      else
                                      {
                                          $where_created=' and tbl_single_purchase.parent_id="'.$created_by.'"';

                                      }

   $bsql=mysqli_query($conn,"SELECT tbl_single_purchase_detail.*,tbl_single_purchase.*,tbl_items.* From tbl_single_purchase_detail inner join tbl_single_purchase on tbl_single_purchase_detail.purchase_id=tbl_single_purchase.purchase_id inner join tbl_items on tbl_single_purchase_detail.product=tbl_items.item_id where  DATE(tbl_single_purchase.created_date) between '$f_date' and '$t_date' $where_items  $where_vendors $where_cat $where_created group by tbl_single_purchase_detail.purchase_id order by DATE(tbl_single_purchase.created_date) asc");



      $count=0;

                                  // print_r(mysqli_fetch_array($bsql));
while($value = mysqli_fetch_assoc($bsql))   
                                {   
                                   
                                    $product=$value['product'];
                                    $bsql2=mysqli_query($conn,"SELECT created_date as pur_date From tbl_single_purchase_detail where product='$product'");
                                    $value1 = mysqli_fetch_assoc($bsql2);
                                    $pur_date=$value1['pur_date'];
                                    $newDate = date("d-m-Y", strtotime($pur_date));
                                    $cat_name=$value['item_name']; 
                                    $purchase_id=$value['purchase_id']; 
                                    $vendor_id=$value['vendor_id']; 
                                    // echo "$cat_name $product<br>";
                                    $net_amount=$value['net_amount'];
                                    $qty=$value['qty'];

                                    $amount=$value['amount'];
                                    $net_amount=$value['net_amount'];
                           
                                    $gross_amount=$value['gross_amount'];
                                    $date=$value['created_date'];

  $sql=mysqli_query($conn, "SELECT * FROM tbl_vendors where vendor_id='$vendor_id'");
                        $data=mysqli_fetch_assoc($sql);
                        $vendorname = $data['username'];
                        // echo $vendorname;exit();

  $sql2=mysqli_query($conn, "SELECT * FROM tbl_items where item_id=$product");
                        $data1=mysqli_fetch_assoc($sql2);
                        $itemname = $data1['item_name'];
 $count++;
  ?>
                                                        <tr>
                            <!-- <td><?php echo $count;?></td> -->
                            <td><a href="local_item_detail.php?u_id=<?php echo $purchase_id ?>" target="_blank"><?php echo $count;?></a></td>
                            <td><?php echo $vendorname;?></td>
                            <td><?php echo $net_amount;  $total_amount+=$net_amount;?></td>
                            <td><?php echo $newDate;?></td>
                                                        </tr>
                                                       
                                                      <?php }?>
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
                                            <p class="m-b-0"><b>Sub-total:</b> <?php echo $total_amount; ?></p>
                                            <p class="m-b-0">Discout: <?php echo $discount; ?>%</p>
                                                                                   
                                            <h3 class="m-b-0 m-t-10">NET AMT - <?php $net_amount=$total_amount-$discount; echo $net_amount; ?></h3>
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


    
</div>
            </div>
    
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="assets_light/bundles/mainscripts.bundle.js"></script>

<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>
<script type="text/javascript">
  function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        // window.location = document.referrer;
        window.location = ('customer.php');
        /* OR */
        //location.replace(document.referrer);
    } else {
      window.location('customer.php');
        // window.history.back().back();
        // window.history.back();
    }
}
</script>
<style type="text/css">
  .data-table-container {
  padding: 10px;
}

.dt-buttons .btn {
  margin-right: 3px;
}

</style>
<script type="text/javascript">
$(document).ready(function() {
    $(".select_group").select2();
          $('#example').DataTable({
      dom: 'Bfrtip',
      scrollY: true,
      scrollX: false,
      "paging":   false,
      "ordering": false,
      "info":     false,
      searching: true,
      buttons: [
        {
          extend: 'pdfHtml5',
          text: 'Alkareem',
           title: '<?php echo $c_name;?> (Local PO Report)',
           
          
          text:'<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
          
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

          
          title: '<?php echo $c_name;?> (Local PO Report)',

          
        },


      ]


    });
} );
</script>
<script type="text/javascript">
  function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        // window.location = document.referrer;
        window.location = ('search_purchase.php');
        /* OR */
        //location.replace(document.referrer);
    } else {
      window.location('search_purchase.php');
        // window.history.back().back();
        // window.history.back();
    }
}
</script>
<script type="text/javascript">
  $("#danger-alert1").hide();
  $("#form1").submit(function(e){
     var from = $("#f_date").val();
var to = $("#t_date").val();

if(Date.parse(from) > Date.parse(to)){
   e.preventDefault();
   // alert("Invalid Date Range");
     

    $("#danger-alert1").fadeTo(4000, 500).slideUp(500, function() {
      $("#danger-alert1").slideUp(500);
    });
  
   $("$f_date").focus();
    // return false;
    }
});

getitem();
        function getitem(){

    var cat_id = $('#cat_id').val();
   
 if(cat_id!='All')
{
      $.ajax({
                  method: "POST",
                  url: "operations/get_purchase_items.php",
                  data: {cat_id:cat_id},
                  dataType: 'json',
                  encode: true,                  
                })
                .done(function(response){
                   var len = response.length;

                     $("#item_id").empty();
                     $("#item_id").append("<option value='Alll'>All Item</option>")
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var item_name = response[i]['item_name'];

                            $("#item_id").append("<option value='"+id+"'>"+item_name+"</option>");

                        }
           
                    
                });
}
else
{
    $("#item_id").empty();
    $("#item_id").append("<option value='Alll'>All Item</option>")

}
}
//             function getitem(){
//               // alert("item");

//     var cat_id = $('#cat_id').val();
 
   
//       $.ajax({
//                   method: "POST", 
//                   url: "operations/get_purchase_items.php",
//                   data: {cat_id:cat_id},
//                   dataType: 'json', 
//                   encode: true,                 
//                 })
//                 .done(function(response){
//                    var len = response.length;
//                    // alert(len)
//                      $("#item_id").empty();
//                         for( var i = 0; i<len; i++){
//                             var id = response[i]['id'];
//                             var item_name = response[i]['item_name'];

//                             $("#item_id").append("<option value='"+id+"'>"+item_name+"</option>");

//                         }
           
                    
//                 });


// }
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
