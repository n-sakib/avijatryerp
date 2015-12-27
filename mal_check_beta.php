<?php 
	require_once "conn.php";

	$memo_no = $_POST['memo_no'];
	$pid = $_POST['pid'];
	$qty = $_POST['qty'];

	$result = mysqli_query($con, "SELECT * FROM sells WHERE memo_no = '$memo_no' AND pid = '$pid' LIMIT 1");

	$row = mysqli_fetch_array($result);

	if ($row['total_qty'] == $qty){
		echo "matched";
	} else {
		echo "doesnt match $row[total_qty]";
	}