<?php
error_reporting(0);
require_once 'includes/session.php';
require_once 'includes/config.php';

if (!isset($_POST['page'])) {
    exit;
}

// Add this near the top after session and config includes
$page = 'pos_sale_list';

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

// Set base URL and pagination variables
$baseURL = 'get_sale_data.php';
$page = !empty($_POST['page']) ? (int)$_POST['page'] : 0;
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 20;
$offset = $page * $limit;

// Build WHERE conditions array
$where_conditions = array();

// Base permission check
$sql = mysqli_query($conn, "SELECT user_privilege FROM users where user_id=$userid");
$data = mysqli_fetch_assoc($sql);
$userprivilege = $data['user_privilege'];

if ($userprivilege == 'Operator') {
    $where_conditions[] = "tbl_sale.created_by = " . $userid;
}

// Keywords search
if (!empty($_POST['keywords'])) {
    $keywords = mysqli_real_escape_string($conn, $_POST['keywords']);
    $where_conditions[] = "(
        tbl_sale_detail.invoice_no LIKE '%$keywords%' OR 
        tbl_customer.username LIKE '%$keywords%' OR 
        tbl_tables.table_name LIKE '%$keywords%' OR 
        tbl_sale.gross_amount LIKE '%$keywords%' OR 
        DATE(tbl_sale.created_date) LIKE '%$keywords%'
    )";
}

// Existing filters
if (!empty($_POST['table_id'])) {
    $table_id = mysqli_real_escape_string($conn, $_POST['table_id']);
    $where_conditions[] = "tbl_sale.table_id = '$table_id'";
}

if (!empty($_POST['f_date']) && !empty($_POST['t_date'])) {
    $f_date = mysqli_real_escape_string($conn, $_POST['f_date']);
    $t_date = mysqli_real_escape_string($conn, $_POST['t_date']);
    $where_conditions[] = "DATE(tbl_sale.created_date) BETWEEN '$f_date' AND '$t_date'";
}

if (!empty($_POST['created_by'])) {
    $created_by = mysqli_real_escape_string($conn, $_POST['created_by']);
    $where_conditions[] = "tbl_sale.created_by = '$created_by'";
}

if (isset($_POST['status']) && $_POST['status'] !== '') {
    $status = trim($_POST['status']);

    if ($status === '1') {
        $status = mysqli_real_escape_string($conn, $status);
        $where_conditions[] = "tbl_sale.status = '1'";
    } elseif ($status === 'all') {
        // No escaping needed for 'all', but okay if you do it
        $where_conditions[] = "(tbl_sale.status = '1' OR tbl_sale.status = '0')";
    } else {
        // Default: show pending only
        $where_conditions[] = "tbl_sale.status = '0'";}
} else {
    // Default: show pending only
    $where_conditions[] = "tbl_sale.status = '0'";
}



if (!empty($_POST['customer_id'])) {
    $customer_id = mysqli_real_escape_string($conn, $_POST['customer_id']);
    $where_conditions[] = "tbl_sale.customer_name = '$customer_id'";
}

// Combine WHERE conditions
$where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";

