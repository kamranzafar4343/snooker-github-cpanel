<!doctype html>
<html lang="en">


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

<!-- Page Loader -->
<?php
include "includes/loader.php";

?>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Items</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Items</li>
                            <li class="breadcrumb-item active">Add</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
                      <div class="alert alert-danger" id="barcode-alert" style="display: none;">
  
                    <strong>Sorry !</strong> Barcode Already Added.
                  </div>

            
                                                  <?php
              
              if(isset($_GET['insert']) && $_GET['insert']=='successful'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Item Added Succesfully.
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
                                   }?>
                                   <?php
              
              if(isset($_GET['update']) && $_GET['update']=='successful'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Item Updated Succesfully.
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
                                   }?>
              <?php
              
              if(isset($_GET['edit_id']))
              {
                $edit_id=mysqli_real_escape_string($conn, $_GET['edit_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_items where item_id=$edit_id");
                $data=mysqli_fetch_assoc($sql);
                        $brand_id = $data['brand_id'];
                        $item_name = $data['item_name'];
                        $item_image = $data['item_image'];
                        $category = $data['category'];
                        $sub_category = $data['sub_category'];
                        $item_model = $data['item_model'];
                        $item_description = $data['item_description'];
                        $item_id = $data['item_id'];
                        $barcode = $data['barcode'];
                        $purchase = $data['purchase'];
                        $retail = $data['retail'];
                        $mini_wholesale = $data['mini_wholesale'];
                        $wholesale = $data['wholesale'];
                        $type_a = $data['type_a'];
                        $type_b = $data['type_b'];
                        $type_c = $data['type_c'];


              }
              ?>
                         <form  action="operations/insert_items.php" method="post" enctype="multipart/form-data">
                        <div class="body">

                            <div class="row clearfix">
                              <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                       <label for="description">Company Name</label>
                                      <select class="form-control select_group" name="brand_id" id="brand_id">
                                        <option selected="selected" value="">Choose one</option>
                                        <?php

                                        $sql="SELECT cat_name,id  FROM tbl_catagory"; 


foreach ($conn->query($sql) as $row){

if($row['id']==$brand_id){

echo "<option value=$row[id] selected>$row[cat_name]</option>"; 

}else{

echo "<option value=$row[id]>$row[cat_name]</option>"; 

}

}

 echo "</select>";
 ?>
</select>
                                    </div>
                                </div>
                                    <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="description">Catagory Name</label>
                                    <select class="form-control select_group" id="cat"  required=""   name="category" style="width:100%;"  >
                                      <option selected="selected" value="">Choose one</option>
                                       <?php

 $sql="SELECT catagory_name,brand_id,id  FROM tbl_cat"; 
foreach ($conn->query($sql) as $row){

if($row['id']==$category){

echo "<option value=$row[id] selected >$row[catagory_name]</option>"; 

}else{

echo "<option value=$row[id]>$row[catagory_name]</option>"; 

}

}

 echo "</select>";
 
 ?>
                                    
</select>
                                </div>
                            </div>
                                                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="description">Sub Catagory Name</label>
                                    <select class="form-control select_group" id="sub_cat"     name="sub_category" style="width:100%;"  >
                                       <?php

 $sql="SELECT sub_cat_name,cat_name,id  FROM tbl_sub_cat"; 


foreach ($conn->query($sql) as $row){

if($row['id']==$sub_category){

echo "<option value=$row[id] selected >$row[sub_cat_name]</option>"; 

}else{

echo "<option value=$row[id]>$row[sub_cat_name]</option>"; 

}

}

 echo "</select>";
 
 ?>
                                    
</select>
                                </div>
                            </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="description">Item Name / Model</label>
                                        <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Item Name *" required="" value="<?php echo $item_name;?>">
                                        <input type="hidden" class="form-control" name="edit_id" value="<?php echo $edit_id; ?>">
                                        <input type="hidden" class="form-control" name="item_id" value="<?php echo $item_id; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12" hidden>
                                    <div class="form-group">
                                      <label for="description">Model</label>
                                        <input type="text" class="form-control" name="item_model" placeholder="Item Model *" value="<?php echo $item_model;?>">
                                        
                                    </div>
                                </div>
                               <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="barcode">Barcode</label>
                                      <input type="text" class="form-control calculate" name="barcode" id="barcode" placeholder="Item barcode *" value="<?php echo $barcode;?>" required onchange="chkbar()">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="retail">Purchase Rate *</label>
                                      <input type="text" class="form-control calculate" name="purchase"  placeholder="Purchase Rate *" value="<?php echo $purchase;?>" required >
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="retail">Retail Rate *</label>
                                      <input type="text" class="form-control calculate" name="retail"  placeholder="Retail Rate *" value="<?php echo $retail;?>" required >
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="mini_wholesale">Mini Wholesale Rate</label>
                                      <input type="text" class="form-control calculate" name="mini_wholesale" placeholder="Mini Wholesale Rate *" value="<?php echo $mini_wholesale;?>"  >
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="wholesale">Wholesale Rate</label>
                                      <input type="text" class="form-control calculate" name="wholesale" placeholder="Wholesale Rate *" value="<?php echo $wholesale;?>"  >
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="type_a">Type A Rate</label>
                                      <input type="text" class="form-control calculate" name="type_a" placeholder="Type A *" value="<?php echo $type_a;?>"  >
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="type_b">Type B Rate</label>
                                      <input type="text" class="form-control calculate" name="type_b" placeholder="Type B Rate *" value="<?php echo $type_b;?>"  >
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="type_c">Type C Rate</label>
                                      <input type="text" class="form-control calculate" name="type_c" placeholder="Type C Rate *" value="<?php echo $type_c;?>"  >
                                    </div>
                                </div>
                             
                                <div class="col-md-6 col-sm-12" hidden>
                                    <div class="form-group">
                                      <label for="description">Description</label>
                                      <textarea type="text" class="form-control" id="description" name="item_description" placeholder="Enter 
                                      description" autocomplete="off" ><?php echo $item_description;?>
                                      </textarea>
                                    </div>
                                </div>
                    
                            
                                <div class="col-md-8 col-sm-12">
                                      <label for="product_image">Image</label>
                                    <div class="kv-avatar">
                                        <div class="file-loading">
                                            <input id="product_image" name="item_image" type="file">
                                        </div>
                                    </div>
                                </div>
                               
                                <?php if($item_image !='') {?>
                                <div class="col-md-4 col-sm-12">
                                    <p>Current Image is</p>
                                    <div class="profile-image"> <img src="<?php echo $item_image; ?>" class="square-circle" alt=""> </div>
                                </div>     
                                <?php }?>
                       
                            </div>
                          </div>
                          <div class="text-center" style="padding: 2%;">
                            <button type="submit" class="btn btn-primary " name="add_items" id="submit">Save Changes</button>
                            <button type="button" class="btn btn-danger" onclick="goBack()">Back</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<!-- Javascript -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/easypiechart.bundle.js"></script> <!-- easypiechart Plugin Js -->

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>

<script src="assets/fileinput/fileinput.min.js"></script>
<link href="assets/fileinput/fileinput.min.css" rel="stylesheet" />

<script>
function goBack() {
  window.history.back();
}
</script>
 <script type="text/javascript">
  $('.calculate').keypress(function(event)
                                {
  var character = String.fromCharCode(event.keyCode);
    return isValidC(character);  
});
$("#item_name").keypress(function(event) {
    var character = String.fromCharCode(event.keyCode);
    return isValid(character);     
});
function isValid(str) {
    return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
}
function isValidC(str) {
    return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?a-zA-Z]/g.test(str);
}

    $(function() {
$("#submit").click(function() {

  var brand_id=$('#brand_id').val();
  if(brand_id=='')
  {
    alert('Please Select Brand..!');
    $('#brand_id').select2('focus');
        $('#brand_id').select2('open');
    return false;
  }

});
});
</script>
<script type="text/javascript">
  function chkbar()
{
  var bc=$("#barcode").val();                   
  $.ajax({                      
                                  method: "POST",
                                  url: "operations/chk_bc_main.php",
                                  data: {bc:bc},
                                  dataType: 'json',
                                  encode: true,                 
                                })
                                .done(function(data){
                                 
                                   if(data=="already"){
                                          $("#barcode-alert").hide();

                                            $("#barcode-alert").fadeTo(4000, 500).slideUp(500, function() {
                                              $("#barcode-alert").slideUp(500);
                                            });
                                            $("#barcode").val('');
                                            $("#barcode").focus();
                                            
                                        }

                                    
                                })

}
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".select_group").select2();
    

    $("#addd_items").addClass('active');
    $("#items").addClass('active');
    
    var btnCust = '<button hidden type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#product_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: 'Add Image',
        removeIcon: 'Remove Image',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>
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
 $(".select_group").select2();
