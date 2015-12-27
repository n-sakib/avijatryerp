<?php
	require_once ('conn.php');

	if($_POST["bank_name"]!=null){
		$sql="INSERT INTO banks (bank_name,acc_number) VALUES ('$_POST[bank_name]','$_POST[acc]')";

		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));

		echo "1 record added";		
		mysqli_close($con);
			}
	header('Location: new_bank.php?msg=success');
		
	} else {
		header('Location: new_bank.php?msg=fail');	
	}
	