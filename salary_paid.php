<!doctype html>
<html lang="en">


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/emp-all.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:02 GMT -->
<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
include "includes/head.php";
include "user_permission.php";

session_start();

if (isset($_SESSION['adminid'])) {
} else {
  header('Location: login.php');
}

// Add this near the top after session and config includes
$page = 'salary_paid';

// Get page ID first
$sql1 = mysqli_query($conn, "SELECT page_id FROM tbl_menu where page_link='$page'");
$data = mysqli_fetch_assoc($sql1);
$page_id = $data['page_id'];

// Then check permissions
if ($userid == '1') {
  // Admin user gets all permissions
  $P = 1;
  $U = 1;
  $D = 1;
  $W = 1;
} else {
  // Get permissions from database for non-admin users
  $query = mysqli_query($conn, "SELECT * FROM tbl_permission where page_id='$page_id' and user_id='$userid'");
  $data = mysqli_fetch_assoc($query);
  $P = $data['P'];
  $U = $data['U'];
  $D = $data['D'];
  $W = $data['W'];
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
            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Salary Paid List</h2>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item">Salary Paid</li>
            </ul>
          </div>
          <?php include "includes/graph.php"; ?>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-lg-12">
          <div class="card">
            <?php


            if (isset($_GET['delete']) && $_GET['delete'] == 'successfull') {
            ?>
              <div class="alert alert-danger" id="danger-alert">

                <strong>Great ! </strong>Catagory Deleted Successfully.
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
            } ?>
            <?php

            if (isset($_GET['insert']) && $_GET['insert'] == 'successfull' || isset($_GET['update']) && $_GET['update'] == 'successfull') {
            ?>
              <div class="alert alert-success" id="success-alert">

                <strong>Great!</strong> Salary Added Succesfully.
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
            }

            if (isset($_GET['insert']) && $_GET['insert'] == 'unsuccessfull' || isset($_GET['update']) && $_GET['update'] == 'unsuccessfull') {
            ?>
              <div class="alert alert-danger" id="danger-alert">

                <strong>Opps!</strong>Failed to Add Catagory.
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


            if (isset($_GET['delete']) && $_GET['delete'] == 'unsuccessful') {
            ?>
              <div class="alert alert-danger" id="danger-alert">

                <strong>Opps!</strong>Failed to Delete Catagory, Because Data related to Catagory Exist in Transactions..!
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


            if (isset($_GET['delete']) && $_GET['delete'] == 'successful') {
            ?>
              <div class="alert alert-danger" id="danger-alert">

                <strong>Great !</strong> Salary Slip Deleted.
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

            <div class="body">

              <!-- Add search form -->
              <div class="row mb-4">
                <div class="col-md-12">
                  <form method="GET" class="form-inline">
                    <div class="form-group mx-2">
                      <label class="mr-2">From Date:</label>
                      <input type="date" name="from_date" onfocus="this.showPicker()" class="form-control" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>">
                    </div>
                    <div class="form-group mx-2">
                      <label class="mr-2">To Date:</label>
                      <input type="date" name="to_date" onfocus="this.showPicker()" class="form-control" value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>">
                    </div>
                    <div class="form-group mx-2">
                      <label class="mr-2">Employee:</label>
                      <select name="employee" class="form-control">
                        <option value="">All Employees</option>
                        <?php
                        $emp_query = mysqli_query($conn, "SELECT DISTINCT s.s_id, s.username 
                                                                        FROM tbl_salesmen s 
                                                                        INNER JOIN tbl_salary ts ON s.s_id = ts.staff_mem_id 
                                                                        ORDER BY s.username");
                        while ($emp = mysqli_fetch_assoc($emp_query)) {
                          $selected = (isset($_GET['employee']) && $_GET['employee'] == $emp['s_id']) ? 'selected' : '';
                          echo "<option value='" . $emp['s_id'] . "' " . $selected . ">" . $emp['username'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="salary_paid.php" class="btn btn-secondary ml-2">Reset</a>
                  </form>
                </div>
              </div>

              <div class="table-responsive">
                <table id="salary_table" class="table table-hover table-custom table-striped m-b-0 c_list">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Name</th>
                      <th>Designation</th>
                      <th>Phone</th>
                      <th>Paid Date</th>

                      <th>Salary</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                    $data = mysqli_fetch_assoc($query);
                    $user_privilege = $data['user_privilege'];

                    // Build the WHERE clause based on filters
                    $where_conditions = array();

                    if ($user_privilege != 'superadmin') {
                      $where_conditions[] = "ts.created_by='$userid'";
                    }

                    if (isset($_GET['from_date']) && !empty($_GET['from_date'])) {
                      $from_date = mysqli_real_escape_string($conn, $_GET['from_date']);
                      $where_conditions[] = "DATE(ts.created_date) >= '$from_date'";
                    }

                    if (isset($_GET['to_date']) && !empty($_GET['to_date'])) {
                      $to_date = mysqli_real_escape_string($conn, $_GET['to_date']);
                      $where_conditions[] = "DATE(ts.created_date) <= '$to_date'";
                    }

                    if (isset($_GET['employee']) && !empty($_GET['employee'])) {
                      $employee = mysqli_real_escape_string($conn, $_GET['employee']);
                      $where_conditions[] = "ts.staff_mem_id = '$employee'";
                    }

                    $where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";

                    $sql = mysqli_query($conn, "SELECT ts.*, sm.username, sm.user_profile, sm.email, sm.mobile_no1, sm.designation 
                                                   FROM tbl_salary ts 
                                                   INNER JOIN tbl_salesmen sm ON ts.staff_mem_id = sm.s_id 
                                                   $where_clause 
                                                   ORDER BY ts.created_date DESC");
                    $count = 0;
                    while ($data = mysqli_fetch_assoc($sql)) {
                      $id = $data['id'];
                      $invoice_no = "Salary_" . $id;
                      $staff_mem_id = $data['staff_mem_id'];
                      $salary = $data['staff_mem_salary'];

                      //total salary paid
                      $total_salary_paid += $salary;
                      $created_by = $data['created_by'];
                      $created_date = $data['created_date'];
                      $newDate = date("d-m-Y", strtotime($created_date));
                      $sql1 = mysqli_query($conn, "SELECT * FROM tbl_salesmen where s_id='$staff_mem_id'");
                      $data1 = mysqli_fetch_assoc($sql1);

                      $username = $data1['username'];

                      $userprofile = $data1['user_profile'];
                      $email = $data1['email'];
                      $mobile_no1 = $data1['mobile_no1'];
                      $designation = $data1['designation'];

                      $sql1 = mysqli_query($conn, "SELECT trans_id FROM tbl_trans where invoice_no='$invoice_no'");
                      $data1 = mysqli_fetch_assoc($sql1);

                      $trans_id = $data1['trans_id'];
                      $count++;

                    ?>

                      <tr>
                        <td class="width45">
                          <img src="<?php if ($userprofile) {
                                      echo $userprofile;
                                    } else { ?> assets/images/userdefault.jpg<?php } ?>" class="rounded-circle width35" alt="">
                        </td>
                        <td>
                          <h6 class="mb-0"><?php echo $username; ?></h6>
                          <span><?php echo $email; ?></span>
                        </td>
                        <td><span><?php echo $designation; ?></span></td>
                        <td><span><?php echo $mobile_no1; ?></span></td>
                        <td><?php echo $newDate; ?></td>

                        <td><?php echo $salary; ?></td>
                        <?php if ($D == '1') { ?>
                          <td>
                            <a href="operations/delete.php?salary_id=<?php echo $id; ?>"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="delete salary slip" onclick="return confirm('Are you sure want to dele');"><i class="fa fa-trash"></i> Delete</button></a>
                            <!--  -->
                          </td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr style="background-color: #343a40; color: white;">
                      <th colspan="5" style="text-align: right;"></th>
                      <th colspan="<?php echo ($c_write == '1') ? '2' : '1'; ?>">
                        <?php echo "Total: " . number_format($total_salary_paid, 2); ?>
                      </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  </div>


  <!-- Javascript -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="assets_light/bundles/libscripts.bundle.js"></script>
  <script src="assets_light/bundles/vendorscripts.bundle.js"></script>

  <script src="assets_light/bundles/datatablescripts.bundle.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>

  <script src="assets_light/bundles/mainscripts.bundle.js"></script>
  <script src="assets_light/js/pages/tables/jquery-datatable.js"></script>
  <script src="assets_light/js/pages/ui/dialogs.js"></script>

  <script type="text/javascript">
    $('.calculate').keyup(function(e) {
      if (/\D/g.test(this.value)) {
        // Filter non-digits from input value.
        this.value = this.value.replace(/\D/g, '1');
      }
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#salary_table').DataTable({
        dom: '<"row"<"col-md-6"l><"col-md-6"f>><"row"<"col-md-12"B>>rtip',
        lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        select: {
          style: 'multi',
          selector: 'td:first-child'
        },
        buttons: [{
            extend: 'print',
            title: 'Salary Payment List',
            text: '<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span>',
            className: 'btn btn-success',
            customize: function(win) {
              $(win.document.body).css('font-size', '10pt');
              $(win.document.body).find('table')
                .addClass('compact')
                .css('font-size', 'inherit');
            },
            exportOptions: {
              columns: [1, 2, 3, 4, 5],
              modifier: {
                selected: null
              }
            },
            autoPrint: true,
            footer: true
          },
          {
            extend: 'pdf',
            title: 'Salary Payment List',
            text: '<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
            className: 'btn btn-danger',
            customize: function(doc) {
              doc.content[1].table.widths =
                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
              doc.styles.tableHeader = {
                alignment: 'left'
              }
            },
            exportOptions: {
              columns: [1, 2, 3, 4, 5],
              modifier: {
                selected: null
              }
            },
            footer: true
          }
        ],
        pageLength: 10,
        "order": [
          [4, "desc"]
        ],
        columnDefs: [{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
        }]
      });
    });
  </script>

</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/emp-all.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:03 GMT -->

</html>