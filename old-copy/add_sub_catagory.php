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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Sub Category</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Sub Category</li>
                            <li class="breadcrumb-item active">Add</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
     
              <?php
            
              if(isset($_GET['edit_id']))
              {
                $edit_id=mysqli_real_escape_string($conn, $_GET['edit_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_sub_cat where id=$edit_id");
                $data=mysqli_fetch_assoc($sql);
                        $brand_id = $data['brand_id'];
                        $cat_name = $data['cat_name'];
                        $sub_cat_name = $data['sub_cat_name'];

                        // $cat_image = $data['cat_image'];

              }
              ?>
                         <form  action="operations/insert_sub_cat.php" method="post" enctype="multipart/form-data">
                        <div class="body">

                            <div class="row clearfix">

                                 <div class="col-md-3 col-sm-12">
                                    <div class="form-group ">
                                                       <select class="form-control select_group" id="brand"     name="brand" style="width:100%;"   onchange="getitem()" >
                                        <option selected="selected">Choose Brand</option>
                                        <?php
                                        



 $sql="SELECT cat_name,id  FROM tbl_catagory"; 
foreach ($conn->query($sql) as $row){

if($row['id']==$brand_id){

echo "<option value=$row[id] selected >$row[cat_name]</option>"; 

}else{

echo "<option value=$row[id]>$row[cat_name]</option>"; 

}

}

 echo "</select>";

 ?>

</select>
                                    </div>
                                </div>
               <div class="col-md-3 col-sm-12">
                                    <div class="form-group ">
                                                       <select class="form-control select_group" id="cat"     name="category" style="width:100%;"  >
                                       <?php

                                       if($edit_id!='')
                                        {
 $sql="SELECT cat_name,brand_id,id  FROM tbl_cat where brand_id='$brand_id'"; 
foreach ($conn->query($sql) as $row){

if($row['brand_id']==$cat_name){

echo "<option value=$row[id] selected >$row[cat_name]</option>"; 

}else{

echo "<option value=$row[id]>$row[cat_name]</option>"; 

}

}

 echo "</select>";
 }
 ?>
                                    
</select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group ">
                                        <input type="text" class="form-control" name="sub_cat" placeholder="Sub-Category Name *" required="" value="<?php echo $sub_cat_name;?>">
                                        <input type="hidden" class="form-control" name="edit_id" value="<?php echo $edit_id; ?>">
                                    </div>
                                </div>

                  
                        
                       
                            </div>

                         <!--    <div class="text-center"> -->
                            <button type="submit" class="btn btn-primary "  name="add_sub_catagory">Add</button>
                            <button type="button"  class="btn btn-danger"  onclick="GoBackWithRefresh();return false;">Back</button><!-- 
                            </div> -->
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
<script type="text/javascript">
 
                function getitem(){

    var cat_id = $('#brand').val();

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
                            var catagory_name = response[i]['catagory_name'];

                            $("#cat").append("<option value='"+id+"'>"+catagory_name+"</option>");

                        }
           
                    
                });


}
</script>
</body>
</html>