// Count total records
$query = $conn->query("SELECT COUNT(DISTINCT tbl_sale.sale_id) as rowNum 
                FROM tbl_sale 
                INNER JOIN tbl_customer ON tbl_sale.customer_name = tbl_customer.customer_id 
                LEFT JOIN users ON tbl_sale.created_by = users.user_id 
                INNER JOIN tbl_sale_detail ON tbl_sale.sale_id = tbl_sale_detail.sale_id 
                LEFT JOIN tbl_tables ON tbl_sale.table_id = tbl_tables.table_id
                $where_clause");
$result = $query->fetch_assoc();
$rowCount = $result['rowNum'];

// Calculate total pages and adjust current page if needed
$totalPages = ceil($rowCount / $limit);
if ($page >= $totalPages) {
    $page = $totalPages - 1;
    $offset = $page * $limit;
}

// Calculate range for display
$start = min($offset + 1, $rowCount);
$end = min($offset + $limit, $rowCount);

// Main query
$query = "SELECT users.user_name, tbl_customer.username, tbl_sale_detail.invoice_no, 
          tbl_sale.*, tbl_tables.table_name  
          FROM tbl_sale 
          INNER JOIN tbl_customer ON tbl_sale.customer_name = tbl_customer.customer_id 
          LEFT JOIN users ON tbl_sale.created_by = users.user_id
          INNER JOIN tbl_sale_detail ON tbl_sale.sale_id = tbl_sale_detail.sale_id
          LEFT JOIN tbl_tables ON tbl_sale.table_id = tbl_tables.table_id
          $where_clause 
          GROUP BY tbl_sale.sale_id  
          ORDER BY tbl_sale.sale_id DESC 
          LIMIT $offset, $limit";

$result = mysqli_query($conn, $query);

// Start output buffer
ob_start();
?>


<table class="table table-striped">
    <thead>
        <tr>
            <th>
                <!-- Add select all checkbox -->
                <input type="checkbox" id="selectAll" onclick="toggleAll(this);">
            </th>
            <th>#</th>
            <th>Id</th>
            <th>Invoice #</th>
            <th>Customer Name</th>
            <th>Table Name</th>
            <th>Game Type</th>
            <th>Net Amount</th>
            <th>Amount Received</th>
            <th>Created By</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = $offset;
        $total_net = 0;
        $total_received = 0;

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $count++;
                $total_net += $row['gross_amount'];
                $total_received += $row['amount_recieved'];
                $game_type = $row['game_type'];

                $created_at = $row['created_date'];
                echo "<script>console.log('Created at: $created_at');</script>";

                $created_by_user = $row['created_by'];
                // Get user name from tbl_user
                $user_query = mysqli_query($conn, "SELECT user_name FROM users WHERE user_id='$created_by_user'");
                $user_data = mysqli_fetch_assoc($user_query);
                $user_name = $user_data['user_name'];

                // Initialize button variables
                $big_invoice = "<a href='pos_sale_invoice.php?sale_id={$row['sale_id']}' class='btn btn-sm btn-outline-primary' title='Print'><i class='icon-printer'></i></a>";

                $small_invoice = "<a href='sale_pos_invoice.php?sale_id={$row['sale_id']}' class='btn btn-sm btn-outline-primary' title='Print'><i class='icon-eye'></i></a>";

                $customer_balance = "<a href='get_customer_balance.php?customer={$row['customer_name']}' target='_blank' class='btn btn-sm btn-outline-danger' title='Balance'>Balance</a>";

                $updateButton = "";
                $deleteButton = "";
                $returnButton = "";
                $freeable = "";
                $completeButton = "";
                $cashCompleteLink = "";
                $bankCompleteLink = "";
                $choosePaymentLink = "";
                $edit_customer = "";

                // Set status dependent buttons
                if ($row['status'] == '0') {
                    $freeable = "<a href='pos.php?free_id={$row['sale_id']}&ref_id={$row['invoice_no']}' class='btn btn-sm btn-outline-success' title='Free Table'>Free Table</a>";
                    $completeButton = "<input type='checkbox' class='complete-checkbox' value='{$row['sale_id']}'>";
                    $cashCompleteLink = "<a href='complete.php?sale_id={$row['sale_id']}' class='btn btn-sm btn-success' title='Complete'>Cash</a>";
                    $bankCompleteLink = "<a href='bank_complete.php?sale_id={$row['sale_id']}' class='btn btn-sm btn-warning' title='Complete'>Bank</a>";
                
                    // $choosePaymentLink = "<a href='javascript:void(0);' class='btn btn-sm btn-danger open-payment-modal' title='Payment' data-toggle='modal' data-target='#choose_payment' data-sale-id='{$row['sale_id']}'> Payment </a>";

                    $edit_customer = "<a href='#' class='btn btn-info px-2 font-weight-light' title='Edit details' onclick='get_details({$row['sale_id']}, {$row['customer_name']});'>Edit Customer</a>";
                } else {
                    $freeable = "<a href='#' class='btn btn-sm btn-outline-success' title='Completed'>Completed</a>";
                    $completeButton = "";
                    $cashCompleteLink = "";
                }

                // Set permission-based buttons
                if ($U == '1') {
                    $updateButton = "<a href='pos.php?edit_id={$row['sale_id']}&ref_id={$row['invoice_no']}' class='btn btn-sm btn-outline-success'><i class='icon-pencil'></i></a>";
                    $returnButton = "<a href='sale_return.php?sale_id={$row['sale_id']}' class='btn btn-sm btn-outline-info'>Sale Return</a>";
                }

                if ($D == '1') {
                    $deleteButton = "<a href='operations/delete.php?pos_sale_id={$row['sale_id']}&ref_id={$row['invoice_no']}' 
                                       class='btn btn-sm btn-outline-danger deleteUser'
                                        onclick='return confirm(\"Do you really want to delete?\")'>
                                       <i class='icon-trash'></i>
                                    </a>";
                }

                // Combine all buttons in the exact order
                $action = $big_invoice . " " . $small_invoice . " " . $updateButton . " " . $deleteButton . " " . $returnButton . " " . $cashCompleteLink . " " . $bankCompleteLink . " " . $choosePaymentLink . " " . $edit_customer . " " . $customer_balance;

                // Then in your table row output:
        ?>

        <?php
                // Convert created_at to DateTime object
                $created = new DateTime($created_at);
                $now = new DateTime();

                // Calculate difference in minutes
                $diff = $now->getTimestamp() - $created->getTimestamp();
                $minutes_passed = floor($diff / 60);

                // Determine background color
                if ($row['status'] == 0 && $minutes_passed > 30 && $row['update_status'] == 0 && $game_type == 'frame') {
                    $bg_color = '#FFD6E0';
                } elseif ($row['status'] == 1) {
                    $bg_color = '#ffffff'; // white
                } elseif ($row['status'] == 0 && $row['update_status'] == 1) {
                    $bg_color = '#d4edda'; // light green
                } else {
                    $bg_color = '#bfbfbf'; // grey
                }

                // Log to console
                echo "<script>console.log('Time passed: {$minutes_passed} minutes');</script>";
                ?>
        <tr style="background-color: <?= $bg_color ?>;">


            <td><?php echo $completeButton; ?></td>
            <td><?php echo $count; ?></td>
            <td><?php echo $row['sale_id']; ?></td>
            <td><?php echo $row['invoice_no']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['table_name']; ?></td>
            <td><?php echo $row['game_type']; ?></td>
            <td><?php echo number_format($row['gross_amount'], 2); ?></td>
            <td><?php echo number_format($row['amount_recieved'], 2); ?></td>
            <td><?php echo $user_name; ?></td>
            <td><?php echo date('d-m-Y H:i', strtotime($row['created_date'])); ?></td>
            <td><?php echo $row['status'] == '0' ? 'Pending' : 'Completed'; ?></td>
            <td><?php echo $action; ?></td>
        </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="10">No records found...</td></tr>';
        }
        ?>
    </tbody>
    <tfoot class="bg-dark text-white">
        <tr>
            <th colspan="6">Total</th>
            <th><?php echo number_format($total_net, 2); ?></th>
            <th><?php echo number_format($total_received, 2); ?></th>
            <th colspan="4"></th>
        </tr>
    </tfoot>
