<!doctype html>
<html lang="en">


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:08 GMT -->
<?php
include "includes/head.php";
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
?>
<?php
include "includes/sidebar.php";
?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create New Project</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Projects</li>
                            <li class="breadcrumb-item active">Add Project</li>
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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Project Name *">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <select class="form-control show-tick">
                                            <option>Select Client Name</option>
                                            <option>Core Technolab Pvt.</option>
                                            <option>vPro Infoweb LLC.</option>
                                            <option>M2 Solution Pvt. Ltd.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="Start date *">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="End date *">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <select class="form-control show-tick">
                                            <option>Select Priority</option>
                                            <option>High</option>
                                            <option>Medium</option>
                                            <option>Low</option>
                                        </select>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-3 col-sm-12">
                                    <label>Select Rate in Doller</label>
                                    <div class="form-group">
                                        <input type="number" class="form-control" placeholder="Rate *">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label>Type</label>
                                    <div class="form-group">
                                        <select class="form-control show-tick">
                                            <option>Select Type</option>
                                            <option>Hourly</option>
                                            <option>Fixed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label>Select Team Lead</label>
                                    <div class="form-group">                                        
                                        <select class="form-control show-tick">
                                            <option>Select</option>
                                            <option>Marshall Nichols</option>
                                            <option>Susie Willis</option>
                                            <option>Hossein Shams</option>
                                            <option>Fidel Tonn</option>
                                            <option>Frank Camly</option>
                                            <option>Debra Stewart</option>
                                            <option>Tim Hank</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label>Selet Team</label>
                                    <div class="form-group">                                        
                                        <select id="multiselect3-all" class="multiselect multiselect-custom" multiple="multiple">
                                            <option value="multiselect-all">Select All</option>
                                            <option value="cheese">Cheese</option>
                                            <option value="tomatoes">Tomatoes</option>
                                            <option value="mozarella">Mozzarella</option>
                                            <option value="mushrooms">Mushrooms</option>
                                            <option value="pepperoni">Pepperoni</option>
                                            <option value="onions">Onions</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-12">
                                    <input type="file" class="dropify">
                                    <div class="mt-3"></div>
                                </div>                                
                                <div class="col-sm-12">
                                    <div class="summernote">
                                        Hello there,
                                        <br/>
                                        <p>The toolbar can be customized and it also supports various callbacks such as <code>oninit</code>, <code>onfocus</code>, <code>onpaste</code> and many more.</p>
                                        <p>Please try <b>paste some texts</b> here</p>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                        <button type="submit" class="btn btn-outline-secondary">Cancel</button>
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
<script src="assets/bundles/libscripts.bundle.js"></script>    
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script><!-- bootstrap datepicker Plugin Js --> 
<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="assets/vendor/dropify/js/dropify.min.js"></script>

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="assets/vendor/summernote/dist/summernote.js"></script>
<script src="assets_light/js/pages/forms/dropify.js"></script>
<script>
    $('#multiselect3-all').multiselect({
        includeSelectAllOption: true,
    });
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:10 GMT -->
</html>
