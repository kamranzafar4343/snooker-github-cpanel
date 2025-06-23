<?php
error_reporting(0);
include "../includes/config.php";
include "../includes/session.php";
if($_POST)
{
$sale_id=$_POST['sale_id'];
$customer=$_POST['customer_id'];
}
$output='';

// Add CSS links at top
$output .= '
<style type="text/css">
.goog-te-banner-frame.skiptranslate{display: none !important;}
  body{top: 0px !important;}
  .svg-sm {
    width: 15px;
    height: 15px;
    color: orange;
  }
  .badge-secondary.white {
    padding: 5px;
    cursor: pointer;
  }
</style>

<form class="form"  action="operations/update_sale_customer.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-12">
     <div class="form-row">
      <input type="hidden" name="sale_id"  id="sale_id" value="'.$sale_id.'" />
      <label for="inputState" class="col-form-label">Choose a Customer 
        <span class="badge badge-secondary white rounded-circle" data-toggle="modal" data-target="#choosecustomer">
          <svg xmlns="http://www.w3.org/2000/svg" class="svg-sm" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_122" x="0px" y="0px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
            <g>
              <rect x="234.362" y="128" width="43.263" height="256"></rect>
              <rect x="128" y="234.375" width="256" height="43.25"></rect>
            </g>
          </svg>
        </span>
      </label>
      <div class="form-group col-md-12"> 
          <select class="form-control form-control-lg form-control-solid select2-customer" name="customer_name" required="">
          <option value="">Select Customer</option>';

$sql="SELECT username,customer_id,mobile_no1 FROM tbl_customer ORDER BY username ASC"; 
foreach ($conn->query($sql) as $row){
  if($row['customer_id']==$customer){
    $output .= "<option value='$row[customer_id]' selected>$row[username] $row[mobile_no1]</option>"; 
  }else{
    $output .= "<option value='$row[customer_id]'>$row[username] $row[mobile_no1]</option>"; 
  }
}            
$output .= '</select>
      </div>                                                           
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
        
        </div>
      </div>
      <div class="mt-3">
        <input type="submit" class="btn btn-primary submit1" name="edit_customer" value="Save"/>
        <button type="button" class="btn btn-danger text-center" data-dismiss="modal" id="docmode">Close</button>
        </div>
      </div> 
    </div>                                           
  </form>

  <!-- Add Customer Modal -->
  <div class="modal fade text-left" id="choosecustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel13" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel13">Add Customer</h3>
          <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
            <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
            </svg>
          </button>
        </div>
        <div class="modal-body">
          <form action="operations/add_client2.php" method="post">
            <div class="form-group row">
              <div class="col-md-6">
                <label class="text-body">Customer Name</label>
                <fieldset class="form-group mb-3">
                  <input type="text" name="username" required="" class="form-control" placeholder="Client Name *">
                </fieldset>
              </div>
              <div class="col-md-6">
                <label class="text-body">Customer Cell</label>
                <fieldset class="form-group mb-3">
                  <input type="text" class="form-control" name="mobile_no1" data-inputmask="\'mask\': \'0399-99999999\'" type="number" maxlength="12">
                </fieldset>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <label class="text-body">Customer CNIC</label>
                <fieldset class="form-group mb-3">
                  <input type="text" name="client_cnic" class="form-control" data-inputmask="\'mask\': \'99999-9999999-9\'" placeholder="XXXXX-XXXXXXX-X">
                </fieldset>
              </div>
              <div class="col-md-6">
                <label class="text-body">Customer Father Name</label>
                <fieldset class="form-group mb-3">
                  <input type="text" name="client_fathername" class="form-control" placeholder="Customer Father Name">
                </fieldset>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <label class="text-body">Customer Permanent Address</label>
                <fieldset class="form-group mb-3">
                  <input type="text" name="address_permanent" class="form-control" placeholder="Customer Permanent Address">
                </fieldset>
              </div>
              <div class="col-md-6">
                <label class="text-body">Customer Residential Address</label>
                <fieldset class="form-group mb-3">
                  <input type="text" name="address_current" class="form-control" placeholder="Customer Residential Address">
                </fieldset>
              </div>
            </div>
            <div class="form-group row justify-content-end mb-0">
              <div class="col-md-6 text-right">
                <button type="submit" name="addclientspos" class="btn btn-primary">Add Customer</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>';

// Scripts at bottom
$output .= '
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    // Initialize Select2 on the customer dropdown
    $(".select2-customer").select2({
        dropdownParent: $("#customerEditModal"),
        placeholder: "Select a customer",
        width: "100%",
        allowClear: true
    });

    // Clean up modal classes when closed
    $(".modal").on("hidden.bs.modal", function () {
        $("body").removeClass("modal-open");
        $(".modal-backdrop").remove();
        
        // Destroy Select2 when modal closes to prevent duplicates
        $(".select2-customer").select2("destroy");
    });
});

function googleTranslateElementInit() {
    setCookie("googtrans", "/en/<?php echo $lang;?>",1);
    new google.translate.TranslateElement({
       pageLanguage: "en"
    }, "google_translate_element");
}
</script>

<style>
/* Select2 Custom Styles */
.select2-container .select2-selection--single {
    height: 38px !important;
    border: 1px solid #ddd !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 38px !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px !important;
}
.select2-dropdown {
    border: 1px solid #ddd !important;
    border-radius: 4px !important;
}
.select2-search__field {
    padding: 6px !important;
}
.select2-results__option {
    padding: 8px !important;
}
</style>';

echo $output;
