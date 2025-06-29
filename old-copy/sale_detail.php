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

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets_light/css/main.css">
<link rel="stylesheet" href="assets_light/css/color_skins.css">
<style>
.highlight{
    background-color: #f8f9fa;
    padding: 20px;
}
.highlight pre code {
    font-size: inherit;
    color: #212529;
}
.nt {
    color: #2f6f9f;
}
.na {
    color: #4f9fcf;
}
.s {
    color: #d44950;
}
pre.prettyprint {
    background-color: #eee;
    border: 0px;
    margin: 0;        
    padding: 20px;
    text-align: left;
}

.atv,
.str {
    color: #05AE0E;
}

.tag,
.pln,
.kwd {
    color: #3472F7;
}

.atn {
    color: #2C93FF;
}

.pln {
    color: #333;
}

.com {
    color: #999;
}

</style>
        
</head>
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

    <div id="main-content" class="profilepage_1">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Sale Details</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Sale</li>
                            <li class="breadcrumb-item active">Sale Details</li>
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
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="body">
                            <h5>iNext - One Page Responsive Template</h5>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            <div class="progress-container progress-info m-b-25">
                                <span class="progress-badge">Project Status</span>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 78%;">
                                        <span class="progress-value">78%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="body">
                            <ul class=" list-unstyled basic-list">
                                <li>Cost:<span class="badge badge-primary">$16,785</span></li>
                                <li>Created:<span class="badge-purple badge">14 Mar, 2018</span></li>
                                <li>Deadline:<span class="badge-purple badge">22 Aug, 2018</span></li>
                                <li>Priority:<span class="badge-danger badge">Highest priority</span></li>
                                <li>Status<span class="badge-info badge">Working</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2>Assigned Team</h2>
                        </div>
                        <div class="body">
                            <div class="w_user">
                                <img class="rounded-circle" src="assets/images/sm/avatar4.jpg" alt="">
                                <div class="wid-u-info">
                                    <h5>Fidel Tonn</h5>
                                    <span>info@thememakker.com</span>
                                    <p class="text-muted m-b-0">Project Lead</p>                                    
                                </div>
                                <hr>
                            </div>
                            <ul class="right_chat list-unstyled mb-0">
                                <li class="online">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="assets/images/xs/avatar4.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Chris Fox</span>
                                                <span class="message">Sales Lead</span>                                                
                                            </div>
                                        </div>
                                    </a>                            
                                </li>
                                <li class="online">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="assets/images/xs/avatar5.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Joge Lucky</span>
                                                <span class="message">Java Developer</span>
                                            </div>
                                        </div>
                                    </a>                            
                                </li>
                                <li class="offline">
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <img class="media-object " src="assets/images/xs/avatar2.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Isabella</span>
                                                <span class="message">UI UX Designer</span>
                                            </div>
                                        </div>
                                    </a>                            
                                </li>
                                <li class="offline">
                                    <a href="javascript:void(0);">
                                        <div class="media mb-0">
                                            <img class="media-object " src="assets/images/xs/avatar1.jpg" alt="">
                                            <div class="media-body">
                                                <span class="name">Folisise Chosielie</span>
                                                <span class="message">FrontEnd Developer</span>
                                            </div>
                                        </div>
                                    </a>                            
                                </li>                     
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2>About Clients</h2>
                        </div>
                        <div class="body text-center">
                            <div class="profile-image m-b-15"> <img src="assets/images/user.png" class="rounded-circle" alt=""> </div>
                            <div>
                                <h4 class="m-b-0"><strong>Jessica</strong> Doe</h4>
                                <span>Washington, d.c.</span>
                            </div>
                            <div class="m-t-15">
                                <button class="btn btn-primary">Profile</button>
                                <button class="btn btn-outline-secondary">Message</button>
                            </div>                            
                        </div>
                    </div>                    
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Project Activity</h2>
                        </div>
                        <div class="body">
                            <div class="form-group">
                                <textarea rows="2" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                            </div>
                            <div class="post-toolbar-b">
                                <button class="btn btn-warning"><i class="icon-paper-clip text-light"></i></button>
                                <button class="btn btn-warning"><i class="icon-camera text-light"></i></button>
                                <button class="btn btn-primary">Add</button>
                            </div>                            
                        </div>
                    </div>
                    <div class="card">
                        <div class="body">
                            <div class="timeline-item green">
                                <span class="date">Just now</span>
                                <h6>iNext - One Page Responsive Template</h6>
                                <span>Project Lead: <a href="javascript:void(0);" title="Fidel Tonn">Fidel Tonn</a></span>
                            </div>        
                            <div class="timeline-item warning">
                                <span class="date">02 Jun 2018</span>
                                <h6>Add Team Members</h6>
                                <span>By: <a href="javascript:void(0);" title="Fidel Tonn">Fidel Tonn</a></span>
                                <div class="msg">
                                    <p>web by far While that's mock-ups and this is politics, are they really so different? I think the only card she has is the Lorem card.</p>
                                    <ul class="list-unstyled team-info">
                                        <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title="Chris Fox" alt="Avatar"></li>
                                        <li><img src="assets/images/xs/avatar5.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                        <li><img src="assets/images/xs/avatar2.jpg" data-toggle="tooltip" data-placement="top" title="Folisise Chosielie" alt="Avatar"></li>
                                        <li><img src="assets/images/xs/avatar1.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                    </ul>
                                    <div class="top_counter">
                                        <div class="icon"><i class="fa fa-file-word-o"></i> </div>
                                        <div class="content">
                                            <p class="mb-1">iNext project documentation.doc</p>
                                            <span>Size: 2.3Mb</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-item warning">
                                <span class="date">02 Jun 2018</span>
                                <h6>Task Assigned</h6>
                                <span>By: <a href="javascript:void(0);" title="Fidel Tonn">Fidel Tonn</a></span>
                                <div class="msg">
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>
                                    <div class="media">
                                        <img class="media-object rounded width40 mr-3" src="assets/images/xs/avatar1.jpg" alt="" />
                                        <div class="media-body">
                                            <h6 class="mb-0">Folisise Chosielie</h6>
                                            <p class="mb-0"><strong>Detail:</strong> Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <img class="media-object rounded width40 mr-3" src="assets/images/xs/avatar5.jpg" alt="" />
                                        <div class="media-body">
                                            <h6 class="mb-0">Joge Lucky</h6>                                            
                                            <p class="mb-0"><strong>Detail:</strong> Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                            <div class="timeline-item warning">
                                <span class="date">02 Jun 2018</span>
                                <h6>Add new code on GitHub</h6>
                                <span>By: <a href="javascript:void(0);" title="Fidel Tonn">Folisise Chosielie</a></span>
                                <div class="msg">
                                    <div class="alert alert-success mb-3" role="alert">Code Update Successfully in GitHub</div>
