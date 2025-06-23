<?php

include "../includes/config.php";

if($_POST['bank_id'])
{


$bank_id = $_POST['bank_id'];


// selecting posts
				$sql6=mysqli_query($conn, "SELECT  SUM(opening_bal) as opening_bal  FROM `tbl_account_lv2` WHERE acode='$bank_id'");

                $data6=mysqli_fetch_assoc($sql6);
                $opening_bal_bank = $data6['opening_bal'];

                $sql5=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_at_bank FROM `tbl_trans_detail` WHERE acode='$bank_id'");

                $data5=mysqli_fetch_assoc($sql5);
                $cash_at_bank = $data5['cash_at_bank'];

                $cash=$opening_bal_bank+$cash_at_bank;

echo json_encode($cash);

}
//////////////////////////////////////////////////////////////////////////////






