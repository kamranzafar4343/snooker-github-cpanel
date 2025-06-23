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


   <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Purchase Grid</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Purchase</li>
                            <li class="breadcrumb-item active">Purchase Grid</li>
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
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <form class="mb-4 mt-3">
                        <div class="form-group mb-2 m-l-0">
                            <label for="inputPassword2" class="sr-only">Search</label>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body text-left pro-img">
                            <img class="mx-auto d-block mb-3" src="assets/images/projects/01.png" alt="">
                            <h6 class="project-title text-primary mb-3"><a href="project-detail.html">iNext - Responsive Template</a></h6>
                            <p><strong>Lorem Ipsum is</strong> simply dummy text of the printing and typesetting industry.</p>
                            <div class="project_progress">
                                <div class="progress progress-xs">
                                    <div class="progress-bar l-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 87%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="align-items-center d-flex">
                                <h6 class="mb-0 mr-2">Team:</h6>
                                <ul class="list-unstyled team-info margin-0">
                                    <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar"
                                            data-original-title="Chris Fox"></li>
                                    <li><img src="assets/images/xs/avatar5.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar"
                                            data-original-title="Joge Lucky"></li>
                                    <li><img src="assets/images/xs/avatar2.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar"
                                            data-original-title="Folisise Chosielie"></li>
                                    <li><img src="assets/images/xs/avatar1.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar"
                                            data-original-title="Joge Lucky"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body text-left pro-img">
                            <img class="mx-auto d-block mb-3" src="assets/images/projects/03.png" alt="">
                            <h6 class="project-title text-primary mb-3"><a href="project-detail.html">Wordpress - Theme Design</a></h6>
                            <p><strong>Lorem Ipsum is</strong> simply dummy text of the printing and typesetting industry.</p>
                            <div class="project_progress">
                                <div class="progress progress-xs">
                                    <div class="progress-bar l-green" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 15%;">
                                        <span class="sr-only">15% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="align-items-center d-flex">
                                <h6 class="mb-0 mr-2">Team:</h6>
                                <ul class="list-unstyled team-info margin-0">
                                    <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar"
                                            data-original-title="Chris Fox"></li>
                                    <li><img src="assets/images/xs/avatar8.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar"
                                            data-original-title="Joge Lucky"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body text-left pro-img">
                            <img class="mx-auto d-block mb-3" src="assets/images/projects/02.png" alt="">
                            <h6 class="project-title text-primary mb-3"><a href="project-detail.html">Logo Design</a></h6>
                            <p><strong>Lorem Ipsum is</strong> simply dummy text of the printing and typesetting industry.</p>
                            <div class="project_progress">
                                <div class="progress progress-xs">
                                    <div class="progress-bar l-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 90%;">
                                        <span class="">90% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="align-items-center d-flex">
                                <h6 class="mb-0 mr-2">Team:</h6>
                                <ul class="list-unstyled team-info margin-0">
                                    <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar"
                                        data-original-title="Chris Fox"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body text-left pro-img">
                            <img class="mx-auto d-block mb-3" src="assets/images/projects/01.png" alt="">
                            <h6 class="project-title text-primary mb-3"><a href="project-detail.html">iNext - Responsive Template</a></h6>
                            <p><strong>Lorem Ipsum is</strong> simply dummy text of the printing and typesetting industry.</p>
                            <div class="project_progress">
                                <div class="progress progress-xs">
                                    <div class="progress-bar l-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 87%;">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="align-items-center d-flex">
                                <h6 class="mb-0 mr-2">Team:</h6>
                                <ul class="list-unstyled team-info margin-0">
                                    <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar"
                                            data-original-title="Chris Fox"></li>
                                    <li><img src="assets/images/xs/avatar5.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar"
                                            data-original-title="Joge Lucky"></li>
                                    <li><img src="assets/images/xs/avatar2.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar"
                                            data-original-title="Folisise Chosielie"></li>
                                    <li><img src="assets/images/xs/avatar1.jpg" data-toggle="tooltip" data-placement="top" title="" alt="Avatar"
                                            data-original-title="Joge Lucky"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body text-left pro-img">
                            <img class="mx-auto d-block mb-3" src="assets/images/projects/03.png" alt="">
                            <h6 class="project-title text-primary mb-3"><a href="project-detail.html">Wordpress - Theme Design</a></h6>
                            <p><strong>Lorem Ipsum is</strong> simply dummy text of the printing and typesetting industry.</p>
                            <div class="project_progress">
                                <div class="progress progress-xs">
                                    <div class="progress-bar l-green" role="progressbar" aria-valuenow="15" aria-valuemin="0"
                                        aria-valuemax="100" style="width: 15%;">
                                        <span class="sr-only">15% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="align-items-center d-flex">
                                <h6 class="mb-0 mr-2">Team:</h6>
                                <ul class="list-unstyled team-info margin-0">
                                    <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title=""
                                            alt="Avatar" data-original-title="Chris Fox"></li>
                                    <li><img src="assets/images/xs/avatar8.jpg" data-toggle="tooltip" data-placement="top" title=""
                                            alt="Avatar" data-original-title="Joge Lucky"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body text-left pro-img">
                            <img class="mx-auto d-block mb-3" src="assets/images/projects/02.png" alt="">
                            <h6 class="project-title text-primary mb-3"><a href="project-detail.html">Logo Design</a></h6>
                            <p><strong>Lorem Ipsum is</strong> simply dummy text of the printing and typesetting industry.</p>
                            <div class="project_progress">
                                <div class="progress progress-xs">
                                    <div class="progress-bar l-green" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                        aria-valuemax="100" style="width: 90%;">
                                        <span class="">90% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="align-items-center d-flex">
                                <h6 class="mb-0 mr-2">Team:</h6>
                                <ul class="list-unstyled team-info margin-0">
                                    <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title=""
                                            alt="Avatar" data-original-title="Chris Fox"></li>
                                </ul>
                            </div>
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
<script src="assets/vendor/bootstrap-progressbar/js/bootstrap-progressbar.min.js"></script>
<script>
    $(function () {
        $('#progress-format1 .progress-bar').progressbar({
            display_text: 'fill'
        });

        $('#progress-format2 .progress-bar').progressbar({
            display_text: 'fill',
            use_percentage: false
        });

        $('#progress-custom-format .progress-bar').progressbar({
            display_text: 'fill',
            use_percentage: false,
            amount_format: function (p, t) {
                return p + ' of ' + t;
            }
        });

        $('#progress-striped .progress-bar, #progress-striped-active .progress-bar, #progress-stacked .progress-bar').progressbar({
            display_text: 'fill'
        });

        $('.progress.vertical .progress-bar').progressbar();
        $('.progress.vertical.wide .progress-bar').progressbar({
            display_text: 'fill'
        });
    });
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
</html>