</table>

<div class="pagination-container">
    <div class="showing-text">
        Showing <?php echo $start; ?> to <?php echo $end; ?> of <?php echo $rowCount; ?>
    </div>
    <div class="pagination">
        <?php if ($page > 0): ?>
        <a href="javascript:void(0);" onclick="searchFilter(0)">First</a>
        <a href="javascript:void(0);" onclick="searchFilter(<?php echo $page - 1; ?>)">Prev</a>
        <?php endif; ?>

        <?php
        $range = 2;
        for ($i = max(0, $page - $range); $i <= min($totalPages - 1, $page + $range); $i++):
        ?>
        <a href="javascript:void(0);" class="<?php echo $page == $i ? 'active' : ''; ?>"
            onclick="searchFilter(<?php echo $i; ?>)"><?php echo $i + 1; ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages - 1): ?>
        <a href="javascript:void(0);" onclick="searchFilter(<?php echo $page + 1; ?>)">Next</a>
        <a href="javascript:void(0);" onclick="searchFilter(<?php echo $totalPages - 1; ?>)">Last</a>
        <?php endif; ?>
    </div>
</div>

<!-- modal for single entry payment -->
<!-- <div class="modal fade text-left" id="choose_payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel13" style="display: none;" aria-hidden="true">
                                     <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg " role="document">
                                         <div class="modal-content">
                                             <div class="modal-header bg-primary text-light">
                                                 <h3 class="modal-title" id="myModalLabel13">Pay in Cash/bank</h3>

                                                 <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
                                                     <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                         <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                                                     </svg>
                                                 </button>
                                             </div>
                                             <div class="modal-body">
                                                 <form action="cash_and_bank_complete.php" method="post">
                                                     <div class="form-group row">

                                                    
                                                         <div class="col-md-6">
                                                             <label class="text-body">Cash Amount</label>
                                                             <fieldset class="form-group mb-3">
                                                                 <input type="text" name="cash_amount" required="" class="form-control" placeholder="Cash Amount *">
                                                             </fieldset>
                                                         </div>
                                                         <div class="col-md-6">
                                                             <label class="text-body">Bank Amount</label>
                                                             <fieldset class="form-group mb-3">
                                                                 <input type="text" name="bank_amount" required="" class="form-control" placeholder="Bank Amount *">
                                                             </fieldset>
                                                         </div>

                                                         <input type="hidden" name="sale_id" id="modal_sale_id">

                                                     </div>
                                                     <div class="form-group row">
                                                         <div class="form-group row justify-align-content-center mb-0">

                                                         </div>
                                                         <div class="col-md-6 text-right ml-4">
                                                             <button type="submit" name="payment" class="btn btn-primary btn-lg" style="font-size: 1.2rem;">Complete</button>
                                                         </div>
                                                     </div>
                                                 </form>
                                             </div>
                                         </div>
                                     </div>
                                 </div> -->


