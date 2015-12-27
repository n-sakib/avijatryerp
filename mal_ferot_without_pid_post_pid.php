<?php 
require_once "conn.php";
	$result = mysqli_query($con,"SELECT * FROM factories WHERE factory_name = '$_POST[factories]' LIMIT 1");
	$row = mysqli_fetch_array($result);
	$factory_no = $row['table_index'];
	$factory_no = str_pad($factory_no, 3, "0", STR_PAD_LEFT);

	$pid = "$factory_no$_POST[genres]$_POST[types]$_POST[colors]$_POST[designs]";

	$result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid' LIMIT 1");
	$row = mysqli_fetch_array($result);
	$num = mysqli_fetch_array($result) + 0;
	
    echo $pid ;


