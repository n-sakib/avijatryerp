<?php
	require_once ('conn.php');
	require_once ('upload_client_img.php');
	//$path= 'img/clients/' . utf8_encode($file_name) . $ext;
	if($_POST["company_name"]!=null ){
		$sql="INSERT INTO clients (company_name, address, phone, check_no, stamp_no, n_id, photo) 
		VALUES ('$_POST[company_name]','$_POST[address]','$_POST[phone]','$_POST[check_no]','$_POST[stamp_no]','$_POST[n_id]','$path')";

		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));

		echo "1 record added";		
		mysqli_close($con);
			}
	header('Location: new_client.php?msg=success');
		
	} else {
		header('Location: new_client.php?msg=fail');	
	}

	/*if($_POST["company_name"]!=null && $_POST["address"]!=null && $_POST["phone"]!=null && $_POST["check_no"]!=null && $_POST["check_no"]!=null && $_POST["check_no"]!=null && $_POST["n_id"]!=null){
		header('Location: http://localhost/avijatry_client_reg_beta/new_client.php?msg=success');
	
	} else {
		header('Location: http://localhost/avijatry_client_reg_beta/new_client.php?msg=fail');	
	}*/
	