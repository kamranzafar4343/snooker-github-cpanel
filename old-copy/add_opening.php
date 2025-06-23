<!doctype html>
<html lang="en">


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Accounts</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Accounts</li>
                            <li class="breadcrumb-item active">Add</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
                       <?php
              
              if(isset($_GET['insert']) && $_GET['insert']=='successfull' || isset($_GET['update']) && $_GET['update']=='successfull'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Changes Made Succesfully.
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

              if(isset($_GET['insert']) && $_GET['insert']=='unsuccessfull' || isset($_GET['update']) && $_GET['update']=='unsuccessfull'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong>Failed to Make Changes.
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


              if(isset($_GET['delete']) && $_GET['delete']=='successful'){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
 <strong>Great!</strong> Changes Made Succesfully.
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
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
                        <div class="body">
                     <?php
            
              if(isset($_GET['subchild_id']))
              {
                $subchild_id=mysqli_real_escape_string($conn, $_GET['subchild_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_account_lv2 where id=$subchild_id");
                $data=mysqli_fetch_assoc($sql);
                    
                        $aname1 = $data['aname'];
                        $parent_code1 = $data['parent_code'];
                        $sub_child11 = $data['sub_child1'];

              }
              ?>
               <?php
            
              if(isset($_GET['head_id']))
              {

                $head_id=mysqli_real_escape_string($conn, $_GET['head_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_head where id=$head_id");
                $data=mysqli_fetch_assoc($sql);
                    
                        $aname = $data['aname'];
                        $parent_code = $data['parent_code'];
                        $sub_child1 = $data['sub_child1'];
                        ?>
                        <script type="text/javascript">


                                 $(document).ready(function(){

                                    $("#largeModal").modal('show');
                                });
                               
                          
                        </script>
              <?php }
              ?>
               <?php
            
              if(isset($_GET['subhead_id']))
              {
                $subhead_id=mysqli_real_escape_string($conn, $_GET['subhead_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_account where id=$subhead_id");
                $data=mysqli_fetch_assoc($sql);

                        $aname = $data['aname'];
                        $parent_code = $data['parent_code'];


                ?>
                        <script type="text/javascript">


                                 $(document).ready(function(){
                                 
                                    $("#largeModal1").modal('show');
                                });
                               
                          
                        </script>
              <?php }
              ?>
             
              
                                <form action="operations/accounts.php" method="post"  enctype="multipart/form-data">
                            <div class="row clearfix">
                                  <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-bottom: 7px;">
                                      <!--  <a href="#largeModal" data-toggle="modal" data-target="#largeModal">
                                          <button type="button" class="btn btn-success text-right" ><i class="fa fa-plus"></i></button>
                                      </a>   --> 
                                
                                       <label>Account Type *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                      <select class="form-control select_group" name="parent_code" id="parent_code" onchange="getsublev()">
                                        <option selected="selected" value="">Choose one</option>
                                        <?php

                                        $sql="SELECT * FROM tbl_head"; 


                                        foreach ($conn->query($sql) as $row){

                                        if($row['acode']==$parent_code1){

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
                                </div>
                                  <div class="col-md-4 col-sm-12">
                                    <div class='col-md-8 col-sm-4' style="padding-bottom: 7px;">
                                  
                                
                                        <label>Head</label>
                                      </div>
                                   
                                    <div class='col-md-12 col-sm-4'>
                                    <div class="form-group">        
                                    <select class=" form-control select_group"  id="sub_child1" name='sub_child1' style="width: 100%;" onchange="getsublev1()">
                                      <option selected value="">Select Sub Head Lv 1</option>
                                      
                                    </select>
                                  </div>
                                </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class='col-md-8 col-sm-4' style="padding-bottom: 7px;">
                                         
                                
                                        <label>Child</label>
                                      </div>
                                   
                                    <div class='col-md-12 col-sm-4'>
                                    <div class="form-group">        
                                    <select class=" form-control select_group"  id="child" name='child' style="width: 100%;">
                                      <option selected value="">Select Child </option>
                                      
                                    </select>
                                  </div>
                                </div>
                                </div>
                                     <div class="col-md-4 col-sm-12">
                                    <div class='col-md-8 col-sm-4' style="padding-bottom: 7px;">
                                     
                                       <label>Opening Balance</label>
                                      </div>
                                    <div class='col-md-12 col-sm-4'>
                                    <div class="form-group">        
                                    <input type="text" name="opening_bal" id="opening_bal" required="" class="form-control calculate" placeholder="Opening Balance *" value="<?php echo $opening_bal;?>">
                                    
                                  </div>
                                </div>
                                </div>
                       
                          </div>
                           <div class='text-center' style="padding-left: 30px;">
                            <button type="submit" id='submit' name="opening" class="btn btn-primary">Create</button>
                            <a href="chart_of_account.php"> <button type="button"  class="btn btn-danger">Back</button></a>

                            </div>
                        </div>
                        </form>   
                        
              

                 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<!-- Javascript -->

<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/easypiechart.bundle.js"></script> <!-- easypiechart Plugin Js -->

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>

</body>
  <script>
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
<script type="text/javascript">
$('.calculate').keypress(function(event)
                                {
  var character = String.fromCharCode(event.keyCode);
    return isValidC(character);  
});
function isValidC(str) {
    return !/[~`!@#$%\^&*()+=\\[\]\\';,/{}|\\":<>\?]/g.test(str);
}
</script> 

        <script type="text/javascript">
          $(function() {
  $(".select_group").select2();




});
</script>
        <script type="text/javascript">
          $(function() {
  $(".select_group").select2();




});
          $("#submit").click(function() {

  var parent_code=$('#parent_code').val();
 
  if(parent_code=='')
  {
    alert('Please Select Head..!');
    $('#parent_code').select2('focus');
    $('#parent_code').select2('open');
    return false;
  }
  var sub_child1=$('#sub_child1').val();
  if(sub_child1=='' && parent_code!='')
  {
    alert('Please Select Sub Head Lv 1..!');
    $('#sub_child1').select2('focus');
    $('#sub_child1').select2('open');
    return false;
  }
  var opening_bal=$('#opening_bal').val();

  if(opening_bal=='')
    {
    alert('Please add opening..!');
    return false;
    }
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
                 
                     $("#child").empty();
                      $("#child").append("<option value=''>Choose</option>");
                        for( var i = 0; i<len; i++){
                            var acode = response[i]['acode'];
                            var aname = response[i]['aname'];
                           
                            $("#child").append("<option value='"+acode+"'>"+aname+"</option>");

                        }
    
                    
                });


}


</script> 
</html>
