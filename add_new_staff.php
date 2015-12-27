<?php
	require_once ('conn.php');
	require_once ('upload_staff_img.php');
	if($_POST["staff_name"]!=null){
		$sql="INSERT INTO staffs (staff_name,phone,photo) VALUES ('$_POST[staff_name]','$_POST[phone]','$path')";

		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));

		echo "1 record added";		
		mysqli_close($con);
			}
	header('Location: new_staff.php?msg=success');
		
	} else {
		header('Location: new_staff.php?msg=fail');	
	}
	