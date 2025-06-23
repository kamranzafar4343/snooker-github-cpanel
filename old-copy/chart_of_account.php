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

<?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Chart of Account</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Accounts</li>
                            <li class="breadcrumb-item active">Chart of Account</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                                    </div>
            </div>
 <?php
              

              if(isset($_GET['delete']) && $_GET['delete']=='unsuccessful'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong>Failed to Delete Account, Because Data related to Account Exist in Transactions..!
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
              <?php
              

              if(isset($_GET['insert']) && $_GET['insert']=='successfull'){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great!</strong> Opening Added Successfully..!
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
             
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Acccounts List</h2>
                            
                        </div>
                        <div class="body">
                            <?php if($c_write=='1'){?>
                                        <tr>
                                            <th colspan="8" class="text-right"><a href="add_account.php"><button type="button" class="btn  btn-simple btn-md btn-success btn-success">Add Acccount</button></a></th>
                                           <th colspan="8" class="text-right"><a href="add_opening.php"><button type="button" class="btn  btn-simple btn-md btn-info btn-info">Add Opening</button></a></th>
                                        </tr>
                                        <?php }?>
                            <button type="button" class="btn  btn-simple btn-sm btn-default btn-filter active" data-target="total">General Accounts</button>
                            <button type="button" class="btn  btn-simple btn-sm btn-success btn-filter " data-target="assets">Asset Accounts</button>
                            <button type="button" class="btn  btn-simple btn-sm btn-secondary btn-filter " data-target="customers">Customers</button>
                            <button type="button" class="btn  btn-simple btn-sm btn-secondary btn-filter " data-target="vendors">Vendors</button>
                            <button type="button" class="btn  btn-simple btn-sm btn-info btn-filter" data-target="liability">Liability Accounts</button>
                            <button type="button" class="btn  btn-simple btn-sm btn-warning btn-filter" data-target="equity">Equity Accounts</button>
                            <button type="button" class="btn  btn-simple btn-sm btn-danger btn-filter" data-target="revenue">Revenue Accounts</button>
                            <button type="button" class="btn  btn-simple btn-sm btn-dark btn-filter" data-target="expense">Expense Accounts</button>
                            <div class="body project_report">

                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0" id="example">
                                <thead > 
                                            
                                           
                                    </thead>                            
                                    <tbody>
                                        <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT * FROM tbl_head  order by id asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $acode=$pdata['acode'];
                                    $aname=$pdata['aname'];
                                    $atype=$pdata['atype'];
                                    $id=$pdata['id'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];

                                   
                                  
                                ?>
                                        <tr data-status="total">
                                            
                                            
                                            <td><?php echo $aname;?></td>
                                            
                                    
                                      
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><?php echo $newDate;?></td>
                                            <td><span class="badge badge-success"><?php echo  $atype;?></span></td>
                                            <?php if($c_write=='1'){?>
                                            <td class="project-actions">
                                             
                                                <a href="add_account.php?head_id=<?php echo $id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <!-- <a href="operations/delete.php?head_id=<?php echo $id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" data-type="confirm"><i class="icon-trash"></i></a> -->
                                            </td>
                                            <?php }?>
                                        </tr>
                                        <?php }?>
                                          <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT * FROM tbl_account where LEFT(acode,3)='100'  order by id asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                          $acode=$pdata['acode'];
                                    $aname=$pdata['aname'];
                                    $atype=$pdata['atype'];
                                   $id=$pdata['id'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    $opening_bal=$pdata['opening_bal'];
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];
                                  
                                ?>
                                        <tr data-status="assets" style="display: none">
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $aname;?></td>
                                            
                                    
                                      
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><span class="badge badge-info">Opening <h6><?php if($opening_bal){echo $opening_bal;}else{echo 0;}?></span></h6></td>
                                            <td><?php echo $newDate;?></td>
                                            <td><span class="badge badge-danger">Child</span></td>
                                            <?php if($c_write=='1'){?>
                                            <td class="project-actions">
                                             
                                                <a href="add_account.php?subhead_id=<?php echo $id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?subhead_id=<?php echo $id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                            </td>
                                            <?php }?>
                                        </tr>
                                         <?php }?>
                                         <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT left(acode,6),id,aname,acode,created_date,created_by,opening_bal FROM tbl_account_lv2 where LEFT(acode,3)='100' and LEFT(acode,6)!='100200' and LEFT(acode,6)!='200200'  order by acode  asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $id=$pdata['id'];
                                    $acode=$pdata['acode'];
                                    $aname1=$pdata['aname'];
                                    $atype=$pdata['atype'];
                                    $acode1=$pdata['left(acode,6)'];
                                   $opening_bal=$pdata['opening_bal'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    
                                    $query=mysqli_query($conn, "SELECT * FROM tbl_account where left(acode,6)=$acode1");
                                    $data=mysqli_fetch_assoc($query);
                                    $aname2 = $data['aname'];
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   ?>
                                        <tr data-status="assets" style="display: none">
                                            
                                            <td><?php echo $customername1;?></td>
                                         
                                             <td><?php echo $aname2; if($aname1!=''){?> ( <?php echo $aname1;?> ) <?php }?></td>
                                    
                                      
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><span class="badge badge-info">Opening <h6><?php if($opening_bal){echo $opening_bal;}else{echo 0;}?></span></h6></td>
                                            <td><?php echo $newDate;?></td>
                                                
                                            <td><span class="badge badge-danger">Sub Child</span></td>
                                            <?php if($c_write=='1'){?>
                                            <td class="project-actions">
                                             
                                                <a href="add_account.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                            </td>
                                            <?php }?>
                                        </tr>
                                        <?php }?>
                                        <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT left(acode,6),id,aname,acode,created_date,created_by,opening_bal FROM tbl_account_lv2 where LEFT(acode,6)='100200'  order by acode  asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $id=$pdata['id'];
                                    $acode=$pdata['acode'];
                                    $aname1=$pdata['aname'];
                                    $atype=$pdata['atype'];
                                    $acode1=$pdata['left(acode,6)'];
                                   $opening_bal=$pdata['opening_bal'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    
                                    $query=mysqli_query($conn, "SELECT * FROM tbl_account where left(acode,6)=$acode1");
                                    $data=mysqli_fetch_assoc($query);
                                    $aname2 = $data['aname'];
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   ?>
                                        <tr data-status="customers" style="display: none">
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $user_name; if($aname1!=''){?> ( <?php echo $aname1;?> ) <?php }?></td>
                                             
                                    
                                      
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><span class="badge badge-info">Opening <h6><?php if($opening_bal){echo $opening_bal;}else{echo 0;}?></span></h6></td>
                                            <td><?php echo $newDate;?></td>
                                                
                                            <td><span class="badge badge-danger">Sub Child</span></td>
                                            <?php if($c_write=='1'){?>
                                            <!-- <td class="project-actions">
                                             
                                                <a href="add_account.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                            </td> -->
                                            <?php }?>
                                        </tr>
                                        <?php }?>
                                        <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT left(acode,6),id,aname,acode,created_date,created_by,opening_bal FROM tbl_account_lv2 where LEFT(acode,6)='200200'  order by acode  asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $id=$pdata['id'];
                                    $acode=$pdata['acode'];
                                    $aname1=$pdata['aname'];
                                    $atype=$pdata['atype'];
                                    $acode1=$pdata['left(acode,6)'];
                                   $opening_bal=$pdata['opening_bal'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    
                                    $query=mysqli_query($conn, "SELECT * FROM tbl_account where left(acode,6)=$acode1");
                                    $data=mysqli_fetch_assoc($query);
                                    $aname2 = $data['aname'];
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   ?>
                                        <tr data-status="vendors" style="display: none">
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $user_name; if($aname1!=''){?> ( <?php echo $aname1;?> ) <?php }?></td>
                                             
                                    
                                      
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><span class="badge badge-info">Opening <h6><?php if($opening_bal){echo $opening_bal;}else{echo 0;}?></span></h6></td>
                                            <td><?php echo $newDate;?></td>
                                                
                                            <td><span class="badge badge-danger">Sub Child</span></td>
                                            <?php if($c_write=='1'){?>
                                           <!--  <td class="project-actions">
                                             
                                                <a href="add_account.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                            </td> -->
                                            <?php }?>
                                        </tr>
                                        <?php }?>
                                           <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT * FROM tbl_account where LEFT(acode,3)='200' and acode!='200200000' order by id asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                          $acode=$pdata['acode'];
                                    $aname=$pdata['aname'];
                                    $atype=$pdata['atype'];
                                   $id=$pdata['id'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    $opening_bal=$pdata['opening_bal'];
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];
                                  
                                ?>
                                        <tr data-status="liability" style="display: none">
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $aname;?></td>
                                            
                                    
                                      
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><span class="badge badge-info">Opening <h6><?php if($opening_bal){echo $opening_bal;}else{echo 0;}?></span></h6></td>
                                            <td><?php echo $newDate;?></td>
                                            <td><span class="badge badge-danger">Child</span></td>
                                            <?php if($c_write=='1'){?>
                                            <!-- <td class="project-actions">
                                             
                                                <a href="add_account.php?subhead_id=<?php echo $id;?>"  class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?subhead_id=<?php echo $id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                            </td> -->
                                            <?php }?>
                                        </tr>
                                         <?php }?>
                                         <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT left(acode,6),id,aname,acode,created_date,created_by,opening_bal FROM tbl_account_lv2 where LEFT(acode,3)='200' and LEFT(acode,6)!='200200' order by acode  asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $id=$pdata['id'];
                                    $acode=$pdata['acode'];
                                    $aname1=$pdata['aname'];
                                    $atype=$pdata['atype'];
                                    $acode1=$pdata['left(acode,6)'];
                                    $opening_bal=$pdata['opening_bal'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    
                                    $query=mysqli_query($conn, "SELECT * FROM tbl_account where left(acode,6)=$acode1");
                                    $data=mysqli_fetch_assoc($query);
                                    $aname2 = $data['aname'];
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   ?>
                                        <tr data-status="liability" style="display: none">
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $user_name." ".$aname2; if($aname1!=''){?> ( <?php echo $aname1;?> ) <?php }?></td>
                                            
                                    
                                      
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><span class="badge badge-info">Opening <h6><?php if($opening_bal){echo $opening_bal;}else{echo 0;}?></span></h6></td>
                                            <td><?php echo $newDate;?></td>
                                            <td><span class="badge badge-danger">Sub Child</span></td>
                                            <?php if($c_write=='1'){?>
                                           <!--  <td class="project-actions">
                                             
                                                <a href="add_account.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                            </td> -->
                                            <?php }?>
                                        </tr>
                                        <?php }?>

                                         <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT * FROM tbl_account where LEFT(acode,3)='400'  order by id asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $acode=$pdata['acode'];
                                    $aname=$pdata['aname'];
                                    $id=$pdata['id'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    $opening_bal=$pdata['opening_bal'];
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];
                                  
                                ?>
                                        <tr data-status="equity" style="display: none">
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $aname;?></td>
                                            
                                    
                                      
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><span class="badge badge-info">Opening <h6><?php if($opening_bal){echo $opening_bal;}else{echo 0;}?></span></h6></td>
                                            <td><?php echo $newDate;?></td>
                                            <td><span class="badge badge-danger">Child</span></td>
                                            <?php if($c_write=='1'){?>
                                            <td class="project-actions">
                                             
                                                <a href="add_account.php?subhead_id=<?php echo $id;?>"  class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?subhead_id=<?php echo $id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                            </td>
                                            <?php }?>
                                        </tr>
                                         <?php }?>
                                         <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT left(acode,6),id,aname,acode,created_date,created_by,opening_bal FROM tbl_account_lv2 where LEFT(acode,3)='400'  order by acode  asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $id=$pdata['id'];
                                    $acode=$pdata['acode'];
                                    $aname1=$pdata['aname'];
                                    $atype=$pdata['atype'];
                                    $acode1=$pdata['left(acode,6)'];
                                    $opening_bal=$pdata['opening_bal'];
                                    $created_date=$pdata['created_date'];
                                     $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    
                                    $query=mysqli_query($conn, "SELECT * FROM tbl_account where left(acode,6)=$acode1");
                                    $data=mysqli_fetch_assoc($query);
                                    $aname2 = $data['aname'];
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   ?>
                                        <tr data-status="equity" style="display: none">
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $aname2; if($aname1!=''){?> ( <?php echo $aname1;?> ) <?php }?></td>
                                            
                                    
                                      
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><span class="badge badge-info">Opening <h6><?php if($opening_bal){echo $opening_bal;}else{echo 0;}?></span></h6></td>
                                            <td><?php echo $newDate;?></td>
                                            <td><span class="badge badge-danger">Sub Child</span></td>
                                            <?php if($c_write=='1'){?>
                                            <td class="project-actions">
                                             
                                                <a href="add_account.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                            </td>
                                            <?php }?>
                                        </tr>
                                        <?php }?>

                                         <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT * FROM tbl_account where LEFT(acode,3)='300'  order by id asc");
                                          while($pdata = mysqli_fetch_assoc($sql))   
                                          { 
                                                    $acode=$pdata['acode'];
                                              $aname=$pdata['aname'];
                                             $id=$pdata['id'];
                                             $opening_bal=$pdata['opening_bal'];
                                              $created_date=$pdata['created_date'];
                                              $newDate = date("d-m-Y", strtotime($created_date));
                                              $created_by=$pdata['created_by'];
                             
                                          
                                             $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                             
                                             $zdata = mysqli_fetch_assoc($query) ;
                                             $user_name=$zdata['user_name'];
                                             $user_profile=$zdata['user_profile'];
                                            
                                          ?>
                                        <tr data-status="revenue" style="display: none">
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $aname;?></td>
                                            
                                    
                                      
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><span class="badge badge-info">Opening <h6><?php if($opening_bal){echo $opening_bal;}else{echo 0;}?></span></h6></td>
                                            <td><?php echo $newDate;?></td>
                                            <td><span class="badge badge-danger">Child</span></td>
                                            <?php if($c_write=='1'){?>
                                            <td class="project-actions">
                                             
                                                <a href="add_account.php?subhead_id=<?php echo $id;?>"  class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?subhead_id=<?php echo $id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                            </td>
                                            <?php }?>
                                        </tr>
                                         <?php }?>
                                         <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT left(acode,6),id,aname,acode,created_date,created_by,opening_bal FROM tbl_account_lv2 where LEFT(acode,3)='300'  order by acode  asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $id=$pdata['id'];
                                    $acode=$pdata['acode'];
                                    $aname1=$pdata['aname'];
                                    $atype=$pdata['atype'];
                                    $acode1=$pdata['left(acode,6)'];
                                    $opening_bal=$pdata['opening_bal'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    
                                    $query=mysqli_query($conn, "SELECT * FROM tbl_account where left(acode,6)=$acode1");
                                    $data=mysqli_fetch_assoc($query);
                                    $aname2 = $data['aname'];
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   ?>
                                        <tr data-status="revenue" style="display: none">
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $aname2; if($aname1!=''){?> ( <?php echo $aname1;?> ) <?php }?></td>
                                            
                                    
                                      
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><span class="badge badge-info">Opening <h6><?php if($opening_bal){echo $opening_bal;}else{echo 0;}?></span></h6></td>
                                            <td><?php echo $newDate;?></td>
                                            <td><span class="badge badge-danger">Sub Child</span></td>
                                            <?php if($c_write=='1'){?>
                                            <td class="project-actions">
                                             
                                                <a href="add_account.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                            </td>
                                            <?php }?>
                                        </tr>
                                        <?php }?> 


                                         <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT * FROM tbl_account where LEFT(acode,3)='500'  order by id asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $id=$pdata['id'];
                                    $acode=$pdata['acode'];
                                    $aname=$pdata['aname'];
                                    $atype=$pdata['atype'];
                                    $opening_bal=$pdata['opening_bal'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                   
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];
                                  
                                ?>
                                        <tr data-status="expense" style="display: none">
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $aname;?></td>
                                            
                                    
                                      
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><span class="badge badge-info">Opening <h6><?php if($opening_bal){echo $opening_bal;}else{echo 0;}?></span></h6></td>
                                            <td><?php echo $newDate;?></td>
                                            <td><span class="badge badge-danger">Child</span></td>
                                            <?php if($c_write=='1'){?>
                                            <td class="project-actions">
                                             
                                                <a href="add_account.php?subhead_id=<?php echo $id;?>"  class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?subhead_id=<?php echo $id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                            </td>
                                            <?php }?>
                                        </tr>
                                        <?php }?>
                                        <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT left(acode,6),id,aname,acode,created_date,created_by,opening_bal FROM tbl_account_lv2 where LEFT(acode,3)='500'  order by acode  asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $id=$pdata['id'];
                                    $acode=$pdata['acode'];
                                    $aname1=$pdata['aname'];
                                    $atype=$pdata['atype'];
                                    $acode1=$pdata['left(acode,6)'];
                                    $opening_bal=$pdata['opening_bal'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    
                                    $query=mysqli_query($conn, "SELECT * FROM tbl_account where left(acode,6)=$acode1");
                                    $data=mysqli_fetch_assoc($query);
                                    $aname2 = $data['aname'];
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   ?>
                                        <tr data-status="expense" style="display: none">
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $aname2; if($aname1!=''){?> ( <?php echo $aname1;?> ) <?php }?></td>
                                            
                                    
                                      
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><span class="badge badge-info">Opening <h6><?php if($opening_bal){echo $opening_bal;}else{echo 0;}?></span></h6></td>
                                            <td><?php echo $newDate;?></td>
                                            <td><span class="badge badge-danger">Sub Child</span></td>
                                            <?php if($c_write=='1'){?>
                                            <td class="project-actions">
                                             
                                                <a href="add_account.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?subchild_id=<?php echo $id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                            </td>
                                            <?php }?>
                                        </tr>
                                        <?php }?> 


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                            <div class="col-sm-12">
                                    <div class="mt-4">
                                        <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>

                                    </div>
                                </div>
        </div>
    </div>
    
</div>

    

<script src="assets_light/bundles/datatablescripts.bundle.js"></script>
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.star').on('click', function () {
            $(this).toggleClass('star-checked');
        });

        $('.ckbox label').on('click', function () {
            $(this).parents('tr').toggleClass('selected');
        });

        $('.btn-filter').on('click', function () {
            var $target = $(this).data('target');
   
            if ($target != 'all') {
                $('.table tr').css('display', 'none');
                $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
            } else {
                $('.table tr').css('display', 'none').fadeIn('slow');
            }
        });
    });
</script>
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
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/table-filter.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:49 GMT -->
</html>