<pre class="prettyprint prettyprinted"><span class="tag">&lt;span</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"badge badge-default"</span><span class="tag">&gt;</span><span class="pln">Default</span><span class="tag">&lt;/span&gt;</span><span class="pln">
</span><span class="tag">&lt;span</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"badge badge-primary"</span><span class="tag">&gt;</span><span class="pln">Primary</span><span class="tag">&lt;/span&gt;</span><span class="pln">
</span><span class="tag">&lt;span</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"badge badge-success"</span><span class="tag">&gt;</span><span class="pln">Success</span><span class="tag">&lt;/span&gt;</span><span class="pln">
</span><span class="tag">&lt;span</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"badge badge-info"</span><span class="tag">&gt;</span><span class="pln">Info</span><span class="tag">&lt;/span&gt;</span><span class="pln">
</span><span class="tag">&lt;span</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"badge badge-warning"</span><span class="tag">&gt;</span><span class="pln">Warning</span><span class="tag">&lt;/span&gt;</span><span class="pln">
</span><span class="tag">&lt;span</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"badge badge-danger"</span><span class="tag">&gt;</span><span class="pln">Danger</span><span class="tag">&lt;/span&gt;</span></pre>
                                </div>
                            </div>
                            <div class="timeline-item danger">
                                <span class="date">04 Jun 2018</span>
                                <h6>Project Reports</h6>
                                <span>By: <a href="javascript:void(0);" title="Fidel Tonn">Fidel Tonn</a></span>
                                <div class="msg">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <span>Design Bug</span>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="17" aria-valuemin="0" aria-valuemax="100" style="width: 17%;"></div>
                                            </div>
                                        </li>
                                        <li class="mb-2">
                                            <span>UI UX Design Task</span>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="83" aria-valuemin="0" aria-valuemax="100" style="width: 83%;"></div>
                                            </div>
                                        </li>
                                        <li class="mb-2">
                                            <span>Developer Task</span>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="49" aria-valuemin="0" aria-valuemax="100" style="width: 49%;"></div>
                                            </div>
                                        </li>
                                        <li class="mb-2">
                                            <span>QA (Quality Assurance)</span>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
                                            </div>
                                        </li>                                      
                                    </ul>                                         
                                </div>
                            </div>
                            <div class="timeline-item dark">
                                <span class="date">05 Jun 2018</span>
                                <h6>Project on Goinng</h6>
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

<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-detail.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
</html>