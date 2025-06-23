<?php

include "../includes/config.php";

if($_POST['account'])
{


$account = $_POST['account'];



       $query3 = mysqli_query($conn,"SELECT SUM(d_amount-c_amount) as balance FROM `tbl_trans_detail` where acode='$account'");

       $data3=mysqli_fetch_assoc($query3);
       $balance = $data3['balance'];

       $sql9=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal1 FROM tbl_account_lv2 where acode='$account'");
                     
               while($row=mysqli_fetch_assoc($sql9))
                    {

                        $opening_bal1 = $row['opening_bal1'];
                        if($opening_bal1=='')
                        {
                           $opening_bal1=0; 
                        }
                    }
       $sql7=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where acode='$account'");
                     
                    while($row=mysqli_fetch_assoc($sql7))
                    {

                        $opening_bal = $row['opening_bal'];
                        if($opening_bal=='')
                        {
                           $opening_bal=0; 
                        }
                    }

     $total_opening=round($balance+$opening_bal+$opening_bal1);
      
      $users_arr[] = array("total_opening" => $total_opening);

 



echo round($total_opening);

}