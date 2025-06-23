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
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->

<div id="wrapper">

    <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Company</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Company</li>
                            <li class="breadcrumb-item active">Add</li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="bh_chart hidden-xs">
                            <div class="float-left m-r-15">
                                <small>Visitors</small>
                                <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                            </div>
                            <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Visits</small>
                                <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                            </div>
                            <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Chats</small>
                                <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                            </div>
                            <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row clearfix">
                
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                        <div class="body">
                            <?php
                            // $comp_id=$_GET['comp_id'];
       
                            $customer_edit = mysqli_query($conn,"SELECT * FROM tbl_company");
                                $row = mysqli_fetch_assoc($customer_edit);   
                                 $comp_id=$row['comp_id'];
                                    $email=$row['c_email'];
                                    $username=$row['c_name'];
                                 
                                    $mobile_no=$row['c_mobile'];
                                    $c_phone=$row['c_phone'];
                                    
                                    $user_profile=$row['user_profile'];
                                    $c_address=$row['c_address'];
                                    $sale_per=$row['sale_per'];
                                    $avo_perc=$row['avo_perc'];
                                    $mo_perc=$row['mo_perc'];
                                    

                            ?>
                                <form action="operations/company_update.php" method="post"  enctype="multipart/form-data">
                            <div class="row clearfix">
                                <label class="col-sm-2 text-right">Name</label>
                                <div class="col-md-10 col-sm-12">
                                    <div class="form-group">                                   
                                        <input type="text" name="c_name" required=""  class="form-control" placeholder="Company Name " value="<?php echo $username; ?>">
                                    </div>
                                </div>
                            </div>
                              <!--  -->
                               <div class="row clearfix">
                               
                                    <label class="col-sm-2 text-right">Email</label>
                                <div class="col-md-10 col-sm-12">
                
                                    <div class="form-group">
                                        <input type="text" name="c_email" required=""  maxlength="40"   class="form-control" placeholder="Company Email Address " value="<?php echo $email; ?>">
                                    </div>
                                </div>    
                         </div>    
                          <div class="row clearfix">
                                <label class="col-sm-2 text-right">Mobile Number</label>
                                <div class="col-md-10 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="c_mobile" required=""  maxlength='11' class="form-control" placeholder="Company Mobile No" value="<?php echo $mobile_no; ?>">
                                    </div>
                                </div>
                                   </div>  
                                    <div class="row clearfix">
                                <label class="col-sm-2 text-right">Phone Number</label>
                                <div class="col-md-10 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="c_phone" required=""  maxlength='11' class="form-control" placeholder="Company Phone No" value="<?php echo $mobile_no; ?>">
                                    </div>
                                </div>
                                   </div> 

                                                <div class="row clearfix">  

                                <label class="col-sm-2 text-right">Company Logo</label>
                                <div class="col-md-10 col-sm-12">
                                    <div class="form-group">
                                              <div class="input-group">
                                      
                                                    <input type="file" class="form-control"   name="user_profile" >
                                                </div>
                                                        </div>
                                </div>
                                          
                                    
                            
                                   </div>
                                   <?php if($comp_id!="") {?>
                                   <div class="row">
                                    <div class="col-md-2">
                                       <h6 class="text-right">The current Image is:</h6>
                                         </div>
                                          <div class="col-md-10 text-left">
                                                           <div class="form-group">
                                                         
                                                               
                                              
                                                    <img style="width: 200px;height: 200px;" src="<?php echo $user_profile; ?>">
                                     
                                                </div>
                                                  </div>
                                       
                                   </div>
                                   <?php } ?>
                                <div class="row clearfix">
                                <label class="col-sm-2 text-right">Company Address</label>
                                <div class="col-md-10 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" required="" name="c_address" class="form-control" placeholder="Company Address" value="<?php echo $c_address; ?>">
                                         <input type="hidden" name="edit_id" class="form-control"  value="<?php echo $comp_id; ?>">
                                    </div></div>
                                    </div>
                                  <div class="row clearfix" hidden="">
                                <label class="col-sm-2 text-right">Sale Percentage</label>
                                <div class="col-md-10 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="sale_per"   maxlength='2' class="form-control" placeholder="Sale Percentage" value="<?php echo $sale_per; ?>">
                                    </div>
                                </div>
                                   </div> 
                                <div class="text-right">
                            <button type="submit" name="addcompany" class="btn btn-primary">Add</button>
                            <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>
