<?php 
	require_once "conn.php";
	$categs = $_POST['categs'];
	mysqli_query($con,"UPDATE `other_expenses` SET `report`=0 WHERE 1");
	foreach($categs as $index => $categ){
		mysqli_query($con,"UPDATE other_expenses SET report = 1 WHERE expense_name = '$categ'");
	}
	header('Location: reports.php');