</script> 
<!-- <script type="text/javascript">
 
                function getcatagory(){

                    var cat_id = $('#brand_id').val();

                      $.ajax({
                                  method: "POST",
                                  url: "operations/get_cat.php",
                                  data: {cat_id:cat_id},
                                  dataType: 'json',                 
                                })
                                .done(function(response){
                              
                                   var len = response.length;

                                     $("#cat").empty();
                                        for( var i = 0; i<len; i++){
                                            var id = response[i]['id'];
                                            var cat_name = response[i]['cat_name'];

                                            $("#cat").append("<option value='"+id+"'>"+cat_name+"</option>");

                                        }
                           getitem();
                                    
                                });


                }
                function getitem(){

                    var cat = $('#cat').val();

                      $.ajax({
                                  method: "POST",
                                  url: "operations/get_sub_cat.php",
                                  data: {cat:cat},
                                  dataType: 'json',                 
                                })
                                .done(function(response){
                       
                                   var len = response.length;

                                     $("#sub_cat").empty();
                                        for( var i = 0; i<len; i++){
                                            var id = response[i]['id'];
                                            var sub_cat_name = response[i]['sub_cat_name'];

                                            $("#sub_cat").append("<option value='"+id+"'>"+sub_cat_name+"</option>");

                                        }
                           
                                    
                                });


                }
</script> -->

</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
</html>