<!-- modal for multiple payment -->
<div class="modal fade text-left" id="choose_payment_multi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel13"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h3 class="modal-title" id="myModalLabel13">Pay in Cash/bank</h3>

                <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0"
                    data-dismiss="modal" aria-label="Close">
                    <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="cash_and_bank_complete_multi.php" method="post">
                    <!-- <div class="form-group justify-content-center"> -->
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="text-body">Total Amount</label>
                            <fieldset class="form-group mb-3">
                                <input type="number" name="total_amount" id="total_amount" required="" readonly=""
                                    class="form-control" placeholder="Total Amount *">
                            </fieldset>
                        </div>
                    </div>
                    <!-- </div> -->

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="text-body">Cash Amount</label>
                            <fieldset class="form-group mb-3">
                                <input type="number" name="cash_amount" required="" class="form-control"
                                    placeholder="Cash Amount *">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <label class="text-body">Bank Amount</label>
                            <fieldset class="form-group mb-3">
                                <input type="number" name="bank_amount" required="" class="form-control"
                                    placeholder="Bank Amount *">
                            </fieldset>
                        </div>

                        <input type="hidden" name="sale_id" id="modal_multi_sale_id">

                    </div>
                    <div class="form-group row">
                        <div class="form-group row justify-align-content-center mb-0">

                        </div>
                        <div class="col-md-6 text-right ml-4">
                            <button type="submit" name="payment" class="btn btn-primary btn-lg"
                                style="font-size: 1.2rem;">Complete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.pagination-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 15px;
}

.pagination {
    display: flex;
    gap: 5px;
}

.pagination a {
    padding: 5px 10px;
    border: 1px solid #ddd;
    text-decoration: none;
    color: #333;
}