</div>

                        </div>
                        </form> 

                    </div>
                    </div>

                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <?php
              
              if(isset($_GET['target']) && $_GET['target']=='successful' ){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Branch Target Added Succesfully.
</div>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#success-alert").hide();

    $("#success-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
    });
  });
    </script>
            
              <?php
              }

              if(isset($_GET['update']) && $_GET['update']=='unsuccessful' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong>Failed to Update.
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
              }
              ?>
                         <div class="body">
                                    <h6>Branch's Target</h6>
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12">
                                            <form  action="operations/branch_target.php" method="post">
                                                <div class="form-group">                                                
                                                    <select class="form-control location"  name="branch_id" id="branch_id">
                            
                                                      <?php
                                                      
                                                          $sql="SELECT * FROM users where user_privilege='branch'";
                                                        
                                                        foreach ($conn->query($sql) as $row){
                                                          
                                                        if($row['user_id']==$branch)
                                                        {
                                                        echo "<option value=$row[user_id] selected>$row[username]</option>"; 
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
                                                 <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" name="target" id="target"   maxlength='8' class="form-control" placeholder="Sale Target" value="<?php echo $target; ?>">
                                                    </div>
                                                </div>
                                                <button type="submit" name="addtarget" class="btn btn-primary">Add</button>
                                            </form>
                                        </div>
                                    </div> 
                        </div>
                    </div>
                     <div class="card">
                        <div class="header">
                            
                            <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <h2>Branch Name</h2>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <h2>Target</h2>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <h2>Date</h2>
                                    </div>
                                </div>
                            </div>
                        <div class="body">
                            <?php
                            $lsql=mysqli_query($conn, "SELECT * FROM tbl_branch_target");
                            $i=0;
                            while($data=mysqli_fetch_assoc($lsql))
                            {
                                    $i++;
                                    $branch_id = $data['branch_id'];
                                    $target = $data['target'];
                                    $created_date = $data['created_date'];
                                    $sql=mysqli_query($conn, "SELECT user_name FROM users where user_id='$branch_id'");  
                                    $data1=mysqli_fetch_assoc($sql);
                                    $branch_name = $data1['user_name'];

                            ?>
                       
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <p><?php echo $branch_name;?></p>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <p><?php echo $target;?></p>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <p><?php echo $created_date;?></p>
                                    </div>
                                </div>
                                
                            
                         
                            <hr>
                            <?php }?>
                            
              
                        </div>
                    </div>
                </div>  
                    <div class="col-lg-2 col-md-12">
                        <div class="row clearfix text-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="body">
                                    <input type="text" class="knob" id="sale_perc" value="<?php echo $sale_per;?>" data-width="70" data-height="70" data-thickness="0.1"  data-fgColor="#01b2c6" onchange="add_sale_perc();" >
                                    <h6>Sale Percentage</h6>
                                    <spapn>sale percentage for this month</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="body">
                                    <input type="text" class="knob" value="<?php echo $avo_perc;?>" id="avo_perc" data-width="70" data-height="70" data-thickness="0.1"  data-fgColor="#2196f3" onchange="add_avo_perc();">
                                    <h6>AVO Percentage</h6>
                                    <span>AVO percentage for this month</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="body">
                                    <input type="text" class="knob" value="<?php echo $mo_perc;?>" id="mo_perc" data-width="70" data-height="70" data-thickness="0.1"  data-fgColor="#f44336"  onchange="add_mo_perc();">
                                    <h6>MO Percentage</h6>
                                    <span>MO percentage for this month</span>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>

                    </div>

    </div>
    
</div>


<!-- Javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script src="assets_light/bundles/mainscripts.bundle.js"></script>

<script>
$(function () {
    $('.knob').knob({
        draw: function () {
            // "tron" case
            if (this.$.data('skin') == 'tron') {

                var a = this.angle(this.cv)  // Angle
                    , sa = this.startAngle          // Previous start angle
                    , sat = this.startAngle         // Start angle
                    , ea                            // Previous end angle
                    , eat = sat + a                 // End angle
                    , r = true;

                this.g.lineWidth = this.lineWidth;

                this.o.cursor
                    && (sat = eat - 0.3)
                    && (eat = eat + 0.3);

                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.value);
                    this.o.cursor
                        && (sa = ea - 0.3)
                        && (ea = ea + 0.3);
                    this.g.beginPath();
                    this.g.strokeStyle = this.previousColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                    this.g.stroke();
                }

                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                this.g.stroke();

                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();

                return false;
            }
        }
    });
});
function add_sale_perc()
{
      var sale_per=$("#sale_perc").val();

              var dataString = 'sale_per='+ sale_per;

                $.ajax({
            type: "POST",
            url: "operations/add_config.php",
            data: dataString,

            success: function(responce){
          
         }
     });
}
function add_avo_perc()
{
    alert('asdas');
      var avo_perc=$("#avo_perc").val();
alert(avo_perc.toFixed(2));
return false;
              var dataString = 'avo_perc='+ avo_perc;

                $.ajax({
            type: "POST",
            url: "operations/add_config.php",
            data: dataString,

            success: function(responce){
    
         }
     });
}
function add_mo_perc()
{
      var mo_perc=$("#mo_perc").val();

              var dataString = 'mo_perc='+ mo_perc;

                $.ajax({
            type: "POST",
            url: "operations/add_config.php",
            data: dataString,

            success: function(responce){
           
         }
     });
}


</script>
<script type="text/javascript">
    
        $("#form1").submit(function(event){
         
            var branch_id=$('#branch_id').val();
            var target=$('#target').val();

           if(target=='' || isNan(target) || target=='0')
           {
            alert('Please Enter Targer Amount..!')
            return false;
            $('#target').focus();
           }
                   var dataString = 'branch_id='+ branch_id+ 'target='+target;
                   alert(dataString);
                $.ajax({
            type: "POST",
            url: "operations/branch_target.php",
            data: dataString,

            success: function(responce){
                alert(responce);
           
         }   
                   
                    
                });
                });
</script>
</body>
<script type="text/javascript">
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = document.referrer;
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}
</script> 

</html>
