<?php 
	require "conn.php";
	$input = $_POST['input'];
	$table = $_POST['table_name'];
	$field = $_POST['field_name'];
	$query = 'SELECT * FROM '.$table.' WHERE '.$field.' = \''.$input.'\'';
	$result = mysqli_query($con,"$query");             
	$row = mysqli_fetch_array($result);      
	if(mysqli_num_rows($result)!=0){
		echo 'duplicate';
	} else{ echo 'ok';}