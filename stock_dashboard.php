<!doctype html>
<html lang="en">


<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
include "includes/head.php";


session_start();

if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}
?>

<body class="theme-orange">

<!-- Page Loader -->
<!-- <div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Stock Transfer Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Stock Transfer</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
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
                 <?php    
 // if($_POST){
  // print_r($_POST);
if($_POST)
{
  $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
  $newDate1 = date("d-m-Y", strtotime($f_date));
  $newDate2 = date("d-m-Y", strtotime($t_date));  
  $branch=mysqli_real_escape_string($conn,$_POST['branch']);
  $status=mysqli_real_escape_string($conn,$_POST['status']);
  if($branch=='')
{
    $branch_name='All';

}
else
{
    $sql="SELECT user_name FROM users where user_id='$branch'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          
                          $branch_name = $data['user_name'];
                          
                         }

}
}
else
{
    
    $status = "All";
    $branch='All';
   
    $branch_name='All';
    $f_date = date('Y-m-d');  
    $t_date = date('Y-m-d');
    $newDate1 = date("d-m-Y", strtotime($f_date));
  $newDate2 = date("d-m-Y", strtotime($t_date));
}

   ?>

                         <form  action="stock_dashboard.php" id="form1"method="post" enctype="multipart/form-data">
                        <div class="body">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                  <div class="alert alert-danger"   id="danger-alert1" style="display:none;">
  
  <strong>Sorry ! </strong>From Date Should be Smaller Then To Date!.
</div>
                            <div class="row clearfix">
                                
                              <div class="col-md-2 col-sm-12">
                                 <label   for="description">From Date </label>
                                    <div class="form-group">
                                  
                                        <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $f_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                           
                                  
                              <div class="col-md-2 col-sm-12">
                                <label   for="description">To Date </label>
                                    <div class="form-group">
                                <input type="date" class="form-control" name="t_date" id="t_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $t_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                            
                              <div class="col-md-4 col-sm-12">
                                <label for="description">Location </label>
                                    <div class="form-group">
                                <select class="form-control mb-3 show-tick select_group" name="branch" >
                                    <option selected="selected" value="All">All</option>
                                  <?php
                                            $sql="SELECT * FROM users where user_privilege='superadmin' or user_privilege='branch'"; 
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
                
                                  <div class="col-md-2 col-sm-12">
                                     <label for="description">Status </label>
                                    <div class="form-group">
                                     <select class="form-control select_group" name="status" id="status">
                                       
                                        <?php
                                        if($status=='All'){?>
                                             <option selected="selected" value="All">All</option>
                                             <option value="1">Recieved</option>
                                             <option value="2">Transfered</option>
                                        <?php }
                                        else if($status=='1'){?>
                                             <option  value="All">All</option>
                                             <option selected="selected" value="1">Recieved</option>
                                             <option value="2">Transfered</option>
                                        <?php }
                                        else if($status=='2'){?>
                                             <option  value="All">All</option>
                                             <option  value="1">Recieved</option>
                                             <option selected="selected" value="2">Transfered</option>
                                        <?php }?>

                                        
                                    </select>
                                    </div>
                                </div>
                              
                                
                                
                                <div class="col-md-2 col-sm-12" style="margin-top:25px; ">
                                    <button style="width:100%; " type="submit" class="btn btn-secondary" name="purchase_rep" target='_blank'>Search</button>
                                </div>
                        </div>
                    </form>
                    </div>
                </div>

                 <div class="row clearfix" >
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                       
                               <div class="row clearfix">
                                
                            <div clas="clearfix text-right col-md-3" >

                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $newDate1.'/'.$newDate2;?>
                       </span></div> </div> 
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>#</th> 
                                                            <th>From Branch</th>                               
                                                            <th>To Branch</th>                                      
                                                            <th>Transfer No</th>
                                                            <th>Transfer Date</th>                                      
                                                            <th>Status</th>                                      
                                                      
                                                            <th>Remarks</th>
                                                
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  
<?php

if($status == "All" && $branch=='All'){

    $where_status="";
    $where_location="";
  }
  else if($status == "All" && $branch!='All')
  {
      $where_status="and tbl_purchase_req.stock_receive_status='Completed'";
      $where_location="and tbl_purchase_req.from_location='$branch'";
  }
  else if($status == "1" && $branch!='All')
  {
      $where_status="and tbl_purchase_req.stock_receive_status='Completed'";
      $where_location="and tbl_purchase_req.from_location='$branch'";
  }
  else if($status == "2" && $branch!='All')
  {
      $where_status="and tbl_purchase_req.stock_status='Completed'";
      $where_location="and tbl_purchase_req.from_location='$branch'";
  }
  else if($status == "1" && $branch=='All')
  {
      $where_status="and tbl_purchase_req.stock_receive_status='Completed'";
      $where_location="and tbl_purchase_req.from_location!=''";
  }
  else if($status == "2" && $branch=='All')
  {
      $where_status="and tbl_purchase_req.stock_status='Completed'";
      $where_location="and tbl_purchase_req.from_location!=''";
  }

