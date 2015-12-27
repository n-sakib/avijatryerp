<?php 
	require_once "conn.php";
	$info_result = mysqli_query($con,"SELECT * FROM sell_memos WHERE memo_no = '$memo_no' ORDER BY table_index DESC LIMIT 1");
	$memo_info = mysqli_fetch_array($info_result) ;

	$client_name = $_GET['client'];
	$date_sold = date('Y-m-d hh:mm:ss');
	
	$info_result = mysqli_query($con,"SELECT * FROM clients WHERE company_name = '$client_name'LIMIT 1");
	$client_info = mysqli_fetch_array($info_result) ;

	$client_addr = $client_info['address'];
	?>

