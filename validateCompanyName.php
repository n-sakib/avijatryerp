<?php 
	require_once "conn.php";
	$company = $_POST['company'];
	$result = mysqli_query($con, "SELECT * FROM clients WHERE company_name = '$company' ");
	if (mysqli_num_rows($result) == 0 ){
		echo "invalid";
	}else{
		echo "valid";
	}
	