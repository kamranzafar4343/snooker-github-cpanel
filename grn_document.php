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

<html lang="en" >

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets_light/css/main.css">
<link rel="stylesheet" href="assets_light/css/color_skins.css">

<!-- <body onload="window.print();"> -->
<?php
            
           if(isset($_GET['purchase_id']))
            {
               $purchase_id=$_GET['purchase_id'];
            }       
              ?> 
            <div class="row clearfix" >
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                                 <div class="card">
                        <div class="header">
                            <h2>GRN Documnets against PO # <?php echo $purchase_id;?></h2>
                        </div>
                        <div class="body">                            
                            <ul class="list-unstyled feeds_widget">
                                <?php
                                $lsql=mysqli_query($conn, "SELECT * FROM tbl_grn_documents where po_id=$purchase_id");

                                    while ($data=mysqli_fetch_assoc($lsql)) {
                                            $po_id = $data['po_id'];
                                            $documents = $data['documents'];

                                            $name=explode('/', $documents);

                                            
                                  
                                ?>
                                <li>
                                    <div class="feeds-left"></div>
                                    <div class="feeds-body">
                                        <h4 class="title"><?php echo $name[4] ?> <large class="float-right text-muted"><a class="dropdown-item" href="uploads/<?php echo $documents; ?>" download><i class="icon-arrow-down"></i></a></large></h4>
                                    </div>
                                </li>
                               <?php }?>                                  
                            </ul>
                        </div>
                    </div>
                            <div class="hidden-print col-md-12 text-center">
                                            <hr>
                                            <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>
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
<script type="text/javascript">
  function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        // window.location = document.referrer;
        window.location = ('purchase_list.php');
        /* OR */
        //location.replace(document.referrer);
    } else {
      window.location('purchase_list.php');
        // window.history.back().back();
        // window.history.back();
    }
}
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
