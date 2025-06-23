<?php 
// Include pagination library file 
include_once 'Pagination.class.php'; 
 
// Include database configuration file 
require_once 'includes/config.php'; 
 error_reporting(0);
include "includes/session.php";

include "includes/head.php";
include "user_permission.php";
if(isset($_SESSION['adminid'])){

}
else{
   header('Location: login.php'); 
}
   $baseURL = 'get_inventory_data.php'; 
      $limit = 10; 
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
<style type="text/css">
  .webgrid-table-hidden
{
    display: none;
}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Stock Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Stock Report</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="body">
                <div class="table-responsive">


        
        <table class="table table-hover table-striped m-b-0 c_list" id="customersTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Barcode</th>  
                <th scope="col">Sale Items</th> 
                <th scope="col">Sale Items Return</th>
                <th scope="col">Purchase Items</th>
                <th scope="col">Purchased Items Return</th>
                <th scope="col">Stock</th>
                
                <th scope="col">Status</th>                                                     
      
            </tr>
        </thead>
      </table>
       
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<!-- Javascript -->
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="assets_light/js/pages/tables/jquery-datatable.js"></script>
<script src="assets_light/js/pages/ui/dialogs.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $('#customersTable').dataTable({
            dom: 'Bfrtip',
            select: true,  

            buttons: [
            {
                extend: 'print',
                text: '<?php echo $c_name;?>',
           
                title: '<?php echo $c_name;?> (Stock List)',
                 
                
                text:'<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>',
                
                className: 'btn btn-success',
          
                     customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.styles.tableHeader = {
                           
                           alignment: 'left'
                         }
                      },
               
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8 ],
                    modifier: {
                        selected: null
                    }
                }

            },
           
            {
                extend: 'pdf',
                 text: '<?php echo $c_name;?>',
           
                title: '<?php echo $c_name;?> (Stock List)',
                 
                
                text:'<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
                
                className: 'btn btn-danger',
          
                     customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.styles.tableHeader = {
                           
                           alignment: 'left'
                         }
                      },
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8 ],
                    modifier: {
                        selected: null
                    }
                }
            },
            
        ],
                  
            "ajax": "get_stock_data.php",
            "columns": [
                {data: 'count'},  
                {data: 'item_id'},
                {data: 'item_name'},
                {data: 'barcode'},
                {data: 'sold_qty'},
                {data: 'sale_returned_qty'},
                {data: 'pur_qty'},
                {data: 'pur_rtn_qty'},
                {data: 'stock_qty'},
                
                {data: 'stock_disp'}
            ],
         
        });

    });
    </script>

<!-- <script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var filterBy = $('#filterBy').val();
    $.ajax({
        type: 'POST',
        url: 'get_stock_data.php',
        data:'page='+page_num+'&keywords='+keywords,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#dataContainer').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script> -->
