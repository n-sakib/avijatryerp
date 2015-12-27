<?php 
	require_once "conn.php";

	$result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$_POST[pid]' LIMIT 1");							
	$row = mysqli_fetch_array($result);

	echo $row['cost_price'];
