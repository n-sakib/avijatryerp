<?php 
	require_once "conn.php";
	$factory = $_POST['factory'];
	$result = mysqli_query($con, "SELECT * FROM factories WHERE factory_name = '$factory' ");
	if (mysqli_num_rows($result) == 0 ){
		echo "invalid";
	}else{
		echo "valid";
	}
	