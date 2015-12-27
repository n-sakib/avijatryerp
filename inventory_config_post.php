<?php
	require_once ('conn.php');

	if(isset($_POST["type"])){
		$result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = '$_POST[genre]' ORDER BY table_index DESC LIMIT 1");							
		$row = mysqli_fetch_array($result);

		$serial = null;
		if(mysqli_num_rows($result)!=0){
			$last = $row['serial_no'];
			$serial = $last + 1;
		} else{ $serial = 1;}


		$sql="INSERT INTO inventory_config_types (type,genre,serial_no) VALUES ('$_POST[type]','$_POST[genre]','$serial')";

		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));

		echo "1 record added";		
		mysqli_close($con);
			}
	header('Location: inventory_configuration.php?msg=success');
		
	}
	else if(isset($_POST["color"])){
		$result = mysqli_query($con,"SELECT * FROM inventory_config_colors ORDER BY table_index DESC LIMIT 1");							
		$row = mysqli_fetch_array($result);

		$serial_no = null;
		if(mysqli_num_rows($result)!=0){
			$last = $row['serial_no'];
			$serial_no = $last + 1;
		} else{ $serial_no = 1;}

		$sql="INSERT INTO inventory_config_colors (color,serial_no) VALUES ('$_POST[color]','$serial_no')";

		if (!mysqli_query($con,$sql))
		{
			die('Error: ' . mysqli_error($con));

		echo "1 record added";		
		mysqli_close($con);
			}
	header('Location: inventory_configuration.php?msg=success');
		
	}else {
		header('Location: inventory_configuration.php?msg=fail');	
	}
