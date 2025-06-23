
<?php
include "../includes/config.php";
$output = '';
if(isset($_POST["query"]))
{
  $search = mysqli_real_escape_string($conn, $_POST["query"]);
  $query = "SELECT * FROM tbl_items INNER JOIN tbl_purchase_detail ON tbl_items.item_id = tbl_purchase_detail.product WHERE product IN (SELECT item_id FROM tbl_items GROUP BY item_id HAVING COUNT(*) > 0) and item_name LIKE '%$search%' OR barcode LIKE '%$search%' OR item_serial LIKE '%$search%' LIMIT 50";
}
else
{
  $query = "SELECT * FROM tbl_items INNER JOIN tbl_purchase_detail ON tbl_items.item_id = tbl_purchase_detail.product WHERE product IN (SELECT item_id FROM tbl_items GROUP BY item_id HAVING COUNT(*) > 0) and item_name LIKE '%$search%' OR barcode LIKE '%$search%' OR item_serial LIKE '%$search%' LIMIT 50";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
  $output .= '<div class="table-responsive">
          <table class="table table bordered">
            <tr>
              <th>Item Name</th>
              
            </tr>';
  while($row = mysqli_fetch_array($result))
  {
    $output .= '
      <tr>
        <td>'.$row["item_name"].'</td>
        
      </tr>
    ';
  }
  echo $output;
}
else
{
  echo 'Data Not Found';
}
?>
