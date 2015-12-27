<?php
	require_once ('conn.php');
	require_once ('upload_factory_img.php');
	if($_POST["factory_name"]!=null){
		$sql="INSERT INTO factories (factory_name, address, photo, phone) 
		VALUES ('$_POST[factory_name]','$_POST[address]','$path','$_POST[phone]')";

		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));

		echo "1 record added";		
		mysqli_close($con);
			}
	header('Location: new_factory.php?msg=success');
		
	} else {
		header('Location: new_factory.php?msg=fail');	
	}
	