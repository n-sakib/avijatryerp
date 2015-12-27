<?php 
	require_once "conn.php";
	$ferot_memo = $_POST['ferot_memo'];
	$sell_memo = $_POST['memo_no'];
	$client = $_POST['company_name'];
	/*
	$ferot_memo = 29;
	$sell_memo = 1;
	$client = "রাফা";*/

	$mal_ferot_result = mysqli_query($con,"SELECT * FROM mal_ferot WHERE memo_no = '$ferot_memo'");								
	//print_r($mal_ferot_result);
	while($ferot = mysqli_fetch_array($mal_ferot_result)){
		mysqli_query($con,"INSERT INTO sells (memo_no, pid, total_qty, retail_price, total_price, due, sell_type)
			VALUES ('$sell_memo', '$ferot[pid]', '$ferot[total_qty]', '$ferot[retail_price]', '$ferot[total_price]', '$ferot[due]', 'return')");
	}
	mysqli_query($con, "UPDATE mal_ferot_memos SET checked = 1 WHERE memo_no = '$ferot_memo'");
	echo "affected rows :".mysqli_affected_rows($con);
	//fetching info from mal ferot memos
	$ferot_result = mysqli_query($con, "SELECT * FROM mal_ferot_memos WHERE memo_no = '$ferot_memo' LIMIT 1");
	$ferot_row = mysqli_fetch_array($ferot_result);

	//fetching info from sell memos
	$sells_result = mysqli_query($con,"SELECT * FROM sell_memos WHERE company_name = '$client' ORDER BY table_index DESC LIMIT 1");
	$sell_row = mysqli_fetch_array($sells_result);
	
	//print_r($ferot_row);
	$due = $sell_row['due'] + $ferot_row['grand_total'] ;
	
	echo "due $due";
	mysqli_query($con, "INSERT INTO sell_memos (memo_no, company_name, total_qty, grand_total, due, sell_type, return_goods) 
	VALUES ('$sell_memo', '$client', '$ferot_row[total_qty]', '$ferot_row[grand_total]', '$due', 'return','$ferot_memo') ");
	