.pagination a.active {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

/* Enhanced checkbox styling */
.complete-checkbox,
#selectAll {
    width: 20px;
    height: 20px;
    cursor: pointer;
    position: relative;
    appearance: none;
    -webkit-appearance: none;
    background-color: #fff;
    border: 2px solid #4CAF50;
    border-radius: 3px;
    transition: all 0.3s ease;
}

/* Checkbox hover effect */
.complete-checkbox:hover,
#selectAll:hover {
    background-color: #f0f9f0;
}

/* Checkbox checked state */
.complete-checkbox:checked,
#selectAll:checked {
    background-color: #4CAF50;
    border-color: #4CAF50;
}

/* Checkmark animation */
.complete-checkbox:checked::after,
#selectAll:checked::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 14px;
    opacity: 0;
    animation: checkmark 0.2s ease forwards;
    animation-delay: 0.1s;
}

/* Center checkboxes */
td:first-child,
th:first-child {
    text-align: center;
    vertical-align: middle;
}

/* Checkmark animation keyframes */
@keyframes checkmark {
    0% {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0);
    }

    100% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
}
</style>

<!-- Add JavaScript for handling (bank) bulk completion -->
<script>
function toggleAll(source) {
    const checkboxes = document.getElementsByClassName('complete-checkbox');
    for (let checkbox of checkboxes) {
        checkbox.checked = source.checked;
    }
}

function completeBankSelected() {
    const checkboxes = document.getElementsByClassName('complete-checkbox');
    const selectedIds = [];

    for (let checkbox of checkboxes) {
        if (checkbox.checked) {
            selectedIds.push(checkbox.value);
        }
    }

    if (selectedIds.length === 0) {
        alert('Please select at least one entry to complete');
        return;
    }

    // Send AJAX request to bank_complete.php with all selected IDs
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'bank_complete.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            // Refresh the table after completion
            searchFilter(<?php echo $page; ?>);
        } else {
            alert('Error completing entries');
        }
    };

    xhr.send('sale_ids=' + JSON.stringify(selectedIds));
}
</script>

<!-- Add JavaScript for handling (cash) bulk completion -->
<script>
function toggleAll(source) {
    const checkboxes = document.getElementsByClassName('complete-checkbox');
    for (let checkbox of checkboxes) {
        checkbox.checked = source.checked;
    }
}

function completeSelected() {
    const checkboxes = document.getElementsByClassName('complete-checkbox');
    const selectedIds = [];

    for (let checkbox of checkboxes) {
        if (checkbox.checked) {
            selectedIds.push(checkbox.value);
        }
    }

    if (selectedIds.length === 0) {
        alert('Please select at least one entry to complete');
        return;
    }

    // Send AJAX request to complete.php with all selected IDs
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'complete.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            // Refresh the table after completion
            searchFilter(<?php echo $page; ?>);
        } else {
            alert('Error completing entries');
        }
    };

    xhr.send('sale_ids=' + JSON.stringify(selectedIds));
}
</script>

<!-- fetch total amount of selected entries in multi payment modal -->
<script>
function openMultiPaymentModal() {
    const checkboxes = document.getElementsByClassName('complete-checkbox');
    const selectedIds = [];

    for (let checkbox of checkboxes) {
        if (checkbox.checked) {
            selectedIds.push(checkbox.value);
        }
    }

    if (selectedIds.length === 0) {
        alert('Please select at least one sale to proceed.');
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'fetch_total_amount.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    document.getElementById('total_amount').value = response.total_amount;
                    document.getElementById('modal_multi_sale_id').value = selectedIds.join(',');
                    $('#choose_payment_multi').modal('show');
                } else {
                    alert('Failed to fetch total amount.');
                }
            } catch (err) {
                console.error('JSON error:', xhr.responseText);
            }
        }
    };

    xhr.send('sale_ids=' + JSON.stringify(selectedIds));
}
</script>

<!-- set sale id -->
<!-- <script>
  $(document).ready(function () {
    $('.open-payment-modal').on('click', function () {
        var saleId = $(this).data('sale-id'); 
        console.log("Setting sale_id to:", saleId);
        $('#modal_sale_id').val(saleId);
    });
});


</script> -->

<?php
echo ob_get_clean();
?>