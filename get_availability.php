<?php 
	require_once "conn.php";
	
	if($_POST['genres'] != 0 && $_POST['types'] != ''&& $_POST['colors'] != 0 ){
		$result = mysqli_query($con,"SELECT * FROM factories WHERE factory_name = '$_POST[factories]' LIMIT 1");
		$row = mysqli_fetch_array($result);
		$factory_no = $row['table_index'];
		$factory_no = str_pad($factory_no, 3, "0", STR_PAD_LEFT);
		$type_no = str_pad($_POST['types'], 2, "0", STR_PAD_LEFT);
		$color_no = str_pad($_POST['colors'], 2, "0", STR_PAD_LEFT);
		$design_no = str_pad($_POST['designs'], 3, "0", STR_PAD_LEFT);

		$pid = "$factory_no$_POST[genres]$type_no$color_no$design_no";

		$result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid' ");
		if(mysqli_num_rows($result) == 0){
			//$some = mysqli_num_rows($result);
			//echo "$num $pid ";
			//echo "$pid asas";
			//echo "নতুন $pid";
			echo "নতুন";
		} else{ 
			echo "আগের মাল";}

	} else {
		echo 'সবগুলো অপশন সিলেক্ট করুন';
	}


	

