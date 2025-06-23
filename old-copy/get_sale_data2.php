<?php

error_reporting(0);
ini_set('display_errors', 0);

if (isset($_POST['page'])) {
  require_once 'includes/session.php';
  include_once 'Pagination.class.php';
  require_once 'includes/config.php';

  $baseURL = 'get_sale_data.php';
  $offset = !empty($_POST['page']) ? $_POST['page'] : 0;
  if (isset($_POST['limit'])) {
    $limit = $_POST['limit'];
  } else {
    $limit = 20;
  }

  $page = 'pos_sale_list';

  $sql1 = mysqli_query($conn, "SELECT page_id  FROM tbl_menu where page_link='$page'");
  $data = mysqli_fetch_assoc($sql1);
  $page_id = $data['page_id'];
  if ($userid == '1') {
    $P = 1;
    $U = 1;
    $D = 1;
    $W = 1;
  } else {
    $query = mysqli_query($conn, "SELECT * FROM tbl_permission where page_id='$page_id' and user_id='$userid'");
    $data = mysqli_fetch_assoc($query);
    $P = $data['P'];
    $U = $data['U'];
    $D = $data['D'];
    $W = $data['W'];
  }
  // Set conditions for search 
  $whereSQL = '';
  $whereSQL1 = '';
  if (!empty($_POST['keywords'])) {
    $whereSQL = " WHERE (tbl_sale_detail.invoice_no LIKE '%" . $_POST['keywords'] . "%' OR Date(tbl_sale.created_date) LIKE '%" . $_POST['keywords'] . "%' OR tbl_sale.sale_type LIKE '%" . $_POST['keywords'] . "%' OR tbl_customer.username LIKE '%" . $_POST['keywords'] . "%' ) ";
    $whereSQL1 = " WHERE (tbl_sale_detail.invoice_no LIKE '%" . $_POST['keywords'] . "%' OR tbl_sale.created_date LIKE '%" . $_POST['keywords'] . "%' ) ";
  }

  $query   = $conn->query("SELECT COUNT(tbl_sale.sale_id) as rowNum FROM tbl_sale INNER JOIN tbl_customer ON tbl_sale.customer_name = tbl_customer.customer_id INNER JOIN users ON tbl_sale.created_by = users.user_id INNER JOIN tbl_sale_detail ON tbl_sale.sale_id = tbl_sale_detail.sale_id  $whereSQL");
  $result  = $query->fetch_assoc();
  $rowCount = $result['rowNum'];

  // Initialize pagination class 
  $pagConfig = array(
    'baseURL' => $baseURL,
    'totalRows' => $rowCount,
    'perPage' => $limit,
    'currentPage' => $offset,
    'contentDiv' => 'dataContainer',
    'link_func' => 'searchFilter'
  );
  $pagination =  new Pagination($pagConfig);

  // Fetch records based on the offset and limit 

  // $query = $conn->query("SELECT tbl_items.*, tbl_catagory.cat_name, tbl_cat.catagory_name FROM ((tbl_items INNER JOIN tbl_catagory ON tbl_items.brand_id = tbl_catagory.id) INNER JOIN tbl_cat ON tbl_items.category = tbl_cat.id) $whereSQL ORDER BY tbl_items.id ASC LIMIT $offset,$limit"); 
?>
  <!-- Data list container -->
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Invoice #</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Table Name</th>
        <th scope="col">Net Amount</th>
        <th scope="col">Amount Recieved</th>
        <th scope="col">Created Date</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $net_amount_tot = 0;
      $amount_recieved_tot = 0;

      // Fetch records based on the offset and limit 
      $query_main = $conn->query("SELECT users.user_name, tbl_customer.username, tbl_sale_detail.invoice_no, tbl_sale.*, tbl_tables.table_name  
FROM tbl_sale 
INNER JOIN tbl_customer ON tbl_sale.customer_name = tbl_customer.customer_id 
INNER JOIN users ON tbl_sale.created_by = users.user_id 
INNER JOIN tbl_sale_detail ON tbl_sale.sale_id = tbl_sale_detail.sale_id
LEFT JOIN tbl_tables ON tbl_sale.table_id = tbl_tables.table_id
$whereSQL 
GROUP BY tbl_sale.sale_id  
ORDER BY tbl_sale.sale_id DESC 
LIMIT $offset,$limit");
      if ($query_main->num_rows > 0) {

        while ($data = $query_main->fetch_assoc()) {
          $offset++;
          $sale_id = $data['sale_id'];
          $customer_id = $data['customer_name'];
          // $query=mysqli_query($conn,"SELECT username FROM tbl_customer where customer_id='$customer_id'");
          // $data_customer = mysqli_fetch_assoc($query);
          $customer_name = $data['username'];
          $table_name = $data['table_name'];
          $table_id = $data['table_id'];
          $sale_status = $data['sale_status'];
          $sale_invoice = $data['invoice_no'];
          $invoice_no = $data['invoice_no'];
          //$customer_name = $data['username'];
          $created_by = $data['user_name'];
          $created_date = $data['created_date'];
          $status = $data['status'];
          if ($status == '0') {
            $status = 'Pending';
            $color = "#bfbfbf";
          } else {
            $status = 'Completed';
            $color = "";
          }
          $date = date('Y-m-d');
          $invoice_date = date("Y-m-d", strtotime($created_date));
          $newDate = date("d-m-Y H:i", strtotime($created_date));
          $net_amount = $data['gross_amount'];
          $tax = $data['tax'];
          $discount = $data['discount'];
          $amount_recieved = $data['amount_recieved'];



          $big_invoice = "<a  href='pos_sale_invoice.php?sale_id=" . $sale_id . "' class='btn btn-sm btn-outline-primary' title='Print'><i class='icon-printer'></i></a>";

          $small_invoice = "<a  href='sale_pos_invoice.php?sale_id=" . $sale_id . "' class='btn btn-sm btn-outline-primary' title='Print'><i class='icon-eye'></i></a>";
          $customer_balance = "<a  href='get_customer_balance.php?customer=" . $customer_id . "' target='_blank' class='btn btn-sm btn-outline-danger' title='Balance'>Balance</a>";
          $edit_customer = '';


          if ($sale_status != 'Completed') {
            $freeable = '<a href="pos.php?free_id=' . $sale_id . '&ref_id=' . $sale_invoice . '" class="btn btn-sm btn-outline-success" title="Free Table">Free Table</a>';
            $completeButton = "<a href='complete.php?sale_id=" . $sale_id . "' class='btn btn-sm btn-outline-success'><i class='icon-pencil'></i> Complete</a>";
            $edit_customer = '<a href="#"  class="btn btn-info px-2 font-weight-light" title="Edit details" onclick="get_details(' . $sale_id . ', ' . $customer_id . ');">Edit Customer</a>';
          } else {
            $freeable = '<a href="#" class="btn btn-sm btn-outline-success" title="Completed">Completed</a>';
            $completeButton = "";
          }
          if ($U == '1') {
            $updateButton = "<a href='pos.php?edit_id=" . $sale_id . "&ref_id=" . $sale_invoice . "' class='btn btn-sm btn-outline-success'><i class='icon-pencil'></i></a>";

            $returnButton = "<a href='sale_return.php?sale_id=" . $sale_id . "' class='btn btn-sm btn-outline-info'>Sale Return</a>";
          }
          if ($D == '1') {
            $deleteButton = "<a href='operations/delete.php?pos_sale_id=" . $sale_id . "&ref_id=" . $sale_invoice . "' class='btn btn-sm btn-outline-danger deleteUser'><i class='icon-trash'></i></a>";
          }
          $action = $big_invoice . " " . $small_invoice . " " . $updateButton . " " . $deleteButton . " " . $returnButton . " " . $completeButton . " " . $edit_customer . " " . $customer_balance;
          $net_amount_tot += $data['net_amount'];
          $amount_recieved_tot += $data['amount_recieved'];
      ?>
          <tr style="background-color: <?php echo $color; ?>">
            <th scope="row"><?php echo $offset; ?></th>
            <td style="font-size: 12px;"><?php echo $invoice_no; ?></td>
            <td style="font-size: 12px;"><span><?php echo $customer_name; ?></span></td>
            <td style="font-size: 12px;"><?php echo $table_name; ?></td>
            <td style="font-size: 12px;"><?php echo $net_amount; ?></td>
            <td style="font-size: 12px;"><?php echo $amount_recieved; ?></td>
            <td style="font-size: 12px;"><?php echo $newDate; ?></td>
            <td style="font-size: 12px;"><?php echo $status; ?></td>
            <td style="font-size: 12px;"><?php echo $action; ?></td>
          </tr>

      <?php
        }
      } else {
        echo '<tr><td colspan="6">No records found...</td></tr>';
      }
      ?>
    </tbody>
    <tfoot class="bg-dark text-white">
      <tr>
        <th>Total</th>
        <th></th>
        <th></th>
        <th><?php echo $net_amount_tot; ?></th>
        <th><?php echo $amount_recieved_tot; ?></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </tfoot>
  </table>

  <!-- Display pagination links -->
  <?php echo $pagination->createLinks(); ?>
<?php
}
?><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</script>