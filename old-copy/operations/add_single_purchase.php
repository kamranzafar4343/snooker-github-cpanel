<?php
include "../includes/config.php";
include "../includes/session.php";




// print_r($_POST);

	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	$vendor=mysqli_real_escape_string($conn, $_POST['vendor']);
	$net_amount=mysqli_real_escape_string($conn, $_POST['net_amount']);
	$gross_amount=mysqli_real_escape_string($conn, $_POST['gross_amount']);
	$discount=mysqli_real_escape_string($conn, $_POST['discount']);

	$location=mysqli_real_escape_string($conn, $_POST['location']);
	$invoice_no=mysqli_real_escape_string($conn, $_POST['invoice_no']);

	$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
	$po_remarks=mysqli_real_escape_string($conn, $_POST['po_remarks']);
    $iemi=mysqli_real_escape_string($conn, $_POST['iemi']);
    $custom_narration=mysqli_real_escape_string($conn, $_POST['narration']);
	$bill_status='Pending';
	date_default_timezone_set("Asia/Karachi");
    $created_date=date("Y-m-d h:i:s");
	$created_by=$userid;
    if($iemi=='1')
    {
        $PO='Local Purchase (IEMI)';
        $bill_status='Pending';
    }
    else
    {
        $PO='Local Purchase';
        $bill_status='Pending';
    }
    $sql1 = mysqli_query($conn,"SELECT product,barcode, item_serial from tbl_single_purchase_detail Where purchase_id='$edit_id'");
       while($data = mysqli_fetch_assoc($sql1))
       {

        $product=$data['product'];
        $barcode=$data['barcode'];
        $item_serial=$data['item_serial'];

        $sql2 = mysqli_query($conn,"SELECT product  from tbl_sale_detail Where product='$product' and barcode='$barcode' and item_serial='$item_serial'");
        
        $sql3 = mysqli_query($conn,"SELECT item_id from tbl_installment Where item_id='$product' and barcode='$barcode' and item_serial='$item_serial'");
        
    
            if (mysqli_num_rows($sql2)!=0 || mysqli_num_rows($sql3)!=0) {
                
                header('Location: ../single_purchase.php?edit=unsuccessful');
                exit;
            }
      }
    $sql=mysqli_query($conn, "SELECT branch_id, created_by  FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $branch_id=$data['branch_id'];
                                $created=$data['created_by'];
                                if($branch_id=='')
                                {
                                  $parent_id=$created;
                                }
                                else
                                {
                                  $parent_id=$userid;
                                }

if($edit_id!='')
{
	 	$sql=mysqli_query($conn, "UPDATE tbl_single_purchase SET  location='$location', narration='$custom_narration', vendor_id='$vendor', invoice_no='$invoice_no', invoice_date='$invoice_date',po_remarks='$po_remarks', net_amount='$net_amount', gross_amount='$gross_amount',amount_payed='',amount_remaining='',bill_status='$bill_status',payment_status='Pending', discount='$discount', created_date='$created_date', created_by='$created_by', parent_id='$parent_id' where purchase_id='$edit_id'");

	 	$invoice_no="Local_Purchase"."_".$edit_id;
  	
  	$sql=mysqli_query($conn, "DELETE FROM tbl_single_purchase_detail WHERE purchase_id = $edit_id");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");

     $pur_item_id_start='8000';
        $sql=mysqli_query($conn, "SELECT pur_item_id FROM tbl_single_purchase_detail  ORDER BY pur_item_id DESC");
        $data = mysqli_fetch_assoc($sql);
        $pur_item_id=$data['pur_item_id'];            
        if($pur_item_id>0)
        {
            ++$pur_item_id;  
        }
        else
        {
           $pur_item_id=$pur_item_id_start;
        } 
            
      for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
            $pur_item_id++;
            if($iemi=='1')
            {
                $sql = "INSERT INTO tbl_single_purchase_detail (purchase_id, invoice_no, product, qty, qty_rec, rate, amount,barcode,item_serial,pur_item_id, created_date, created_by, parent_id, iemi) VALUES ('$purchaseid', '$invoice_no','" . $_POST["product"][$a] . "', '" . $_POST["qty"][$a] . "', '" . $_POST["qty"][$a] . "', '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "',  '" . $_POST["barcode"][$a] . "',  '" . $_POST["item_serial"][$a] . "', '$pur_item_id', '$created_date', '$created_by', '$parent_id', '$iemi')";
            }
            else
            {
                $sql = "INSERT INTO tbl_single_purchase_detail (purchase_id, invoice_no, product, qty, rate, amount,barcode,item_serial,pur_item_id, created_date, created_by, parent_id, iemi) VALUES ('$purchaseid', '$invoice_no','" . $_POST["product"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "',  '" . $_POST["barcode"][$a] . "',  '" . $_POST["item_serial"][$a] . "', '$pur_item_id', '$created_date', '$created_by', '$parent_id', '$iemi')";

            }


            mysqli_query($conn, $sql);
        }    

    $purchaseid=$edit_id ;  
    $narration=" ".$PO." # ".$purchaseid." Net Amount was ".$net_amount." Transaction Date was ".$invoice_date."  Complete Stock Received on ".$created_date." (CUSTOM NARRATION =". $custom_narration.")";
	$v_type='SR';



$vendor_id=mysqli_real_escape_string($conn, $_POST['vendor']);

	$sql=mysqli_query($conn, "INSERT INTO tbl_trans(vendor_id, invoice_no, narration, total_amount, v_type, bill_status ,created_date, created_by, parent_id) VALUES ('$vendor_id', '$invoice_no', '$narration', '$net_amount',  '$v_type', '$bill_status', '$created_date', '$userid', '$parent_id')");


$tran_id = mysqli_insert_id($conn); 


$sql=mysqli_query($conn, "SELECT user_privilege, created_by FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                                if($user_privilege!='branch' && $created_by=='1')
                                {
                                  $stock_acode='100300000';
                                }
                                else
                                {
                                  $stock_acode='100900000';
                                }

$narration1 ="".$PO." # ".$purchaseid." Net Amount was ".$net_amount." Transaction Date was ".$invoice_date."  Complete Stock Received on ".$created_date." (CUSTOM NARRATION =". $custom_narration.")";
$narration2 =" Payment Pending to Vendor against ".$PO." # ".$purchaseid." is ".$net_amount." Transaction Date was ".$invoice_date." (CUSTOM NARRATION =". $custom_narration.")";

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tran_id', '$invoice_no', '$stock_acode','$net_amount', '0.00','$bill_status', '$narration1', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tran_id', '$invoice_no', '$vendor_id', '0.00', '$net_amount', '$bill_status', '$narration2', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);
  
	if($sql){
		header('Location: ../single_purchase.php?updated=done');
	}
	 
}
//////////////////////////////////////////////
else
{


	$net_amount=mysqli_real_escape_string($conn, $_POST['net_amount']);
	$vendor=mysqli_real_escape_string($conn, $_POST['vendor']);
	

 	$sql=mysqli_query($conn, "INSERT INTO tbl_single_purchase(location,narration, iemi, vendor_id, invoice_no, invoice_date, po_remarks, net_amount, gross_amount, discount,bill_status, payment_status, created_date, created_by,parent_id) VALUES ('$location','$custom_narration', '$iemi', '$vendor', '$invoice_no', '$invoice_date', '$po_remarks', '$net_amount', '$gross_amount', '$discount','$bill_status','Pending', '$created_date', '$userid','$parent_id')");

 	$purchaseid = mysqli_insert_id($conn); 
	$invoice_no="Local_Purchase"."_".$purchaseid;
        $pur_item_id_start='8000';
        $sql=mysqli_query($conn, "SELECT pur_item_id FROM tbl_single_purchase_detail  ORDER BY pur_item_id DESC");
        $data = mysqli_fetch_assoc($sql);
        $pur_item_id=$data['pur_item_id'];            
        if($pur_item_id>0)
        {
            ++$pur_item_id;  
        }
        else
        {
           $pur_item_id=$pur_item_id_start;
        } 
            
	  for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
            $pur_item_id++;
            $product=$_POST["product"][$a];
            $item=explode(',', $product);
            $itemid=$item[0];
            if($iemi=='1')
            {
                $qty_local=$_POST["qty"][$a];
                $qty_pur=$_POST["qty_allowed"][$a];
                $pur_req_id=$_POST["pur_req_id"][$a];
                if($qty_local==$qty_pur)
                {
                    $status=1;
                }
                else
                {
                    $status=0;
                }
         
                $sql=mysqli_query($conn, "UPDATE tbl_local_purchase SET qty_purchased='$qty_local', status='$status'  WHERE pur_req_id='$pur_req_id' and product='$itemid'");
                $sql = "INSERT INTO tbl_single_purchase_detail (purchase_id, invoice_no, product, qty, rate, amount,barcode,item_serial,pur_item_id, created_date, created_by, parent_id, iemi) VALUES ('$purchaseid', '$invoice_no','$itemid', '" . $_POST["qty"][$a] . "', '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "',  '" . $_POST["barcode"][$a] . "',  '" . $_POST["item_serial"][$a] . "', '$pur_item_id', '$created_date', '$created_by', '$parent_id', '$iemi')";
                mysqli_query($conn, $sql);
           
            }
            else
            {
                $qty_local=$_POST["qty"][$a];
                $qty_pur=$_POST["qty_allowed"][$a];
                $pur_req_id=$_POST["pur_req_id"][$a];
                if($qty_local==$qty_pur)
                {
                    $status=1;
                }
                else
                {
                    $status=0;
                }
         
                $sql=mysqli_query($conn, "UPDATE tbl_local_purchase SET qty_purchased='$qty_local', status='$status'  WHERE pur_req_id='$pur_req_id' and product='$itemid'");
                 $sql = "INSERT INTO tbl_single_purchase_detail (purchase_id, invoice_no, product, qty, rate, amount,barcode,item_serial,pur_item_id, created_date, created_by, parent_id, iemi) VALUES ('$purchaseid', '$invoice_no', '$itemid', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "',  '" . $_POST["barcode"][$a] . "',  '" . $_POST["item_serial"][$a] . "', '$pur_item_id', '$created_date', '$created_by', '$parent_id', '$iemi')";
                mysqli_query($conn, $sql);

            }



            
        }
//////////////////////////////////////////////////////////////////////Account///////////////////////////////////////////////////////////////////////////
	$narration=" ".$PO." # ".$purchaseid." Net Amount was ".$net_amount." Transaction Date was ".$invoice_date."  Complete Stock Received on ".$created_date." (CUSTOM NARRATION =". $custom_narration.")";
	$v_type='SR';

if($iemi=='1')
            {

$vendor_id=mysqli_real_escape_string($conn, $_POST['vendor']);

	$sql=mysqli_query($conn, "INSERT INTO tbl_trans(vendor_id, invoice_no, narration, total_amount, v_type, bill_status ,created_date, created_by, parent_id) VALUES ('$vendor_id', '$invoice_no', '$narration', '$net_amount',  '$v_type', '$bill_status', '$created_date', '$created_by', '$parent_id')");


$tran_id = mysqli_insert_id($conn); 


$sql=mysqli_query($conn, "SELECT user_privilege, created_by FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                                if($user_privilege!='branch' && $created_by=='1')
                                {
                                  $stock_acode='100300000';
                                }
                                else
                                {
                                  $stock_acode='100900000';
                                }

$narration1 ="".$PO." # ".$purchaseid." Net Amount was ".$net_amount." Transaction Date was ".$invoice_date."  Complete Stock Received on ".$created_date." (CUSTOM NARRATION =". $custom_narration.")";
$narration2 =" Payment Pending to Vendor against ".$PO." # ".$purchaseid." is ".$net_amount." Transaction Date was ".$invoice_date." (CUSTOM NARRATION =". $custom_narration.")";

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tran_id', '$invoice_no', '$stock_acode','$net_amount', '0.00','$bill_status', '$narration1', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tran_id', '$invoice_no', '$vendor_id', '0.00', '$net_amount', '$bill_status', '$narration2', '$created_date', '$userid', '$parent_id')";
            mysqli_query($conn, $sql);
}            
   

	if($sql){
		header('Location: ../single_purchase.php?added=done');
	}

}

?>