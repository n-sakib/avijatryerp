<?php 
	require_once "conn.php";
	
	if($_POST['genres'] != 0 && $_POST['types'] != 0 && $_POST['colors'] != 0 ){
		$result = mysqli_query($con,"SELECT * FROM factories WHERE factory_name = '$_POST[factories]' LIMIT 1");
		$row = mysqli_fetch_array($result);
		$factory_no = $row['table_index'];
		$factory_no = str_pad($factory_no, 3, "0", STR_PAD_LEFT);
		$type = str_pad($_POST['types'], 2, "0", STR_PAD_LEFT);
		$color = str_pad($_POST['colors'], 2, "0", STR_PAD_LEFT);		
		$design = str_pad($_POST['designs'], 3, "0", STR_PAD_LEFT);

		$pid = "$factory_no$_POST[genres]$type$color$design";

		$result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid' LIMIT 1");
		$row = mysqli_fetch_array($result);
		echo $pid;
	} else {
		echo 'জেনারেট হয়নি';
	}


	