$bsql=mysqli_query($conn,"SELECT * FROM tbl_purchase_req WHERE date(created_date) between '$f_date' and '$t_date' and transfer_type='2' $where_status $where_location");
  $datafound=mysqli_num_rows($bsql);

      $count=0;
while($value = mysqli_fetch_assoc($bsql))   
                                {   
                                    $purchase_req_id=$value['purchase_req_id']; 
                                    $location=$value['location'];

                                    $sql="SELECT user_name FROM users where user_id='$location'";
                                    $result1 = mysqli_query($conn,$sql);
                                    while($data = mysqli_fetch_array($result1) ){
                                      
                                      $to_branch_name = $data['user_name'];
                                      
                                     }
                                    $from_location=$value['from_location']; 
                                    $sql="SELECT user_name FROM users where user_id='$from_location'";
                                    $result1 = mysqli_query($conn,$sql);
                                    while($data = mysqli_fetch_array($result1) ){
                                      
                                      $from_branch_name = $data['user_name'];
                                      
                                     }
                                    $invoice_no=$value['invoice_no']; 
                                    $created_date=$value['created_date'];
                                    $date = date('d-m-Y',strtotime($created_date));
                                    $time = date('H:i a',strtotime($created_date));
                                    $po_remarks=$value['po_remarks'];
                                    $stock_receive_status=$value['stock_receive_status'];
                                    $stock_status=$value['stock_status'];
                                    if($stock_status=='Completed' && $stock_receive_status=='Pending')
                                    {
                                        $status_display="Transfered";
                                    }
                                    else
                                    {
                                        $status_display="Recieved";
                                    }
                                
                  
 $count++;

  ?>
                        <tr>
                  
                            <td><?php echo $count;?></td>
                            <td><?php echo $from_branch_name;?></td>
                            <td><?php echo $to_branch_name;?></td>
                            <td><a href="stock_dashboard_invoice.php?purchase_req_id=<?php echo $purchase_req_id;?>" target="_blank"><?php echo $invoice_no;?></a></td>
                            <td><?php echo $date;?> <?php echo $time;?></td>
                            <td><?php echo $status_display;?></td>
                            <td><?php echo $po_remarks;?></td>            
                        </tr>

                                                       
<?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                                                
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
          extend: 'pdf',
          text: 'PDF',
          title: 'Alkareem (Stock Report)',
          orientation: 'landscape',
          text:'<span class="text-default"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
          pageSize: 'LEGAL',
          className: 'btn btn-sm btn-outline-dark',
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
          className: 'btn btn-sm btn-outline-dark',
          titleAttr: 'print',
          text:'<span class="text-default"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>', 

          
          title: 'Alkareem (Stock Report)',

          
        },


      ]


    });
} );
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
  getcat();
            function getcat(){

    var cat_id = $('#brand_id').val();
if(cat_id!='All')
{
      $.ajax({
                  method: "POST",
                  url: "operations/get_cat.php",
                  data: {cat_id:cat_id},
                  dataType: 'json',                 
                })
                .done(function(response){
                   var len = response.length;
                   
                 
                     $("#cat_id").empty();
                     $("#cat_id").append("<option value='All'>All Item</option>");
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var item_name = response[i]['cat_name'];
                            // alert(id);
                            $("#cat_id").append("<option value='"+id+"'>"+item_name+"</option>");

                        }
                        getitem();
                });

}
else
{
    $("#cat_id").empty();
    $("#cat_id").append("<option value='All'>All Item</option>");
}
                


} 

      function getitem(){

    var cat_id = $('#cat_id').val();
 if(cat_id!='All')
{
      $.ajax({
                  method: "POST",
                  url: "operations/get_items.php",
                  data: {cat_id:cat_id},
                  dataType: 'json',                 
                })
                .done(function(response){
                   var len = response.length;

                     $("#item_id").empty();
                     $("#item_id").append("<option value='All'>All Item</option>")
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
    $("#item_id").append("<option value='All'>All Item</option>")

}


}
 
</script>


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
</html>
