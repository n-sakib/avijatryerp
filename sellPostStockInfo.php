<?php 
	require_once "conn.php";
	$pid = $_POST['pid'];
	$result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid' LIMIT 1");
	$row = mysqli_fetch_array($result);

	echo "<input type=\"number\" name=\"qtys[]\" value=\"6\" id=\"qty1\" min="1\" max=\"5\" step=\"1\">";