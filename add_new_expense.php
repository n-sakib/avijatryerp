<?php
	require_once ('conn.php');
	require_once ('upload_expense_img.php');
	if($_POST["expense_name"]!=null){
		$sql="INSERT INTO other_expenses (expense_name,phone,photo) VALUES ('$_POST[expense_name]','$_POST[phone]','$path')";

		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));

		echo "1 record added";		
		mysqli_close($con);
			}
	header('Location: new_expenses.php?msg=success');
		
	} else {
		header('Location: new_expenses.php?msg=fail');	
	}
	