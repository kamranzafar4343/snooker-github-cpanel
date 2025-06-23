<?php
include "../includes/config.php";
include "../includes/session.php";
if (isset($_POST['add_head'])) {
		
	$aname=mysqli_real_escape_string($conn, $_POST['aname']);
	
	$head_id=mysqli_real_escape_string($conn, $_POST['head_id']);
	$date=date('Y-m-d');
	
	


	if($head_id!=''){
$sql=mysqli_query($conn, "update tbl_head set aname='$aname' where id='$head_id' ");
	
	if($sql){
		header('Location:../add_account.php?update=successfull');
	}
	else{
		header('Location:../add_account.php?update=unsuccessfull');
	}
}else{
	$lsql=mysqli_query($conn, "SELECT LEFT(acode,1) FROM tbl_head order by id DESC LIMIT 1");
	if(mysqli_num_rows($lsql)>0){ 
	
		$data=mysqli_fetch_assoc($lsql);
		$acodes=$data['LEFT(acode,1)'];
	

			$acode = ++$acodes;
			$acode = $acode.'00000000';
		
		
	}
	else{
		
		$acode='100000000';
		
	}
		$sql=mysqli_query($conn, "insert into tbl_head(aname, acode, created_by, created_date) values('$aname', '$acode', '$userid', '$date') ");
if($sql){
		header('Location:../add_account.php?insert=successfull');
	}
	else{
		header('Location:../add_account.php?insert=unsuccessfull');
	}
}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////


if (isset($_POST['add_subhead'])) {
	
	$aname=mysqli_real_escape_string($conn, $_POST['aname']);
	$parent_code=mysqli_real_escape_string($conn, $_POST['parent_code']);
	$subhead_id=mysqli_real_escape_string($conn, $_POST['subhead_id']);
	$date=date('Y-m-d');
	
	


if($subhead_id!=''){
		$sql=mysqli_query($conn, "update tbl_account set aname='$aname' where id='$subhead_id' ");
			
			if($sql){
				header('Location:../add_account.php?update=successfull');
			}
			else{
				header('Location:../add_account.php?update=unsuccessfull');
			}
		}
else{


		$lsql=mysqli_query($conn, "SELECT LEFT(acode,3) FROM tbl_head where acode='$parent_code'");
		$data=mysqli_fetch_assoc($lsql);
		$acodes1=$data['LEFT(acode,3)'];
		

		$bsql=mysqli_query($conn, "SELECT RIGHT(acode,7) FROM tbl_account where parent_code='$parent_code' order by id DESC LIMIT 1");
		if(mysqli_num_rows($bsql)>0){ 
		
			$data=mysqli_fetch_assoc($bsql);
			$acodes=$data['RIGHT(acode,7)'];
			$acodes+=100000;
			$acode=$acodes1.$acodes;
		
	
		}
		else{
			
			$acode=$acodes1.+100000;
			
		}

	
		$sql=mysqli_query($conn, "insert into tbl_account(parent_code ,aname, acode, created_by, created_date) values('$parent_code' ,'$aname', '$acode', '$userid', '$date') ");
if($sql){
		header('Location:../add_account.php?insert=successfull');
	}
	else{
		header('Location:../add_account.php?insert=unsuccessfull');
	}
}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////


if (isset($_POST['subhead_lv2'])) {
	
	$aname=mysqli_real_escape_string($conn, $_POST['aname']);
	$parent_code=mysqli_real_escape_string($conn, $_POST['parent_code']);
	$sub_child1=mysqli_real_escape_string($conn, $_POST['sub_child1']);
	$subchild_id=mysqli_real_escape_string($conn, $_POST['subchild_id']);
	$date=date('Y-m-d');
	
	


if($subchild_id!=''){
		$sql=mysqli_query($conn, "DELETE FROM tbl_account_lv2 WHERE id=$subchild_id");
		
		$lsql=mysqli_query($conn, "SELECT LEFT(acode,6) FROM tbl_account where acode='$sub_child1'");
		$data=mysqli_fetch_assoc($lsql);
		$acodes1=$data['LEFT(acode,6)'];
		
		$bsql=mysqli_query($conn, "SELECT RIGHT(acode,3) FROM tbl_account_lv2 where sub_child1='$sub_child1' order by id DESC LIMIT 1");
		if(mysqli_num_rows($bsql)>0){ 
		
			$data=mysqli_fetch_assoc($bsql);
			$acodes=$data['RIGHT(acode,3)'];
			$acodes+=100;
			$acode=$acodes1.$acodes;
			

	
		}
		else{
			
			$acode=$acodes1.+100;
			

		}

	
		$sql=mysqli_query($conn, "insert into tbl_account_lv2(parent_code , sub_child1, aname, acode, created_by, created_date) values('$parent_code' , '$sub_child1','$aname', '$acode', '$userid', '$date') ");
if($sql){
		header('Location:../add_account.php?insert=successfull');
	}
	else{
		header('Location:../add_account.php?insert=unsuccessfull');
	}
		}
else{


		$lsql=mysqli_query($conn, "SELECT LEFT(acode,6) FROM tbl_account where acode='$sub_child1'");
		$data=mysqli_fetch_assoc($lsql);
		$acodes1=$data['LEFT(acode,6)'];
		
		$bsql=mysqli_query($conn, "SELECT RIGHT(acode,3) FROM tbl_account_lv2 where sub_child1='$sub_child1' order by id DESC LIMIT 1");
		if(mysqli_num_rows($bsql)>0){ 
		
			$data=mysqli_fetch_assoc($bsql);
			$acodes=$data['RIGHT(acode,3)'];
			$acodes+=100;
			$acode=$acodes1.$acodes;
			

	
		}
		else{
			
			$acode=$acodes1.+100;
			

		}

	
		$sql=mysqli_query($conn, "insert into tbl_account_lv2(parent_code , sub_child1, aname, acode, created_by, created_date) values('$parent_code' , '$sub_child1','$aname', '$acode', '$userid', '$date') ");
if($sql){
		header('Location:../add_account.php?insert=successfull');
	}
	else{
		header('Location:../add_account.php?insert=unsuccessfull');
	}
}
}

////////////////////////////////////////////////////////////////Opening//////////////////////////////////////
if (isset($_POST['opening'])) {
	
	$child=mysqli_real_escape_string($conn, $_POST['child']);
	$sub_child1=mysqli_real_escape_string($conn, $_POST['sub_child1']);
	$opening_bal=mysqli_real_escape_string($conn, $_POST['opening_bal']);
	$opening_date=date('Y-m-d');
	

if($child!='' && $child!='0'){

		$lsql=mysqli_query($conn, "SELECT opening_bal FROM tbl_account_lv2 where acode='$child'");
		$data=mysqli_fetch_assoc($lsql);
		$opening_bal1=$data['opening_bal'];
		//$new_bal=round($opening_bal1+$opening_bal);
		$sql=mysqli_query($conn, "UPDATE tbl_account_lv2 set opening_bal='$opening_bal', opening_date='$opening_date' where acode='$child'");
		
}
else{
	$lsql=mysqli_query($conn, "SELECT opening_bal FROM tbl_account where acode='$sub_child1'");
		$data=mysqli_fetch_assoc($lsql);
		$opening_bal1=$data['opening_bal'];
		//$new_bal=round($opening_bal1+$opening_bal);
	$sql=mysqli_query($conn, "UPDATE tbl_account set opening_bal='$opening_bal', opening_date='$opening_date' where acode='$sub_child1'");
}


if($sql){
		header('Location:../chart_of_account.php?insert=successfull');
	}
	else{
		header('Location:../chart_of_account.php?insert=unsuccessfull');
	}
		}



?>