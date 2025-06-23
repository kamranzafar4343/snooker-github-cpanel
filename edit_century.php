<!doctype html>
<html lang="en">

<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
include "includes/head.php";

session_start();

if (isset($_SESSION['adminid'])) {
} else {
    header('Location: login.php');
}
?>

<body class="theme-orange">

    <!-- Page Loader -->
    <?php
    include "includes/loader.php";

    ?>
    <!-- Overlay For Sidebars -->

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
                            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Edit Century Price</h2>

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                                <li class="breadcrumb-item">Century</li>
                                <li class="breadcrumb-item active">Edit</li>


                            </ul>
                        </div>
                        <?php include "includes/graph.php"; ?>
                    </div>
                </div>

                <?php


                if (isset($_GET['add']) && $_GET['add'] == 'successfull') {
                ?>
                    <div class="alert alert-success" id="danger-alert">

                        <strong>Great!</strong> Client Added Succesfully.
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
                <?php } ?>
                <?php


                if (isset($_GET['record']) && $_GET['record'] == 'exist') {
                ?>
                    <div class="alert alert-danger" id="danger-alert">

                        <strong>Opps!</strong> Client with Same CNIC already Exist.
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
                <?php } ?>
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="card">
                            <div class="body">
                                <?php

                                // check if form is submitted
                                if (isset($_POST['editprice'])) {
                                    $name = $_POST['name'];
                                    $price = $_POST['price'];

                                    // update record
                                    $id = $_GET['id'];
                                    $sql = "UPDATE `century` SET `name`='$name',`price`='$price' WHERE `id`='$id'";
                                    if (mysqli_query($conn, $sql)) {
                                        header('Location: century_price.php?add=successfull');
                                    } else {
                                        echo "Error updating record: " . mysqli_error($conn);
                                    }
                                }


                                // show item previous data
                                if (isset($_GET['id'])) {

                                    $id = $_GET['id'];
                                    $sql = "SELECT * FROM `century` WHERE `id`= '$id'";

                                    $result = $conn->query($sql);
                                    $row = mysqli_fetch_array($result);

                                    $name = $row['name'];
                                    $price = $row['price'];
                                }

                                ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row clearfix">

                                        <div class="col-md-3 col-sm-12">
                                            <label>Name</label>
                                            <div class="form-group">
                                                <input type="text" name="name" required="" class="form-control" placeholder="Name *" value="<?php echo $name; ?>" readonly>
                                            </div>
                                        </div>
                                        
                                            <div class="col-md-3 col-sm-12">
                                                <label>Price</label>
                                                <div class="form-group">
                                                    <input type="number" name="price" required="" class="form-control" placeholder="Price *" value="<?php echo $price; ?>">
                                                </div>
                                            </div>

                                        

                                    </div>
                                    <br>

                                    <button type="submit" name="editprice" class="btn btn-primary">Edit</button>
                                    <button type="button" class="btn btn-danger" onclick="goBack()">Back</button>

                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script>
        $(":input").inputmask();
    </script>
    <!-- Javascript -->
    <!-- Javascript -->
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
          //redirect to CENTURY PRICE PAGE
            window.location.href = "century_price.php";
          
        }
    </script>

</body>

</html>