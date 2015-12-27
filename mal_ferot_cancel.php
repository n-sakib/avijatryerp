<?php 
	require_once "conn.php";
	$memo_no = $_POST['ferot_memo'];
 	mysqli_query($con,"UPDATE mal_ferot_memos SET checked = 1 WHERE memo_no = '$memo_no'");
 	if (mysqli_affected_rows($con)>0){
 		echo 'ok';
 	}