<?php 
	$pid= $_POST['pid'];

	require "conn.php";
	$inventory_result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid' LIMIT 1");               
	$inventory = mysqli_fetch_array($inventory_result) ;

	//getting description
	$genre = '';
	if ($inventory['genre'] == 1) {
	$genre = 'জেন্টস' ;
	} else if ($inventory['genre'] == 2) {
	$genre = 'লেডিস';
	} else if ($inventory['genre'] == 3) {
	$genre = 'সু';
	} else if ($inventory['genre'] == 4) {
	$genre = 'বেবি';
	} else{}

	$type_result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = '$inventory[genre]' AND serial_no = '$inventory[type]' LIMIT 1");                
	$type = mysqli_fetch_array($type_result) ;
	$type = $type['type'];

	$color_result = mysqli_query($con,"SELECT * FROM inventory_config_colors WHERE serial_no = '$inventory[color]' LIMIT 1");               
	$color = mysqli_fetch_array($color_result) ;
	$color = $color['color'];

	$description = "$genre $type $color";
	if ($description != " "){
		echo $description;	
	} else{
		echo 'পাওয়া যায়নি';
	}
	