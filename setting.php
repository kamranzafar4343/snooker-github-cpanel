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
<?php
include "includes/loader.php";

?>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Setting</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Setting</li>
                            <li class="breadcrumb-item active">Add</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            
            <div class="row clearfix">
                
                    <div class="col-lg-8 col-md-8">
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
                                    $language=$row['lang'];
                                    $secret=$row['secret'];
                                    $over_selling=$row['over_selling'];
                                    

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
                                <div class="row clearfix">
                                <label class="col-sm-2 text-right">Select Language</label>
                                <div class="col-md-10 col-sm-12">
                                    <div class="form-group">
                                       <select name="lang" class="form-control">
                                           
                                           <?php if($language=='ar'){?>
                                            <option value="an" >English</option>
                                            <option value="ar" selected="">Arabic</option>
                                            <?php } else{?>
                                            <option value="an" selected="">English</option>
                                            <option value="ar">Arabic</option>
                                            <?php }?>
                                           
                                       </select>
                                    </div></div>
                                    </div>
                                    <div class="row clearfix">
                                <label class="col-sm-2 text-right">Over Selling</label>
                                <div class="col-md-10 col-sm-12">
                                    <div class="form-group">
                                       <select name="over_selling" class="form-control">
                                           
                                           <?php if($over_selling==1){?>
                                            <option value="1" selected="">Yes</option>
                                            <option value="0" >No</option>
                                            <?php } else{?>
                                            <option value="0" selected="">No</option>
                                            <option value="1">Yes</option>
                                            <?php }?>
                                           
                                       </select>
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

                <div class="col-lg-4 col-md-4" >

                    <div class="card">
                       <div class="body">
                        <div class="tab-pane p-l-15 p-r-15 active show" id="setting">
                        <h6>Choose Skin (click twice to change color)</h6>
                        <ul class="choose-skin list-unstyled">
                        <li data-theme="purple" <?php if($color=='purple'){?>class="active"<?php }?>>
                        <div class="purple"></div>
                        <span>Purple</span>
                        </li>
                        <li data-theme="blue" <?php if($color=='blue'){?>class="active"<?php }?>>
                        <div class="blue"></div>
                        <span>Blue</span>
                        </li>
                        <li data-theme="cyan" <?php if($color=='cyan'){?>class="active"<?php }?>>
                        <div class="cyan"></div>
                        <span>Cyan</span>
                        </li>
                        <li data-theme="green" <?php if($color=='green'){?>class="active"<?php }?>>
                        <div class="green"></div>
                        <span>Green</span>
                        </li>
                        <li data-theme="orange" <?php if($color=='orange'){?>class="active"<?php }?>>
                        <div class="orange"></div>
                        <span>Orange</span>
                        </li>
                        <li data-theme="blush" <?php if($color=='blush'){?>class="active"<?php }?>>
                        <div class="blush"></div>
                        <span>Blush</span>
                        </li>
                        </ul>
                        </div>
                    </div>
                  </div>
                </div>  
                    <div class="col-lg-2 col-md-12" hidden>

                        <div class="row clearfix text-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="body">
                                    <input type="text" class="knob" id="sale_perc" value="<?php echo $sale_per;?>" data-width="70" data-height="70" data-thickness="0.1"  data-fgColor="#01b2c6" onchange="add_sale_perc();" >
                                    <h6>Sale Percentage</h6>
                                    <spapn>Sale percentage for this month</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="body" id="avo">
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
<script type="text/javascript">
  $('.calculate').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
  
});
</script>

<script>
    
$(function () {
    $(".submit").click(function() {
         var calculate= $('.calculate').val();
         if(calculate<100000)
          {
            $("#error-alert").show();
                    $("#error-alert").fadeTo(4000, 500).slideUp(500, function() {
                  $("#error-alert").slideUp(500);
              });
          
     
            return false;
          }

    });
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

      var avo_perc=$("#avo_perc").val();

              var dataString = 'avo_perc='+ avo_perc;

                $.ajax({
            type: "POST",
            url: "operations/add_config.php",
            data: dataString,

            success: function(responce){
            $("#avo").empty();
            $("#avo").html(responce);
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
function skinChanger()
{
  $(".choose-skin li").on("click",function(){

    var t=$("body"),e=$(this),i=$(".choose-skin li.active").data("theme");
 
    $.ajax({
            url:"operations/add_color.php",
            method:"POST",
            data:{i:i},
            success:function(data){

            }
        });
    $(".choose-skin li").removeClass("active"),t.removeClass("theme-"+i),e.addClass("active"),t.addClass("theme-"+e.data("theme"))
  })}
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
